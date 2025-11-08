<?php

// database/seeders/TemoignageSeeder.php

namespace Database\Seeders;

use App\Models\Projet;
use App\Models\Temoignage;
use Illuminate\Database\Seeder;

class TemoignageSeeder extends Seeder
{
    public function run()
    {
        $projets = Projet::all();

        $temoignages = [
            [
                'nom_client' => 'Marie Lambert',
                'poste_client' => 'Directrice Marketing',
                'entreprise_client' => 'TechCorp',
                'avatar_client' => null,
                'contenu' => 'John a réalisé un excellent travail sur notre plateforme e-commerce. Son professionnalisme et sa maîtrise technique ont dépassé nos attentes. Le projet a été livré dans les temps et avec une qualité exceptionnelle.',
                'note' => 5,
                'projet_id' => $projets->where('slug', 'application-ecommerce-modern')->first()->id,
                'ordre' => 1,
                'est_visible' => true,
            ],
            [
                'nom_client' => 'Pierre Dubois',
                'poste_client' => 'CEO',
                'entreprise_client' => 'StartUp Innovante',
                'avatar_client' => null,
                'contenu' => 'Collaboration remarquable avec John sur notre application SaaS. Sa capacité à comprendre nos besoins métier et à proposer des solutions techniques optimales a été déterminante pour notre succès.',
                'note' => 5,
                'projet_id' => $projets->where('slug', 'application-mobile-fitness')->first()->id,
                'ordre' => 2,
                'est_visible' => true,
            ],
            [
                'nom_client' => 'Sophie Martin',
                'poste_client' => 'Product Manager',
                'entreprise_client' => 'DataSolutions',
                'avatar_client' => null,
                'contenu' => 'Le dashboard analytics développé par John a transformé notre façon de visualiser les données. Interface intuitive, performances excellentes et un support réactif. Je recommande vivement !',
                'note' => 5,
                'projet_id' => $projets->where('slug', 'dashboard-analytics')->first()->id,
                'ordre' => 3,
                'est_visible' => true,
            ],
            [
                'nom_client' => 'Thomas Leroy',
                'poste_client' => 'CTO',
                'entreprise_client' => 'WebAgency',
                'avatar_client' => null,
                'contenu' => 'John a fait preuve d\'une grande expertise technique sur notre refonte frontend. Son code est propre, bien documenté et ses solutions sont toujours élégantes. Un plaisir de collaborer avec lui.',
                'note' => 4,
                'projet_id' => null, // Témoignage général
                'ordre' => 4,
                'est_visible' => true,
            ],
            [
                'nom_client' => 'Julie Petit',
                'poste_client' => 'Designer UX',
                'entreprise_client' => 'CreativeLab',
                'avatar_client' => null,
                'contenu' => 'Travailler avec John a été une expérience incroyable. Il comprend parfaitement les enjeux UX et sait traduire les maquettes en interfaces fonctionnelles et esthétiques. Son attention aux détails est impressionnante.',
                'note' => 5,
                'projet_id' => null, // Témoignage général
                'ordre' => 5,
                'est_visible' => true,
            ],
            [
                'nom_client' => 'Marc Bernard',
                'poste_client' => 'Freelance',
                'entreprise_client' => null,
                'avatar_client' => null,
                'contenu' => 'J\'ai collaboré avec John sur plusieurs projets en remote. Sa communication est excellente, ses délais sont toujours respectés et la qualité de son travail est constante. Un partenaire de confiance.',
                'note' => 5,
                'projet_id' => null, // Témoignage général
                'ordre' => 6,
                'est_visible' => true,
            ],
        ];

        foreach ($temoignages as $temoignage) {
            Temoignage::create($temoignage);
        }
    }
}
