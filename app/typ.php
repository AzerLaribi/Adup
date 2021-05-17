<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class typ extends Model
{
    use HasFactory;
    public $table = 'typs';

    protected $fillable = [
        'name',   
    ];
}
