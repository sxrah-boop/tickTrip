<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'depart','latitude','longitude', 'destination', 'heure_depart', 'places_disponibles', 'prix', 'place_reserve',
    ];

    protected $casts = [
        'heure_depart' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
