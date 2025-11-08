<?php

// app/Models/Formation.php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Formation extends Model
{
    protected $fillable = [
        'diplome', 'ecole', 'domaine', 'description',
        'date_debut', 'date_fin', 'en_cours', 'ordre',
    ];

    protected $casts = [
        'date_debut' => 'date',
        'date_fin' => 'date',
        'en_cours' => 'boolean',
    ];

    // Scope pour les formations en cours
    public function scopeEnCours($query)
    {
        return $query->where('en_cours', true);
    }

    // Scope pour les formations terminées
    public function scopeTerminees($query)
    {
        return $query->where('en_cours', false);
    }

    // Scope par domaine
    public function scopeParDomaine($query, $domaine)
    {
        return $query->where('domaine', $domaine);
    }

    // Scope ordonnées par date (plus récent en premier)
    public function scopeOrdreChronologique($query)
    {
        return $query->orderBy('date_debut', 'desc')
            ->orderBy('date_fin', 'desc')
            ->orderBy('ordre');
    }

    // Scope pour les formations les plus importantes (diplômes)
    public function scopeDiplomes($query)
    {
        return $query->whereIn('diplome', [
            'Bachelor', 'Master', 'Licence', 'Doctorat', 'Ingénieur',
        ]);
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

    // Accessor pour l'année de début
    public function getAnneeDebutAttribute()
    {
        return Carbon::parse($this->date_debut)->year;
    }

    // Accessor pour l'année de fin
    public function getAnneeFinAttribute()
    {
        if ($this->en_cours) {
            return 'En cours';
        }

        return $this->date_fin ? Carbon::parse($this->date_fin)->year : null;
    }

    // Accessor pour vérifier si c'est un diplôme
    public function getEstDiplomeAttribute()
    {
        $diplomes = ['Bachelor', 'Master', 'Licence', 'Doctorat', 'Ingénieur', 'BTS', 'DUT'];

        return in_array($this->diplome, $diplomes);
    }

    // Accessor pour le niveau de formation
    public function getNiveauAttribute()
    {
        $niveaux = [
            'Doctorat' => 8,
            'Master' => 7,
            'Ingénieur' => 7,
            'Bachelor' => 6,
            'Licence' => 6,
            'BTS' => 5,
            'DUT' => 5,
            'Certification' => 4,
            'Formation' => 3,
        ];

        foreach ($niveaux as $diplome => $niveau) {
            if (str_contains($this->diplome, $diplome)) {
                return $niveau;
            }
        }

        return 3; // Niveau par défaut pour les formations courtes
    }

    // Méthode pour obtenir le domaine formaté
    public function getDomaineFormateAttribute()
    {
        $domaines = [
            'informatique' => 'Informatique',
            'design' => 'Design',
            'management' => 'Management',
            'marketing' => 'Marketing',
            'communication' => 'Communication',
            'commerce' => 'Commerce',
        ];

        return $domaines[$this->domaine] ?? ucfirst($this->domaine);
    }

    // Méthode pour obtenir le dernier diplôme
    public static function getDernierDiplome()
    {
        return self::diplomes()
            ->terminees()
            ->ordreChronologique()
            ->first();
    }
}
