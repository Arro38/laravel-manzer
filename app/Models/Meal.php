<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meal extends Model
{
    use HasFactory;

    // Add the fillable property to allow mass assignment on the model

    protected $user_id;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->user_id = $attributes['user_id'] ?? null;
    }

    protected $fillable = [
        'name',
        'description',
        'price',
        'image',
        'user_id',
        'enabled'
    ];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class)->select(['id', 'name', 'tel', 'address', 'sector_id']);
    }


}
