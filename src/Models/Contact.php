<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Contact extends Common
{
  use SoftDeletes;

  protected $definition = '\App\Models\Definitions\Contact';
  protected $titles = ['Contact', 'Contacts'];
  protected $icon = 'user tie';

  protected $appends = [
    'type',
    'title',
    'entity',
    'notes',
  ];

  protected $visible = [
    'type',
    'title',
    'entity',
    'notes',
  ];

  protected $with = [
    'type:id,name',
    'title:id,name',
    'entity:id,name',
    'notes:id',
  ];

  public function type(): BelongsTo
  {
    return $this->belongsTo('\App\Models\Contacttype', 'contacttype_id');
  }
  public function title(): BelongsTo
  {
    return $this->belongsTo('\App\Models\Usertitle', 'usertitle_id');
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
}
