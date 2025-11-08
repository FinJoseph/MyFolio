<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    /**
     * Envoyer un message de contact
     * Alias : store() pour compatibility avec Route::resource
     */
    public function envoyerMessage(Request $request): JsonResponse
    {
        try {
            // Validation des données
            $validator = Validator::make($request->all(), [
                'nom' => 'required|string|min:2|max:255',
                'email' => 'required|email|max:255',
                'sujet' => 'nullable|string|max:255',
                'message' => 'required|string|min:10|max:1000',
            ], [
                'nom.required' => 'Le nom est obligatoire.',
                'nom.min' => 'Le nom doit contenir au moins 2 caractères.',
                'email.required' => 'L\'email est obligatoire.',
                'email.email' => 'L\'email n\'est pas valide.',
                'message.required' => 'Le message est obligatoire.',
                'message.min' => 'Le message doit contenir au moins 10 caractères.',
                'message.max' => 'Le message ne peut pas dépasser 1000 caractères.',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Erreur de validation.',
                    'errors' => $validator->errors(),
                ], 422);
            }

            // Créer le message avec statut 'nouveau' par défaut
            $message = Message::create([
                'nom' => $request->nom,
                'email' => $request->email,
                'sujet' => $request->sujet ?? 'Demande de contact',
                'message' => $request->message,
                'statut' => 'nouveau', // Automatiquement défini comme 'nouveau'
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ]);

            // Vérifier si c'est du spam (optionnel)
            if (method_exists($message, 'estSpam') && $message->estSpam()) {
                $message->marquerCommeSpam();

                return response()->json([
                    'success' => false,
                    'message' => 'Votre message a été détecté comme spam. Si vous pensez qu\'il s\'agit d\'une erreur, veuillez réessayer.',
                ], 400);
            }

            return response()->json([
                'success' => true,
                'message' => 'Votre message a été envoyé avec succès ! Je vous répondrai dans les plus brefs délais.',
                'data' => [
                    'id' => $message->id,
                    'statut' => $message->statut, // Retourne 'nouveau'
                    'date' => $message->created_at->format('d/m/Y H:i'),
                ],
            ], 201);

        } catch (\Exception $e) {
            Log::error('Erreur envoi message contact: '.$e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Une erreur est survenue lors de l\'envoi du message. Veuillez réessayer.',
            ], 500);
        }
    }

    /**
     * Store method (alias pour envoyerMessage)
     * Pour compatibility avec Route::resource ou Route::apiResource
     */
    public function store(Request $request): JsonResponse
    {
        return $this->envoyerMessage($request);
    }
}
