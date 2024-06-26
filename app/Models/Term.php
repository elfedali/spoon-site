<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Term extends Model
{
    use HasFactory;
    //todo : use \App\Models\Concerns\UsesUuid;
    use HasSlug;


    public const TYPE_SERVICE = 'service';
    public const TYPE_KITCHEN = 'kitchen';



    /**
     * The taxonomy of the term. (kitchen, amenity, service)
     * used to categorize the term.
     * @var array 
     * 
     */
    public const TAXONOMY = [
        'kitchen', # en français : cuisine
        'amenity', # en français : équipement
        'service', # en français : service

    ];


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
        'taxonomy',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    //places
    public function places()
    {
        return $this->belongsToMany(Place::class);
    }
}
