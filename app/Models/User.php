<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, HasUuids;

    public $incrementing = false;

    protected $keyType = 'string';

    protected $guarded = [];

    protected $fillable = ['nom', 'email', 'password', 'role', 'statut', 'password_set'];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'role' => 'string',
        'statut' => 'string',
        'password_set' => 'boolean',
    ];

    public function emprunts()
    {
        return $this->hasMany(Emprunt::class, 'user_id');
    }
}
