<?php

// database/seeders/ExperienceSeeder.php

namespace Database\Seeders;

use App\Models\Experience;
use Illuminate\Database\Seeder;

class ExperienceSeeder extends Seeder
{
    public function run()
    {
        $experiences = [
            [
                'poste' => 'Développeur Full-Stack Senior',
                'entreprise' => 'TechCorp',
                'url_entreprise' => 'https://techcorp.com',
                'lieu' => 'Paris, France',
                'type_emploi' => 'CDI',
                'description' => 'Développement et maintenance d\'applications web complexes pour des clients internationaux. Lead technique sur plusieurs projets.',
                'realisations' => [
                    'Refonte complète de la plateforme e-commerce avec amélioration des performances de 40%',
                    'Mise en place d\'une architecture microservices',
                    'Formation et mentorat de 3 développeurs juniors',
                ],
                'technologies' => ['Laravel', 'Vue.js', 'MySQL', 'Docker', 'AWS'],
                'date_debut' => '2022-03-01',
                'date_fin' => null,
                'en_cours' => true,
                'ordre' => 1,
            ],
            [
                'poste' => 'Développeur Frontend',
                'entreprise' => 'WebAgency',
                'url_entreprise' => 'https://webagency.fr',
                'lieu' => 'Lyon, France',
                'type_emploi' => 'CDI',
                'description' => 'Création d\'interfaces utilisateur modernes et responsives pour divers clients. Collaboration étroite avec l\'équipe design.',
                'realisations' => [
                    'Développement de 15+ sites web responsifs',
                    'Implémentation de design systems',
                    'Optimisation des performances frontend',
                ],
                'technologies' => ['React', 'TypeScript', 'Sass', 'GraphQL', 'Jest'],
                'date_debut' => '2020-06-15',
                'date_fin' => '2022-02-28',
                'en_cours' => false,
                'ordre' => 2,
            ],
            [
                'poste' => 'Développeur Full-Stack',
                'entreprise' => 'StartUp Innovante',
                'url_entreprise' => 'https://startup-innovante.com',
                'lieu' => 'Toulouse, France',
                'type_emploi' => 'Alternance',
                'description' => 'Développement full-stack d\'une application SaaS. Participation à toutes les phases du projet, du concept au déploiement.',
                'realisations' => [
                    'Développement d\'une application SaaS from scratch',
                    'Mise en place de l\'infrastructure CI/CD',
                    'Intégration de paiements en ligne',
                ],
                'technologies' => ['Node.js', 'React', 'MongoDB', 'Stripe', 'GitLab CI'],
                'date_debut' => '2019-09-01',
                'date_fin' => '2020-06-01',
                'en_cours' => false,
                'ordre' => 3,
            ],
            [
                'poste' => 'Développeur Web Freelance',
                'entreprise' => 'Indépendant',
                'url_entreprise' => null,
                'lieu' => 'Remote',
                'type_emploi' => 'Freelance',
                'description' => 'Prestations de développement web pour divers clients. Gestion de projet, développement et déploiement.',
                'realisations' => [
                    'Réalisation de 20+ projets pour différents clients',
                    'Développement de sites vitrines et e-commerce',
                    'Consulting technique',
                ],
                'technologies' => ['PHP', 'JavaScript', 'WordPress', 'WooCommerce', 'jQuery'],
                'date_debut' => '2018-01-01',
                'date_fin' => '2019-08-31',
                'en_cours' => false,
                'ordre' => 4,
            ],
        ];

        foreach ($experiences as $experience) {
            Experience::create($experience);
        }
    }
}
