<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Zoom_meeting extends Model
{
    protected $table = 'zoom_meeting';
    protected $fillable = [
        'meeting_id', 'zoom_id' , 'password', 'start_time', 'duration', 'timezone', 'start_url', 'join_url', 'timezone'
    ];
    protected $primaryKey = 'meeting_id';
    public function zoomable()
    {
            return $this->morphTo();
    }
}
