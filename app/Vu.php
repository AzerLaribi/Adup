<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vu extends Model
{
    use HasFactory;
    public $table = 'ad_consumer';
    
    protected $fillable = [
        'consumer_id',
        'ad_id',
    ];
    public function consumers()
    {
        return $this->belongsToMany(Consumer::class);
    }
    public function ads()
    {
        return $this->belongsToMany(Ad::class);
    }
}
