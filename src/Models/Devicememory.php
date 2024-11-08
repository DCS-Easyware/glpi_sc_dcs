<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Devicememory extends Common
{
  use SoftDeletes;

  protected $definition = '\App\Models\Definitions\Devicememory';
  protected $titles = ['Memory', 'Memory'];
  protected $icon = 'edit';

  protected $appends = [
    'manufacturer',
    'type',
    'model',
    'entity',
  ];

  protected $visible = [
    'manufacturer',
    'type',
    'model',
    'entity',
    'documents',
  ];

  protected $with = [
    'manufacturer:id,name',
    'type:id,name',
    'model:id,name',
    'entity:id,name',
    'documents:id,name',
  ];

  public function manufacturer(): BelongsTo
  {
    return $this->belongsTo('\App\Models\Manufacturer');
  }

  public function type(): BelongsTo
  {
    return $this->belongsTo('\App\Models\Devicememorytype', 'devicememorytype_id');
  }

  public function model(): BelongsTo
  {
    return $this->belongsTo('\App\Models\Devicememorymodel', 'devicememorymodel_id');
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
}
