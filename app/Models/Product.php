<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'image', 'price', 'rate', 'team_id', 'tags',
    ];

    public function subscriptions()
    {
        return $this->hasMany(UserSubscription::class);
    }
}