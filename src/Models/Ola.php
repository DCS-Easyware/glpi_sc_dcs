<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ola extends Common
{
  use SoftDeletes;

  protected $definition = '\App\Models\Definitions\Ola';
  protected $titles = ['OLA', 'OLA'];
  protected $icon = 'edit';

  protected $appends = [
    'entity',
    'calendar',
  ];

  protected $visible = [
    'entity',
    'calendar',
  ];

  protected $with = [
    'entity:id,name,completename',
    'calendar:id,name',
  ];

  public function entity(): BelongsTo
  {
    return $this->belongsTo('\App\Models\Entity');
  }

  public function calendar(): BelongsTo
  {
    return $this->belongsTo('\App\Models\Calendar', 'calendar_id');
  }
}
