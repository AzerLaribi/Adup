<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConsumerRasb extends Model
{
 
    use HasFactory;
    public $table = 'consumer_rasbary';
    
    protected $fillable = [
        'rasbary_id',
        'consumer_id',
        'created_at'
    ];
    public function consumers()
    {
        return $this->belongsToMany(Consumer::class);
    }
    public function rasbarys()
    {
        return $this->belongsToMany(Rasbary::class);
    }
}
