<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Project extends Common
{
  use SoftDeletes;

  protected $definition = '\App\Models\Definitions\Project';
  protected $titles = ['Project', 'Projects'];
  protected $icon = 'columns';

  protected $appends = [
    'type',
    'state',
    'user',
    'group',
    'entity',
    'notes',
  ];

  protected $visible = [
    'type',
    'state',
    'user',
    'group',
    'entity',
    'notes',
    'knowbaseitems',
    'documents',
    'contracts',
  ];

  protected $with = [
    'type:id,name',
    'state:id,name',
    'user:id,name',
    'group:id,name',
    'entity:id,name',
    'notes:id',
    'knowbaseitems:id,name',
    'documents:id,name',
    'contracts:id,name',
  ];


  public function type(): BelongsTo
  {
    return $this->belongsTo('\App\Models\Projecttype', 'projecttype_id');
  }

  public function state(): BelongsTo
  {
    return $this->belongsTo('\App\Models\Projectstate', 'projectstate_id');
  }

  public function user(): BelongsTo
  {
    return $this->belongsTo('\App\Models\User');
  }

  public function group(): BelongsTo
  {
    return $this->belongsTo('\App\Models\Group');
  }

  public function entity(): BelongsTo
  {
    return $this->belongsTo('\App\Models\Entity');
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
}
