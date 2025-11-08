<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Projet; // Changé de Project à Projet
use Illuminate\Http\JsonResponse;

class ProjetController extends Controller // Renommez aussi le contrôleur si nécessaire
{
    public function index(): JsonResponse
    {
        $projects = Projet::publie() // Changé de published() à publie()
            ->orderBy('publie_le', 'desc') // Changé de published_at à publie_le
            ->get(['id', 'titre', 'slug', 'description', 'image', 'technologies', 'url_projet', 'url_github', 'publie_le']); // Champs corrigés

        // Formater les données pour le frontend
        $formattedProjects = $projects->map(function ($project) {
            return [
                'id' => $project->id,
                'titre' => $project->titre,
                'slug' => $project->slug,
                'description' => $project->description,
                'image' => $project->image ? asset('storage/'.$project->image) : '/images/projet-par-defaut.jpg',
                'technologies' => $this->formatTechnologies($project->technologies),
                'categorie' => $project->categorie ?? 'web', // Utilise le champ catégorie du modèle
                'statut' => 'complet',
                'date_creation' => $project->publie_le ? $project->publie_le->format('Y-m-d') : null,
                'project_url' => $project->url_projet,
                'github_url' => $project->url_github,
            ];
        });

        return response()->json($formattedProjects);
    }

    public function show(Projet $projet): JsonResponse // Changé de Project à Projet
    {
        if (! $projet->publie_le || $projet->publie_le->isFuture()) { // Changé de published_at à publie_le
            abort(404);
        }

        // Formater les données pour le détail du projet
        $formattedProject = [
            'id' => $projet->id,
            'titre' => $projet->titre,
            'slug' => $projet->slug,
            'description' => $projet->description,
            'contenu' => $projet->contenu,
            'image' => $projet->image ? asset('storage/'.$projet->image) : '/images/projet-par-defaut.jpg',
            'technologies' => $this->formatTechnologies($projet->technologies),
            'categorie' => $projet->categorie ?? 'web',
            'statut' => 'complet',
            'date_creation' => $projet->publie_le ? $projet->publie_le->format('Y-m-d') : null,
            'project_url' => $projet->url_projet,
            'github_url' => $projet->url_github,
            'images_supplementaires' => $projet->galerie ?? [],
        ];

        return response()->json($formattedProject);
    }

    /**
     * Formater les technologies (supporte JSON et string)
     */
    private function formatTechnologies($technologies): array
    {
        if (is_array($technologies)) {
            return $technologies;
        }

        if (is_string($technologies)) {
            // Si c'est un JSON string
            $decoded = json_decode($technologies, true);
            if (json_last_error() === JSON_ERROR_NONE) {
                return $decoded;
            }

            // Si c'est une string séparée par des virgules
            return array_map('trim', explode(',', $technologies));
        }

        return [];
    }
}
