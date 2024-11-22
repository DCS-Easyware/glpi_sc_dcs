<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Projecttask extends Common
{
  use SoftDeletes;

  protected $definition = '\App\Models\Definitions\Projecttask';
  protected $titles = ['Project task', 'Project tasks'];
  protected $icon = 'columns';

  protected $appends = [
    'entity',
    'parent',
    'type',
    'state',
    'tickets',
  ];

  protected $visible = [
    'entity',
    'parent',
    'type',
    'state',
    'tickets',
  ];

  protected $with = [
    'entity:id,name',
    'parent:id,name',
    'type:id,name',
    'state:id,name,color',
    'tickets:id,name',
  ];

  public function entity(): BelongsTo
  {
    return $this->belongsTo('\App\Models\Entity');
  }

  public function parent(): BelongsTo
  {
    return $this->belongsTo('\App\Models\Projecttask', 'projecttask_id');
  }

  public function type(): BelongsTo
  {
    return $this->belongsTo('\App\Models\Projecttasktype', 'projecttasktype_id');
  }

  public function state(): BelongsTo
  {
    return $this->belongsTo('\App\Models\Projectstate', 'projectstate_id');
  }

  public function tickets(): BelongsToMany
  {
    return $this->belongsToMany('\App\Models\Ticket', 'projecttask_ticket', 'projecttask_id', 'ticket_id');
  }
}
