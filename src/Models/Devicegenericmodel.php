<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Devicegenericmodel extends Common
{
  use SoftDeletes;

  protected $definition = '\App\Models\Definitions\Devicegenericmodel';
  protected $titles = ['Device generic model', 'Device generic models'];
  protected $icon = 'edit';
  protected $hasEntityField = false;
}