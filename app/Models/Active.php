<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Active extends Model
{
    protected $table = 'active_log';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'log_details',
        'controller_name',
        'function_name',
        'ip_address',
    ];

    public function users(){
        return $this->hasOne(User::class, 'id','user_id');
    }


}
