<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Categorie;
use App\Models\DetailOffreUser;
use App\Models\Offre;
use App\Models\OffreDetail;
use App\Models\Vehicule;
use App\Notifications\PaiementSuccess;
use App\Notifications\PaiementValider;
use App\User;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use DateTime;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;

class HomeController extends Controller
{
    public function getAllDepart()
    {
        $departs = Offre::select('depart')->active()->get();
        $tabDepart = array();
        foreach ($departs as $depart) {
            if (!in_array($depart->depart, $tabDepart)) {
                array_push($tabDepart, $depart->depart);
            }
        }
        return $tabDepart;
    }

    public function getAllArriver()
    {
        $arriver = Offre::select('arriver')->active()->get();
        $tabArriver = array();
        foreach ($arriver as $arrive) {
            if (!in_array($arrive->arriver, $tabArriver)) {
                array_push($tabArriver, $arrive->arriver);
            }
        }
        return $tabArriver;
    }

    public function getData(Request $request)
    {
        $date = $request->date;
        $dateR = date('Y-m-d', strtotime($date));
        $offre = Offre::where('depart', $request->depr)->where('arriver', $request->arriverF)->where('vehicule_id', $request->vehicule)->first();
        if ($offre == null) {
            return response()->json([
                'status' => true,
                'data' => $dateR,
                'offre' => $offre,
            ]);
        } else {
            return response()->json([
                'status' => true,
                'data' => $dateR,
                'offre' => $offre,
                'prixOffre' => $offre->prixOffre,
            ]);
        }

    }

    public function index()
    {
        $request = array("depart" => '', 'arriver' => '', 'nbrMax' => '');
        //        dd($request['depart']);
        $vehicules = Vehicule::selection()->activeCauff()->get();
        $categories = Categorie::selection()->get();
        $destinations = Offre::selection()->active()->get();
        // dd($categories);
        $status = true; // index
        $tabDepart = $this->getAllDepart();
        $tabArriver = $this->getAllArriver();

        // dd($tabDepart, $tabArriver);
        return view('site.home', compact('vehicules', 'categories', 'status', 'request', 'tabArriver', 'tabDepart', 'destinations'));
    }

    public function detailOffre($slug)
    {

        $offre = Offre::where('slug', $slug)->first();
        if (!$offre) {
            session()->flash('error', "offre n'existe pas");
            toast(session('error'), 'error');
            return redirect()->route('home');
        } else {
            $offres = Offre::where('categorie_id', $offre->categorie_id)->active()->where('id', '!=', $offre->id)->get();
            $offresSimArrDepart = Offre::where('categorie_id', $offre->categorie_id)->active()->where('depart', $offre->depart)->where('arriver', $offre->arriver)->get();
            $datetime = new DateTime('tomorrow');
            $date_reteur_default = $datetime->format('d/m/Y');
            // dd($date_reteur_default);
            $tabDepart = $this->getAllDepart();
            $tabArriver = $this->getAllArriver();
            return view('site.offre.detail')->with([
                'offre' => $offre,
                'offres' => $offres,
                'date_reteur_default' => $date_reteur_default,
                'offresSimArrDepart' => $offresSimArrDepart,
                'tabDepart' => $tabDepart,
                'tabArriver' => $tabArriver,
            ]);
        }
    }

    public function chercherOffre(Request $request)
    {


        try {
            if ($request->nbrMax <= 7) {
                $categories = Categorie::whereBetween('NbrPlaceMax', array($request->nbrMax, 7))->get();
            } else if ($request->nbrMax <= 17) {
                $categories = Categorie::whereBetween('NbrPlaceMax', array($request->nbrMax, 17))->get();
            } else {
                $categories = Categorie::whereBetween('NbrPlaceMax', array($request->nbrMax, 56))->get();
            }
            $categirieId = array();
            foreach ($categories as $categorie) {
                array_push($categirieId, $categorie->id);
            }

            $vehicules = Vehicule::whereIn('categorie_id', $categirieId)->get();
            $vId = array();
            foreach ($vehicules as $v) {
                array_push($vId, $v->id);
            }
            $offres = Offre::selection()->active()->where('depart', $request->depart)->where('arriver', $request->arriver)->whereIn('vehicule_id', $vId)->get();
            $destinations = Offre::selection()->active()->get();
            // vehicules

            $requestFind = $request;
            if (count($offres) > 0) {
                $status = true;
                $cmp = count($offres);
                session()->flash('success', "$cmp" . " Offres " . "trouver pour vous ");
                toast(session('success'), 'success');
                return view('site.offre.find')->with([
                    'categories' => $categories,
                    'offres' => $offres,
                    'destinations' => $destinations,
                    'status' => $status,
                    'requestFind' => $requestFind,
                    'statusForAutre' => false,
                ]);
            } else {
                $tabDepart = $this->getAllDepart();
                $tabArriver = $this->getAllArriver();
//                dd($vehicules, $categirieId);
                $cate = Categorie::find($categirieId[0]);
//                $vehicules = $cate->vehicules;
                $vehicules = Vehicule::selection()->where('categorie_id', $categirieId[0])->paginate(PAGINATION_COUNT);
                return view('site.offre.categorie')->with([
                    'categorie' => $cate,
                    'vehicules' => $vehicules,
                    'destinations' => $destinations,
                    'tabArriver' => $tabArriver,
                    'tabDepart' => $tabDepart,
                    'requestFind' => $requestFind,
                    'statusForAutre' => true,
                ]);
            }
        } catch (\Exception $ex) {
            return $ex;
        }
    }

    public function offreCharge(Request $request)
    {

        try {
            DB::beginTransaction();
            $user = getUser($request);
            $admin = Admin::selection()->first();
            $vehicule = Vehicule::find($request->vehicule);
            $admin->setAttribute('client', $user);
            $admin->setAttribute('offre', $vehicule);
            $admin->setAttribute('prix', $request->prix);
            $offredetaId = OffreDetail::insertGetId([
                'date_rdv' => date("yy-m-d", strtotime($request->date_rdv)),
                'heure' => $request->heure,
                'offre_id' => $request->offre,
                'date_retour' => $request->date_ret,
                'nbrjour' => $request->nbrjour,
                'vehicule_id' => $request->vehicule,
                'heure_retour' => $request->heure_retour,
                'service' => ucfirst(str_replace('_', ' ', $request->service)),
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            ]);
            DetailOffreUser::create([
                'offreDetail_id' => $offredetaId,
                'user_id' => $user->id,
            ]);
            $user->setAttribute('id_reservation', $offredetaId);
            DB::commit();
            $offredetail = OffreDetail::find($offredetaId);
            $user->setAttribute('offreDetail', $offredetail);
            $admin->setAttribute('offreDetail', $offredetail);
            $admin->email = 'contact@shuttlemarrakech.ma';
            Notification::send($admin, new PaiementSuccess($admin));
            Notification::send($user, new PaiementValider($user));
            session()->flash('success', "Vous serez contacté plus rapidement possible,Merci pour votre confiance");
            toast(session('success'), 'success');
            return redirect()->route('home');
        } catch (\Exception $ex) {
            return $ex;
        }
    }

    public function all()
    {
        // autocomplete
        $arriver = Offre::select('arriver')->get();
        $departs = Offre::select('depart')->get();
        //        dd($arriver);
        $tabDepart = array();
        $tabArriver = array();
        foreach ($arriver as $arrive) {
            if (!in_array($arrive->arriver, $tabArriver)) {
                array_push($tabArriver, $arrive->arriver);
            }
        }
        foreach ($departs as $depart) {
            if (!in_array($depart->depart, $tabDepart)) {
                array_push($tabDepart, $depart->depart);
            }
        }
        return response()->json([
            'status' => true,
            'arriver' => $tabArriver,
            'depart' => $tabDepart,
        ]);
    }

    public function feedback()
    {
        return view('site.avisClient');
    }

    public function categorieOffre($slug)
    {
        $categorie = Categorie::where('slug', $slug)->first();
        if (!$categorie) {
            session()->flash('error', "Categorie n'existe pas");
            toast(session('error'), 'error');
            return redirect()->route('home');
        }
        $destinations = Offre::selection()->active()->get();
        $vehicules = Vehicule::selection()->where('categorie_id', $categorie->id)->paginate(PAGINATION_COUNT);
        $request = array("depart" => '', 'arriver' => '', 'nbrMax' => '');
        //        dd($request['depart']);
        $categories = Categorie::selection()->get();
        // dd($categories);
        $status = true; // index
        // dd($offres);
        return view('site.offre.categorie', compact('vehicules', 'categorie', 'status', 'request', 'destinations'));
    }

    public function getOffreAjax(Request $request)
    {
        $vehicule = Vehicule::where('id', $request->id_ve)->first();
        if (!$vehicule) {
            return response()->json([
                'status' => false,
                'msg' => 'Véhicule non trouveé',
            ]);
        }
        $offres = $vehicule->offres;
        return response()->json([
            'status' => true,
            'vehicule' => $vehicule,
            'offres' => $offres,
        ]);
    }

    public function getVehicule(Request $request)
    {
        $categorie = Categorie::find($request->id_cate);
        if (!$categorie) {
            return response()->json([
                'status' => false,
                'msg' => 'Véhicule non trouveé',
            ]);
        }
        return response()->json([
            'status' => true,
            'vehicule' => $categorie->vehicules,
        ]);
    }

    public function getPrixAjax(Request $request)
    {
//        dd($request->all());
        $offre = Offre::where('id', $request->auterDestination)->where('vehicule_id', $request->vehicule)->first();
        if (!$offre) {
            return response()->json([
                'status' => false,
                'msg' => 'Véhicule non trouveé',
            ]);
        }
        return response()->json([
            'status' => true,
            'offre' => $offre,
            'prix' => $offre->prixOffre,

        ]);

    }
}
