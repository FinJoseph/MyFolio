<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Competence;
use Illuminate\Http\JsonResponse;

class CompetenceController extends Controller
{
    public function index(): JsonResponse
    {
        try {
            $competences = Competence::visible()->get();

            return response()->json($competences);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erreur lors du chargement des compétences',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
