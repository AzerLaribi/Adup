<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Venue extends Model implements HasMedia
{
    use SoftDeletes, InteractsWithMedia;

    public $table = 'venues';

    // protected $appends = [
    //     'photos',
    // ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'address',
        'region',
        'latitude',
        'longitude',
        'logo',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
        'description',
    ];

    // public function registerMediaConversions(Media $media = null): void
    // {
    //     $this->addMediaConversion('thumb')->width(50)->height(50);
    // }

    // public function getPhotosAttribute()
    // {
    //     $files = $this->getMedia('photos');
    //     $files->each(function ($item) {
    //         $item->url       = $item->getUrl();
    //         $item->thumbnail = $item->getUrl('thumb');
    //     });

    //     return $files;
    // }


    public function users()
    {
        return $this->belongsToMany(User::class);
    }
    public function rasbarys()
    {
        return $this->belongsToMany(Rasbary::class);
    }
    public function tags()
    {
        return $this->belongsToMany(tag::class);
    }
    public function typs()
    {
        return $this->belongsToMany(typ::class);
    }

    public function ads()
    {
        return $this->belongsToMany(Ad::class);
    }

}
