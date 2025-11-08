<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Experience;
use Illuminate\Http\JsonResponse;

class ExperienceController extends Controller
{
    public function index(): JsonResponse
    {
        try {
            $experiences = Experience::ordreChronologique()->get();

            return response()->json($experiences);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erreur lors du chargement des expériences',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
