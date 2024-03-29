<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Experience extends Model
{
    use HasFactory;
    use HasSlug;


    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'place_id',
        'date_start',
        'date_end',
        'description',
        'title',
        'slug'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'place_id' => 'integer',
        'date_start' => 'datetime',
        'date_end' => 'datetime',
    ];

    public function attachments(): HasMany
    {
        return $this->hasMany(Attachment::class);
    }

    public function place(): BelongsTo
    {
        return $this->belongsTo(Place::class);
    }
}
