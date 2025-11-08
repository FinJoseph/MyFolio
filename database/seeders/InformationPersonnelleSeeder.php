<?php

// database/seeders/InformationPersonnelleSeeder.php

namespace Database\Seeders;

use App\Models\InformationPersonnelle;
use Illuminate\Database\Seeder;

class InformationPersonnelleSeeder extends Seeder
{
    public function run()
    {
        InformationPersonnelle::create([
            'nom_complet' => 'John Doe',
            'prenom' => 'John',
            'nom' => 'Doe',
            'titre_poste' => 'Développeur Full-Stack & Designer',
            'bio_courte' => 'Développeur passionné créant des expériences web modernes et performantes.',
            'bio_complete' => 'Avec plus de 5 ans d\'expérience dans le développement web, je me spécialise dans la création d\'applications modernes et performantes. Passionné par les nouvelles technologies et l\'UX/UI design.',
            'email' => 'contact@johndoe.com',
            'telephone' => '+33 6 12 34 56 78',
            'adresse' => '123 Rue de la République',
            'ville' => 'Paris',
            'pays' => 'France',
            'code_postal' => '75001',
            'date_naissance' => '1990-05-15',
            'linkedin' => 'https://linkedin.com/in/johndoe',
            'github' => 'https://github.com/johndoe',
            'twitter' => 'https://twitter.com/johndoe',
            'disponible_freelance' => true,
            'statut_disponibilite' => 'disponible',
            'message_disponibilite' => 'Ouvert à de nouvelles opportunités passionnantes !',
            'meta_titre' => 'John Doe - Développeur Full-Stack & Designer',
            'meta_description' => 'Portfolio de John Doe, développeur full-stack passionné créant des expériences web modernes et performantes.',
            'meta_mots_cles' => ['développeur', 'full-stack', 'designer', 'portfolio', 'web'],
        ]);
    }
}
