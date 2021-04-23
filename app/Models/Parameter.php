<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parameter extends Model
{
    use HasFactory;

    protected $table = 'parameters';
    public $timestamps = true;

    protected $fillable = [
        'group_id',
        'name',
        'description',
    ];
}
