<?php

namespace App\Models\Definitions;

class Monitor
{
  public static function getDefinition()
  {
    global $translator;
    return [
      [
        'id'    => 2,
        'title' => $translator->translate('Name'),
        'type'  => 'input',
        'name'  => 'name',
        'fillable' => true,
      ],
      [
        'id'    => 3,
        'title' => $translator->translatePlural('Location', 'Locations', 1),
        'type'  => 'dropdown_remote',
        'name'  => 'location',
        'dbname' => 'location_id',
        'itemtype' => '\App\Models\Location',
        'fillable' => true,
      ],
      [
        'id'    => 31,
        'title' => $translator->translate('Status'),
        'type'  => 'dropdown_remote',
        'name'  => 'state',
        'dbname' => 'state_id',
        'itemtype' => '\App\Models\State',
        'fillable' => true,
      ],
      [
        'id'    => 4,
        'title' => $translator->translatePlural('Type', 'Types', 1),
        'type'  => 'dropdown_remote',
        'name'  => 'type',
        'dbname' => 'monitortype_id',
        'itemtype' => '\App\Models\Monitortype',
        'fillable' => true,
      ],
      [
        'id'    => 40,
        'title' => $translator->translatePlural('Model', 'Models', 1),
        'type'  => 'dropdown_remote',
        'name'  => 'model',
        'dbname' => 'monitormodel_id',
        'itemtype' => '\App\Models\Monitormodel',
        'fillable' => true,
      ],
      [
        'id'    => 40,
        'title' => $translator->translatePlural('Manufacturer', 'Manufacturers', 1),
        'type'  => 'dropdown_remote',
        'name'  => 'manufacturer',
        'dbname' => 'manufacturer_id',
        'itemtype' => '\App\Models\Manufacturer',
        'fillable' => true,
      ],
      [
        'id'    => 5,
        'title' => $translator->translate('Serial number'),
        'type'  => 'input',
        'name'  => 'serial',
        'fillable' => true,
      ],
      [
        'id'    => 6,
        'title' => $translator->translate('Inventory number'),
        'type'  => 'input',
        'name'  => 'otherserial',
        'fillable' => true,
      ],
      [
        'id'    => 7,
        'title' => $translator->translate('Alternate username'),
        'type'  => 'input',
        'name'  => 'contact',
        'fillable' => true,
      ],
      [
        'id'    => 8,
        'title' => $translator->translate('Alternate username number'),
        'type'  => 'input',
        'name'  => 'contact_num',
        'fillable' => true,
      ],
      [
        'id'    => 70,
        'title' => $translator->translatePlural('User', 'Users', 1),
        'type'  => 'dropdown_remote',
        'name'  => 'user',
        'dbname' => 'user_id',
        'itemtype' => '\App\Models\User',
        'fillable' => true,
      ],
      [
        'id'    => 71,
        'title' => $translator->translatePlural('Group', 'Groups', 1),
        'type'  => 'dropdown_remote',
        'name'  => 'group',
        'dbname' => 'group_id',
        'itemtype' => '\App\Models\Group',
        'fillable' => true,
      ],
      [
        'id'    => 16,
        'title' => $translator->translate('Comments'),
        'type'  => 'textarea',
        'name'  => 'comment',
        'fillable' => true,
      ],
      [
        'id'    => 11,
        'title' => $translator->translate('Size'),
        'type'  => 'input',
        'name'  => 'size',
        'fillable' => true,
      ],
      [
        'id'    => 41,
        'title' => $translator->translate('Microphone'),
        'type'  => 'boolean',
        'name'  => 'have_micro',
        'fillable' => true,
      ],
      [
        'id'    => 42,
        'title' => $translator->translate('Speakers'),
        'type'  => 'boolean',
        'name'  => 'have_speaker',
        'fillable' => true,
      ],
      [
        'id'    => 43,
        'title' => $translator->translate('Sub-D'),
        'type'  => 'boolean',
        'name'  => 'have_subd',
        'fillable' => true,
      ],
      [
        'id'    => 44,
        'title' => $translator->translate('BNC'),
        'type'  => 'boolean',
        'name'  => 'have_bnc',
        'fillable' => true,
      ],
      [
        'id'    => 45,
        'title' => $translator->translate('DVI'),
        'type'  => 'boolean',
        'name'  => 'have_dvi',
        'fillable' => true,
      ],
      [
        'id'    => 46,
        'title' => $translator->translate('Pivot'),
        'type'  => 'boolean',
        'name'  => 'have_pivot',
        'fillable' => true,
      ],
      [
        'id'    => 47,
        'title' => $translator->translate('HDMI'),
        'type'  => 'boolean',
        'name'  => 'have_hdmi',
        'fillable' => true,
      ],
      [
        'id'    => 48,
        'title' => $translator->translate('DisplayPort'),
        'type'  => 'boolean',
        'name'  => 'have_displayport',
        'fillable' => true,
      ],
      [
        'id'    => 82,
        'title' => $translator->translate('Global management'),
        'type'  => 'boolean',
        'name'  => 'is_global',
        'fillable' => true,
      ],
      [
        'id'    => 24,
        'title' => $translator->translate('Technician in charge of the hardware'),
        'type'  => 'dropdown_remote',
        'name'  => 'userstech',
        'dbname' => 'user_id_tech',
        'itemtype' => '\App\Models\User',
        'fillable' => true,
      ],
      [
        'id'    => 49,
        'title' => $translator->translate('Group in charge of the hardware'),
        'type'  => 'dropdown_remote',
        'name'  => 'groupstech',
        'dbname' => 'group_id_tech',
        'itemtype' => '\App\Models\Group',
        'fillable' => true,
      ],
      // [
      //   'id'    => 61,
      //   'title' => $translator->translate('Template name'),
      //   'type'  => 'input',
      //   'name'  => 'template_name',
      // ],
      // [
      //   'id'    => 49,
      //   'title' => $translator->translatePlural('Entity', 'Entities', 1),
      //   'type'  => 'dropdown_remote',
      //   'name'  => 'completename',
      //   'itemtype' => '\App\Models\Entity',
      // ],
      [
        'id'    => 19,
        'title' => $translator->translate('Last update'),
        'type'  => 'datetime',
        'name'  => 'updated_at',
        'readonly'  => 'readonly',
      ],
      [
        'id'    => 121,
        'title' => $translator->translate('Creation date'),
        'type'  => 'datetime',
        'name'  => 'created_at',
        'readonly'  => 'readonly',
      ],
    ];
  }

  public static function getRelatedPages($rootUrl)
  {
    global $translator;
    return [
      [
        'title' => $translator->translatePlural('Monitor', 'Monitors', 1),
        'icon' => 'home',
        'link' => $rootUrl,
      ],
      [
        'title' => $translator->translate('Analysis impact'),
        'icon' => 'caret square down outline',
        'link' => '',
      ],
      [
        'title' => $translator->translatePlural('Operating system', 'Operating systems', 2),
        'icon' => 'laptop house',
        'link' => $rootUrl . '/operatingsystem',
      ],
      [
        'title' => $translator->translatePlural('Software', 'Softwares', 2),
        'icon' => 'cube',
        'link' => $rootUrl . '/softwares',
      ],
      [
        'title' => $translator->translatePlural('Connection', 'Connections', 2),
        'icon' => 'linkify',
        'link' => '',
      ],
      [
        'title' => $translator->translatePlural('Network port', 'Network ports', 2),
        'icon' => 'ethernet',
        'link' => '',
      ],
      [
        'title' => $translator->translate('Management'),
        'icon' => 'caret square down outline',
        'link' => '',
      ],
      [
        'title' => $translator->translatePlural('Contract', 'Contract', 2),
        'icon' => 'caret square down outline',
        'link' => '',
      ],
      [
        'title' => $translator->translatePlural('Document', 'Documents', 2),
        'icon' => 'caret square down outline',
        'link' => '',
      ],
      [
        'title' => $translator->translate('Knowledge base'),
        'icon' => 'book',
        'link' => $rootUrl . '/knowbaseitems',
      ],
      [
        'title' => $translator->translatePlural('Ticket', 'Tickets', 2),
        'icon' => 'caret square down outline',
        'link' => '',
      ],
      [
        'title' => $translator->translatePlural('Problem', 'Problems', 2),
        'icon' => 'caret square down outline',
        'link' => '',
      ],
      [
        'title' => $translator->translatePlural('Change', 'Changes', 2),
        'icon' => 'caret square down outline',
        'link' => '',
      ],
      [
        'title' => $translator->translatePlural('External link', 'External links', 2),
        'icon' => 'caret square down outline',
        'link' => $rootUrl . '/externallinks',
      ],
      [
        'title' => $translator->translatePlural('Note', 'Notes', 2),
        'icon' => 'caret square down outline',
        'link' => $rootUrl . '/notes',
      ],
      [
        'title' => $translator->translatePlural('Reservation', 'Reservations', 2),
        'icon' => 'caret square down outline',
        'link' => '',
      ],
      [
        'title' => $translator->translatePlural('Domain', 'Domains', 2),
        'icon' => 'caret square down outline',
        'link' => $rootUrl . '/domains',
      ],
      [
        'title' => $translator->translatePlural('Appliance', 'Appliances', 2),
        'icon' => 'caret square down outline',
        'link' => $rootUrl . '/appliances',
      ],
      [
        'title' => $translator->translate('Historical'),
        'icon' => 'history',
        'link' => $rootUrl . '/history',
      ],
      [
        'title' => $translator->translate('Information d\'import'),
        'icon' => 'caret square down outline',
        'link' => '',
      ],
    ];
  }
}
