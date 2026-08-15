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

    public function getForenameAttribute()
    {
        return $this->nom;
    }

    public function setForenameAttribute($value)
    {
        $this->attributes['nom'] = $value;
    }

    public function getSurnameAttribute()
    {
        return '';
    }

    public function setSurnameAttribute($value)
    {
        // Ignored as nom stores the full name
    }

    public function getNameAttribute()
    {
        return $this->nom;
    }

    public function setNameAttribute($value)
    {
        $this->attributes['nom'] = $value;
    }

    public function getUserFullNameAttribute()
    {
        return $this->nom;
    }
}
