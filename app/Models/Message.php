<?php

// app/Models/Message.php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Message extends Model
{
    protected $fillable = [
        'nom', 'email', 'sujet', 'message', 'statut',
        'ip_address', 'user_agent', 'reponse', 'repondu_le', 'repondu_par',
    ];

    protected $casts = [
        'repondu_le' => 'datetime',
    ];

    // Relation avec l'utilisateur qui a répondu (pour futur admin)
    public function reponduPar(): BelongsTo
    {
        return $this->belongsTo(User::class, 'repondu_par');
    }

    // Scope pour les messages non lus
    public function scopeNonLus($query)
    {
        return $query->where('statut', 'nouveau');
    }

    // Scope pour les messages lus
    public function scopeLus($query)
    {
        return $query->where('statut', 'lu');
    }

    // Scope pour les messages répondus
    public function scopeRepondus($query)
    {
        return $query->where('statut', 'repondu');
    }

    // Scope pour les messages archivés
    public function scopeArchives($query)
    {
        return $query->where('statut', 'archive');
    }

    // Scope pour les messages spam
    public function scopeSpam($query)
    {
        return $query->where('statut', 'spam');
    }

    // Scope pour les messages récents
    public function scopeRecents($query, $jours = 7)
    {
        return $query->where('created_at', '>=', Carbon::now()->subDays($jours));
    }

    // Scope pour rechercher dans les messages
    public function scopeRechercher($query, $term)
    {
        return $query->where(function ($q) use ($term) {
            $q->where('nom', 'like', "%{$term}%")
                ->orWhere('email', 'like', "%{$term}%")
                ->orWhere('sujet', 'like', "%{$term}%")
                ->orWhere('message', 'like', "%{$term}%");
        });
    }

    // Accessor pour le statut formaté
    public function getStatutFormateAttribute()
    {
        $statuts = [
            'nouveau' => ['label' => 'Nouveau', 'couleur' => 'blue'],
            'lu' => ['label' => 'Lu', 'couleur' => 'green'],
            'repondu' => ['label' => 'Répondu', 'couleur' => 'purple'],
            'archive' => ['label' => 'Archivé', 'couleur' => 'gray'],
            'spam' => ['label' => 'Spam', 'couleur' => 'red'],
        ];

        return $statuts[$this->statut] ?? ['label' => $this->statut, 'couleur' => 'gray'];
    }

    // Accessor pour le sujet par défaut
    public function getSujetDefautAttribute()
    {
        return $this->sujet ?: 'Sans objet';
    }

    // Accessor pour le message tronqué (pour aperçu)
    public function getMessageTronqueAttribute()
    {
        $message = strip_tags($this->message);

        if (strlen($message) > 100) {
            return substr($message, 0, 100).'...';
        }

        return $message;
    }

    // Accessor pour la date relative
    public function getDateRelativeAttribute()
    {
        return $this->created_at->locale('fr')->diffForHumans();
    }

    // Accessor pour vérifier si le message est récent
    public function getEstRecentAttribute()
    {
        return $this->created_at->greaterThan(Carbon::now()->subHours(24));
    }

    // Accessor pour vérifier si le message a été répond
    public function getEstReponduAttribute()
    {
        return $this->statut === 'repondu' && ! empty($this->reponse);
    }

    // Accessor pour le temps de réponse
    public function getTempsReponseAttribute()
    {
        if (! $this->repondu_le) {
            return null;
        }

        return $this->created_at->diffInHours($this->repondu_le);
    }

    // Méthodes pour changer le statut
    public function marquerCommeLu()
    {
        $this->update(['statut' => 'lu']);
    }

    public function marquerCommeRepondu($reponse = null, $userId = null)
    {
        $this->update([
            'statut' => 'repondu',
            'reponse' => $reponse,
            'repondu_le' => now(),
            'repondu_par' => $userId,
        ]);
    }

    public function marquerCommeArchive()
    {
        $this->update(['statut' => 'archive']);
    }

    public function marquerCommeSpam()
    {
        $this->update(['statut' => 'spam']);
    }

    // Méthode pour détecter le spam (règles basiques)
    public function estSpam()
    {
        $spamMots = ['viagra', 'casino', 'prêt', 'credit', 'urgent', 'gagner', 'loterie'];
        $contenu = strtolower($this->nom.' '.$this->sujet.' '.$this->message);

        foreach ($spamMots as $mot) {
            if (str_contains($contenu, $mot)) {
                return true;
            }
        }

        // Vérifier l'email suspect
        if (preg_match('/\.ru$|\.xyz$/', $this->email)) {
            return true;
        }

        return false;
    }

    // Méthodes statistiques
    public static function getStatistiques($jours = 30)
    {
        $dateDebut = Carbon::now()->subDays($jours);

        return [
            'total' => self::where('created_at', '>=', $dateDebut)->count(),
            'nouveaux' => self::nonLus()->where('created_at', '>=', $dateDebut)->count(),
            'repondus' => self::repondus()->where('created_at', '>=', $dateDebut)->count(),
            'taux_reponse' => self::where('created_at', '>=', $dateDebut)->count() > 0
                ? round((self::repondus()->where('created_at', '>=', $dateDebut)->count() / self::where('created_at', '>=', $dateDebut)->count()) * 100, 1)
                : 0,
            'moyenne_journaliere' => round(self::where('created_at', '>=', $dateDebut)->count() / $jours, 1),
        ];
    }

    // Méthode pour obtenir les messages non lus récents
    public static function getMessagesNonLusRecents($limit = 5)
    {
        return self::nonLus()
            ->orderBy('created_at', 'desc')
            ->limit($limit)
            ->get();
    }

    // Méthode pour nettoyer les anciens messages
    public static function nettoyerAnciensMessages($jours = 365)
    {
        $dateLimite = Carbon::now()->subDays($jours);

        return self::where('created_at', '<', $dateLimite)
            ->whereIn('statut', ['archive', 'spam'])
            ->delete();
    }
}
