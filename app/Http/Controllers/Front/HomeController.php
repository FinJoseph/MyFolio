<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\JsonResponse;

class HomeController extends Controller
{
    public function index(): JsonResponse
    {
        $featuredProjects = Project::published()
            ->featured()
            ->orderBy('published_at', 'desc')
            ->limit(3)
            ->get(['id', 'title', 'slug', 'description', 'image', 'technologies']);

        return response()->json([
            'featured_projects' => $featuredProjects,
            'stats' => [
                'total_projects' => Project::published()->count(),
            ],
        ]);
    }
}
