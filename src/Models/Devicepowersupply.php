<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Devicepowersupply extends Common
{
  use SoftDeletes;

  protected $definition = '\App\Models\Definitions\Devicepowersupply';
  protected $titles = ['Power supply', 'Power supplies'];
  protected $icon = 'edit';

  protected $appends = [
    'manufacturer',
    'model',
    'entity',
    'items',
  ];

  protected $visible = [
    'manufacturer',
    'model',
    'entity',
    'documents',
    'items',
  ];

  protected $with = [
    'manufacturer:id,name',
    'model:id,name',
    'entity:id,name,completename',
    'documents',
    'items',
  ];

  public function manufacturer(): BelongsTo
  {
    return $this->belongsTo('\App\Models\Manufacturer');
  }

  public function model(): BelongsTo
  {
    return $this->belongsTo('\App\Models\Devicepowersupplymodel', 'devicepowersupplymodel_id');
  }

  public function entity(): BelongsTo
  {
    return $this->belongsTo('\App\Models\Entity');
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

  public function items(): HasMany
  {
    return $this->hasMany('\App\Models\ItemDevicepowersupply', 'devicepowersupply_id');
  }
}
