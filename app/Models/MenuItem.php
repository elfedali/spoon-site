<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MenuItem extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'menu_category_id',
        'name',
        'description',
        'price',
        'position',
        'is_available',
        'is_vegetarian',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'menu_category_id' => 'integer',
        // 'price' => 'decimal',
    ];

    public function menuCategory(): BelongsTo
    {
        return $this->belongsTo(MenuCategory::class);
    }

    // scope to always order by position
    // use it like this: MenuItem::ordered()->get();
    // in load method: $menuCategory->load(['menuItems' => fn($query) => $query->ordered()]);
    // and if $place->load('menuCategories', 'menuCategories.menuItems');
    // $place->menuCategories->each(fn($category) => $category->menuItems->each(fn($item) => $item->position));
    public function scopeOrdered($query)
    {
        return $query->orderBy('position');
    }
}
