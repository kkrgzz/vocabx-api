<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class UserProfile extends Model
{
    /** @use HasFactory<\Database\Factories\UserProfileFactory> */
    use HasFactory;
    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'profile_image',
        'mother_language',
        'target_language',
        'is_ai_assistant_enabled',
        'api_key',
        'preferred_model_id',
    ];

    // Accessor for profile_image to return the full URL
    public function getProfileImageAttribute($value)
    {
        return $value ? env('APP_URL') . Storage::url($value) : null;
    }

    // Relationship with User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
