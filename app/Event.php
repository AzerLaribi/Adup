<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    public $table = 'events';

 

    protected $fillable = [
        'start_time',
        'finish_time',
        'title',
        'description',
        'user_id'
    ];
}
