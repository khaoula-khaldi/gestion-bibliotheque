<?php

namespace App\Http\Controllers;
use App\Models\Subscription;
use App\Models\User;

use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function index(){
        $subscriptions=Subscription::with('user')->get();
        return view('subscriptions.index', compact('subscriptions'));
    }

    public function create(){
        $user = auth()->user();
        return view('subscriptions.create', compact('user'));
    }

    public function store(Request $request){
        $request->validate([
            'user_id'=>'required|exists:users,id',
            'type'=>'required|in:mensuel,annuel',
        ]);

        $dateDebut = now();
        $dateFin = $request->type==='mensuel'? $dateDebut->copy()->addMonth() : $dateDebut->copy()->addYear();

        Subscription::create([
            'user_id'=>$request->user_id,
            'type'=>$request->type,
            'date_debut'=>$dateDebut,
            'date_fin'=>$dateFin,
            'statut'=>'actif',
        ]);

        return \redirect()->route('dashboard')->with('success','Abonnment créé avec succès ! ');
    }

    public function checkStatus(){
        $subscriptions=Subscription::where('statut','actif')->get();
        foreach($subscriptions as $sub){
            if(now()->gt($sub->date_fin)){
                $sub->statut='expire';
                $sub->save();
            }
        }
    }

}
