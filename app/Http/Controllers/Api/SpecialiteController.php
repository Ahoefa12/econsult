<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Specialite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SpecialiteController extends Controller
{
    // Lister toutes les spécialités
    public function index()
    {
        $specialities = Specialite::all();
        return view('specialite.index');
    }

    // Afficher une spécialité spécifique (non essentiel pour ce CdC, mais bonne pratique)
    public function show($id)
    {
        $speciality = Specialite::with('medecins')->find($id);
        if (!$speciality) {
            return response()->json(['message' => 'Spécialité non trouvée'], 404);
        }
        return response()->json($speciality);
    }

    // Ajouter une nouvelle spécialité (nécessiterait authentification admin)
    public function store(Request $request)
    {
        // Exemple de validation
        $validator = Validator::make($request->all(), [
            'nom' => 'required|string|max:255|unique:specialities',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $speciality = Specialite::create($request->all());
        return response()->json(['message' => 'Spécialité créée avec succès', 'speciality' => $speciality], 201);
    }

    // Mettre à jour une spécialité (nécessiterait authentification admin)
    public function update(Request $request, $id)
    {
        $speciality = Specialite::find($id);
        if (!$speciality) {
            return response()->json(['message' => 'Spécialité non trouvée'], 404);
        }

        $validator = Validator::make($request->all(), [
            'nom' => 'required|string|max:255|unique:specialities,' . $id,
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $speciality->update($request->all());
        return response()->json(['message' => 'Spécialité mise à jour avec succès', 'speciality' => $speciality]);
    }

    // Supprimer une spécialité (nécessiterait authentification admin)
    public function destroy($id)
    {
        $speciality = Specialite::find($id);
        if (!$speciality) {
            return response()->json(['message' => 'Spécialité non trouvée'], 404);
        }

        $speciality->delete();
        return response()->json(['message' => 'Spécialité supprimée avec succès']);
    }
}