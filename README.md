<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework. You can also check out [Laravel Learn](https://laravel.com/learn), where you will be guided through building a modern Laravel application.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

Base de Donne, Migration 

// Migration: create_informations_personnelles_table.php
Schema::create('informations_personnelles', function (Blueprint $table) {
    $table->id();
    $table->string('nom_complet');
    $table->string('prenom');
    $table->string('nom');
    $table->string('titre_poste'); // Ex: Développeur Full-Stack & Designer
    $table->text('bio_courte'); // Bio courte pour hero section
    $table->longText('bio_complete')->nullable(); // Bio complète pour page à propos
    $table->string('email');
    $table->string('telephone')->nullable();
    $table->string('adresse')->nullable();
    $table->string('ville')->nullable();
    $table->string('pays')->nullable();
    $table->string('code_postal')->nullable();
    $table->date('date_naissance')->nullable();
    $table->string('photo_profil')->nullable();
    $table->string('cv_pdf')->nullable(); // Lien vers le CV en PDF
    
    // Réseaux sociaux
    $table->string('linkedin')->nullable();
    $table->string('github')->nullable();
    $table->string('twitter')->nullable();
    $table->string('instagram')->nullable();
    $table->string('facebook')->nullable();
    $table->string('dribbble')->nullable();
    $table->string('behance')->nullable();
    $table->string('youtube')->nullable();
    
    // Disponibilité
    $table->boolean('disponible_freelance')->default(true);
    $table->string('statut_disponibilite')->default('disponible'); // disponible, occupe, bientot_disponible
    $table->text('message_disponibilite')->nullable();
    
    // SEO
    $table->string('meta_titre')->nullable();
    $table->text('meta_description')->nullable();
    $table->json('meta_mots_cles')->nullable();
    
    $table->timestamps();
});

// Migration: create_projets_table.php
Schema::create('projets', function (Blueprint $table) {
    $table->id();
    $table->string('titre');
    $table->string('slug')->unique();
    $table->text('description');
    $table->longText('contenu')->nullable();
    $table->string('image')->nullable();
    $table->json('galerie')->nullable(); // Images supplémentaires
    $table->json('technologies')->nullable();
    $table->string('url_projet')->nullable();
    $table->string('url_github')->nullable();
    $table->string('categorie')->nullable();
    $table->integer('ordre')->default(0);
    $table->boolean('est_mis_en_avant')->default(false);
    $table->date('date_projet')->nullable();
    $table->timestamp('publie_le')->nullable();
    $table->timestamps();
});

// Migration: create_competences_table.php
Schema::create('competences', function (Blueprint $table) {
    $table->id();
    $table->string('nom');
    $table->string('categorie'); // frontend, backend, design, outils
    $table->integer('niveau')->default(50); // 0-100
    $table->string('icone')->nullable();
    $table->string('couleur')->nullable();
    $table->integer('ordre')->default(0);
    $table->boolean('est_visible')->default(true);
    $table->timestamps();
});

// Migration: create_experiences_table.php
Schema::create('experiences', function (Blueprint $table) {
    $table->id();
    $table->string('poste');
    $table->string('entreprise');
    $table->string('url_entreprise')->nullable();
    $table->string('lieu')->nullable();
    $table->string('type_emploi')->nullable(); // CDI, Freelance, Stage
    $table->text('description');
    $table->json('realisations')->nullable();
    $table->json('technologies')->nullable();
    $table->date('date_debut');
    $table->date('date_fin')->nullable();
    $table->boolean('en_cours')->default(false);
    $table->integer('ordre')->default(0);
    $table->timestamps();
});

// Migration: create_formations_table.php
Schema::create('formations', function (Blueprint $table) {
    $table->id();
    $table->string('diplome');
    $table->string('ecole');
    $table->string('domaine')->nullable();
    $table->text('description')->nullable();
    $table->date('date_debut');
    $table->date('date_fin')->nullable();
    $table->boolean('en_cours')->default(false);
    $table->integer('ordre')->default(0);
    $table->timestamps();
});

// Migration: create_témoignages_table.php
Schema::create('temoignages', function (Blueprint $table) {
    $table->id();
    $table->string('nom_client');
    $table->string('poste_client')->nullable();
    $table->string('entreprise_client')->nullable();
    $table->string('avatar_client')->nullable();
    $table->text('contenu');
    $table->integer('note')->default(5);
    $table->foreignId('projet_id')->nullable()->constrained('projets')->nullOnDelete();
    $table->integer('ordre')->default(0);
    $table->boolean('est_visible')->default(true);
    $table->timestamps();
});

// Migration: create_services_table.php
Schema::create('services', function (Blueprint $table) {
    $table->id();
    $table->string('titre');
    $table->string('icone')->nullable();
    $table->text('description');
    $table->json('fonctionnalites')->nullable();
    $table->integer('ordre')->default(0);
    $table->boolean('est_visible')->default(true);
    $table->timestamps();
});

// Migration: create_articles_table.php
Schema::create('articles', function (Blueprint $table) {
    $table->id();
    $table->string('titre');
    $table->string('slug')->unique();
    $table->text('extrait');
    $table->longText('contenu');
    $table->string('image_principale')->nullable();
    $table->string('categorie')->nullable();
    $table->json('tags')->nullable();
    $table->integer('temps_lecture')->nullable();
    $table->integer('vues')->default(0);
    $table->timestamp('publie_le')->nullable();
    $table->timestamps();
});

// Migration: create_parametres_table.php
Schema::create('parametres', function (Blueprint $table) {
    $table->id();
    $table->string('cle')->unique();
    $table->text('valeur')->nullable();
    $table->string('type')->default('text'); // text, json, boolean, number
    $table->string('groupe')->default('general'); // general, social, seo, contact
    $table->timestamps();
});

// Migration: create_messages_table.php
Schema::create('messages', function (Blueprint $table) {
    $table->id();
    $table->string('nom');
    $table->string('email');
    $table->string('sujet')->nullable();
    $table->text('message');
    $table->string('statut')->default('nouveau'); // nouveau, lu, repondu, archive
    $table->timestamps();
});

Model de chaque Table 

<?php

// app/Models/Projet.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Projet extends Model
{
    protected $fillable = [
        'titre', 'slug', 'description', 'contenu', 'image', 'galerie',
        'technologies', 'url_projet', 'url_github', 'categorie', 'ordre',
        'est_mis_en_avant', 'date_projet', 'publie_le'
    ];

    protected $casts = [
        'technologies' => 'array',
        'galerie' => 'array',
        'est_mis_en_avant' => 'boolean',
        'date_projet' => 'date',
        'publie_le' => 'datetime',
    ];

    public function temoignages(): HasMany
    {
        return $this->hasMany(Temoignage::class);
    }

    public function scopePublie($query)
    {
        return $query->whereNotNull('publie_le')
            ->where('publie_le', '<=', now());
    }

    public function scopeMisEnAvant($query)
    {
        return $query->where('est_mis_en_avant', true);
    }
}

// app/Models/Competence.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Competence extends Model
{
    protected $fillable = [
        'nom', 'categorie', 'niveau', 'icone', 'couleur', 'ordre', 'est_visible'
    ];

    protected $casts = [
        'niveau' => 'integer',
        'ordre' => 'integer',
        'est_visible' => 'boolean',
    ];

    public function scopeVisible($query)
    {
        return $query->where('est_visible', true)->orderBy('ordre');
    }

    public function scopeParCategorie($query, $categorie)
    {
        return $query->where('categorie', $categorie);
    }
}

// app/Models/Experience.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    protected $fillable = [
        'poste', 'entreprise', 'url_entreprise', 'lieu', 'type_emploi',
        'description', 'realisations', 'technologies', 'date_debut',
        'date_fin', 'en_cours', 'ordre'
    ];

    protected $casts = [
        'realisations' => 'array',
        'technologies' => 'array',
        'date_debut' => 'date',
        'date_fin' => 'date',
        'en_cours' => 'boolean',
    ];

    public function scopeEnCours($query)
    {
        return $query->where('en_cours', true);
    }
}

// app/Models/Formation.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Formation extends Model
{
    protected $fillable = [
        'diplome', 'ecole', 'domaine', 'description',
        'date_debut', 'date_fin', 'en_cours', 'ordre'
    ];

    protected $casts = [
        'date_debut' => 'date',
        'date_fin' => 'date',
        'en_cours' => 'boolean',
    ];
}

// app/Models/Temoignage.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Temoignage extends Model
{
    protected $fillable = [
        'nom_client', 'poste_client', 'entreprise_client', 'avatar_client',
        'contenu', 'note', 'projet_id', 'ordre', 'est_visible'
    ];

    protected $casts = [
        'note' => 'integer',
        'est_visible' => 'boolean',
    ];

    public function projet(): BelongsTo
    {
        return $this->belongsTo(Projet::class);
    }

    public function scopeVisible($query)
    {
        return $query->where('est_visible', true)->orderBy('ordre');
    }
}

// app/Models/Service.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'titre', 'icone', 'description', 'fonctionnalites', 'ordre', 'est_visible'
    ];

    protected $casts = [
        'fonctionnalites' => 'array',
        'est_visible' => 'boolean',
    ];

    public function scopeVisible($query)
    {
        return $query->where('est_visible', true)->orderBy('ordre');
    }
}

// app/Models/Article.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [
        'titre', 'slug', 'extrait', 'contenu', 'image_principale',
        'categorie', 'tags', 'temps_lecture', 'vues', 'publie_le'
    ];

    protected $casts = [
        'tags' => 'array',
        'vues' => 'integer',
        'temps_lecture' => 'integer',
        'publie_le' => 'datetime',
    ];

    public function scopePublie($query)
    {
        return $query->whereNotNull('publie_le')
            ->where('publie_le', '<=', now());
    }

    public function incrementerVues()
    {
        $this->increment('vues');
    }
}

// app/Models/Parametre.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Parametre extends Model
{
    protected $fillable = ['cle', 'valeur', 'type', 'groupe'];

    public static function obtenir(string $cle, $defaut = null)
    {
        $parametre = static::where('cle', $cle)->first();
        
        if (!$parametre) {
            return $defaut;
        }

        return match($parametre->type) {
            'json' => json_decode($parametre->valeur, true),
            'boolean' => (bool) $parametre->valeur,
            'number' => (int) $parametre->valeur,
            default => $parametre->valeur,
        };
    }

    public static function definir(string $cle, $valeur, string $type = 'text', string $groupe = 'general')
    {
        $valeurStr = is_array($valeur) ? json_encode($valeur) : $valeur;
        
        return static::updateOrCreate(
            ['cle' => $cle],
            ['valeur' => $valeurStr, 'type' => $type, 'groupe' => $groupe]
        );
    }
}

// app/Models/Message.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'nom', 'email', 'sujet', 'message', 'statut'
    ];

    public function scopeNonLus($query)
    {
        return $query->where('statut', 'nouveau');
    }

    public function marquerCommeLu()
    {
        $this->update(['statut' => 'lu']);
    }
}

// app/Models/InformationPersonnelle.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InformationPersonnelle extends Model
{
    protected $fillable = [
        'nom_complet', 'prenom', 'nom', 'titre_poste', 'bio_courte', 'bio_complete',
        'email', 'telephone', 'adresse', 'ville', 'pays', 'code_postal', 'date_naissance',
        'photo_profil', 'cv_pdf', 'linkedin', 'github', 'twitter', 'instagram',
        'facebook', 'dribbble', 'behance', 'youtube', 'disponible_freelance',
        'statut_disponibilite', 'message_disponibilite', 'meta_titre',
        'meta_description', 'meta_mots_cles'
    ];

    protected $casts = [
        'date_naissance' => 'date',
        'disponible_freelance' => 'boolean',
        'meta_mots_cles' => 'array',
    ];

    // Méthode helper pour obtenir les infos (singleton)
    public static function obtenir()
    {
        return static::first() ?? new static();
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
}

<?php

// app/Models/Projet.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Projet extends Model
{
    protected $fillable = [
        'titre', 'slug', 'description', 'contenu', 'image', 'galerie',
        'technologies', 'url_projet', 'url_github', 'categorie', 'ordre',
        'est_mis_en_avant', 'date_projet', 'publie_le'
    ];

    protected $casts = [
        'technologies' => 'array',
        'galerie' => 'array',
        'est_mis_en_avant' => 'boolean',
        'date_projet' => 'date',
        'publie_le' => 'datetime',
    ];

    public function temoignages(): HasMany
    {
        return $this->hasMany(Temoignage::class);
    }

    public function scopePublie($query)
    {
        return $query->whereNotNull('publie_le')
            ->where('publie_le', '<=', now());
    }

    public function scopeMisEnAvant($query)
    {
        return $query->where('est_mis_en_avant', true);
    }
}

// app/Models/Competence.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Competence extends Model
{
    protected $fillable = [
        'nom', 'categorie', 'niveau', 'icone', 'couleur', 'ordre', 'est_visible'
    ];

    protected $casts = [
        'niveau' => 'integer',
        'ordre' => 'integer',
        'est_visible' => 'boolean',
    ];

    public function scopeVisible($query)
    {
        return $query->where('est_visible', true)->orderBy('ordre');
    }

    public function scopeParCategorie($query, $categorie)
    {
        return $query->where('categorie', $categorie);
    }
}

// app/Models/Experience.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    protected $fillable = [
        'poste', 'entreprise', 'url_entreprise', 'lieu', 'type_emploi',
        'description', 'realisations', 'technologies', 'date_debut',
        'date_fin', 'en_cours', 'ordre'
    ];

    protected $casts = [
        'realisations' => 'array',
        'technologies' => 'array',
        'date_debut' => 'date',
        'date_fin' => 'date',
        'en_cours' => 'boolean',
    ];

    public function scopeEnCours($query)
    {
        return $query->where('en_cours', true);
    }
}

// app/Models/Formation.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Formation extends Model
{
    protected $fillable = [
        'diplome', 'ecole', 'domaine', 'description',
        'date_debut', 'date_fin', 'en_cours', 'ordre'
    ];

    protected $casts = [
        'date_debut' => 'date',
        'date_fin' => 'date',
        'en_cours' => 'boolean',
    ];
}

// app/Models/Temoignage.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Temoignage extends Model
{
    protected $fillable = [
        'nom_client', 'poste_client', 'entreprise_client', 'avatar_client',
        'contenu', 'note', 'projet_id', 'ordre', 'est_visible'
    ];

    protected $casts = [
        'note' => 'integer',
        'est_visible' => 'boolean',
    ];

    public function projet(): BelongsTo
    {
        return $this->belongsTo(Projet::class);
    }

    public function scopeVisible($query)
    {
        return $query->where('est_visible', true)->orderBy('ordre');
    }
}

// app/Models/Service.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'titre', 'icone', 'description', 'fonctionnalites', 'ordre', 'est_visible'
    ];

    protected $casts = [
        'fonctionnalites' => 'array',
        'est_visible' => 'boolean',
    ];

    public function scopeVisible($query)
    {
        return $query->where('est_visible', true)->orderBy('ordre');
    }
}

// app/Models/Article.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [
        'titre', 'slug', 'extrait', 'contenu', 'image_principale',
        'categorie', 'tags', 'temps_lecture', 'vues', 'publie_le'
    ];

    protected $casts = [
        'tags' => 'array',
        'vues' => 'integer',
        'temps_lecture' => 'integer',
        'publie_le' => 'datetime',
    ];

    public function scopePublie($query)
    {
        return $query->whereNotNull('publie_le')
            ->where('publie_le', '<=', now());
    }

    public function incrementerVues()
    {
        $this->increment('vues');
    }
}

// app/Models/Parametre.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Parametre extends Model
{
    protected $fillable = ['cle', 'valeur', 'type', 'groupe'];

    public static function obtenir(string $cle, $defaut = null)
    {
        $parametre = static::where('cle', $cle)->first();
        
        if (!$parametre) {
            return $defaut;
        }

        return match($parametre->type) {
            'json' => json_decode($parametre->valeur, true),
            'boolean' => (bool) $parametre->valeur,
            'number' => (int) $parametre->valeur,
            default => $parametre->valeur,
        };
    }

    public static function definir(string $cle, $valeur, string $type = 'text', string $groupe = 'general')
    {
        $valeurStr = is_array($valeur) ? json_encode($valeur) : $valeur;
        
        return static::updateOrCreate(
            ['cle' => $cle],
            ['valeur' => $valeurStr, 'type' => $type, 'groupe' => $groupe]
        );
    }
}

// app/Models/Message.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'nom', 'email', 'sujet', 'message', 'statut'
    ];

    public function scopeNonLus($query)
    {
        return $query->where('statut', 'nouveau');
    }

    public function marquerCommeLu()
    {
        $this->update(['statut' => 'lu']);
    }
}

Controller 
<?php

// app/Http/Controllers/Front/AccueilController.php
namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Projet;
use App\Models\Competence;
use App\Models\Temoignage;
use App\Models\Service;
use App\Models\Parametre;
use App\Models\InformationPersonnelle;
use Illuminate\Http\JsonResponse;

class AccueilController extends Controller
{
    public function index(): JsonResponse
    {
        $infosPersonnelles = InformationPersonnelle::obtenir();

        $projetsMisEnAvant = Projet::publie()
            ->misEnAvant()
            ->orderBy('publie_le', 'desc')
            ->limit(3)
            ->get(['id', 'titre', 'slug', 'description', 'image', 'technologies', 'categorie']);

        $competences = Competence::visible()
            ->get(['id', 'nom', 'categorie', 'niveau', 'icone', 'couleur']);

        $temoignages = Temoignage::visible()
            ->with('projet:id,titre')
            ->limit(6)
            ->get();

        $services = Service::visible()->get();

        return response()->json([
            'informations_personnelles' => $infosPersonnelles,
            'projets_mis_en_avant' => $projetsMisEnAvant,
            'competences' => $competences,
            'temoignages' => $temoignages,
            'services' => $services,
            'statistiques' => [
                'total_projets' => Projet::publie()->count(),
                'annees_experience' => Parametre::obtenir('annees_experience', 0),
                'clients_satisfaits' => Parametre::obtenir('clients_satisfaits', 0),
            ],
        ]);
    }
}

// app/Http/Controllers/Front/ProjetController.php
namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Projet;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProjetController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = Projet::publie();

        // Filtrer par catégorie
        if ($request->has('categorie')) {
            $query->where('categorie', $request->categorie);
        }

        // Recherche
        if ($request->has('recherche')) {
            $query->where(function ($q) use ($request) {
                $q->where('titre', 'like', '%' . $request->recherche . '%')
                  ->orWhere('description', 'like', '%' . $request->recherche . '%');
            });
        }

        $projets = $query->orderBy('publie_le', 'desc')
            ->get([
                'id', 'titre', 'slug', 'description', 'image', 
                'technologies', 'url_projet', 'url_github', 
                'categorie', 'publie_le'
            ]);

        $categories = Projet::publie()
            ->distinct()
            ->pluck('categorie')
            ->filter()
            ->values();

        return response()->json([
            'projets' => $projets,
            'categories' => $categories,
        ]);
    }

    public function show(Projet $projet): JsonResponse
    {
        if (!$projet->publie_le || $projet->publie_le->isFuture()) {
            abort(404);
        }

        $projet->load('temoignages');

        // Projets similaires
        $projetsSimilaires = Projet::publie()
            ->where('id', '!=', $projet->id)
            ->where('categorie', $projet->categorie)
            ->limit(3)
            ->get(['id', 'titre', 'slug', 'description', 'image']);

        return response()->json([
            'projet' => $projet,
            'projets_similaires' => $projetsSimilaires,
        ]);
    }
}

// app/Http/Controllers/Front/CompetenceController.php
namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Competence;
use Illuminate\Http\JsonResponse;

class CompetenceController extends Controller
{
    public function index(): JsonResponse
    {
        $competences = Competence::visible()
            ->orderBy('categorie')
            ->orderBy('ordre')
            ->get()
            ->groupBy('categorie');

        return response()->json($competences);
    }
}

// app/Http/Controllers/Front/ExperienceController.php
namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Experience;
use App\Models\Formation;
use Illuminate\Http\JsonResponse;

class ExperienceController extends Controller
{
    public function index(): JsonResponse
    {
        $experiences = Experience::orderBy('date_debut', 'desc')
            ->orderBy('ordre')
            ->get();

        $formations = Formation::orderBy('date_debut', 'desc')
            ->orderBy('ordre')
            ->get();

        return response()->json([
            'experiences' => $experiences,
            'formations' => $formations,
        ]);
    }
}

// app/Http/Controllers/Front/ArticleController.php
namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = Article::publie();

        if ($request->has('categorie')) {
            $query->where('categorie', $request->categorie);
        }

        if ($request->has('recherche')) {
            $query->where(function ($q) use ($request) {
                $q->where('titre', 'like', '%' . $request->recherche . '%')
                  ->orWhere('extrait', 'like', '%' . $request->recherche . '%');
            });
        }

        $articles = $query->orderBy('publie_le', 'desc')
            ->paginate(9);

        $categories = Article::publie()
            ->distinct()
            ->pluck('categorie')
            ->filter()
            ->values();

        return response()->json([
            'articles' => $articles,
            'categories' => $categories,
        ]);
    }

    public function show(Article $article): JsonResponse
    {
        if (!$article->publie_le || $article->publie_le->isFuture()) {
            abort(404);
        }

        $article->incrementerVues();

        $articlesRecents = Article::publie()
            ->where('id', '!=', $article->id)
            ->orderBy('publie_le', 'desc')
            ->limit(3)
            ->get(['id', 'titre', 'slug', 'extrait', 'image_principale', 'publie_le']);

        return response()->json([
            'article' => $article,
            'articles_recents' => $articlesRecents,
        ]);
    }
}

// app/Http/Controllers/Front/ContactController.php
namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'nom' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'sujet' => 'nullable|string|max:255',
            'message' => 'required|string|min:10',
        ], [
            'nom.required' => 'Le nom est obligatoire',
            'email.required' => 'L\'email est obligatoire',
            'email.email' => 'L\'email doit être valide',
            'message.required' => 'Le message est obligatoire',
            'message.min' => 'Le message doit contenir au moins 10 caractères',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        Message::create($request->only(['nom', 'email', 'sujet', 'message']));

        return response()->json([
            'success' => true,
            'message' => 'Votre message a été envoyé avec succès !',
        ]);
    }
}

<?php

// app/Http/Controllers/Front/AccueilController.php
namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Projet;
use App\Models\Competence;
use App\Models\Temoignage;
use App\Models\Service;
use App\Models\Parametre;
use Illuminate\Http\JsonResponse;

class AccueilController extends Controller
{
    public function index(): JsonResponse
    {
        $projetsMisEnAvant = Projet::publie()
            ->misEnAvant()
            ->orderBy('publie_le', 'desc')
            ->limit(3)
            ->get(['id', 'titre', 'slug', 'description', 'image', 'technologies', 'categorie']);

        $competences = Competence::visible()
            ->get(['id', 'nom', 'categorie', 'niveau', 'icone', 'couleur']);

        $temoignages = Temoignage::visible()
            ->with('projet:id,titre')
            ->limit(6)
            ->get();

        $services = Service::visible()->get();

        return response()->json([
            'projets_mis_en_avant' => $projetsMisEnAvant,
            'competences' => $competences,
            'temoignages' => $temoignages,
            'services' => $services,
            'statistiques' => [
                'total_projets' => Projet::publie()->count(),
                'annees_experience' => Parametre::obtenir('annees_experience', 0),
                'clients_satisfaits' => Parametre::obtenir('clients_satisfaits', 0),
            ],
        ]);
    }
}

// app/Http/Controllers/Front/ProjetController.php
namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Projet;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProjetController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = Projet::publie();

        // Filtrer par catégorie
        if ($request->has('categorie')) {
            $query->where('categorie', $request->categorie);
        }

        // Recherche
        if ($request->has('recherche')) {
            $query->where(function ($q) use ($request) {
                $q->where('titre', 'like', '%' . $request->recherche . '%')
                  ->orWhere('description', 'like', '%' . $request->recherche . '%');
            });
        }

        $projets = $query->orderBy('publie_le', 'desc')
            ->get([
                'id', 'titre', 'slug', 'description', 'image', 
                'technologies', 'url_projet', 'url_github', 
                'categorie', 'publie_le'
            ]);

        $categories = Projet::publie()
            ->distinct()
            ->pluck('categorie')
            ->filter()
            ->values();

        return response()->json([
            'projets' => $projets,
            'categories' => $categories,
        ]);
    }

    public function show(Projet $projet): JsonResponse
    {
        if (!$projet->publie_le || $projet->publie_le->isFuture()) {
            abort(404);
        }

        $projet->load('temoignages');

        // Projets similaires
        $projetsSimilaires = Projet::publie()
            ->where('id', '!=', $projet->id)
            ->where('categorie', $projet->categorie)
            ->limit(3)
            ->get(['id', 'titre', 'slug', 'description', 'image']);

        return response()->json([
            'projet' => $projet,
            'projets_similaires' => $projetsSimilaires,
        ]);
    }
}

// app/Http/Controllers/Front/CompetenceController.php
namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Competence;
use Illuminate\Http\JsonResponse;

class CompetenceController extends Controller
{
    public function index(): JsonResponse
    {
        $competences = Competence::visible()
            ->orderBy('categorie')
            ->orderBy('ordre')
            ->get()
            ->groupBy('categorie');

        return response()->json($competences);
    }
}

// app/Http/Controllers/Front/ExperienceController.php
namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Experience;
use App\Models\Formation;
use Illuminate\Http\JsonResponse;

class ExperienceController extends Controller
{
    public function index(): JsonResponse
    {
        $experiences = Experience::orderBy('date_debut', 'desc')
            ->orderBy('ordre')
            ->get();

        $formations = Formation::orderBy('date_debut', 'desc')
            ->orderBy('ordre')
            ->get();

        return response()->json([
            'experiences' => $experiences,
            'formations' => $formations,
        ]);
    }
}

// app/Http/Controllers/Front/ArticleController.php
namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = Article::publie();

        if ($request->has('categorie')) {
            $query->where('categorie', $request->categorie);
        }

        if ($request->has('recherche')) {
            $query->where(function ($q) use ($request) {
                $q->where('titre', 'like', '%' . $request->recherche . '%')
                  ->orWhere('extrait', 'like', '%' . $request->recherche . '%');
            });
        }

        $articles = $query->orderBy('publie_le', 'desc')
            ->paginate(9);

        $categories = Article::publie()
            ->distinct()
            ->pluck('categorie')
            ->filter()
            ->values();

        return response()->json([
            'articles' => $articles,
            'categories' => $categories,
        ]);
    }

    public function show(Article $article): JsonResponse
    {
        if (!$article->publie_le || $article->publie_le->isFuture()) {
            abort(404);
        }

        $article->incrementerVues();

        $articlesRecents = Article::publie()
            ->where('id', '!=', $article->id)
            ->orderBy('publie_le', 'desc')
            ->limit(3)
            ->get(['id', 'titre', 'slug', 'extrait', 'image_principale', 'publie_le']);

        return response()->json([
            'article' => $article,
            'articles_recents' => $articlesRecents,
        ]);
    }
}

// app/Http/Controllers/Front/ContactController.php
namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'nom' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'sujet' => 'nullable|string|max:255',
            'message' => 'required|string|min:10',
        ], [
            'nom.required' => 'Le nom est obligatoire',
            'email.required' => 'L\'email est obligatoire',
            'email.email' => 'L\'email doit être valide',
            'message.required' => 'Le message est obligatoire',
            'message.min' => 'Le message doit contenir au moins 10 caractères',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        Message::create($request->only(['nom', 'email', 'sujet', 'message']));

        return response()->json([
            'success' => true,
            'message' => 'Votre message a été envoyé avec succès !',
        ]);
    }
}

<?php

// routes/web.php
use App\Http\Controllers\Front\AccueilController;
use App\Http\Controllers\Front\ProjetController;
use App\Http\Controllers\Front\CompetenceController;
use App\Http\Controllers\Front\ExperienceController;
use App\Http\Controllers\Front\ArticleController;
use App\Http\Controllers\Front\ContactController;
use Illuminate\Support\Facades\Route;

// Routes API pour le front SPA
Route::prefix('api')->group(function () {
    // Accueil - Données globales
    Route::get('/accueil', [AccueilController::class, 'index']);

    // Projets
    Route::get('/projets', [ProjetController::class, 'index']);
    Route::get('/projets/{projet:slug}', [ProjetController::class, 'show']);

    // Compétences
    Route::get('/competences', [CompetenceController::class, 'index']);

    // Expériences & Formations
    Route::get('/parcours', [ExperienceController::class, 'index']);

    // Blog/Articles
    Route::get('/articles', [ArticleController::class, 'index']);
    Route::get('/articles/{article:slug}', [ArticleController::class, 'show']);

    // Contact
    Route::post('/contact', [ContactController::class, 'store']);
});

// Route catch-all pour le SPA (doit être la dernière)
Route::get('/{any?}', function () {
    return view('spa');
})->where('any', '.*');


// resources/js/app.js
import { createApp } from 'vue'
import { createPinia } from 'pinia'
import App from './App.vue'
import router from './router'
import './assets/css/main.css'

const app = createApp(App)
const pinia = createPinia()

app.use(pinia)
app.use(router)
app.mount('#app')

// ========================================
// resources/js/router/index.js
import { createRouter, createWebHistory } from 'vue-router'
import Accueil from '../views/Accueil.vue'

const routes = [
  {
    path: '/',
    name: 'accueil',
    component: Accueil,
    meta: { title: 'Accueil' }
  },
  {
    path: '/projets',
    name: 'projets',
    component: () => import('../views/Projets.vue'),
    meta: { title: 'Mes Projets' }
  },
  {
    path: '/projets/:slug',
    name: 'projet-detail',
    component: () => import('../views/ProjetDetail.vue'),
    meta: { title: 'Détail du Projet' }
  },
  {
    path: '/a-propos',
    name: 'a-propos',
    component: () => import('../views/APropos.vue'),
    meta: { title: 'À Propos' }
  },
  {
    path: '/blog',
    name: 'blog',
    component: () => import('../views/Blog.vue'),
    meta: { title: 'Blog' }
  },
  {
    path: '/blog/:slug',
    name: 'article-detail',
    component: () => import('../views/ArticleDetail.vue'),
    meta: { title: 'Article' }
  },
  {
    path: '/contact',
    name: 'contact',
    component: () => import('../views/Contact.vue'),
    meta: { title: 'Contact' }
  },
  {
    path: '/:pathMatch(.*)*',
    name: 'not-found',
    component: () => import('../views/NotFound.vue'),
    meta: { title: 'Page non trouvée' }
  }
]

const router = createRouter({
  history: createWebHistory(),
  routes,
  scrollBehavior(to, from, savedPosition) {
    if (savedPosition) {
      return savedPosition
    }
    if (to.hash) {
      return { el: to.hash, behavior: 'smooth' }
    }
    return { top: 0, behavior: 'smooth' }
  }
})

router.beforeEach((to, from, next) => {
  document.title = `${to.meta.title} | Portfolio` || 'Portfolio'
  next()
})

export default router

// ========================================
// resources/js/services/api.js
import axios from 'axios'

const api = axios.create({
  baseURL: '/api',
  headers: {
    'Content-Type': 'application/json',
    'Accept': 'application/json'
  }
})

// Intercepteur pour gérer les erreurs
api.interceptors.response.use(
  response => response,
  error => {
    console.error('Erreur API:', error)
    return Promise.reject(error)
  }
)

export default api

// ========================================
// resources/js/services/endpoints/accueil.js
import api from '../api'

export const accueilService = {
  async obtenirDonneesAccueil() {
    const response = await api.get('/accueil')
    return response.data
  }
}

// ========================================
// resources/js/services/endpoints/projets.js
import api from '../api'

export const projetsService = {
  async obtenirTous(params = {}) {
    const response = await api.get('/projets', { params })
    return response.data
  },
  
  async obtenirParSlug(slug) {
    const response = await api.get(`/projets/${slug}`)
    return response.data
  }
}

// ========================================
// resources/js/services/endpoints/competences.js
import api from '../api'

export const competencesService = {
  async obtenirTous() {
    const response = await api.get('/competences')
    return response.data
  }
}

// ========================================
// resources/js/services/endpoints/contact.js
import api from '../api'

export const contactService = {
  async envoyerMessage(data) {
    const response = await api.post('/contact', data)
    return response.data
  }
}

// ========================================
// resources/js/stores/accueil.js
import { defineStore } from 'pinia'
import { accueilService } from '../services/endpoints/accueil'

export const useAccueilStore = defineStore('accueil', {
  state: () => ({
    donneesAccueil: null,
    chargement: false,
    erreur: null
  }),

  getters: {
    infosPersonnelles: (state) => state.donneesAccueil?.informations_personnelles,
    projetsMisEnAvant: (state) => state.donneesAccueil?.projets_mis_en_avant || [],
    competences: (state) => state.donneesAccueil?.competences || [],
    temoignages: (state) => state.donneesAccueil?.temoignages || [],
    services: (state) => state.donneesAccueil?.services || [],
    statistiques: (state) => state.donneesAccueil?.statistiques || {}
  },

  actions: {
    async chargerDonneesAccueil() {
      this.chargement = true
      this.erreur = null
      try {
        this.donneesAccueil = await accueilService.obtenirDonneesAccueil()
      } catch (error) {
        this.erreur = error.message
        console.error('Erreur chargement accueil:', error)
      } finally {
        this.chargement = false
      }
    }
  }
})

// ========================================
// resources/js/composables/useIntersectionObserver.js
import { onMounted, onUnmounted, ref } from 'vue'

export function useIntersectionObserver(options = {}) {
  const isVisible = ref(false)
  const targetRef = ref(null)
  let observer = null

  onMounted(() => {
    observer = new IntersectionObserver(([entry]) => {
      if (entry.isIntersecting) {
        isVisible.value = true
        if (options.once) {
          observer.disconnect()
        }
      } else if (!options.once) {
        isVisible.value = false
      }
    }, {
      threshold: options.threshold || 0.1,
      rootMargin: options.rootMargin || '0px'
    })

    if (targetRef.value) {
      observer.observe(targetRef.value)
    }
  })

  onUnmounted(() => {
    if (observer) observer.disconnect()
  })

  return { isVisible, targetRef }
}

// ========================================
// resources/js/utils/helpers.js
export function formaterDate(date, format = 'long') {
  if (!date) return ''
  
  const options = format === 'long' 
    ? { year: 'numeric', month: 'long', day: 'numeric' }
    : { year: 'numeric', month: 'short' }
  
  return new Date(date).toLocaleDateString('fr-FR', options)
}

export function calculerTempsLecture(texte) {
  const mots = texte.split(/\s+/).length
  const minutes = Math.ceil(mots / 200)
  return minutes
}

export function tronquerTexte(texte, longueur = 100) {
  if (texte.length <= longueur) return texte
  return texte.substring(0, longueur) + '...'
}

<!-- resources/js/components/ui/Loader.vue -->
<template>
  <div class="loader-container">
    <div class="loader"></div>
    <p v-if="message" class="loader-message">{{ message }}</p>
  </div>
</template>

<script setup>
defineProps({
  message: {
    type: String,
    default: 'Chargement...'
  }
})
</script>

<style scoped>
.loader-container {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  padding: 3rem;
}

.loader {
  width: 48px;
  height: 48px;
  border: 4px solid #f3f4f6;
  border-top-color: #3b82f6;
  border-radius: 50%;
  animation: spin 1s linear infinite;
}

.loader-message {
  margin-top: 1rem;
  color: #6b7280;
  font-size: 0.875rem;
}

@keyframes spin {
  to { transform: rotate(360deg); }
}
</style>

<!-- ======================================== -->
<!-- resources/js/components/ui/Button.vue -->
<template>
  <component
    :is="tag"
    :class="['btn', `btn-${variant}`, `btn-${size}`, { 'btn-loading': loading }]"
    :disabled="disabled || loading"
    v-bind="$attrs"
  >
    <span v-if="loading" class="btn-spinner"></span>
    <slot v-else />
  </component>
</template>

<script setup>
defineProps({
  tag: {
    type: String,
    default: 'button'
  },
  variant: {
    type: String,
    default: 'primary', // primary, secondary, outline, ghost
    validator: (value) => ['primary', 'secondary', 'outline', 'ghost'].includes(value)
  },
  size: {
    type: String,
    default: 'md', // sm, md, lg
    validator: (value) => ['sm', 'md', 'lg'].includes(value)
  },
  loading: {
    type: Boolean,
    default: false
  },
  disabled: {
    type: Boolean,
    default: false
  }
})
</script>

<style scoped>
.btn {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: 0.5rem;
  font-weight: 500;
  border-radius: 0.5rem;
  transition: all 0.3s;
  cursor: pointer;
  border: 2px solid transparent;
  text-decoration: none;
}

.btn:disabled {
  opacity: 0.5;
  cursor: not-allowed;
}

/* Variants */
.btn-primary {
  background: linear-gradient(135deg, #3b82f6, #2563eb);
  color: white;
}

.btn-primary:hover:not(:disabled) {
  transform: translateY(-2px);
  box-shadow: 0 10px 25px rgba(59, 130, 246, 0.4);
}

.btn-secondary {
  background: linear-gradient(135deg, #8b5cf6, #7c3aed);
  color: white;
}

.btn-secondary:hover:not(:disabled) {
  transform: translateY(-2px);
  box-shadow: 0 10px 25px rgba(139, 92, 246, 0.4);
}

.btn-outline {
  background: transparent;
  border-color: #3b82f6;
  color: #3b82f6;
}

.btn-outline:hover:not(:disabled) {
  background: #3b82f6;
  color: white;
}

.btn-ghost {
  background: transparent;
  color: #6b7280;
}

.btn-ghost:hover:not(:disabled) {
  background: #f3f4f6;
  color: #1f2937;
}

/* Sizes */
.btn-sm {
  padding: 0.5rem 1rem;
  font-size: 0.875rem;
}

.btn-md {
  padding: 0.75rem 1.5rem;
  font-size: 1rem;
}

.btn-lg {
  padding: 1rem 2rem;
  font-size: 1.125rem;
}

.btn-loading {
  pointer-events: none;
}

.btn-spinner {
  width: 16px;
  height: 16px;
  border: 2px solid currentColor;
  border-top-color: transparent;
  border-radius: 50%;
  animation: spin 0.6s linear infinite;
}

@keyframes spin {
  to { transform: rotate(360deg); }
}

/* Dark mode */
:global(.dark-mode) .btn-ghost {
  color: #d1d5db;
}

:global(.dark-mode) .btn-ghost:hover:not(:disabled) {
  background: #374151;
  color: #f9fafb;
}
</style>

<!-- ======================================== -->
<!-- resources/js/components/ui/Card.vue -->
<template>
  <div :class="['card', { 'card-hover': hover }]">
    <slot />
  </div>
</template>

<script setup>
defineProps({
  hover: {
    type: Boolean,
    default: false
  }
})
</script>

<style scoped>
.card {
  background: white;
  border-radius: 1rem;
  padding: 1.5rem;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
  transition: all 0.3s;
}

.card-hover:hover {
  transform: translateY(-5px);
  box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
}

:global(.dark-mode) .card {
  background: #1e293b;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
}

:global(.dark-mode) .card-hover:hover {
  box-shadow: 0 20px 40px rgba(0, 0, 0, 0.5);
}
</style>

<!-- ======================================== -->
<!-- resources/js/components/ui/Badge.vue -->
<template>
  <span :class="['badge', `badge-${variant}`]">
    <slot />
  </span>
</template>

<script setup>
defineProps({
  variant: {
    type: String,
    default: 'default', // default, primary, success, warning, danger
    validator: (value) => ['default', 'primary', 'success', 'warning', 'danger'].includes(value)
  }
})
</script>

<style scoped>
.badge {
  display: inline-flex;
  align-items: center;
  padding: 0.25rem 0.75rem;
  font-size: 0.75rem;
  font-weight: 600;
  border-radius: 9999px;
  text-transform: uppercase;
  letter-spacing: 0.025em;
}

.badge-default {
  background: #f3f4f6;
  color: #4b5563;
}

.badge-primary {
  background: #dbeafe;
  color: #1e40af;
}

.badge-success {
  background: #d1fae5;
  color: #065f46;
}

.badge-warning {
  background: #fef3c7;
  color: #92400e;
}

.badge-danger {
  background: #fee2e2;
  color: #991b1b;
}

:global(.dark-mode) .badge-default {
  background: #374151;
  color: #d1d5db;
}
</style>

<!-- ======================================== -->
<!-- resources/js/components/ui/ScrollToTop.vue -->
<template>
  <Transition name="fade">
    <button
      v-if="visible"
      class="scroll-to-top"
      @click="scrollToTop"
      aria-label="Retour en haut"
    >
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <polyline points="18 15 12 9 6 15"></polyline>
      </svg>
    </button>
  </Transition>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue'

const visible = ref(false)

const handleScroll = () => {
  visible.value = window.scrollY > 300
}

const scrollToTop = () => {
  window.scrollTo({
    top: 0,
    behavior: 'smooth'
  })
}

onMounted(() => {
  window.addEventListener('scroll', handleScroll)
})

onUnmounted(() => {
  window.removeEventListener('scroll', handleScroll)
})
</script>

<style scoped>
.scroll-to-top {
  position: fixed;
  bottom: 2rem;
  right: 2rem;
  width: 48px;
  height: 48px;
  border-radius: 50%;
  background: linear-gradient(135deg, #3b82f6, #2563eb);
  color: white;
  border: none;
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
  box-shadow: 0 10px 25px rgba(59, 130, 246, 0.4);
  transition: all 0.3s;
  z-index: 999;
}

.scroll-to-top:hover {
  transform: translateY(-5px);
  box-shadow: 0 15px 35px rgba(59, 130, 246, 0.5);
}

.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.3s, transform 0.3s;
}

.fade-enter-from,
.fade-leave-to {
  opacity: 0;
  transform: scale(0.8);
}
</style>

<!-- resources/js/components/layout/Header.vue -->
<template>
  <header :class="['header', { 'header-scrolled': scrolled }]">
    <div class="container">
      <router-link to="/" class="logo">
        <span class="logo-text">Portfolio</span>
      </router-link>

      <nav :class="['nav', { 'nav-open': menuOuvert }]">
        <router-link
          v-for="lien in liens"
          :key="lien.path"
          :to="lien.path"
          class="nav-link"
          @click="fermerMenu"
        >
          {{ lien.nom }}
        </router-link>

        <button class="theme-toggle" @click="$emit('toggle-dark-mode')" aria-label="Changer de thème">
          <svg v-if="!isDarkMode" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <circle cx="12" cy="12" r="5"></circle>
            <line x1="12" y1="1" x2="12" y2="3"></line>
            <line x1="12" y1="21" x2="12" y2="23"></line>
            <line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line>
            <line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line>
            <line x1="1" y1="12" x2="3" y2="12"></line>
            <line x1="21" y1="12" x2="23" y2="12"></line>
            <line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line>
            <line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line>
          </svg>
          <svg v-else xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path>
          </svg>
        </button>
      </nav>

      <button class="menu-toggle" @click="toggleMenu" aria-label="Menu">
        <span></span>
        <span></span>
        <span></span>
      </button>
    </div>
  </header>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue'

defineProps({
  isDarkMode: {
    type: Boolean,
    required: true
  }
})

defineEmits(['toggle-dark-mode'])

const scrolled = ref(false)
const menuOuvert = ref(false)

const liens = [
  { nom: 'Accueil', path: '/' },
  { nom: 'Projets', path: '/projets' },
  { nom: 'À Propos', path: '/a-propos' },
  { nom: 'Blog', path: '/blog' },
  { nom: 'Contact', path: '/contact' }
]

const handleScroll = () => {
  scrolled.value = window.scrollY > 50
}

const toggleMenu = () => {
  menuOuvert.value = !menuOuvert.value
}

const fermerMenu = () => {
  menuOuvert.value = false
}

onMounted(() => {
  window.addEventListener('scroll', handleScroll)
})

onUnmounted(() => {
  window.removeEventListener('scroll', handleScroll)
})
</script>

<style scoped>
.header {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  z-index: 1000;
  background: rgba(255, 255, 255, 0.8);
  backdrop-filter: blur(10px);
  border-bottom: 1px solid rgba(0, 0, 0, 0.05);
  transition: all 0.3s;
}

.header-scrolled {
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
}

.container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 1rem 1.5rem;
  display: flex;
  align-items: center;
  justify-content: space-between;
}

.logo {
  font-size: 1.5rem;
  font-weight: 700;
  background: linear-gradient(135deg, #3b82f6, #8b5cf6);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  text-decoration: none;
  transition: all 0.3s;
}

.logo:hover {
  opacity: 0.8;
  transform: scale(1.05);
}

.nav {
  display: flex;
  align-items: center;
  gap: 2rem;
}

.nav-link {
  color: #4b5563;
  text-decoration: none;
  font-weight: 500;
  position: relative;
  transition: color 0.3s;
}

.nav-link::after {
  content: '';
  position: absolute;
  bottom: -4px;
  left: 0;
  width: 0;
  height: 2px;
  background: linear-gradient(135deg, #3b82f6, #8b5cf6);
  transition: width 0.3s;
}

.nav-link:hover {
  color: #3b82f6;
}

.nav-link:hover::after,
.nav-link.router-link-active::after {
  width: 100%;
}

.theme-toggle {
  background: #f3f4f6;
  border: none;
  width: 40px;
  height: 40px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  transition: all 0.3s;
}

.theme-toggle:hover {
  background: #e5e7eb;
  transform: rotate(20deg);
}

.menu-toggle {
  display: none;
  flex-direction: column;
  gap: 5px;
  background: none;
  border: none;
  cursor: pointer;
  padding: 0.5rem;
}

.menu-toggle span {
  width: 25px;
  height: 2px;
  background: #4b5563;
  transition: all 0.3s;
}

/* Dark mode */
:global(.dark-mode) .header {
  background: rgba(15, 23, 42, 0.8);
  border-bottom-color: rgba(255, 255, 255, 0.05);
}

:global(.dark-mode) .nav-link {
  color: #cbd5e1;
}

:global(.dark-mode) .nav-link:hover {
  color: #60a5fa;
}

:global(.dark-mode) .theme-toggle {
  background: #1e293b;
  color: #cbd5e1;
}

:global(.dark-mode) .theme-toggle:hover {
  background: #334155;
}

/* Responsive */
@media (max-width: 768px) {
  .menu-toggle {
    display: flex;
  }

  .nav {
    position: fixed;
    top: 70px;
    left: 0;
    right: 0;
    background: white;
    flex-direction: column;
    padding: 2rem;
    transform: translateY(-100%);
    opacity: 0;
    visibility: hidden;
    transition: all 0.3s;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
  }

  .nav-open {
    transform: translateY(0);
    opacity: 1;
    visibility: visible;
  }

  :global(.dark-mode) .nav {
    background: #0f172a;
  }
}
</style>

<!-- ======================================== -->
<!-- resources/js/views/Accueil.vue -->
<template>
  <div class="accueil">
    <Loader v-if="chargement" message="Chargement des données..." />
    
    <template v-else-if="donneesChargees">
      <!-- Section Hero -->
      <section class="hero">
        <div class="container">
          <div class="hero-content">
            <div class="hero-text">
              <span class="hero-badge">👋 Bienvenue</span>
              <h1 class="hero-title">
                Je suis <span class="gradient-text">{{ infos.prenom }}</span>
              </h1>
              <h2 class="hero-subtitle">{{ infos.titre_poste }}</h2>
              <p class="hero-description">{{ infos.bio_courte }}</p>
              
              <div class="hero-actions">
                <Button tag="router-link" to="/projets" variant="primary" size="lg">
                  Voir mes projets
                </Button>
                <Button tag="router-link" to="/contact" variant="outline" size="lg">
                  Me contacter
                </Button>
              </div>

              <div v-if="infos.reseaux_sociaux" class="hero-social">
                <a
                  v-for="(url, reseau) in infos.reseaux_sociaux"
                  :key="reseau"
                  :href="url"
                  target="_blank"
                  rel="noopener noreferrer"
                  class="social-link"
                  :aria-label="reseau"
                >
                  <span>{{ reseau }}</span>
                </a>
              </div>
            </div>

            <div class="hero-image">
              <div class="image-wrapper">
                <img
                  v-if="infos.photo_profil"
                  :src="infos.photo_profil"
                  :alt="infos.nom_complet"
                  class="profile-image"
                />
                <div v-else class="profile-placeholder">
                  <span>{{ infos.prenom?.charAt(0) }}{{ infos.nom?.charAt(0) }}</span>
                </div>
              </div>
              <div class="floating-card">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <polyline points="16 18 22 12 16 6"></polyline>
                  <polyline points="8 6 2 12 8 18"></polyline>
                </svg>
                <span>Code propre & moderne</span>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- Section Statistiques -->
      <section v-if="statistiques" class="stats">
        <div class="container">
          <div class="stats-grid">
            <div class="stat-card">
              <div class="stat-number">{{ statistiques.total_projets }}+</div>
              <div class="stat-label">Projets réalisés</div>
            </div>
            <div class="stat-card">
              <div class="stat-number">{{ statistiques.annees_experience }}+</div>
              <div class="stat-label">Années d'expérience</div>
            </div>
            <div class="stat-card">
              <div class="stat-number">{{ statistiques.clients_satisfaits }}+</div>
              <div class="stat-label">Clients satisfaits</div>
            </div>
          </div>
        </div>
      </section>

      <!-- Section Projets mis en avant -->
      <section v-if="projets.length" class="featured-projects">
        <div class="container">
          <div class="section-header">
            <h2 class="section-title">Projets en vedette</h2>
            <Button tag="router-link" to="/projets" variant="ghost">
              Voir tous les projets →
            </Button>
          </div>

          <div class="projects-grid">
            <Card
              v-for="projet in projets"
              :key="projet.id"
              hover
              class="project-card"
            >
              <router-link :to="`/projets/${projet.slug}`" class="project-link">
                <div class="project-image">
                  <img v-if="projet.image" :src="projet.image" :alt="projet.titre" />
                  <div v-else class="project-placeholder">{{ projet.titre.charAt(0) }}</div>
                </div>
                <div class="project-content">
                  <Badge v-if="projet.categorie" variant="primary">{{ projet.categorie }}</Badge>
                  <h3 class="project-title">{{ projet.titre }}</h3>
                  <p class="project-description">{{ projet.description }}</p>
                  <div v-if="projet.technologies" class="project-tech">
                    <span
                      v-for="tech in projet.technologies.slice(0, 3)"
                      :key="tech"
                      class="tech-tag"
                    >
                      {{ tech }}
                    </span>
                  </div>
                </div>
              </router-link>
            </Card>
          </div>
        </div>
      </section>

      <!-- Section Compétences -->
      <section v-if="competencesParCategorie" class="skills">
        <div class="container">
          <h2 class="section-title">Mes compétences</h2>
          
          <div class="skills-categories">
            <div
              v-for="(competences, categorie) in competencesParCategorie"
              :key="categorie"
              class="skill-category"
            >
              <h3 class="category-title">{{ formaterCategorie(categorie) }}</h3>
              <div class="skills-list">
                <div
                  v-for="competence in competences"
                  :key="competence.id"
                  class="skill-item"
                >
                  <div class="skill-header">
                    <span class="skill-name">{{ competence.nom }}</span>
                    <span class="skill-level">{{ competence.niveau }}%</span>
                  </div>
                  <div class="skill-bar">
                    <div
                      class="skill-progress"
                      :style="{ width: competence.niveau + '%', backgroundColor: competence.couleur || '#3b82f6' }"
                    ></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- Section Services -->
      <section v-if="services.length" class="services">
        <div class="container">
          <h2 class="section-title">Mes services</h2>
          
          <div class="services-grid">
            <Card
              v-for="service in services"
              :key="service.id"
              hover
              class="service-card"
            >
              <div class="service-icon">{{ service.icone || '🚀' }}</div>
              <h3 class="service-title">{{ service.titre }}</h3>
              <p class="service-description">{{ service.description }}</p>
              <ul v-if="service.fonctionnalites" class="service-features">
                <li v-for="(feature, index) in service.fonctionnalites" :key="index">
                  ✓ {{ feature }}
                </li>
              </ul>
            </Card>
          </div>
        </div>
      </section>

      <!-- Section CTA -->
      <section class="cta">
        <div class="container">
          <div class="cta-content">
            <h2 class="cta-title">Prêt à démarrer un projet ?</h2>
            <p class="cta-description">Discutons de votre prochain projet et donnons vie à vos idées.</p>
            <Button tag="router-link" to="/contact" variant="primary" size="lg">
              Commencer maintenant
            </Button>
          </div>
        </div>
      </section>
    </template>
  </div>
</template>

<script setup>
import { computed, onMounted } from 'vue'
import { useAccueilStore } from '../stores/accueil'
import Loader from '../components/ui/Loader.vue'
import Button from '../components/ui/Button.vue'
import Card from '../components/ui/Card.vue'
import Badge from '../components/ui/Badge.vue'

const store = useAccueilStore()

const chargement = computed(() => store.chargement)
const donneesChargees = computed(() => store.donneesAccueil !== null)
const infos = computed(() => store.infosPersonnelles || {})
const projets = computed(() => store.projetsMisEnAvant)
const statistiques = computed(() => store.statistiques)
const services = computed(() => store.services)

const competencesParCategorie = computed(() => {
  const competences = store.competences
  if (!competences.length) return null
  
  return competences.reduce((acc, comp) => {
    if (!acc[comp.categorie]) {
      acc[comp.categorie] = []
    }
    acc[comp.categorie].push(comp)
    return acc
  }, {})
})

const formaterCategorie = (categorie) => {
  const categories = {
    frontend: 'Frontend',
    backend: 'Backend',
    design: 'Design',
    outils: 'Outils'
  }
  return categories[categorie] || categorie
}

onMounted(() => {
  store.chargerDonneesAccueil()
})
</script>

<style scoped>
/* Styles dans le prochain message pour ne pas dépasser la limite */
</style>

/* resources/js/assets/css/main.css */

/* Reset et base */
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

body {
  font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
  line-height: 1.6;
  color: #1f2937;
  background: #ffffff;
  transition: background 0.3s, color 0.3s;
}

.dark-mode {
  background: #0f172a;
  color: #cbd5e1;
}

.container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 1.5rem;
}

/* Section commune */
section {
  padding: 5rem 0;
}

.section-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 3rem;
}

.section-title {
  font-size: 2.5rem;
  font-weight: 700;
  background: linear-gradient(135deg, #3b82f6, #8b5cf6);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  margin-bottom: 1rem;
}

.gradient-text {
  background: linear-gradient(135deg, #3b82f6, #8b5cf6);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
}

/* Hero Section */
.hero {
  min-height: 100vh;
  display: flex;
  align-items: center;
  padding-top: 70px;
  position: relative;
  overflow: hidden;
}

.hero::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: radial-gradient(circle at 20% 50%, rgba(59, 130, 246, 0.1) 0%, transparent 50%),
              radial-gradient(circle at 80% 80%, rgba(139, 92, 246, 0.1) 0%, transparent 50%);
  pointer-events: none;
}

.hero-content {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 4rem;
  align-items: center;
  position: relative;
  z-index: 1;
}

.hero-text {
  animation: fadeInUp 0.8s ease-out;
}

.hero-badge {
  display: inline-block;
  padding: 0.5rem 1rem;
  background: linear-gradient(135deg, rgba(59, 130, 246, 0.1), rgba(139, 92, 246, 0.1));
  border: 1px solid rgba(59, 130, 246, 0.2);
  border-radius: 2rem;
  font-size: 0.875rem;
  font-weight: 500;
  color: #3b82f6;
  margin-bottom: 1.5rem;
}

.hero-title {
  font-size: 3.5rem;
  font-weight: 800;
  line-height: 1.2;
  margin-bottom: 1rem;
}

.hero-subtitle {
  font-size: 1.5rem;
  color: #6b7280;
  margin-bottom: 1.5rem;
}

.hero-description {
  font-size: 1.125rem;
  color: #6b7280;
  line-height: 1.8;
  margin-bottom: 2rem;
}

.hero-actions {
  display: flex;
  gap: 1rem;
  margin-bottom: 2rem;
}

.hero-social {
  display: flex;
  gap: 1rem;
}

.social-link {
  width: 40px;
  height: 40px;
  border-radius: 50%;
  background: #f3f4f6;
  display: flex;
  align-items: center;
  justify-content: center;
  text-decoration: none;
  color: #4b5563;
  font-size: 0.75rem;
  font-weight: 600;
  text-transform: uppercase;
  transition: all 0.3s;
}

.social-link:hover {
  background: linear-gradient(135deg, #3b82f6, #8b5cf6);
  color: white;
  transform: translateY(-3px);
}

.hero-image {
  position: relative;
  animation: fadeInRight 0.8s ease-out;
}

.image-wrapper {
  position: relative;
  width: 400px;
  height: 400px;
  margin: 0 auto;
}

.image-wrapper::before {
  content: '';
  position: absolute;
  inset: -20px;
  background: linear-gradient(135deg, #3b82f6, #8b5cf6);
  border-radius: 50%;
  filter: blur(40px);
  opacity: 0.3;
  animation: pulse 3s ease-in-out infinite;
}

.profile-image {
  width: 100%;
  height: 100%;
  object-fit: cover;
  border-radius: 50%;
  border: 5px solid white;
  box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
  position: relative;
  z-index: 1;
}

.profile-placeholder {
  width: 100%;
  height: 100%;
  border-radius: 50%;
  background: linear-gradient(135deg, #3b82f6, #8b5cf6);
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 8rem;
  font-weight: 700;
  color: white;
  box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
}

.floating-card {
  position: absolute;
  bottom: 20px;
  right: -20px;
  background: white;
  padding: 1rem 1.5rem;
  border-radius: 1rem;
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
  display: flex;
  align-items: center;
  gap: 0.75rem;
  animation: float 3s ease-in-out infinite;
}

.floating-card svg {
  color: #3b82f6;
}

/* Statistiques */
.stats {
  padding: 3rem 0;
  background: linear-gradient(135deg, rgba(59, 130, 246, 0.05), rgba(139, 92, 246, 0.05));
}

.stats-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
  gap: 2rem;
}

.stat-card {
  text-align: center;
  padding: 2rem;
}

.stat-number {
  font-size: 3rem;
  font-weight: 800;
  background: linear-gradient(135deg, #3b82f6, #8b5cf6);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  margin-bottom: 0.5rem;
}

.stat-label {
  font-size: 1rem;
  color: #6b7280;
  font-weight: 500;
}

/* Projets */
.featured-projects {
  background: #f9fafb;
}

.projects-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
  gap: 2rem;
}

.project-card {
  overflow: hidden;
}

.project-link {
  text-decoration: none;
  color: inherit;
  display: block;
}

.project-image {
  width: 100%;
  height: 200px;
  overflow: hidden;
  border-radius: 0.5rem;
  margin-bottom: 1rem;
}

.project-image img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 0.3s;
}

.project-card:hover .project-image img {
  transform: scale(1.1);
}

.project-placeholder {
  width: 100%;
  height: 100%;
  background: linear-gradient(135deg, #3b82f6, #8b5cf6);
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 4rem;
  font-weight: 700;
  color: white;
}

.project-content {
  display: flex;
  flex-direction: column;
  gap: 0.75rem;
}

.project-title {
  font-size: 1.25rem;
  font-weight: 700;
  color: #1f2937;
}

.project-description {
  color: #6b7280;
  font-size: 0.875rem;
  line-height: 1.6;
}

.project-tech {
  display: flex;
  flex-wrap: wrap;
  gap: 0.5rem;
}

.tech-tag {
  padding: 0.25rem 0.75rem;
  background: #e5e7eb;
  border-radius: 0.25rem;
  font-size: 0.75rem;
  font-weight: 500;
  color: #4b5563;
}

/* Compétences */
.skills-categories {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
  gap: 2rem;
}

.skill-category {
  background: white;
  padding: 2rem;
  border-radius: 1rem;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
}

.category-title {
  font-size: 1.5rem;
  font-weight: 700;
  color: #1f2937;
  margin-bottom: 1.5rem;
}

.skills-list {
  display: flex;
  flex-direction: column;
  gap: 1.5rem;
}

.skill-item {
  display: flex;
  flex-direction: column;
  gap: 0.5rem;
}

.skill-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.skill-name {
  font-weight: 600;
  color: #1f2937;
}

.skill-level {
  font-size: 0.875rem;
  color: #6b7280;
  font-weight: 500;
}

.skill-bar {
  height: 8px;
  background: #e5e7eb;
  border-radius: 1rem;
  overflow: hidden;
}

.skill-progress {
  height: 100%;
  background: linear-gradient(90deg, #3b82f6, #8b5cf6);
  border-radius: 1rem;
  transition: width 1s ease-out;
}

/* Services */
.services {
  background: #f9fafb;
}

.services-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
  gap: 2rem;
}

.service-card {
  text-align: center;
}

.service-icon {
  font-size: 3rem;
  margin-bottom: 1rem;
}

.service-title {
  font-size: 1.25rem;
  font-weight: 700;
  color: #1f2937;
  margin-bottom: 0.75rem;
}

.service-description {
  color: #6b7280;
  margin-bottom: 1rem;
  line-height: 1.6;
}

.service-features {
  list-style: none;
  text-align: left;
  display: flex;
  flex-direction: column;
  gap: 0.5rem;
}

.service-features li {
  color: #4b5563;
  font-size: 0.875rem;
}

/* CTA */
.cta {
  background: linear-gradient(135deg, #3b82f6, #8b5cf6);
  color: white;
}

.cta-content {
  text-align: center;
  max-width: 600px;
  margin: 0 auto;
}

.cta-title {
  font-size: 2.5rem;
  font-weight: 700;
  margin-bottom: 1rem;
  color: white;
}

.cta-description {
  font-size: 1.125rem;
  margin-bottom: 2rem;
  opacity: 0.9;
}

/* Animations */
@keyframes fadeInUp {
  from {
    opacity: 0;
    transform: translateY(30px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

@keyframes fadeInRight {
  from {
    opacity: 0;
    transform: translateX(30px);
  }
  to {
    opacity: 1;
    transform: translateX(0);
  }
}

@keyframes pulse {
  0%, 100% {
    transform: scale(1);
  }
  50% {
    transform: scale(1.05);
  }
}

@keyframes float {
  0%, 100% {
    transform: translateY(0);
  }
  50% {
    transform: translateY(-10px);
  }
}

/* Dark Mode */
.dark-mode .hero-subtitle,
.dark-mode .hero-description,
.dark-mode .stat-label,
.dark-mode .project-description,
.dark-mode .skill-level,
.dark-mode .service-description {
  color: #94a3b8;
}

.dark-mode .featured-projects,
.dark-mode .services {
  background: #1e293b;
}

.dark-mode .skill-category {
  background: #1e293b;
}

.dark-mode .project-title,
.dark-mode .category-title,
.dark-mode .skill-name,
.dark-mode .service-title {
  color: #f1f5f9;
}

.dark-mode .tech-tag {
  background: #334155;
  color: #cbd5e1;
}

.dark-mode .social-link {
  background: #1e293b;
  color: #cbd5e1;
}

.dark-mode .floating-card {
  background: #1e293b;
}

/* Responsive */
@media (max-width: 768px) {
  .hero-content {
    grid-template-columns: 1fr;
    gap: 2rem;
  }

  .hero-title {
    font-size: 2.5rem;
  }

  .hero-subtitle {
    font-size: 1.25rem;
  }

  .hero-actions {
    flex-direction: column;
  }

  .image-wrapper {
    width: 300px;
    height: 300px;
  }

  .section-title {
    font-size: 2rem;
  }

  .section-header {
    flex-direction: column;
    align-items: flex-start;
    gap: 1rem;
  }

  .projects-grid {
    grid-template-columns: 1fr;
  }

  .cta-title {
    font-size: 2rem;
  }
}

resources/
├── views/
│   └── spa.blade.php          🎯 SEUL TEMPLATE UTILISÉ
├── css/
│   └── app.css               🎯 STYLES PRINCIPAUX
└── js/
    ├── app.js                🎯 ENTRY POINT VUE
    ├── App.vue               🎯 COMPOSANT RACINE
    ├── bootstrap.js          🎯 BOOTSTRAP LARAVEL
    ├── router/
    │   └── index.js          🎯 CONFIGURATION ROUTES
    ├── stores/
    │   ├── app.js            🎯 STORE PRINCIPAL
    │   └── loading.js        🎯 STORE CHARGEMENT
    ├── services/
    │   ├── api.js            🎯 CLIENT API
    │   └── endpoints/
    │       ├── accueil.js    🎯 SERVICE ACCUEIL
    │       ├── projets.js    🎯 SERVICE PROJETS
    │       └── contact.js    🎯 SERVICE CONTACT
    ├── components/
    │   ├── layout/
    │   │   ├── Header.vue    🎯 HEADER
    │   │   └── Footer.vue    🎯 FOOTER
    │   └── ui/
    │       ├── Button.vue    🎯 BOUTON
    │       ├── Loader.vue    🎯 LOADER
    │       └── ScrollToTop.vue 🎯 SCROLL TOP
    ├── views/
    │   ├── Accueil.vue       🎯 ACCUEIL
    │   ├── Projets.vue       🎯 LISTE PROJETS
    │   ├── ProjetDetail.vue  🎯 DÉTAIL PROJET
    │   ├── APropos.vue       🎯 À PROPOS
    │   ├── Blog.vue          🎯 BLOG
    │   ├── ArticleDetail.vue 🎯 DÉTAIL ARTICLE
    │   ├── Contact.vue       🎯 CONTACT
    │   └── NotFound.vue      🎯 404
    └── assets/
        └── css/
            └── main.css      🎯 STYLES COMPLÉMENTAIRES