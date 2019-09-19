<?php

namespace App\Models\Event;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'eventdate',
        'description',
        'status',
        'pdpanric',
        'pdpaaddress',
        'pdpatelmobileemail',
        'memregistration',
    ];

    public function eventType()
    {
        return $this->belongsToMany(EventType::class, 'events_event_types');
    }

    public function eventLang()
    {
        return $this->belongsToMany(EventLanguage::class, 'events_event_languages');
    }

    public function eventStatus()
    {
        return $this->belongsTo(EventStatus::class, 'status_id');
    }

    public function participants()
    {
        return $this->belongsToMany(Participant::class, 'event_participants');
    }
}
