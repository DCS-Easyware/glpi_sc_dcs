<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ticketcost extends Common
{
  use SoftDeletes;

  protected $definition = '\App\Models\Definitions\Ticketcost';
  protected $titles = ['Ticket cost', 'Ticket costs'];
  protected $icon = 'edit';

  protected $appends = [
    'entity',
    'budget',
  ];

  protected $visible = [
    'entity',
    'budget',
  ];

  protected $with = [
    'entity:id,name',
    'budget:id,name',
  ];


  public function entity(): BelongsTo
  {
    return $this->belongsTo('\App\Models\Entity');
  }

  public function budget(): BelongsTo
  {
    return $this->belongsTo('\App\Models\Budget');
  }
}
