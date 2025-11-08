<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InformationPersonnelle extends Model
{
    protected $table = 'information_personnelles';

    protected $fillable = [
        'nom_complet', 'prenom', 'nom', 'titre_poste', 'bio_courte', 'bio_complete',
        'email', 'telephone', 'adresse', 'ville', 'pays', 'code_postal', 'date_naissance',
        'photo_profil', 'cv_pdf', 'linkedin', 'github', 'twitter', 'instagram',
        'facebook', 'dribbble', 'behance', 'youtube', 'disponible_freelance',
        'statut_disponibilite', 'message_disponibilite', 'meta_titre',
        'meta_description', 'meta_mots_cles',
    ];

    protected $casts = [
        'date_naissance' => 'date',
        'disponible_freelance' => 'boolean',
        'meta_mots_cles' => 'array',
    ];

    // Méthode helper pour obtenir les infos (singleton)
    public static function obtenir()
    {
        return static::first() ?? new static;
    }

    // Obtenir les réseaux sociaux actifs
    public function getReseauxSociauxAttribute()
    {
        return collect([
            'linkedin' => $this->linkedin,
            'github' => $this->github,
            'twitter' => $this->twitter,
            'instagram' => $this->instagram,
            'facebook' => $this->facebook,
            'dribbble' => $this->dribbble,
            'behance' => $this->behance,
            'youtube' => $this->youtube,
        ])->filter()->toArray();
    }

    // Accessor pour l'âge
    public function getAgeAttribute()
    {
        return $this->date_naissance?->age;
    }

    // Scope pour disponibilité
    public function scopeDisponible($query)
    {
        return $query->where('disponible_freelance', true);
    }
}
