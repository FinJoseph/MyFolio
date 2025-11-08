<?php

// app/Http/Controllers/Front/AccueilController.php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Competence;
use App\Models\InformationPersonnelle;
use App\Models\Parametre;
use App\Models\Projet;
use App\Models\Service;
use App\Models\Temoignage;
use Illuminate\Http\JsonResponse;

class AccueilController extends Controller
{
    public function index(): JsonResponse
    {
        try {
            $infosPersonnelles = InformationPersonnelle::obtenir();

            $projetsMisEnAvant = Projet::publie()
                ->misEnAvant()
                ->orderBy('publie_le', 'desc')
                ->limit(3)
                ->get(['id', 'titre', 'slug', 'description', 'image', 'technologies', 'categorie']);

            $competences = Competence::visible()
                ->get(['id', 'nom', 'categorie', 'niveau', 'icone', 'couleur']);

            $temoignages = Temoignage::visible()
                ->with('projet:id,titre')
                ->limit(6)
                ->get();

            $services = Service::visible()->get();

            return response()->json([
                'informations_personnelles' => $infosPersonnelles,
                'projets_mis_en_avant' => $projetsMisEnAvant,
                'competences' => $competences,
                'temoignages' => $temoignages,
                'services' => $services,
                'statistiques' => [
                    'total_projets' => Projet::publie()->count(),
                    'annees_experience' => Parametre::obtenir('annees_experience', 0),
                    'clients_satisfaits' => Parametre::obtenir('clients_satisfaits', 0),
                ],
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erreur lors du chargement des données',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
