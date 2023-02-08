<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'ip',
        'team_id',
        'ikev2',
        'user',
        'password',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
}