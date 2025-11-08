<?php

// database/seeders/FormationSeeder.php

namespace Database\Seeders;

use App\Models\Formation;
use Illuminate\Database\Seeder;

class FormationSeeder extends Seeder
{
    public function run()
    {
        $formations = [
            [
                'diplome' => 'Master en Développement Web',
                'ecole' => 'Université Paris Tech',
                'domaine' => 'informatique',
                'description' => 'Spécialisation en architectures modernes, frameworks JavaScript et développement full-stack. Mémoire sur les performances des applications web.',
                'date_debut' => '2021-09-01',
                'date_fin' => '2023-06-30',
                'en_cours' => false,
                'ordre' => 1,
            ],
            [
                'diplome' => 'Bachelor Informatique',
                'ecole' => 'Ecole Supérieure d\'Informatique',
                'domaine' => 'informatique',
                'description' => 'Formation généraliste en informatique avec spécialisation en développement web et bases de données.',
                'date_debut' => '2018-09-01',
                'date_fin' => '2021-06-30',
                'en_cours' => false,
                'ordre' => 2,
            ],
            [
                'diplome' => 'Certification AWS Solutions Architect',
                'ecole' => 'Amazon Web Services',
                'domaine' => 'informatique',
                'description' => 'Certification professionnelle en architecture cloud AWS, couvrant les services de calcul, stockage, réseau et base de données.',
                'date_debut' => '2023-01-15',
                'date_fin' => '2023-03-15',
                'en_cours' => false,
                'ordre' => 3,
            ],
            [
                'diplome' => 'Formation React Avancé',
                'ecole' => 'React Masters',
                'domaine' => 'informatique',
                'description' => 'Formation intensive sur les concepts avancés de React : hooks personnalisés, performance optimization, testing et patterns avancés.',
                'date_debut' => '2022-10-01',
                'date_fin' => '2022-11-15',
                'en_cours' => false,
                'ordre' => 4,
            ],
            [
                'diplome' => 'Formation UX/UI Design',
                'ecole' => 'Design Institute',
                'domaine' => 'design',
                'description' => 'Apprentissage des principes du design d\'expérience utilisateur et des interfaces modernes. Projets pratiques sur Figma et Adobe XD.',
                'date_debut' => '2023-09-01',
                'date_fin' => null,
                'en_cours' => true,
                'ordre' => 5,
            ],
            [
                'diplome' => 'Baccalauréat Scientifique',
                'ecole' => 'Lycée Pierre de Fermat',
                'domaine' => 'scientifique',
                'description' => 'Baccalauréat scientifique option sciences de l\'ingénieur, mention bien.',
                'date_debut' => '2015-09-01',
                'date_fin' => '2018-06-30',
                'en_cours' => false,
                'ordre' => 6,
            ],
        ];

        foreach ($formations as $formation) {
            Formation::create($formation);
        }
    }
}
