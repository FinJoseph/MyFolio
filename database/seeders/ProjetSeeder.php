<?php

// database/seeders/ProjetSeeder.php

namespace Database\Seeders;

use App\Models\Projet;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class ProjetSeeder extends Seeder
{
    public function run()
    {
        $projets = [
            [
                'titre' => 'Application E-commerce Modern',
                'slug' => 'application-ecommerce-modern',
                'description' => 'Plateforme e-commerce complète avec système de paiement et gestion d\'inventaire.',
                'contenu' => 'Développement d\'une application e-commerce moderne avec Laravel et Vue.js...',
                'image' => 'projets/ecommerce.jpg',
                'technologies' => ['Laravel', 'Vue.js', 'MySQL', 'Tailwind CSS', 'Stripe'],
                'url_projet' => 'https://ecommerce-example.com',
                'url_github' => 'https://github.com/johndoe/ecommerce',
                'categorie' => 'Développement Web',
                'ordre' => 1,
                'est_mis_en_avant' => true,
                'date_projet' => '2024-01-15',
                'publie_le' => Carbon::now()->subDays(10),
            ],
            [
                'titre' => 'Dashboard Analytics',
                'slug' => 'dashboard-analytics',
                'description' => 'Tableau de bord interactif pour visualisation de données en temps réel.',
                'contenu' => 'Création d\'un dashboard analytics avec graphiques interactifs...',
                'image' => 'projets/dashboard.jpg',
                'technologies' => ['React', 'Node.js', 'MongoDB', 'D3.js', 'Express'],
                'url_projet' => 'https://analytics-demo.com',
                'url_github' => 'https://github.com/johndoe/analytics-dashboard',
                'categorie' => 'Data Visualization',
                'ordre' => 2,
                'est_mis_en_avant' => true,
                'date_projet' => '2024-02-01',
                'publie_le' => Carbon::now()->subDays(5),
            ],
            [
                'titre' => 'Application Mobile Fitness',
                'slug' => 'application-mobile-fitness',
                'description' => 'App mobile de suivi fitness avec plans d\'entraînement personnalisés.',
                'contenu' => 'Développement d\'une application mobile cross-platform pour le fitness...',
                'image' => 'projets/fitness-app.jpg',
                'technologies' => ['React Native', 'Firebase', 'Redux', 'Node.js'],
                'url_projet' => null,
                'url_github' => 'https://github.com/johndoe/fitness-app',
                'categorie' => 'Mobile',
                'ordre' => 3,
                'est_mis_en_avant' => false,
                'date_projet' => '2024-01-20',
                'publie_le' => Carbon::now()->subDays(2),
            ],
        ];

        foreach ($projets as $projet) {
            Projet::create($projet);
        }
    }
}
