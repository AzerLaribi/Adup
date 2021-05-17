<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rasbary extends Model
{
    use HasFactory;
    public $table = 'rasbaries';
    protected $fillable = [
        'model',
        'key',
        'name',
        'boughtdate',
        'givingdate',
    ];

    public function consumers()
    {
        return $this->belongsToMany(Consumer::class);
    }

    public function venues()
    {
        return $this->belongsToMany(Venue::class);
    }

}
