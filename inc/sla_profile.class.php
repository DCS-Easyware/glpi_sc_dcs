<?php
/*
 * @version $Id$
 -------------------------------------------------------------------------
 GLPI - Gestionnaire Libre de Parc Informatique
 Copyright (C) 2003-2014 by the INDEPNET Development Team.

 http://indepnet.net/   http://glpi-project.org
 -------------------------------------------------------------------------

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
 along with GLPI. If not, see <http://www.gnu.org/licenses/>.
 --------------------------------------------------------------------------
 */

/** @file
* @brief
*/

if (!defined('GLPI_ROOT')) {
   die("Sorry. You can't access directly to this file");
}

/// Class SLA_Profile
/// since version 0.86
class SLA_Profile extends CommonDBRelation {

   // From CommonDBRelation
   static public $itemtype_1          = 'SLA';
   static public $items_id_1          = 'slas_id';
   static public $itemtype_2          = 'Profile';
   static public $items_id_2          = 'profiles_id';

   static public $checkItem_2_Rights  = self::DONT_CHECK_ITEM_RIGHTS;
   static public $logs_for_item_2     = false;


   /**
    * Get profiles for a SLA
    *
    * @param $slas_id ID of the SLA
    *
    * @return array of profiles linked to a SLA
   **/
   static function getProfiles($slas_id) {
      global $DB;

      $prof  = array();
      $query = "SELECT `glpi_slas_profiles`.*
                FROM `glpi_slas_profiles`
                WHERE `slas_id` = '$slas_id'";

      foreach ($DB->request($query) as $data) {
         $prof[$data['profiles_id']][] = $data;
      }
      return $prof;
   }

}
?>