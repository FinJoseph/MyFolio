<?php

// database/seeders/ServiceSeeder.php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run()
    {
        $services = [
            [
                'titre' => 'Développement Web Sur Mesure',
                'icone' => '💻',
                'description' => 'Création d\'applications web modernes et performantes adaptées à vos besoins spécifiques. Développement full-stack avec les dernières technologies.',
                'fonctionnalites' => [
                    'Applications responsives',
                    'Bases de données optimisées',
                    'APIs RESTful',
                    'Intégration de paiement',
                    'Systèmes d\'authentification',
                    'Déploiement et hébergement',
                ],
                'ordre' => 1,
                'est_visible' => true,
            ],
            [
                'titre' => 'Applications Mobile',
                'icone' => '📱',
                'description' => 'Développement d\'applications mobiles cross-platform pour iOS et Android. Interfaces intuitives et expérience utilisateur optimale.',
                'fonctionnalites' => [
                    'Applications iOS et Android',
                    'Design adaptatif',
                    'Performances optimisées',
                    'Notifications push',
                    'Intégration d\'APIs',
                    'Publication sur les stores',
                ],
                'ordre' => 2,
                'est_visible' => true,
            ],
            [
                'titre' => 'UI/UX Design',
                'icone' => '🎨',
                'description' => 'Conception d\'interfaces utilisateur modernes et intuitives. Focus sur l\'expérience utilisateur pour maximiser l\'engagement.',
                'fonctionnalites' => [
                    'Design system complet',
                    'Prototypage interactif',
                    'Tests utilisateurs',
                    'Wireframes et maquettes',
                    'Design responsif',
                    'Guidelines et documentation',
                ],
                'ordre' => 3,
                'est_visible' => true,
            ],
            [
                'titre' => 'Consulting Technique',
                'icone' => '📊',
                'description' => 'Audit et optimisation de vos systèmes existants. Conseils stratégiques pour améliorer performances et maintenabilité.',
                'fonctionnalites' => [
                    'Audit de code',
                    'Optimisation des performances',
                    'Architecture logicielle',
                    'Revue de sécurité',
                    'Plan de migration',
                    'Formation d\'équipe',
                ],
                'ordre' => 4,
                'est_visible' => true,
            ],
            [
                'titre' => 'Maintenance & Support',
                'icone' => '🔧',
                'description' => 'Service de maintenance continue et support technique pour assurer le bon fonctionnement de vos applications.',
                'fonctionnalites' => [
                    'Maintenance corrective',
                    'Mises à jour de sécurité',
                    'Support technique',
                    'Monitoring 24/7',
                    'Sauvegardes automatiques',
                    'Rapports de performance',
                ],
                'ordre' => 5,
                'est_visible' => true,
            ],
            [
                'titre' => 'Optimisation SEO',
                'icone' => '🔍',
                'description' => 'Amélioration du référencement naturel de votre site web pour augmenter votre visibilité sur les moteurs de recherche.',
                'fonctionnalites' => [
                    'Audit SEO complet',
                    'Optimisation technique',
                    'Recherche de mots-clés',
                    'Content strategy',
                    'Analytics et reporting',
                    'SEO local',
                ],
                'ordre' => 6,
                'est_visible' => true,
            ],
            [
                'titre' => 'Formation & Mentorat',
                'icone' => '👨‍🏫',
                'description' => 'Formations personnalisées et mentorat pour votre équipe sur les technologies modernes et bonnes pratiques.',
                'fonctionnalites' => [
                    'Formations sur mesure',
                    'Workshops pratiques',
                    'Code reviews',
                    'Pair programming',
                    'Documentation technique',
                    'Support continu',
                ],
                'ordre' => 7,
                'est_visible' => true,
            ],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}
