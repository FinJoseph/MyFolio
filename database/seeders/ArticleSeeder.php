<?php

// database/seeders/ArticleSeeder.php

namespace Database\Seeders;

use App\Models\Article;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    public function run()
    {
        $articles = [
            [
                'titre' => 'Les meilleures pratiques pour le développement Vue.js en 2024',
                'slug' => 'meilleures-pratiques-vuejs-2024',
                'extrait' => 'Découvrez comment optimiser votre workflow Vue.js avec les dernières fonctionnalités et les bonnes pratiques essentielles.',
                'contenu' => $this->genererContenuArticle('Vue.js'),
                'image_principale' => 'articles/vuejs-best-practices.jpg',
                'categorie' => 'Développement Frontend',
                'tags' => ['Vue.js', 'JavaScript', 'Frontend', 'Best Practices'],
                'temps_lecture' => 8,
                'vues' => 1542,
                'publie_le' => Carbon::now()->subDays(5),
            ],
            [
                'titre' => 'Introduction à Laravel : Créer sa première API REST',
                'slug' => 'introduction-laravel-api-rest',
                'extrait' => 'Apprenez à créer une API REST complète avec Laravel, de la configuration à la déployement.',
                'contenu' => $this->genererContenuArticle('Laravel'),
                'image_principale' => 'articles/laravel-api-rest.jpg',
                'categorie' => 'Développement Backend',
                'tags' => ['Laravel', 'PHP', 'API', 'Backend', 'REST'],
                'temps_lecture' => 12,
                'vues' => 2341,
                'publie_le' => Carbon::now()->subDays(12),
            ],
            [
                'titre' => 'Optimisation des performances web : techniques avancées',
                'slug' => 'optimisation-performances-web-techniques',
                'extrait' => 'Explorez des techniques avancées pour améliorer les performances de vos applications web.',
                'contenu' => $this->genererContenuArticle('Performances'),
                'image_principale' => 'articles/web-performance.jpg',
                'categorie' => 'Performance',
                'tags' => ['Performance', 'Optimisation', 'Web', 'SEO'],
                'temps_lecture' => 15,
                'vues' => 1897,
                'publie_le' => Carbon::now()->subDays(20),
            ],
            [
                'titre' => 'Les principes fondamentaux du Design System',
                'slug' => 'principes-fondamentaux-design-system',
                'extrait' => 'Comprenez les concepts clés derrière la création et la maintenance d\'un Design System efficace.',
                'contenu' => $this->genererContenuArticle('Design System'),
                'image_principale' => 'articles/design-system.jpg',
                'categorie' => 'Design',
                'tags' => ['Design', 'UI/UX', 'Design System', 'Figma'],
                'temps_lecture' => 10,
                'vues' => 976,
                'publie_le' => Carbon::now()->subDays(30),
            ],
            [
                'titre' => 'Déploiement continu avec Docker et GitLab CI',
                'slug' => 'deploiement-continu-docker-gitlab-ci',
                'extrait' => 'Mettez en place un pipeline CI/CD robuste pour vos applications avec Docker et GitLab.',
                'contenu' => $this->genererContenuArticle('CI/CD'),
                'image_principale' => 'articles/docker-gitlab-ci.jpg',
                'categorie' => 'DevOps',
                'tags' => ['Docker', 'CI/CD', 'GitLab', 'DevOps', 'Deployment'],
                'temps_lecture' => 14,
                'vues' => 1123,
                'publie_le' => Carbon::now()->subDays(45),
            ],
            [
                'titre' => 'TypeScript vs JavaScript : quand et pourquoi migrer',
                'slug' => 'typescript-vs-javascript-migration',
                'extrait' => 'Analyse comparative entre TypeScript et JavaScript pour prendre la bonne décision pour votre projet.',
                'contenu' => $this->genererContenuArticle('TypeScript'),
                'image_principale' => 'articles/typescript-vs-javascript.jpg',
                'categorie' => 'Développement Frontend',
                'tags' => ['TypeScript', 'JavaScript', 'Frontend', 'Migration'],
                'temps_lecture' => 11,
                'vues' => 876,
                'publie_le' => Carbon::now()->subDays(60),
            ],
        ];

        foreach ($articles as $article) {
            Article::create($article);
        }
    }

    private function genererContenuArticle($sujet)
    {
        return "
            <h2>Introduction à {$sujet}</h2>
            <p>Dans cet article, nous allons explorer les concepts fondamentaux de {$sujet} et comment les appliquer dans vos projets.</p>
            
            <h3>Les avantages principaux</h3>
            <p>L'utilisation de {$sujet} offre de nombreux avantages :</p>
            <ul>
                <li>Amélioration de la productivité</li>
                <li>Code plus maintenable</li>
                <li>Meilleure collaboration en équipe</li>
                <li>Réduction des erreurs</li>
            </ul>
            
            <h3>Cas d'utilisation pratiques</h3>
            <p>Voici quelques exemples concrets où {$sujet} excelle :</p>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
            
            <h3>Conclusion</h3>
            <p>En conclusion, {$sujet} est un outil puissant qui peut considérablement améliorer votre workflow de développement.</p>
            <p>N'hésitez pas à expérimenter et à adapter ces concepts à vos besoins spécifiques.</p>
        ";
    }
}
