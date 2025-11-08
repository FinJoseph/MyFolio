<?php

// app/Models/Competence.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Competence extends Model
{
    protected $fillable = [
        'nom', 'categorie', 'niveau', 'icone', 'couleur', 'ordre', 'est_visible',
    ];

    protected $casts = [
        'niveau' => 'integer',
        'ordre' => 'integer',
        'est_visible' => 'boolean',
    ];

    // Scope pour les compétences visibles
    public function scopeVisible($query)
    {
        return $query->where('est_visible', true)->orderBy('ordre');
    }

    // Scope par catégorie
    public function scopeParCategorie($query, $categorie)
    {
        return $query->where('categorie', $categorie);
    }

    // Scope pour les compétences principales (niveau élevé)
    public function scopePrincipales($query, $seuil = 70)
    {
        return $query->where('niveau', '>=', $seuil);
    }

    // Accessor pour le niveau formaté
    public function getNiveauFormateAttribute()
    {
        return "{$this->niveau}%";
    }

    // Accessor pour la couleur par défaut
    public function getCouleurDefautAttribute()
    {
        return $this->couleur ?? $this->getCouleurParCategorie();
    }

    // Méthode pour obtenir une couleur par catégorie
    protected function getCouleurParCategorie()
    {
        $couleurs = [
            'frontend' => '#3b82f6',    // Bleu
            'backend' => '#10b981',     // Vert
            'design' => '#8b5cf6',      // Violet
            'outils' => '#f59e0b',      // Orange
            'langage' => '#ef4444',     // Rouge
            'mobile' => '#06b6d4',      // Cyan
        ];

        return $couleurs[$this->categorie] ?? '#6b7280'; // Gris par défaut
    }

    // Méthode pour obtenir l'icône par défaut
    public function getIconeDefautAttribute()
    {
        if ($this->icone) {
            return $this->icone;
        }

        $icones = [
            'frontend' => '🎨',
            'backend' => '⚙️',
            'design' => '🎯',
            'outils' => '🛠️',
            'langage' => '💻',
            'mobile' => '📱',
        ];

        return $icones[$this->categorie] ?? '⭐';
    }

    // Méthode pour formater la catégorie
    public function getCategorieFormateeAttribute()
    {
        $categories = [
            'frontend' => 'Frontend',
            'backend' => 'Backend',
            'design' => 'Design',
            'outils' => 'Outils',
            'langage' => 'Langages',
            'mobile' => 'Mobile',
        ];

        return $categories[$this->categorie] ?? ucfirst($this->categorie);
    }
}
