<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meal extends Model
{
    use HasFactory;
    // Add the fillable property to allow mass assignment on the model

    public mixed $user_id;
    protected $fillable = [
        'name',
        'description',
        'price',
        'image',
        'user_id',
        'enabled'
    ];

    public function user()
    {
        return $this->belongsTo(User::class)->select(['id', 'sector_id']);
    }


}
