<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class SubscriptionController extends Controller
{
    /**
     * Affiche la liste de tous les abonnements (Réservé à l'Admin)
     */
    public function index()
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Action non autorisée.'); 
        }
        // On récupère les abonnements avec les infos des utilisateurs
        $subscriptions = Subscription::with('user')->latest()->get();
        
        return view('subscriptions.index', compact('subscriptions'));
    }

    /**
     * Affiche le formulaire de souscription pour l'utilisateur connecté
     */
    public function create()
    {
        $user = auth()->user();
        
        // Vérifier si l'utilisateur a déjà un abonnement actif pour éviter les doublons
        $activeSub = Subscription::where('user_id', $user->id)
                                 ->where('statut', 'actif')
                                 ->first();

        return view('subscriptions.create', compact('user', 'activeSub'));
    }

    /**
     * Enregistre un nouvel abonnement dans la base de données
     */
    public function store(Request $request)
    {
        // 1. Validation des données entrantes
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'type'    => 'required|in:mensuel,annuel',
        ]);

        // 2. Sécurité : Vérifier si l'utilisateur n'a pas déjà un abonnement en cours
        $exists = Subscription::where('user_id', $request->user_id)
                              ->where('statut', 'actif')
                              ->exists();

        if ($exists) {
            return redirect()->back()->with('error', 'Vous avez déjà un abonnement actif.');
        }

        // 3. Calcul des dates (Début et Fin)
        $dateDebut = now();
        // Si mensuel +1 mois, sinon +1 an
        $dateFin = ($request->type === 'mensuel') 
                    ? $dateDebut->copy()->addMonth() 
                    : $dateDebut->copy()->addYear();

        // 4. Création de l'enregistrement
        Subscription::create([
            'user_id'    => $request->user_id,
            'type'       => $request->type,
            'date_debut' => $dateDebut,
            'date_fin'   => $dateFin,
            'statut'     => 'actif',
        ]);

        // Redirection avec un message de succès
        return redirect()->route('dashboard')->with('success', 'Abonnement créé avec succès !');
    }

    /**
     * Méthode pour mettre à jour les abonnements expirés
     * Note: Idéalement, ceci devrait être automatisé via une tâche planifiée (Task Scheduling)
     */
    public function checkStatus()
    {
        // On récupère uniquement les abonnements actifs dont la date de fin est dépassée
        $expiredSubs = Subscription::where('statut', 'actif')
                                   ->where('date_fin', '<', now())
                                   ->get();

        foreach ($expiredSubs as $sub) {
            $sub->update(['statut' => 'expire']);
        }

        return "Mise à jour terminée. " . $expiredSubs->count() . " abonnements expirés.";
    }
}