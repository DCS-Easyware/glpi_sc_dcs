<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Deviceharddrive extends Common
{
  use SoftDeletes;

  protected $definition = '\App\Models\Definitions\Deviceharddrive';
  protected $titles = ['Hard drive', 'Hard drives'];
  protected $icon = 'edit';

  protected $appends = [
    'manufacturer',
    'model',
    'interface',
    'entity',
  ];

  protected $visible = [
    'manufacturer',
    'model',
    'interface',
    'entity',
  ];

  protected $with = [
    'manufacturer:id,name',
    'model:id,name',
    'interface:id,name',
    'entity:id,name',
  ];

  public function manufacturer(): BelongsTo
  {
    return $this->belongsTo('\App\Models\Manufacturer');
  }

  public function model(): BelongsTo
  {
    return $this->belongsTo('\App\Models\Deviceharddrivemodel', 'deviceharddrivemodel_id');
  }

  public function interface(): BelongsTo
  {
    return $this->belongsTo('\App\Models\Interfacetype', 'interfacetype_id');
  }

  public function entity(): BelongsTo
  {
    return $this->belongsTo('\App\Models\Entity');
  }
}
