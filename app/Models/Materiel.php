<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Materiel extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'category_id',
        'nom',
        'description',
        'numero_serie',
        'quantite_disponible',
        'etat',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function emprunts()
    {
        return $this->hasMany(Emprunt::class, 'materiel_id');
    }
}
