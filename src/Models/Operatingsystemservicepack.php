<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Operatingsystemservicepack extends Common
{
  use SoftDeletes;

  protected $definition = '\App\Models\Definitions\Operatingsystemservicepack';
  protected $titles = ['Service pack', 'Service packs'];
  protected $icon = 'edit';
  protected $hasEntityField = false;
}
