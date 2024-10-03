<?php

declare(strict_types=1);

// phpcs:disable PSR1.Classes.ClassDeclaration.MissingNamespace

use Phinx\Migration\AbstractMigration;
use Phinx\Migration\Manager\Environment;
use Phinx\Config\Config;
use App\v1\Controllers\Toolbox;

final class MonitorsMigration extends AbstractMigration
{
  public function change()
  {
    $configArray = require('phinx.php');
    $environments = array_keys($configArray['environments']);
    if (in_array('old', $environments))
    {
      // Migration of database

      $config = Config::fromPhp('phinx.php');
      $environment = new Environment('old', $config->getEnvironment('old'));
      $pdo = $environment->getAdapter()->getConnection();
    } else {
      return;
    }
    $item = $this->table('monitors');

    if ($this->isMigratingUp())
    {
      $stmt = $pdo->query('SELECT * FROM glpi_monitors');
      $rows = $stmt->fetchAll();
      foreach ($rows as $row)
      {
        $data = [
          [
            'id'                => $row['id'],
            'entity_id'         => $row['entities_id'],
            'name'              => $row['name'],
            'updated_at'        => $row['date_mod'],
            'contact'           => $row['contact'],
            'contact_num'       => $row['contact_num'],
            'user_id_tech'      => $row['users_id_tech'],
            'group_id_tech'     => $row['groups_id_tech'],
            'comment'           => $row['comment'],
            'serial'            => $row['serial'],
            'otherserial'       => $row['otherserial'],
            'size'              => $row['size'],
            'have_micro'        => $row['have_micro'],
            'have_speaker'      => $row['have_speaker'],
            'have_subd'         => $row['have_subd'],
            'have_bnc'          => $row['have_bnc'],
            'have_dvi'          => $row['have_dvi'],
            'have_pivot'        => $row['have_pivot'],
            'have_hdmi'         => $row['have_hdmi'],
            'have_displayport'  => $row['have_displayport'],
            'location_id'       => $row['locations_id'],
            'monitortype_id'    => $row['monitortypes_id'],
            'monitormodel_id'   => $row['monitormodels_id'],
            'manufacturer_id'   => $row['manufacturers_id'],
            'is_global'         => $row['is_global'],
            'is_deleted'        => $row['is_deleted'],
            'is_template'       => $row['is_template'],
            'template_name'     => $row['template_name'],
            'user_id'           => $row['users_id'],
            'group_id'          => $row['groups_id'],
            'state_id'          => $row['states_id'],
            'ticket_tco'        => $row['ticket_tco'],
            'is_dynamic'        => $row['is_dynamic'],
            'created_at'        => $row['date_creation'],
            'is_recursive'      => $row['is_recursive'],
          ]
        ];

        $item->insert($data)
             ->saveData();
      }
    } else {
      // rollback
      $item->truncate();
    }
  }
}
