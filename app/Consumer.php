<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consumer extends Model
{
    use HasFactory;
    public $table = 'consumers';
    protected $fillable = [
        'Mac',
        'sex',
        'age',
      
 
    ];
    public function ads()
    {
        return $this->belongsToMany(Ad::class);
    }

    public function rasbarys()
    {
        return $this->belongsToMany(Rasbary::class);
    }
}
