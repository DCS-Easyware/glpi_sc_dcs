<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Monitor extends Common
{
  use SoftDeletes;

  protected $definition = '\App\Models\Definitions\Monitor';
  protected $titles = ['Monitor', 'Monitors'];
  protected $icon = 'desktop';

  protected $appends = [
    'type',
    'model',
    'state',
    'manufacturer',
    'user',
    'group',
    'groupstech',
    'userstech',
    'location',
    'entity',
  ];

  protected $visible = [
    'type',
    'model',
    'state',
    'manufacturer',
    'user',
    'group',
    'groupstech',
    'userstech',
    'location',
    'entity',
    'domains',
    'appliances',
    'notes',
    'knowbaseitems',
  ];

  protected $with = [
    'type:id,name',
    'model:id,name',
    'state:id,name',
    'manufacturer:id,name',
    'user:id,name',
    'group:id,name',
    'groupstech:id,name',
    'userstech:id,name',
    'location:id,name',
    'entity:id,name',
    'domains:id,name',
    'appliances:id,name',
    'notes:id',
    'knowbaseitems:id,name',
  ];


  public function type(): BelongsTo
  {
    return $this->belongsTo('\App\Models\Monitortype');
  }

  public function model(): BelongsTo
  {
    return $this->belongsTo('\App\Models\Monitormodel');
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
}
