<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupParameter extends Model
{
    use HasFactory;

    protected $table = 'group_parameters';
    public $timestamps = true;

    protected $fillable = [
        'name',
        'description',
    ];

    public function parametersGroup()
    {
        return $this->belongsTo(Parameter::class, 'group_id');
    }
}
