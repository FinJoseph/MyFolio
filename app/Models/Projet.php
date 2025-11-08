<?php

// app/Models/Projet.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Projet extends Model
{
    protected $fillable = [
        'titre', 'slug', 'description', 'contenu', 'image', 'galerie',
        'technologies', 'url_projet', 'url_github', 'categorie', 'ordre',
        'est_mis_en_avant', 'date_projet', 'publie_le',
    ];

    protected $casts = [
        'technologies' => 'array',
        'galerie' => 'array',
        'est_mis_en_avant' => 'boolean',
        'date_projet' => 'date',
        'publie_le' => 'datetime',
    ];

    // Relation avec les témoignages
    public function temoignages(): HasMany
    {
        return $this->hasMany(Temoignage::class);
    }

    // Scope pour les projets publiés
    public function scopePublie($query)
    {
        return $query->whereNotNull('publie_le')
            ->where('publie_le', '<=', now());
    }

    // Scope pour les projets mis en avant
    public function scopeMisEnAvant($query)
    {
        return $query->where('est_mis_en_avant', true);
    }

    // Scope par catégorie
    public function scopeParCategorie($query, $categorie)
    {
        return $query->where('categorie', $categorie);
    }

    // Génération automatique du slug
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($projet) {
            if (empty($projet->slug)) {
                $projet->slug = Str::slug($projet->titre);
            }
        });

        static::updating(function ($projet) {
            if ($projet->isDirty('titre') && empty($projet->slug)) {
                $projet->slug = Str::slug($projet->titre);
            }
        });
    }

    // Accessor pour l'URL complète
    public function getUrlCompleteAttribute()
    {
        return $this->url_projet ?: $this->url_github;
    }

    // Méthode pour publier un projet
    public function publier()
    {
        $this->update(['publie_le' => now()]);
    }

    // Méthode pour dépublier un projet
    public function depublier()
    {
        $this->update(['publie_le' => null]);
    }
}
