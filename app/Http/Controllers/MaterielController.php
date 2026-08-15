<?php

namespace App\Http\Controllers;

use App\Models\Materiel;
use Illuminate\Http\Request;

class MaterielController extends Controller
{
    public function index(Request $request)
    {
        $query = Materiel::with('category')->when($request->filled('search'), function ($q) use ($request) {
            $q->where('nom', 'like', '%' . $request->search . '%');
        })->when($request->filled('etat'), function ($q) use ($request) {
            $q->where('etat', $request->etat);
        })->when($request->filled('category_id'), function ($q) use ($request) {
            $q->where('category_id', $request->category_id);
        });

        return response()->json($query->paginate(15));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => ['required', 'uuid', 'exists:categories,id'],
            'nom' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'numero_serie' => ['nullable', 'string', 'max:255'],
            'quantite_disponible' => ['required', 'integer', 'min:0'],
            'etat' => ['required', 'in:disponible,en_maintenance,hors_service'],
        ]);

        $materiel = Materiel::create($validated);

        return response()->json($materiel, 201);
    }

    public function show(Materiel $materiel)
    {
        return response()->json($materiel->load('category'));
    }

    public function update(Request $request, Materiel $materiel)
    {
        $validated = $request->validate([
            'category_id' => ['sometimes', 'uuid', 'exists:categories,id'],
            'nom' => ['sometimes', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'numero_serie' => ['nullable', 'string', 'max:255'],
            'quantite_disponible' => ['sometimes', 'integer', 'min:0'],
            'etat' => ['sometimes', 'in:disponible,en_maintenance,hors_service'],
        ]);

        $materiel->update($validated);

        return response()->json($materiel);
    }

    public function destroy(Materiel $materiel)
    {
        $materiel->delete();

        return response()->json(['message' => 'Matériel supprimé.'], 200);
    }
}
