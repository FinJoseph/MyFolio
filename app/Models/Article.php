<?php

// app/Models/Article.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Article extends Model
{
    protected $fillable = [
        'titre', 'slug', 'extrait', 'contenu', 'image_principale',
        'categorie', 'tags', 'temps_lecture', 'vues', 'publie_le',
    ];

    protected $casts = [
        'tags' => 'array',
        'vues' => 'integer',
        'temps_lecture' => 'integer',
        'publie_le' => 'datetime',
    ];

    // Scope pour les articles publiés
    public function scopePublie($query)
    {
        return $query->whereNotNull('publie_le')
            ->where('publie_le', '<=', now());
    }

    // Scope pour les articles populaires (plus de vues)
    public function scopePopulaires($query, $limit = 5)
    {
        return $query->publie()->orderBy('vues', 'desc')->limit($limit);
    }

    // Scope pour les articles récents
    public function scopeRecents($query, $limit = 5)
    {
        return $query->publie()->orderBy('publie_le', 'desc')->limit($limit);
    }

    // Scope par catégorie
    public function scopeParCategorie($query, $categorie)
    {
        return $query->where('categorie', $categorie);
    }

    // Scope par tag
    public function scopeAvecTag($query, $tag)
    {
        return $query->whereJsonContains('tags', $tag);
    }

    // Scope pour la recherche
    public function scopeRechercher($query, $term)
    {
        return $query->where(function ($q) use ($term) {
            $q->where('titre', 'like', "%{$term}%")
                ->orWhere('extrait', 'like', "%{$term}%")
                ->orWhere('contenu', 'like', "%{$term}%");
        });
    }

    // Génération automatique du slug
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($article) {
            if (empty($article->slug)) {
                $article->slug = Str::slug($article->titre);
            }

            // Générer le temps de lecture si non fourni
            if (empty($article->temps_lecture)) {
                $article->temps_lecture = $article->calculerTempsLecture();
            }
        });

        static::updating(function ($article) {
            if ($article->isDirty('titre') && empty($article->slug)) {
                $article->slug = Str::slug($article->titre);
            }

            // Recalculer le temps de lecture si le contenu change
            if ($article->isDirty('contenu') && empty($article->temps_lecture)) {
                $article->temps_lecture = $article->calculerTempsLecture();
            }
        });
    }

    // Méthode pour incrémenter les vues
    public function incrementerVues()
    {
        $this->increment('vues');
    }

    // Méthode pour calculer le temps de lecture
    public function calculerTempsLecture()
    {
        $mots = str_word_count(strip_tags($this->contenu));

        return max(1, ceil($mots / 200)); // 200 mots par minute
    }

    // Accessor pour le temps de lecture formaté
    public function getTempsLectureFormateAttribute()
    {
        if ($this->temps_lecture <= 1) {
            return '1 min';
        }

        return "{$this->temps_lecture} min";
    }

    // Accessor pour la date de publication formatée
    public function getDatePublicationFormateeAttribute()
    {
        if (! $this->publie_le) {
            return 'Non publié';
        }

        return $this->publie_le->locale('fr')->translatedFormat('j F Y');
    }

    // Accessor pour la date relative (il y a...)
    public function getDateRelativeAttribute()
    {
        if (! $this->publie_le) {
            return 'Non publié';
        }

        return $this->publie_le->locale('fr')->diffForHumans();
    }

    // Accessor pour vérifier si l'article est publié
    public function getEstPublieAttribute()
    {
        return $this->publie_le && $this->publie_le <= now();
    }

    // Accessor pour l'image par défaut
    public function getImageParDefautAttribute()
    {
        if ($this->image_principale) {
            return $this->image_principale;
        }

        // Générer une image placeholder basée sur le titre
        $couleurs = ['3b82f6', '10b981', '8b5cf6', 'f59e0b', 'ef4444'];
        $couleur = $couleurs[array_rand($couleurs)];

        return "https://via.placeholder.com/800x400/{$couleur}/ffffff?text=".urlencode(Str::limit($this->titre, 30));
    }

    // Accessor pour les tags formatés
    public function getTagsFormatesAttribute()
    {
        if (! $this->tags) {
            return [];
        }

        return array_map(function ($tag) {
            return '#'.$tag;
        }, $this->tags);
    }

    // Méthode pour publier un article
    public function publier()
    {
        $this->update(['publie_le' => now()]);
    }

    // Méthode pour dépublier un article
    public function depublier()
    {
        $this->update(['publie_le' => null]);
    }

    // Méthode pour obtenir les articles similaires
    public function articlesSimilaires($limit = 3)
    {
        return self::publie()
            ->where('id', '!=', $this->id)
            ->where(function ($query) {
                $query->where('categorie', $this->categorie)
                    ->orWhereJsonContains('tags', $this->tags ? $this->tags[0] : '');
            })
            ->limit($limit)
            ->get();
    }

    // Méthode pour obtenir les catégories existantes
    public static function getCategories()
    {
        return self::publie()
            ->distinct()
            ->pluck('categorie')
            ->filter()
            ->values();
    }

    // Méthode pour obtenir tous les tags utilisés
    public static function getTousLesTags()
    {
        return self::publie()
            ->whereNotNull('tags')
            ->pluck('tags')
            ->flatten()
            ->unique()
            ->values();
    }
}
