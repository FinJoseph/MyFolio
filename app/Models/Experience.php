<?php

// app/Models/Experience.php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    protected $fillable = [
        'poste', 'entreprise', 'url_entreprise', 'lieu', 'type_emploi',
        'description', 'realisations', 'technologies', 'date_debut',
        'date_fin', 'en_cours', 'ordre',
    ];

    protected $casts = [
        'realisations' => 'array',
        'technologies' => 'array',
        'date_debut' => 'date',
        'date_fin' => 'date',
        'en_cours' => 'boolean',
    ];

    // Scope pour les expériences en cours
    public function scopeEnCours($query)
    {
        return $query->where('en_cours', true);
    }

    // Scope pour les expériences passées
    public function scopePassees($query)
    {
        return $query->where('en_cours', false);
    }

    // Scope par type d'emploi
    public function scopeParType($query, $type)
    {
        return $query->where('type_emploi', $type);
    }

    // Scope ordonnées par date (plus récent en premier)
    public function scopeOrdreChronologique($query)
    {
        return $query->orderBy('date_debut', 'desc')
            ->orderBy('date_fin', 'desc')
            ->orderBy('ordre');
    }

    // Accessor pour la durée formatée
    public function getDureeAttribute()
    {
        $debut = Carbon::parse($this->date_debut);

        if ($this->en_cours) {
            $fin = Carbon::now();
        } else {
            $fin = Carbon::parse($this->date_fin);
        }

        $annees = $fin->diffInYears($debut);
        $mois = $fin->diffInMonths($debut) % 12;

        if ($annees > 0 && $mois > 0) {
            return "{$annees} an".($annees > 1 ? 's' : '')." {$mois} mois";
        } elseif ($annees > 0) {
            return "{$annees} an".($annees > 1 ? 's' : '');
        } else {
            return "{$mois} mois";
        }
    }

    // Accessor pour la période formatée
    public function getPeriodeFormateeAttribute()
    {
        $debut = Carbon::parse($this->date_debut)->format('m/Y');

        if ($this->en_cours) {
            $fin = 'Aujourd\'hui';
        } else {
            $fin = Carbon::parse($this->date_fin)->format('m/Y');
        }

        return "{$debut} - {$fin}";
    }

    // Accessor pour l'année de début
    public function getAnneeDebutAttribute()
    {
        return Carbon::parse($this->date_debut)->year;
    }

    // Accessor pour l'année de fin
    public function getAnneeFinAttribute()
    {
        if ($this->en_cours) {
            return 'Aujourd\'hui';
        }

        return $this->date_fin ? Carbon::parse($this->date_fin)->year : null;
    }

    // Méthode pour vérifier si c'est une expérience actuelle
    public function getEstActuelleAttribute()
    {
        return $this->en_cours;
    }

    // Méthode pour obtenir le type d'emploi formaté
    public function getTypeEmploiFormateAttribute()
    {
        $types = [
            'CDI' => 'CDI',
            'CDD' => 'CDD',
            'Freelance' => 'Freelance',
            'Stage' => 'Stage',
            'Alternance' => 'Alternance',
            'Interim' => 'Intérim',
        ];

        return $types[$this->type_emploi] ?? $this->type_emploi;
    }

    // Méthode pour calculer le nombre total d'années d'expérience
    public static function getTotalAnneesExperience()
    {
        $experiences = self::all();
        $totalMois = 0;

        foreach ($experiences as $exp) {
            $debut = Carbon::parse($exp->date_debut);
            $fin = $exp->en_cours ? Carbon::now() : Carbon::parse($exp->date_fin);
            $totalMois += $fin->diffInMonths($debut);
        }

        return floor($totalMois / 12);
    }
}
