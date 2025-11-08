<?php

// database/seeders/MessageSeeder.php

namespace Database\Seeders;

use App\Models\Message;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class MessageSeeder extends Seeder
{
    public function run()
    {
        $messages = [
            [
                'nom' => 'Alice Martin',
                'email' => 'alice.martin@entreprise.com',
                'sujet' => 'Demande de devis pour application web',
                'message' => 'Bonjour, je suis intéressée par vos services de développement web. Nous souhaitons créer une application de gestion de projet pour notre entreprise. Pourriez-vous me faire un devis détaillé ? Merci d\'avance.',
                'statut' => 'repondu',
                'ip_address' => '192.168.1.100',
                'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36',
                'reponse' => 'Bonjour Alice, merci pour votre message. Je vous ai envoyé un devis détaillé par email. N\'hésitez pas à me contacter pour toute question supplémentaire.',
                'repondu_le' => Carbon::now()->subDays(2),
                'created_at' => Carbon::now()->subDays(3),
            ],
            [
                'nom' => 'Thomas Bernard',
                'email' => 'thomas.bernard@startup.fr',
                'sujet' => 'Collaboration sur projet React',
                'message' => 'Bonjour, j\'ai vu votre portfolio et je suis impressionné par vos compétences en React. Nous cherchons un développeur pour rejoindre notre équipe sur un projet passionnant. Seriez-vous disponible pour en discuter ?',
                'statut' => 'lu',
                'ip_address' => '192.168.1.101',
                'user_agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36',
                'reponse' => null,
                'repondu_le' => null,
                'created_at' => Carbon::now()->subDays(1),
            ],
            [
                'nom' => 'Sophie Petit',
                'email' => 'sophie.petit@agence.com',
                'sujet' => 'Refonte site web',
                'message' => 'Nous souhaitons refondre complètement notre site web institutionnel. Votre expertise en UX/Design nous intéresse particulièrement. Pourrions-nous planifier un appel pour discuter de notre projet ?',
                'statut' => 'nouveau',
                'ip_address' => '192.168.1.102',
                'user_agent' => 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_0 like Mac OS X) AppleWebKit/537.36',
                'reponse' => null,
                'repondu_le' => null,
                'created_at' => Carbon::now()->subHours(5),
            ],
            [
                'nom' => 'Marc Dubois',
                'email' => 'marc.dubois@freelance.fr',
                'sujet' => 'Question technique Laravel',
                'message' => 'Bonjour, je suis développeur Laravel et j\'ai rencontré un problème avec l\'optimisation des requêtes Eloquent. J\'ai vu que vous aviez de l\'expérience sur le sujet. Accepteriez-vous une courte consultation ?',
                'statut' => 'repondu',
                'ip_address' => '192.168.1.103',
                'user_agent' => 'Mozilla/5.0 (Linux; Android 10) AppleWebKit/537.36',
                'reponse' => 'Bonjour Marc, je serais ravi de vous aider avec votre problème Laravel. Je vous propose un appel de 30 minutes gratuit pour analyser votre situation. Quels jours/temps vous arrangent ?',
                'repondu_le' => Carbon::now()->subDays(1),
                'created_at' => Carbon::now()->subDays(2),
            ],
            [
                'nom' => 'Julie Lambert',
                'email' => 'julie.lambert@association.org',
                'sujet' => 'Création site vitrine',
                'message' => 'Notre association cherche à créer un site vitrine simple mais professionnel. Votre portfolio montre que vous savez créer des designs élégants et fonctionnels. Quel serait votre tarif pour ce type de projet ?',
                'statut' => 'nouveau',
                'ip_address' => '192.168.1.104',
                'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36',
                'reponse' => null,
                'repondu_le' => null,
                'created_at' => Carbon::now()->subHours(2),
            ],
            [
                'nom' => 'Spam Bot',
                'email' => 'spam@fake.ru',
                'sujet' => 'Gagnez de l\'argent rapidement',
                'message' => 'Voulez-vous gagner 5000€ par semaine sans effort ? Cliquez sur ce lien...',
                'statut' => 'spam',
                'ip_address' => '192.168.1.105',
                'user_agent' => 'Spam Bot 1.0',
                'reponse' => null,
                'repondu_le' => null,
                'created_at' => Carbon::now()->subDays(5),
            ],
        ];

        foreach ($messages as $message) {
            Message::create($message);
        }
    }
}
