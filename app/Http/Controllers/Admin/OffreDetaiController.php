<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Chauffeur;
use App\Models\ChauffeurOffre;
use App\Models\DetailOffreUser;
use App\Models\Offre;
use App\Models\OffreDetail;
use App\Models\PrixOffre;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OffreDetaiController extends Controller
{
    public function index()
    {

        // 0 la demande est fait mais pas encore traiter
        // 1  la demande est affecter a un client
        // 2  le chauffeur a commencer la mission
        // 3   la mission est terminer avec succe
        $offreDetails0 = OffreDetail::selection()->where('date_rdv', date('yy-m-d'))->where('status', 0)->get();
        $offreDetails1 = OffreDetail::selection()->where('date_rdv', date('yy-m-d'))->where('status', 1)->get();
        $offreDetails2 = OffreDetail::selection()->where('date_rdv', date('yy-m-d'))->where('status', 2)->get();
        $offreDetails3 = OffreDetail::selection()->where('date_rdv', date('yy-m-d'))->where('status', 3)->get();
        $chauffeurs = Chauffeur::all();
        return view('admin.offreDetail.index')->with([
            'offreDetails0' => $offreDetails0,
            'offreDetails1' => $offreDetails1,
            'offreDetails2' => $offreDetails2,
            'offreDetails3' => $offreDetails3,
            'chauffeurs' => $chauffeurs,
        ]);
    }

    public function affecter($id)
    {
        try {
            $offredetail = OffreDetail::find($id);
            if (!$offredetail) {
                session()->flash('error', "offre detail n'existe pas");
                toast(session('error'), 'error');
                return redirect()->route('admin.offreDetail');
            }
            $chauffeurs = Chauffeur::activedisponible()->where('categorie_id', $offredetail->vehicule->categorie_id)->get();
            //            dd($chauffeurs[0]);
            foreach ($chauffeurs as $cahuff) {
                $cahuff->setAttribute('imageV', $offredetail->vehicule->image);
            }
            return view('admin.offreDetail.affecter', compact('chauffeurs', 'offredetail'));
        } catch (\Exception $ex) {
            return $ex;
        }
    }

    public function affecterChauffeur($chuffeurId, $offreId, $offredetailId)
    {

        $chauffur = Chauffeur::find($chuffeurId);
        $offre = Offre::find($offreId);
        if (!$chauffur || !$offre) {
            session()->flash('error', "offre ou chauffeur  n'existe pas");
            toast(session('error'), 'error');
            return redirect()->route('admin.offreDetail');
        }
        try {
            DB::beginTransaction();
            $offredetail = OffreDetail::find($offredetailId);
            //            dd($offredetail->chauffeur_id == 0);
            if ($offredetail->chauffeur_id == 0) {
                OffreDetail::where('id', $offredetailId)->update([
                    'chauffeur_id' => $chuffeurId,
                    'status' => 1
                ]);
                Chauffeur::where('id', $chuffeurId)->update([
                    'disponible' => 0,
                ]);
            } else {
                //                $chuffeurId nouveaux chaauffeur
                OffreDetail::where('id', $offredetailId)->update([
                    'chauffeur_id' => $chuffeurId,
                    'status' => 1
                ]);
                Chauffeur::where('id', $offredetail->chauffeur_id)->update([
                    'disponible' => 1,
                ]);
                Chauffeur::where('id', $chuffeurId)->update([
                    'disponible' => 0,
                ]);
            }
            DB::commit();
            // envoyer un email ou chauffeur
            session()->flash('success', "Affectation est fait avec succé");
            toast(session('success'), 'success');
            return redirect()->route('admin.offreDetail');
        } catch (\Exception $ex) {
            DB::rollBack();
            return $ex;
        }
    }

    public function show($id)
    {
        try {
            $offredetail = OffreDetail::find($id);
            if (!$offredetail) {
                session()->flash('error', "offre detail n'existe pas");
                toast(session('error'), 'error');
                return redirect()->route('admin.offreDetail');
            }
            $userid = DetailOffreUser::where('offreDetail_id', $offredetail->id)->select('user_id')->first();
            $user = User::find($userid);
            // dd($user);
            return view('admin.offreDetail.show', compact('offredetail', 'user'));
        } catch (\Exception $ex) {
            return $ex;
        }
    }

    public function destroy($id)
    {
        try {
            $offredetail = OffreDetail::find($id);
            if (!$offredetail) {
                session()->flash('error', "offre detail n'existe pas");
                toast(session('error'), 'error');
                return redirect()->route('admin.offreDetail');
            }
            $offreDetailUser = DetailOffreUser::where('offreDetail_id', $id)->first();
            $offredetail->delete();
            $offreDetailUser->delete();
            session()->flash('success', "La réservation est supprimée avec succeé");
            toast(session('success'), 'success');
            return redirect()->route('admin.offreDetail');
//            dd($offredetail);
        } catch (\Exception $ex) {
            return $ex;
        }
    }

    public function terminer(Request $request)
    {
        try {
            $offredetail = OffreDetail::find($request->offredetail_id);
            if (!$offredetail) {
                session()->flash('error', "offre detail n'existe pas");
                toast(session('error'), 'error');
                return redirect()->route('admin.offreDetail');
            }
            $offredetail->update([
                'status' => 3,
                'chauffeur_id' => $request->chauffeur,
            ]);
            session()->flash('success', "La réservation est mentione comme termineé");
            toast(session('success'), 'success');
            return redirect()->route('admin.offreDetail');
//            dd($offredetail);
        } catch (\Exception $ex) {
            return $ex;
        }
    }

    public function definitPrix(Request $request)
    {
        $offre = Offre::where('id', $request->id_offre)->first();
        if (!$offre) {
            session()->flash('error', "offre n'existe pas");
            toast(session('error'), 'error');
            return redirect()->route('admin.offres');
        } else {
            $id_prix = PrixOffre::insertGetId([
                'transfert_simple' => $request->prix_transfert,
                'transfert_aller_retour' => $request->prix_aller_retour,
                'mise_à_disposition' => $request->prix_mise_disposition,
                'soiré' => $request->soiré,
            ]);
            $prixOffre = $offre->update([
                'prixoffre_id' => $id_prix
            ]);
            session()->flash('success', "Prix est creé avec suceé");
            toast(session('success'), 'success');
            return redirect()->route('admin.offreDetail');
        }
    }
}
