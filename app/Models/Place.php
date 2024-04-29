<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Place extends Model implements HasMedia
{
    use HasFactory;
    use HasSlug;
    use InteractsWithMedia;

    public const TYPES = [
        'place' => 'place',
        'cafe' => 'Café',
        // 'hotel' => 'Hôtel',
        'spa' => 'Spa',
        // 'salon' => 'Salon',
    ];
    public const STATUSES = [
        'draft' => 'Brouillon',
        'published' => 'Publié',
    ];
    public const RESERVATION_REQUIRED = [
        '1' => 'Oui',
        '0' => 'Non',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'owner_id',
        'approver_id',
        // 'place_type',
        'place_service',
        'place_kitchen',

        'street_id',

        'title',
        'slug',
        'address',

        'city',
        'neighborhood',
        'country',

        'email',
        'phone',
        'phone_secondary',
        'phone_tertiary',
        'website',
        'description',
        'excerpt',

        'status',
        'reservation_required',
        'opening_hours'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'owner_id' => 'integer',
        'approver_id' => 'integer',
        'street_id' => 'integer',
        // 'reservation_required' => 'boolean',
    ];

    public function openingHours(): HasMany
    {
        return $this->hasMany(OpeningHour::class);
    }

    public function salles(): HasMany
    {
        return $this->hasMany(Salle::class);
    }

    public function pings(): HasMany
    {
        return $this->hasMany(Ping::class);
    }

    public function experiences(): HasMany
    {
        return $this->hasMany(Experience::class);
    }

    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class);
    }

    public function demands(): HasMany
    {
        return $this->hasMany(Demand::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    public function favorites(): HasMany
    {
        return $this->hasMany(Favorite::class);
    }

    public function attachments(): MorphMany
    {
        return $this->morphMany(Attachment::class, 'attachmentable');
    }

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function approver(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function street(): BelongsTo
    {
        return $this->belongsTo(Street::class);
    }

    // menu categeories
    public function menuCategories(): HasMany
    {
        return $this->hasMany(MenuCategory::class);
    }

    // slug
    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }


    // on save change the 'on' reservation_required to 1
    public function setReservationRequiredAttribute($value)
    {
        $this->attributes['reservation_required'] = $value === 'on' ? 1 : 0;
    }
}
