<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TodoCategory extends Model
{
    /** @use HasFactory<\Database\Factories\TodoCategoryFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'color',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
