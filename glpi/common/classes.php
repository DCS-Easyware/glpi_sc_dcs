<?php
/*

  ----------------------------------------------------------------------
GLPI - Gestionnaire libre de parc informatique
 Copyright (C) 2002 by the INDEPNET Development Team.
 Bazile Lebeau, baaz@indepnet.net - Jean-Mathieu Dol�ans, jmd@indepnet.net
 http://indepnet.net/   http://glpi.indepnet.org
 ----------------------------------------------------------------------
 Based on:
IRMA, Information Resource-Management and Administration
Christian Bauer, turin@incubus.de 

 ----------------------------------------------------------------------
 LICENSE

This file is part of GLPI.

    GLPI is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    GLPI is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with GLPI; if not, write to the Free Software
    Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 ----------------------------------------------------------------------
 Original Author of file:
 Purpose of file:
 ----------------------------------------------------------------------
*/
// And Julien Dombre for externals identifications


class DBmysql {

	var $dbhost	= ""; 
	var $dbuser = ""; 
	var $dbpassword	= "";
	var $dbdefault	= "";
	var $dbh;

	function DB()
	{  // Constructor
		$this->dbh = mysql_connect($this->dbhost, $this->dbuser, $this->dbpassword);
		mysql_select_db($this->dbdefault);
	}
	function query($query) {
		return mysql_query($query);
	}
	function result($result, $i, $field) {
		return mysql_result($result, $i, $field);
	}
	function numrows($result) {
		return mysql_num_rows($result);
	}
	function fetch_array($result) {
		return mysql_fetch_array($result);
	}
	function fetch_row($result) {
		return mysql_fetch_row($result);
	}
	function fetch_assoc($result) {
		return mysql_fetch_assoc($result);
	}
	function num_fields($result) {
		return mysql_num_fields($result);
	}
	function field_name($result,$nb)
	{
		return mysql_field_name($result,$nb);
	}
	function list_tables() {
		return mysql_list_tables($this->dbdefault);
	}
	function errno()
	{
		return mysql_errno();
	}

	function error()
	{
		return mysql_error();
	}
	function close()
	{
		return mysql_close($this->dbh);
	}
	
}

class Connection {

	var $ID				= 0;
	var $end1			= 0;
	var $end2			= 0;
	var $type			= 0;
	var $device_name	= "";
	var $device_ID		= 0;

	function getComputerContact ($ID) {
		$db = new DB;
		$query = "SELECT * FROM connect_wire WHERE (end1 = '$ID' AND type = '$this->type')";
		if ($result=$db->query($query)) {
			$data = $db->fetch_array($result);
			$this->end2 = $data["end2"];
			return $this->end2;
		} else {
				return false;
		}
	}

	function getComputerData($ID) {
		$db = new DB;
		$query = "SELECT * FROM computers WHERE (ID = '$ID')";
		if ($result=$db->query($query)) {
			$data = $db->fetch_array($result);
			$this->device_name = $data["name"];
			$this->device_ID = $ID;
			return true;
		} else {
			return false;
		}
	}

	function deleteFromDB($ID) {

		$db = new DB;

		$query = "DELETE from connect_wire WHERE (end1 = '$ID' AND type = '$this->type')";
		if ($result = $db->query($query)) {
			return true;
		} else {
			return false;
		}
	}

	function addToDB() {
		$db = new DB;

		// Build query
		$query = "INSERT INTO connect_wire (end1,end2,type) VALUES ('$this->end1','$this->end2','$this->type')";
		if ($result=$db->query($query)) {
			return true;
		} else {
			return false;
		}
	}

}

class Identification
{
	var $err;
	var $user;

	//constructor for class Identification
	function Identification()
	{
		//echo "il est pass� par ici";
		$this->err = "";
		$this->user = new User;
	}


	//return 1 if the (IMAP/pop) connection to host $host, using login $login and pass $pass
	// is successfull
	//else return 0
	function connection_imap($host,$login,$pass)
	{
		error_reporting(16);
		if($mbox = imap_open($host,$login,$pass))
		//if($mbox)$mbox =
		{
			imap_close($mbox);
			return 1;
		}
		else
		{
			$this->err = imap_last_error();
			imap_close($mbox);
			return 0;
		}
	}


	// void;
	//try to connect to DB
	//update the instance variable user with the user who has the name $name
	//and the password is $password in the DB.
	//If not found or can't connect to DB updates the instance variable err
	//with an eventual error message
	function connection_db_mysql($name,$password)
	{
		$db = new DB;
		$query = "SELECT * from users where (name = '".$name."' && password = PASSWORD('".$password."'))";
		$result = $db->query($query);
		//echo $query;
		if($result)
		{
			if($db->numrows($result))
			{
				$this->user->getFromDB($name);
				return 2;
			}
			else
			{
				$this->err = "Bad username or password";
				return 1;
			}
		}
		else
		{
			$err = "Erreur numero : ".$db->errno().": ";
			$err += $db->error();
			return 0;
		}

	}

	// Set Cookie for this user
	function setCookies()
	{
		$name = $this->user->fields['name'];
		$password = md5($this->user->fields['password']);
		$type = $this->user->fields['type'];
		session_start();
		$_SESSION["glpipass"] = $password;
		$_SESSION["glpiname"] = $name;
		$_SESSION["glpitype"] = $type;
		$_SESSION["authorisation"] = true;
	 	//SetCookie("IRMName", $name, 0, "/");
		//SetCookie("IRMPass", $password, 0, "/");
	}

	function eraseCookies()
	{
	$_SESSION["glpipass"] = "";
	$_SESSION["glpiname"] = "bogus";
	$_SESSION["glpitype"] = "";
	$_SESSION["authorisation"] = false;
	}

	//Add an user to DB or update his password if user allready exist.
	//The default type of the added user will be 'post-only'
	function add_an_user($name, $password, $host)
	{

		// Update user password if already known
		if ($this->connection_db_mysql($name,$password) == 2)
		{
			$update[0]="password";
			$this->user->fields["password"]=$password;
			$this->user->updateInDB($update);

		}// Add user if not known
		else
		{
			// dump status

			$this->user->fields["name"]=$name;
			if(empty($host))
			{
			$this->user->fields["email"]=$name;
			}
			else
			{
			$this->user->fields["email"]=$name."@".$host;
			}
			$this->user->fields["type"]="post-only";
			$this->user->fields["realname"]=$name;
			$this->user->fields["can_assign_job"]="no";
			$this->user->addToDB();
			$update[0]="password";
			$this->user->fields["password"]=$password;
    		$this->user->updateInDB($update);
		}

	}

	function getErr()
	{
		return $this->err;
	}
	function getUser()
	{
		return $this->user;
	}
}

class Mailing
{
	var $type=NULL;
	var $job=NULL;
	// User who change the status of the job
	var $user=NULL;
 
	function Mailing ($type="",$job=NULL,$user=NULL)
	{
		$this->type=$type;
		$this->job=$job;
		$this->user=$user;
//		$this->test_type();
	}
	function is_valid_email($email="")
	{
		if( !eregi( "^" .
			"[a-z0-9]+([_\\.-][a-z0-9]+)*" .    //user
            "@" .
            "([a-z0-9]+([\.-][a-z0-9]+)*)+" .   //domain
            "\\.[a-z]{2,}" .                    //sld, tld 
            "$", $email)
                        )
        {
        //echo "Erreur: '$email' n'est pas une adresse mail valide!<br>";
        return false;
        }
		else return true;
	}
	function test_type()
	{
		if (!(get_class($this->job)=="Job"))
			$this->job=NULL;
		if (!(get_class($this->user)=="User"))
			$this->user=NULL;	
	}
	// Return array of emails of people to send mail
	function get_users_to_send_mail()
	{
		GLOBAL $cfg_mailing;
		
		$emails=array();
		$nb=0;
		$db = new DB;
		
		if ($cfg_mailing[$this->type]["admin"]&&$this->is_valid_email($cfg_mailing["admin_email"])&&!in_array($cfg_mailing["admin_email"],$emails))
		{
			$emails[$nb]=$cfg_mailing["admin_email"];
			$nb++;
		}

		if ($cfg_mailing[$this->type]["all_admin"])
		{
			$query = "SELECT email FROM users WHERE (type = 'admin')";
			if ($result = $db->query($query)) 
			{
				while ($row = $db->fetch_row($result))
				{
					// Test du format du mail et de sa non existance dans la table
					if ($this->is_valid_email($row[0])&&!in_array($row[0],$emails))
					{
						$emails[$nb]=$row[0];
						$nb++;
					}
				}
			}
		}	

		if ($cfg_mailing[$this->type]["all_normal"])
		{
			$query = "SELECT email FROM users WHERE (type = 'normal')";
			if ($result = $db->query($query)) 
			{
				while ($row = $db->fetch_row($result))
				{
					// Test du format du mail et de sa non existance dans la table
					if ($this->is_valid_email($row[0])&&!in_array($row[0],$emails))
					{
						$emails[$nb]=$row[0];
						$nb++;
					}
				}
			}
		}	

		if ($cfg_mailing[$this->type]["attrib"]&&$this->job->assign)
		{
			$query2 = "SELECT email FROM users WHERE (name = '".$this->job->assign."')";
			if ($result2 = $db->query($query2)) 
			{
				if ($db->numrows($result2)==1)
				{
					$row2 = $db->fetch_row($result2);
					if ($this->is_valid_email($row2[0])&&!in_array($row2[0],$emails))
						{
							$emails[$nb]=$row2[0];
							$nb++;
						}
				}
			}
		}

		if ($cfg_mailing[$this->type]["user"]&&$this->job->emailupdates=="yes")
		{
			if ($this->is_valid_email($this->job->uemail)&&!in_array($this->job->uemail,$emails))
			{
				$emails[$nb]=$this->job->uemail;
				$nb++;
			}
		}
		return $emails;
	}

	// Format the mail body to send
	function get_mail_body()
	{
		// Create message body from Job and type
		$body="";
		
		$body.=$this->job->textDescription();
		if ($this->type!="new") $body.=$this->job->textFollowups();
		
		return $body;
	}
	// Format the mail subject to send
	function get_mail_subject()
	{
		GLOBAL $lang;
		
		// Create the message subject 
		$subject="";
		switch ($this->type){
			case "new":
			$subject.=$lang["mailing"][9];
				break;
			case "attrib":
			$subject.=$lang["mailing"][12];
				break;
			case "followup":
			$subject.=$lang["mailing"][10];
				break;
			case "finish":
			$subject.=$lang["mailing"][11].$this->job->closedate;			
				break;
			default :
			$subject.=$lang["mailing"][13];
				break;
		}
		
		if ($this->type!="new") $subject .= " (ref ".$this->job->ID.")";		
		
		return $subject;
	}
	
	function get_reply_to_address ()
	{
		GLOBAL $cfg_mailing;
	$replyto="";

	switch ($this->type){
			case "new":
				if ($this->is_valid_email($this->job->uemail)) $replyto=$this->job->uemail;
				else $replyto=$cfg_mailing["admin_email"];
				break;
			case "followup":
				if ($this->is_valid_email($user->user->fields["email"])) $replyto=$this->user->fields["email"];
				else $replyto=$cfg_mailing["admin_email"];
				break;
			default :
				$replyto=$cfg_mailing["admin_email"];
				break;
		}
	return $replyto;		
	}
	// Send email 
	function send()
	{
		GLOBAL $cfg_features,$cfg_mailing;
		if ($cfg_features["mailing"]&&$this->is_valid_email($cfg_mailing["admin_email"]))
		{
			if (!is_null($this->job)&&!is_null($this->user)&&(strcmp($this->type,"new")||strcmp($this->type,"attrib")||strcmp($this->type,"followup")||strcmp($this->type,"finish")))
			{
				// get users to send mail
				$users=$this->get_users_to_send_mail();
				// get body + signature OK
				$body=ereg_replace("<br>","",$this->get_mail_body()."\n".$cfg_mailing["signature"]);
				// get subject OK
				$subject=$this->get_mail_subject();
				// get sender :  OK
				$sender= $cfg_mailing[admin_email];
				// get reply-to address : user->email ou job_email if not set OK
				$replyto=$this->get_reply_to_address ();
				// Send all mails
				for ($i=0;$i<count($users);$i++)
				{
				mail($users[$i],$subject,$body,
				"From: $sender\r\n" .
			    "Reply-To: $replyto\r\n" .
     		   "X-Mailer: PHP/" . phpversion()) ;
				}
			} else {
				echo "Type d'envoi invalide";
			}
		}
	}



}
?>
