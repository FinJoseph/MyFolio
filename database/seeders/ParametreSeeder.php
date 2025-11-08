<?php

// database/seeders/ParametreSeeder.php

namespace Database\Seeders;

use App\Models\Parametre;
use Illuminate\Database\Seeder;

class ParametreSeeder extends Seeder
{
    public function run()
    {
        // Groupe: Général
        Parametre::definir(
            'nom_site',
            'Portfolio John Doe',
            'text',
            'general',
            'Nom du site portfolio'
        );

        Parametre::definir(
            'slogan',
            'Développeur Full-Stack Passionné',
            'text',
            'general',
            'Slogan ou phrase d\'accroche'
        );

        Parametre::definir(
            'maintenance_mode',
            false,
            'boolean',
            'general',
            'Mode maintenance activé/désactivé'
        );

        // Groupe: Contact
        Parametre::definir(
            'email_contact',
            'contact@johndoe.com',
            'text',
            'contact',
            'Email principal de contact'
        );

        Parametre::definir(
            'telephone',
            '+33 6 12 34 56 78',
            'text',
            'contact',
            'Numéro de téléphone'
        );

        Parametre::definir(
            'adresse',
            '123 Rue de la République, 75001 Paris, France',
            'text',
            'contact',
            'Adresse complète'
        );

        Parametre::definir(
            'horaires_contact',
            'Lun - Ven: 9h - 18h',
            'text',
            'contact',
            'Horaires de contact'
        );

        // Groupe: Réseaux sociaux
        Parametre::definir(
            'linkedin_url',
            'https://linkedin.com/in/johndoe',
            'text',
            'social',
            'URL LinkedIn'
        );

        Parametre::definir(
            'github_url',
            'https://github.com/johndoe',
            'text',
            'social',
            'URL GitHub'
        );

        Parametre::definir(
            'twitter_url',
            'https://twitter.com/johndoe',
            'text',
            'social',
            'URL Twitter'
        );

        Parametre::definir(
            'instagram_url',
            'https://instagram.com/johndoe',
            'text',
            'social',
            'URL Instagram'
        );

        // Groupe: SEO
        Parametre::definir(
            'meta_description',
            'Portfolio de John Doe, développeur full-stack passionné créant des expériences web modernes et performantes.',
            'text',
            'seo',
            'Meta description par défaut'
        );

        Parametre::definir(
            'meta_keywords',
            ['développeur', 'full-stack', 'portfolio', 'web', 'react', 'laravel'],
            'json',
            'seo',
            'Mots-clés SEO'
        );

        Parametre::definir(
            'google_analytics_id',
            'GA-123456789',
            'text',
            'seo',
            'ID Google Analytics'
        );

        // Groupe: Apparence
        Parametre::definir(
            'theme_couleur_principale',
            '#3b82f6',
            'text',
            'appearance',
            'Couleur principale du thème'
        );

        Parametre::definir(
            'theme_couleur_secondaire',
            '#8b5cf6',
            'text',
            'appearance',
            'Couleur secondaire du thème'
        );

        Parametre::definir(
            'logo_url',
            '/assets/images/logo.png',
            'text',
            'appearance',
            'URL du logo'
        );

        Parametre::definir(
            'favicon_url',
            '/assets/images/favicon.ico',
            'text',
            'appearance',
            'URL du favicon'
        );

        // Groupe: Statistiques
        Parametre::definir(
            'annees_experience',
            5,
            'number',
            'stats',
            'Nombre d\'années d\'expérience'
        );

        Parametre::definir(
            'clients_satisfaits',
            42,
            'number',
            'stats',
            'Nombre de clients satisfaits'
        );

        Parametre::definir(
            'projets_realises',
            87,
            'number',
            'stats',
            'Nombre total de projets réalisés'
        );

        Parametre::definir(
            'heures_coding',
            12500,
            'number',
            'stats',
            'Nombre d\'heures de coding'
        );

        // Groupe: Configuration
        Parametre::definir(
            'articles_par_page',
            9,
            'number',
            'config',
            'Nombre d\'articles par page'
        );

        Parametre::definir(
            'projets_par_page',
            12,
            'number',
            'config',
            'Nombre de projets par page'
        );

        Parametre::definir(
            'notifications_actives',
            true,
            'boolean',
            'config',
            'Notifications activées'
        );
    }
}
