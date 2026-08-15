<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmpruntRequest;
use App\Http\Requests\ReturnEmpruntRequest;
use App\Models\Emprunt;
use App\Models\Materiel;
use Illuminate\Http\Request;
use Carbon\Carbon;

class EmpruntController extends Controller
{
    public function index()
    {
        return response()->json(Emprunt::with(['user','materiel'])->paginate(15));
    }

    public function store(StoreEmpruntRequest $request)
    {
        $validated = $request->validated();

        $materiel = Materiel::findOrFail($validated['materiel_id']);

        if ($materiel->quantite_disponible <= 0) {
            return response()->json(['message' => 'Rupture de stock.'], 422);
        }

        if (in_array($materiel->etat, ['en_maintenance', 'hors_service'])) {
            return response()->json(['message' => 'Matériel indisponible (maintenance/hors service).'], 422);
        }

        // Décrémente le stock
        $materiel->decrement('quantite_disponible');

        $emprunt = Emprunt::create([
            'user_id' => $request->user()->id,
            'materiel_id' => $materiel->id,
            'date_emprunt' => Carbon::parse($validated['date_emprunt'])->toDateString(),
            'date_prevue_retour' => Carbon::parse($validated['date_prevue_retour'])->toDateString(),
            'statut' => 'en_cours',
        ]);

        return response()->json($emprunt, 201);
    }

    public function show(Emprunt $emprunt)
    {
        return response()->json($emprunt->load(['user','materiel']));
    }

    public function return(ReturnEmpruntRequest $request, Emprunt $emprunt)
    {
        if ($emprunt->statut === 'retourne') {
            return response()->json(['message' => 'Emprunt déjà retourné.'], 422);
        }

        $validated = $request->validated();

        $emprunt->date_effective_retour = Carbon::parse($validated['date_effective_retour'])->toDateString();
        $emprunt->statut = 'retourne';
        $emprunt->save();

        // Incrémente le stock
        $materiel = $emprunt->materiel;
        $materiel->increment('quantite_disponible');

        return response()->json($emprunt);
    }
}
