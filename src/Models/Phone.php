<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Phone extends Common
{
  use SoftDeletes;

  protected $definition = '\App\Models\Definitions\Phone';
  protected $titles = ['Phone', 'Phones'];
  protected $icon = 'phone';

  protected $appends = [
    'type',
    'model',
    'phonepowersupply',
    'state',
    'manufacturer',
    'user',
    'group',
    'network',
    'groupstech',
    'userstech',
    'location',
    'entity',
  ];

  protected $visible = [
    'type',
    'model',
    'phonepowersupply',
    'state',
    'manufacturer',
    'user',
    'group',
    'network',
    'groupstech',
    'userstech',
    'location',
    'entity',
    'domains',
    'appliances',
    'notes',
    'knowbaseitems',
    'documents',
    'contracts',
    'softwareversions',
    'operatingsystems',
    'tickets',
    'problems',
    'changes',
  ];

  protected $with = [
    'type:id,name',
    'model:id,name',
    'phonepowersupply:id,name',
    'state:id,name',
    'manufacturer:id,name',
    'user:id,name',
    'group:id,name',
    'network:id,name',
    'groupstech:id,name',
    'userstech:id,name',
    'location:id,name',
    'entity:id,name',
    'domains:id,name',
    'appliances:id,name',
    'notes:id',
    'knowbaseitems:id,name',
    'documents:id,name',
    'contracts:id,name',
    'softwareversions:id,name',
    'operatingsystems:id,name',
    'tickets:id,name',
    'problems:id,name',
    'changes:id,name',
  ];


  public function type(): BelongsTo
  {
    return $this->belongsTo('\App\Models\Phonetype', 'phonetype_id');
  }

  public function model(): BelongsTo
  {
    return $this->belongsTo('\App\Models\Phonemodel', 'phonemodel_id');
  }

  public function phonepowersupply(): BelongsTo
  {
    return $this->belongsTo('\App\Models\Phonepowersupply');
  }

  public function state(): BelongsTo
  {
    return $this->belongsTo('\App\Models\State');
  }

  public function manufacturer(): BelongsTo
  {
    return $this->belongsTo('\App\Models\Manufacturer');
  }

  public function user(): BelongsTo
  {
    return $this->belongsTo('\App\Models\User');
  }

  public function group(): BelongsTo
  {
    return $this->belongsTo('\App\Models\Group');
  }

  public function network(): BelongsTo
  {
    return $this->belongsTo('\App\Models\Network');
  }

  public function groupstech(): BelongsTo
  {
    return $this->belongsTo('\App\Models\Group', 'group_id_tech');
  }

  public function userstech(): BelongsTo
  {
    return $this->belongsTo('\App\Models\User', 'user_id_tech');
  }

  public function location(): BelongsTo
  {
    return $this->belongsTo('\App\Models\Location');
  }

  public function entity(): BelongsTo
  {
    return $this->belongsTo('\App\Models\Entity');
  }

  public function domains(): MorphToMany
  {
    return $this->morphToMany(
      '\App\Models\Domain',
      'item',
      'domain_item'
    )->withPivot(
      'domainrelation_id',
    );
  }

  public function appliances(): MorphToMany
  {
    return $this->morphToMany(
      '\App\Models\Appliance',
      'item',
      'appliance_item'
    );
  }

  public function notes(): MorphMany
  {
    return $this->morphMany(
      '\App\Models\Notepad',
      'item',
    );
  }

  public function knowbaseitems(): MorphToMany
  {
    return $this->morphToMany(
      '\App\Models\Knowbaseitem',
      'item',
      'knowbaseitem_item'
    )->withPivot(
      'knowbaseitem_id',
    );
  }

  public function documents(): MorphToMany
  {
    return $this->morphToMany(
      '\App\Models\Document',
      'item',
      'document_item'
    )->withPivot(
      'document_id',
      'updated_at',
    );
  }

  public function contracts(): MorphToMany
  {
    return $this->morphToMany(
      '\App\Models\Contract',
      'item',
      'contract_item'
    )->withPivot(
      'contract_id',
    );
  }

  public function softwareversions(): MorphToMany
  {
    return $this->morphToMany('\App\Models\Softwareversion', 'item', 'item_softwareversion');
  }

  public function operatingsystems(): MorphToMany
  {
    return $this->morphToMany(
      '\App\Models\Operatingsystem',
      'item',
      'item_operatingsystem'
    )->withPivot(
      'operatingsystemversion_id',
      'operatingsystemservicepack_id',
      'operatingsystemarchitecture_id',
      'operatingsystemkernelversion_id',
      'operatingsystemedition_id',
      'license_number',
      'licenseid',
      'installationdate',
      'winowner',
      'wincompany',
      'oscomment',
      'hostid'
    );
  }

  public function tickets(): MorphToMany
  {
    return $this->morphToMany(
      '\App\Models\Ticket',
      'item',
      'item_ticket'
    )->withPivot(
      'ticket_id',
    );
  }

  public function problems(): MorphToMany
  {
    return $this->morphToMany(
      '\App\Models\Problem',
      'item',
      'item_problem'
    )->withPivot(
      'problem_id',
    );
  }

  public function changes(): MorphToMany
  {
    return $this->morphToMany(
      '\App\Models\Change',
      'item',
      'change_item'
    )->withPivot(
      'change_id',
    );
  }
}
