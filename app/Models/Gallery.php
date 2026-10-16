<?php

namespace App\Models;

use Database\Factories\GalleryFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * @property int $id // Internal PK - never expose publicly
 * @property string $uuid // Public identifier - expose in APIs
 * @property int $user_id
 * @property string $name
 * @property Carbon $event_date
 * @property string $location
 * @property string $slug
 * @property Carbon|null $expires_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read User $user
 */
#[Fillable(['uuid', 'user_id', 'name', 'event_date', 'location', 'slug', 'expires_at'])]
class Gallery extends Model
{
    /** @use HasFactory<GalleryFactory> */
    use HasFactory;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'event_date' => 'datetime',
            'expires_at' => 'datetime',
        ];
    }

    /**
     * Get the user that owns this gallery.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
