<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Emprunt extends Model
{
    use HasFactory, HasUuids;

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'user_id',
        'materiel_id',
        'date_emprunt',
        'date_prevue_retour',
        'date_effective_retour',
        'statut',
    ];

    protected $casts = [
        'date_emprunt' => 'date',
        'date_prevue_retour' => 'date',
        'date_effective_retour' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function materiel()
    {
        return $this->belongsTo(Materiel::class);
    }
}
