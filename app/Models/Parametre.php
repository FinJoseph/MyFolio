<?php

// app/Models/Parametre.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Parametre extends Model
{
    protected $fillable = ['cle', 'valeur', 'type', 'groupe', 'description'];

    // Cache pour optimiser les performances
    protected static $cache = [];

    // Méthode principale pour obtenir un paramètre
    public static function obtenir(string $cle, $defaut = null)
    {
        // Vérifier le cache d'abord
        if (array_key_exists($cle, static::$cache)) {
            return static::$cache[$cle];
        }

        $parametre = static::where('cle', $cle)->first();

        if (! $parametre) {
            static::$cache[$cle] = $defaut;

            return $defaut;
        }

        // Convertir la valeur selon le type
        $valeur = match ($parametre->type) {
            'json' => json_decode($parametre->valeur, true),
            'boolean' => (bool) $parametre->valeur,
            'number' => (int) $parametre->valeur,
            'array' => explode(',', $parametre->valeur),
            default => $parametre->valeur,
        };

        static::$cache[$cle] = $valeur;

        return $valeur;
    }

    // Méthode pour définir un paramètre
    public static function definir(string $cle, $valeur, string $type = 'text', string $groupe = 'general', ?string $description = null)
    {
        // Préparer la valeur selon le type
        $valeurStr = match ($type) {
            'json' => is_array($valeur) ? json_encode($valeur) : $valeur,
            'boolean' => $valeur ? '1' : '0',
            'number' => (string) $valeur,
            'array' => is_array($valeur) ? implode(',', $valeur) : $valeur,
            default => (string) $valeur,
        };

        $parametre = static::updateOrCreate(
            ['cle' => $cle],
            [
                'valeur' => $valeurStr,
                'type' => $type,
                'groupe' => $groupe,
                'description' => $description,
            ]
        );

        // Mettre à jour le cache
        static::$cache[$cle] = $valeur;

        return $parametre;
    }

    // Méthode pour obtenir tous les paramètres d'un groupe
    public static function obtenirGroupe(string $groupe)
    {
        return static::where('groupe', $groupe)
            ->get()
            ->mapWithKeys(function ($parametre) {
                return [$parametre->cle => static::convertirValeur($parametre)];
            })
            ->toArray();
    }

    // Méthode pour convertir la valeur d'un paramètre
    protected static function convertirValeur($parametre)
    {
        return match ($parametre->type) {
            'json' => json_decode($parametre->valeur, true),
            'boolean' => (bool) $parametre->valeur,
            'number' => (int) $parametre->valeur,
            'array' => explode(',', $parametre->valeur),
            default => $parametre->valeur,
        };
    }

    // Méthode pour vider le cache
    public static function viderCache()
    {
        static::$cache = [];
    }

    // Méthodes helpers pour des paramètres spécifiques

    // Informations de contact
    public static function obtenirContact()
    {
        return static::obtenirGroupe('contact');
    }

    // Réseaux sociaux
    public static function obtenirReseauxSociaux()
    {
        $reseaux = static::obtenirGroupe('social');

        return array_filter($reseaux); // Retirer les valeurs vides
    }

    // Paramètres SEO
    public static function obtenirSEO()
    {
        return static::obtenirGroupe('seo');
    }

    // Paramètres d'apparence
    public static function obtenirApparence()
    {
        return static::obtenirGroupe('appearance');
    }

    // Statistiques
    public static function obtenirStats()
    {
        return static::obtenirGroupe('stats');
    }

    // Vérifier si un paramètre existe
    public static function existe(string $cle)
    {
        return static::where('cle', $cle)->exists();
    }

    // Supprimer un paramètre
    public static function supprimer(string $cle)
    {
        unset(static::$cache[$cle]);

        return static::where('cle', $cle)->delete();
    }
}
