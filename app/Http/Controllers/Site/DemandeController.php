<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Requests\DemandeRequest;
use App\Http\Requests\ReservationRequest;
use App\Models\DetailOffreUser;
use App\Models\Offre;
use App\Models\OffreDetail;
use App\Models\Offretype;
use App\Models\PrixOffre;
use App\Models\Vehicule;

// use Illuminate\Http\Request;
use App\Notifications\PaiementValider;
use App\Notifications\ValiderPaiement;
use App\User;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;

class DemandeController extends Controller
{
    public function store(DemandeRequest $request)
    {
        dd($request->all());
        try {
            DB::beginTransaction();
            $offreType = Offretype::where('offreType', $request->paiement)->first();
            //            dd($offreType[0]->id);
            $slug = SlugService::createSlug(Offre::class, 'slug', $request->depart, ['unique' => true]);
            $offreId = Offre::insertGetId([
                'depart' => $request->depart,
                'arriver' => $request->arriver,
                'categorie_id' => $request->id,
                'slug' => $slug,
                'prix' => 0,
                'active' => 0,
                'offretype_id' => $offreType->id,
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            ]);
            $user = User::where('email', $request->email)->first();
            if (!$user) {
                $userId = User::insertGetId([
                    'telephone' => $request->telephone,
                    'email' => $request->email,
                    "created_at" => date('Y-m-d H:i:s'),
                    "updated_at" => date('Y-m-d H:i:s'),
                ]);
            } else {
                $userId = $user->id;
            }
            $iddetailOffre = OffreDetail::insertGetId([
                'date_rdv' => date("yy-m-d", strtotime($request->date_rdv)),
                'heure' => $request->heure,
                'offre_id' => $offreId,
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            ]);
            DetailOffreUser::create([
                'offreDetail_id' => $iddetailOffre,
                'user_id' => $userId,
            ]);
            DB::commit();
            session()->flash('success', "Votre réservation a été enregistrée, vous serez contacté rapidemment par mail pour confirmation");
            toast(session('success'), 'success');
            return redirect()->route('home');
        } catch (\Exception $ex) {
            return $ex;
            DB::rollBack();
        }
    }

    public function index()
    {
        $reservation = OffreDetail::activeOffre()->get();
        $reservation0 = OffreDetail::activeOffre()->where('status', 0)->get();
        $reservation1 = OffreDetail::activeOffre()->where('status', 1)->get();
        $reservation2 = OffreDetail::activeOffre()->where('status', 2)->get();
        $reservation3 = OffreDetail::activeOffre()->where('status', 3)->get();
        foreach ($reservation1 as $rese0) {
            $detiUser = DetailOffreUser::where('offreDetail_id', $rese0->id)->first();
            $user = User::find($detiUser->user_id);
            $rese0->setAttribute('user', $user);
        }
        foreach ($reservation2 as $rese0) {
            $detiUser = DetailOffreUser::where('offreDetail_id', $rese0->id)->first();
            $user = User::find($detiUser->user_id);
            $rese0->setAttribute('user', $user);
        }
        foreach ($reservation3 as $rese0) {
            $detiUser = DetailOffreUser::where('offreDetail_id', $rese0->id)->first();
            $user = User::find($detiUser->user_id);
            $rese0->setAttribute('user', $user);
        }
        foreach ($reservation0 as $rese0) {
            $detiUser = DetailOffreUser::where('offreDetail_id', $rese0->id)->first();
            $user = User::find($detiUser->user_id);
            $rese0->setAttribute('user', $user);
        }
        //        dd($reservation0, $reservation1, $reservation2, $reservation3);
        return view('admin.reservation.index', compact('reservation0', 'reservation1', 'reservation2', 'reservation3'));
    }

    public function updatePrix(Request $request)
    {
        $offreDetail = OffreDetail::find($request->idofffreDetail);
        if (!$offreDetail) {
            session()->flash('error', "Offre N'existe pas");
            toast(session('error'), 'error');
            return redirect()->route('admin.reservation');
        }
        Offre::where('id', $offreDetail->offre_id)->update([
            'prix' => $request->prix,
        ]);
        session()->flash('success', "Le prix a été modifier avec succeé");
        toast(session('success'), 'success');
        return redirect()->route('admin.reservation');
    }

    public function sendEmailToClient($id)
    {
        try {
            $offredetail = OffreDetail::find($id);
            if (!$offredetail) {
                session()->flash('error', "Offre N'existe pas");
                toast(session('error'), 'error');
                return redirect()->route('admin.reservation');
            }
            $offre = Offre::where('id', $offredetail->offre_id)->first();
            $detiUser = DetailOffreUser::where('offreDetail_id', $id)->first();
            $user = User::find($detiUser->user_id);
            $user->setAttribute('offreDetail', $offredetail);
            $user->setAttribute('prix', $offre->prix);
            Notification::send($user, new ValiderPaiement($user));
            session()->flash('success', "Email de paiement a été envoyer aux client");
            toast(session('success'), 'success');
            return redirect()->route('admin.reservation');
        } catch (\Exception $ex) {
            return $ex;
        }
    }

    public function validation(ReservationRequest $request)
    {

        $user = getUser($request);
        $offre = Vehicule::find($request->vehicule);
        $destination = '';
        if ($request->destination == '-2') {
            $slug = SlugService::createSlug(Offre::class, 'slug', $request->departA, ['unique' => true]);
            $offreiD = Offre::insertGetId([
                'depart' => $request->departA,
                'arriver' => $request->arriverA,
                'vehicule_id' => $request->vehicule,
                'active' => 0,
                'prixoffre_id' => 0,
                'slug' => $slug,
            ]);
            $destination = Offre::find($offreiD);
            $offre->setAttribute('service', $request->service_choisit);
            $offre->setAttribute('date_ret', $request->date_ret);
            $offre->setAttribute('heure_retour', $request->heurer);

        } else {
            $destination = Offre::find($request->destination);
            $offre->setAttribute('date_ret', $request->date_retour);
            $offre->setAttribute('service', $request->type);
            $offre->setAttribute('heure_retour', $request->heure_retour);
        }
        $prix = PrixOffre::select($request->type)->where('id', $offre->prixoffre_id)->first();
        $offre->setAttribute('distination', $destination);
        $offre->setAttribute('nbrjour', $request->nombre_de_jour);
        $offre->setAttribute('heure', $request->heure);
        $offre->setAttribute('user', $user);
        $offre->setAttribute('date', $request->date_rdv);
//        dd($offre);
//        $serviceOffre = array();
        return view('site.offre.validation', compact('offre', 'prix'))->render();
//        return $pageValidation;
    }

    public function validation2(DemandeRequest $request)
    {
//        dd($request->all());
        $user = getUser($request);
        $offre = Vehicule::find($request->vehicule);
        $slug = SlugService::createSlug(Offre::class, 'slug', $request->depart . "-" . $request->arriver, ['unique' => true]);
        $destination = Offre::where('depart', $request->depart)->where('arriver', $request->arriver)->where('vehicule_id', $request->vehicule)->first();
        $offreiD = 0;
        if ($destination == null) {
            $offreiD = Offre::insertGetId([
                'depart' => $request->depart,
                'arriver' => $request->arriver,
                'vehicule_id' => $request->vehicule,
                'active' => 0,
                'prixoffre_id' => 0,
                'slug' => $slug,
            ]);
        } else {
            $offreiD = $destination->id;
        }
        $destination = Offre::find($offreiD);
        $offre->setAttribute('date', $request->date_rdv);
        $offre->setAttribute('user', $user);
        $offre->setAttribute('heure', $request->heure);
        $offre->setAttribute('service', $request->service_choisit);
        $offre->setAttribute('distination', $destination);
        $offre->setAttribute('date_ret', $request->date_ret);
        $offre->setAttribute('heure_retour', $request->heurer);
        $offre->setAttribute('nbrjour', $request->nbrjour);

//        dd($offre);
        return view('site.offre.validation', compact('offre'));
    }

    public function paiement($idUser, $idOffreDe)
    {
        $user = User::find($idUser);
        $offredetail = OffreDetail::find($idOffreDe);
        if (!$user || !$idOffreDe) {
            session()->flash('error', "Offre N'existe pas");
            toast(session('error'), 'error');
            return redirect()->route('home');
        }

        return view('site.offre.paiement', compact('user', 'offredetail'));
    }

    public function avisClient($idUser, $idOffreDe)
    {
        $user = User::find($idUser);
        $offredetail = OffreDetail::find($idOffreDe);
        if (!$user) {
            session()->flash('error', "erreur offre n'existe pas");
            toast(session('error'), 'error');
            return redirect()->route('home');
        }
        if (!$offredetail) {
            session()->flash('error', "erreur offre n'existe pas");
            toast(session('error'), 'error');
            return redirect()->route('home');
        }
        return view('site.avisClient', compact('user', 'offredetail'));
    }

    public function charge(Request $request)
    {

        try {
            $offredetail = OffreDetail::find($request->offredetailId);
            $offre = Offre::find($offredetail->offre_id);
            //            dd($offre);
            $charge = Stripe::charges()->create([
                'currency' => 'USD',
                'source' => $request->stripeToken,
                'amount' => $offre->prix,
                'description' => 'paiment for reserve Chauffeur'
            ]);
            User::where('email', $request->email)->update([
                'telephone' => $request->telephone,
            ]);
            $user = User::where('email', $request->email)->first();
            $user->setAttribute('offreDetail', $offredetail);
            Notification::send($user, new PaiementValider($user));
            session()->flash('success', "Un de nous chauffeur sera a votre disposition plus rapidement possible");
            toast(session('success'), 'success');
            return redirect()->route('home');
        } catch (\Exception $ex) {
            return $ex;
        }
    }

    public function saveAviClient(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:20',
            'avis' => 'required|string|max:500',
        ]);
        try {
            //            $detailOffreUser = DetailOffreUser::where('offreDetail_id ', $request->idOfffredetail)->where('user_id ', $request->iduser)->first();
            $detiUser = DetailOffreUser::where('offreDetail_id', $request->idOfffredetail)->first();
            $detiUser->update([
                'avisClient' => $request->avis,
                'score' => $request->score,
            ]);
            User::where('id', $request->iduser)->update([
                'name' => $request->name,
            ]);
            session()->flash('success', "Merci pour votre réaction");
            toast(session('success'), 'success');
            return redirect()->route('home');
        } catch (\Exception $ex) {
            return $ex;
        }
    }
}
