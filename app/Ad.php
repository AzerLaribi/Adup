<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    use HasFactory;
    public $table = 'ads';
    protected $fillable = [
        'type',
        'title',
        'description',
        'imageUrl',
        'video',
        'start',
        'end',
        'user_id',
        'priority',
        'time',
        'status',
        'owner',
        'link',

    ];
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function venues()
    {
        return $this->belongsToMany(Venue::class);
    }
    public function consumers()
    {
        return $this->belongsToMany(Consumer::class);
    }

}
