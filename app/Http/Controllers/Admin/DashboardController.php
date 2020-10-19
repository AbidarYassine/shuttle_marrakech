<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Offre;
use App\Models\OffreDetail;
use App\Models\Vehicule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function getPrixOffre($idV, $serviceO, $offresDetail)
    {
        $prix = 0;
        $offre = Offre::find($idV);
//        $service = str_replace(' ', '_', strtolower($serviceO));
//        dd($service);
        if ($serviceO == 'Soiré') {
            $prix = $offre->prixOffre->soiré;
        } else if ($serviceO == 'Transfert aller retour') {
            $prix = $offre->prixOffre->transfert_aller_retour;
        } else if ($serviceO == 'Transfert simple') {
            $prix = $offre->prixOffre->transfert_simple;
        } else if ($serviceO == 'Mise à disposition') {
            $prix = $offresDetail->nbrjour * $offre->prixOffre->mise_à_disposition;
        }
        return $prix;
    }

    public function index()
    {
        $missionDemande = DB::table('offre_details')->count();
        $chiffreAffiare = 0;
        $missionRealiser = OffreDetail::selection()->where('status', 3)->get();
//        dd($missionRealiser);
        foreach ($missionRealiser as $offreRealiser) {
            $chiffreAffiare += $this->getPrixOffre($offreRealiser->offre_id, $offreRealiser->service, $offreRealiser);
        }
//        dd($chiffreAffiare);
        return view('admin.dashboard', compact('missionDemande', 'missionRealiser', 'chiffreAffiare'));
    }

    public function statistique(Request $request)
    {
        $arrayOffreDEsign = array();
        $offrecount = array();
        $MonthReservation = array();
        $offresDetail = OffreDetail::selection()->activePrix()->where('status', 3)->get();
        // dd(count($offresDetail));
        foreach ($offresDetail as $offreDet) {
            $countOffreSelect = OffreDetail::where('vehicule_id', $offreDet->vehicule->id)->where('status', 3)->count();
            if (!in_array($offreDet->vehicule->marque . " " . $offreDet->vehicule->model, $arrayOffreDEsign)) {
                array_push($arrayOffreDEsign, $offreDet->vehicule->marque . " " . $offreDet->vehicule->model);
                array_push($offrecount, $countOffreSelect);
            }
        }
        $i = 1;
        for ($i = 1; $i <= 12; $i++) {
            array_push($MonthReservation, $this->getValueMonth($i));
        }
        return response()->json([
            'status' => true,
            'array' => $arrayOffreDEsign,
            'numCount' => $offrecount,
            'MonthReservation' => $MonthReservation,
        ]);
    }

    public function getValueMonth($month)
    {
        $valueMonth = OffreDetail::selection()->where('status', 3)->whereMonth('created_at', '=', $month)->count();
        return $valueMonth;
    }
}
