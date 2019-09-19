<?php

namespace App\Models\Event;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EventStatus extends Model
{
    use SoftDeletes;

    protected $fillable = ['code', 'value'];

    public function event()
    {
        return $this->hasMany(Event::class, 'event_id');
    }
}
