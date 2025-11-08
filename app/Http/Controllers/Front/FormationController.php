<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Formation;
use Illuminate\Http\JsonResponse;

class FormationController extends Controller
{
    public function index(): JsonResponse
    {
        try {
            $formations = Formation::ordreChronologique()->get();

            return response()->json($formations);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erreur lors du chargement des formations',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
