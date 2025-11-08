<?php

// app/Models/Temoignage.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Temoignage extends Model
{
    protected $fillable = [
        'nom_client', 'poste_client', 'entreprise_client', 'avatar_client',
        'contenu', 'note', 'projet_id', 'ordre', 'est_visible',
    ];

    protected $casts = [
        'note' => 'integer',
        'est_visible' => 'boolean',
    ];

    // Relation avec le projet
    public function projet(): BelongsTo
    {
        return $this->belongsTo(Projet::class);
    }

    // Scope pour les témoignages visibles
    public function scopeVisible($query)
    {
        return $query->where('est_visible', true)->orderBy('ordre');
    }

    // Scope pour les témoignages avec note élevée
    public function scopeNoteElevee($query, $seuil = 4)
    {
        return $query->where('note', '>=', $seuil);
    }

    // Scope pour les témoignages récents
    public function scopeRecents($query, $limit = 5)
    {
        return $query->orderBy('created_at', 'desc')->limit($limit);
    }

    // Scope par projet
    public function scopeParProjet($query, $projetId)
    {
        return $query->where('projet_id', $projetId);
    }

    // Accessor pour les étoiles (affichage)
    public function getEtoilesAttribute()
    {
        return str_repeat('⭐', $this->note).str_repeat('☆', 5 - $this->note);
    }

    // Accessor pour l'avatar par défaut
    public function getAvatarDefautAttribute()
    {
        if ($this->avatar_client) {
            return $this->avatar_client;
        }

        // Générer un avatar par défaut basé sur les initiales
        $initiales = '';
        $noms = explode(' ', $this->nom_client);

        foreach ($noms as $nom) {
            $initiales .= strtoupper(substr($nom, 0, 1));
        }

        return 'https://ui-avatars.com/api/?name='.urlencode($initiales).'&background=3b82f6&color=ffffff&size=128';
    }

    // Accessor pour le nom complet avec poste
    public function getIdentiteCompleteAttribute()
    {
        $identite = $this->nom_client;

        if ($this->poste_client) {
            $identite .= ", {$this->poste_client}";
        }

        if ($this->entreprise_client) {
            $identite .= " chez {$this->entreprise_client}";
        }

        return $identite;
    }

    // Accessor pour le contenu tronqué (pour aperçu)
    public function getContenuTronqueAttribute()
    {
        $contenu = strip_tags($this->contenu);

        if (strlen($contenu) > 150) {
            return substr($contenu, 0, 150).'...';
        }

        return $contenu;
    }

    // Méthode pour obtenir la note moyenne globale
    public static function getNoteMoyenne()
    {
        return self::visible()->avg('note') ?? 0;
    }

    // Méthode pour obtenir le nombre total de témoignages par note
    public static function getStatsNotes()
    {
        return self::visible()
            ->selectRaw('note, COUNT(*) as count')
            ->groupBy('note')
            ->orderBy('note', 'desc')
            ->get()
            ->pluck('count', 'note');
    }
}
