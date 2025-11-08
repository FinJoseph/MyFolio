<?php

// database/seeders/CompetenceSeeder.php

namespace Database\Seeders;

use App\Models\Competence;
use Illuminate\Database\Seeder;

class CompetenceSeeder extends Seeder
{
    public function run()
    {
        $competences = [
            // Frontend
            [
                'nom' => 'Vue.js',
                'categorie' => 'frontend',
                'niveau' => 90,
                'icone' => 'vuejs',
                'couleur' => '#41b883',
                'ordre' => 1,
                'est_visible' => true,
            ],
            [
                'nom' => 'React',
                'categorie' => 'frontend',
                'niveau' => 85,
                'icone' => 'react',
                'couleur' => '#61dafb',
                'ordre' => 2,
                'est_visible' => true,
            ],
            [
                'nom' => 'JavaScript',
                'categorie' => 'frontend',
                'niveau' => 95,
                'icone' => 'javascript',
                'couleur' => '#f7df1e',
                'ordre' => 3,
                'est_visible' => true,
            ],
            [
                'nom' => 'TypeScript',
                'categorie' => 'frontend',
                'niveau' => 80,
                'icone' => 'typescript',
                'couleur' => '#3178c6',
                'ordre' => 4,
                'est_visible' => true,
            ],
            [
                'nom' => 'Tailwind CSS',
                'categorie' => 'frontend',
                'niveau' => 88,
                'icone' => 'tailwind',
                'couleur' => '#06b6d4',
                'ordre' => 5,
                'est_visible' => true,
            ],

            // Backend
            [
                'nom' => 'Laravel',
                'categorie' => 'backend',
                'niveau' => 92,
                'icone' => 'laravel',
                'couleur' => '#ff2d20',
                'ordre' => 1,
                'est_visible' => true,
            ],
            [
                'nom' => 'PHP',
                'categorie' => 'backend',
                'niveau' => 90,
                'icone' => 'php',
                'couleur' => '#777bb4',
                'ordre' => 2,
                'est_visible' => true,
            ],
            [
                'nom' => 'Node.js',
                'categorie' => 'backend',
                'niveau' => 85,
                'icone' => 'nodejs',
                'couleur' => '#339933',
                'ordre' => 3,
                'est_visible' => true,
            ],
            [
                'nom' => 'MySQL',
                'categorie' => 'backend',
                'niveau' => 88,
                'icone' => 'mysql',
                'couleur' => '#4479a1',
                'ordre' => 4,
                'est_visible' => true,
            ],
            [
                'nom' => 'API REST',
                'categorie' => 'backend',
                'niveau' => 90,
                'icone' => 'api',
                'couleur' => '#ff6b6b',
                'ordre' => 5,
                'est_visible' => true,
            ],

            // Design
            [
                'nom' => 'UI/UX Design',
                'categorie' => 'design',
                'niveau' => 85,
                'icone' => 'figma',
                'couleur' => '#f24e1e',
                'ordre' => 1,
                'est_visible' => true,
            ],
            [
                'nom' => 'Figma',
                'categorie' => 'design',
                'niveau' => 88,
                'icone' => 'figma',
                'couleur' => '#f24e1e',
                'ordre' => 2,
                'est_visible' => true,
            ],
            [
                'nom' => 'Adobe XD',
                'categorie' => 'design',
                'niveau' => 75,
                'icone' => 'xd',
                'couleur' => '#ff61f6',
                'ordre' => 3,
                'est_visible' => true,
            ],

            // Outils
            [
                'nom' => 'Git',
                'categorie' => 'outils',
                'niveau' => 95,
                'icone' => 'git',
                'couleur' => '#f05032',
                'ordre' => 1,
                'est_visible' => true,
            ],
            [
                'nom' => 'Docker',
                'categorie' => 'outils',
                'niveau' => 80,
                'icone' => 'docker',
                'couleur' => '#2496ed',
                'ordre' => 2,
                'est_visible' => true,
            ],
            [
                'nom' => 'AWS',
                'categorie' => 'outils',
                'niveau' => 70,
                'icone' => 'aws',
                'couleur' => '#ff9900',
                'ordre' => 3,
                'est_visible' => true,
            ],
        ];

        foreach ($competences as $competence) {
            Competence::create($competence);
        }
    }
}
