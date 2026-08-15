<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Category;
use App\Models\Materiel;
use App\Models\Emprunt;

class DashboardController extends Controller
{
    public function index()
    {
        return response()->json([
            'users_count' => User::count(),
            'categories_count' => Category::count(),
            'materiels_count' => Materiel::count(),
            'materiels_disponible' => Materiel::where('etat', 'disponible')->sum('quantite_disponible'),
            'materiels_en_maintenance' => Materiel::where('etat', 'en_maintenance')->count(),
            'materiels_hors_service' => Materiel::where('etat', 'hors_service')->count(),
            'emprunts_en_cours' => Emprunt::where('statut','en_cours')->count(),
            'emprunts_retournes' => Emprunt::where('statut','retourne')->count(),
        ]);
    }
}
