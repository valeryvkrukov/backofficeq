<?php

namespace App\Models\Event;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EventRole extends Model
{
    use SoftDeletes;

    protected $fillable = ['code', 'value', 'abbv'];

    public function participant()
    {
        return $this->hasMany(Participant::class);
    }
}
