<?php

// app/Models/Service.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'titre', 'icone', 'description', 'fonctionnalites', 'ordre', 'est_visible',
    ];

    protected $casts = [
        'fonctionnalites' => 'array',
        'est_visible' => 'boolean',
    ];

    // Scope pour les services visibles
    public function scopeVisible($query)
    {
        return $query->where('est_visible', true)->orderBy('ordre');
    }

    // Scope pour les services principaux (ordre élevé)
    public function scopePrincipaux($query, $limit = 6)
    {
        return $query->visible()->orderBy('ordre')->limit($limit);
    }

    // Accessor pour l'icône par défaut
    public function getIconeDefautAttribute()
    {
        if ($this->icone) {
            return $this->icone;
        }

        // Icônes par défaut basées sur le titre
        $iconesParDefaut = [
            'développement' => '💻',
            'web' => '🌐',
            'mobile' => '📱',
            'design' => '🎨',
            'consulting' => '📊',
            'maintenance' => '🔧',
            'formation' => '👨‍🏫',
            'seo' => '🔍',
        ];

        foreach ($iconesParDefaut as $mot => $icone) {
            if (stripos($this->titre, $mot) !== false) {
                return $icone;
            }
        }

        return '🚀'; // Icône par défaut
    }

    // Accessor pour la description tronquée
    public function getDescriptionCourteAttribute()
    {
        $description = strip_tags($this->description);

        if (strlen($description) > 120) {
            return substr($description, 0, 120).'...';
        }

        return $description;
    }

    // Accessor pour le nombre de fonctionnalités
    public function getNombreFonctionnalitesAttribute()
    {
        return $this->fonctionnalites ? count($this->fonctionnalites) : 0;
    }

    // Méthode pour obtenir les fonctionnalités formatées
    public function getFonctionnalitesFormateesAttribute()
    {
        if (! $this->fonctionnalites) {
            return [];
        }

        return array_map(function ($fonctionnalite) {
            return '✓ '.$fonctionnalite;
        }, $this->fonctionnalites);
    }

    // Méthode pour vérifier si le service a des fonctionnalités
    public function getAFonctionnalitesAttribute()
    {
        return ! empty($this->fonctionnalites);
    }

    // Méthode pour obtenir les services groupés par catégorie (basé sur l'icône)
    public static function getServicesParCategorie()
    {
        $services = self::visible()->get();
        $categories = [
            'développement' => ['💻', '🌐', '📱', '🔧'],
            'design' => ['🎨', '🎯', '✨'],
            'consulting' => ['📊', '👨‍🏫', '🔍'],
        ];

        $result = [];

        foreach ($services as $service) {
            $icone = $service->icone_defaut;
            $categorieTrouvee = 'autres';

            foreach ($categories as $categorie => $icones) {
                if (in_array($icone, $icones)) {
                    $categorieTrouvee = $categorie;
                    break;
                }
            }

            if (! isset($result[$categorieTrouvee])) {
                $result[$categorieTrouvee] = [];
            }

            $result[$categorieTrouvee][] = $service;
        }

        return $result;
    }
}
