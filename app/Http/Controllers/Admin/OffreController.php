<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\OffreRequest;
use App\Models\Categorie;
use App\Models\Offre;
use App\Models\Offretype;
use App\Models\PrixOffre;
use App\Models\Vehicule;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;

class OffreController extends Controller
{
    public function index()
    {
        $offres = Offre::selection()->active()->get();
        return view('admin.offre.index')->with([
            'offres' => $offres,
        ]);
    }

    public function create()
    {
        $vehicules = Vehicule::marque()->get();
        return view('admin.offre.create')->with([
            'vehicules' => $vehicules,
        ]);
    }

    public function store(OffreRequest $request)
    {
//         dd($request->all());
        try {
            $slug = SlugService::createSlug(Offre::class, 'slug', $request->depart . "-" . $request->arriver, ['unique' => true]);
            $id_prix = PrixOffre::insertGetId([
                'transfert_simple' => $request->prix_transfert,
                'transfert_aller_retour' => $request->prix_aller_retour,
                'mise_à_disposition' => $request->prix_mise_disposition,
                'soiré' => $request->soiré,
            ]);
            Offre::create([
                'depart' => $request->depart,
                'arriver' => $request->arriver,
                'vehicule_id' => $request->vehicule,
                'prixoffre_id' => $id_prix,
                'slug' => $slug,
            ]);
            session()->flash('success', "Offre est creé avec suceé");
            toast(session('success'), 'success');
            return redirect()->route('admin.offres');
        } catch (\Exception $e) {
            return $e;
//            session()->flash('error', "offre controller store erreur");
//            toast(session('error'), 'error');
//            return redirect()->route('admin.offres');
        }
    }

    public function edit($slug)
    {
        $offre = Offre::where('slug', $slug)->first();
        if (!$offre) {
            session()->flash('error', "offre n'existe pas");
            toast(session('error'), 'error');
            return redirect()->route('admin.offres');
        } else {
            $vehicules = Vehicule::marque()->where('id', '!=', $offre->vehicule_id)->get();
            return view('admin.offre.edit')->with('offre', $offre)
                ->with('offre', $offre)
                ->with('vehicules', $vehicules);
        }
    }

    public function show($slug)
    {
        $offre = Offre::where('slug', $slug)->first();
        if (!$offre) {
            session()->flash('error', "offre n'existe pas");
            toast(session('error'), 'error');
            return redirect()->route('admin.offres');
        } else {
            $categories = Categorie::Selection()->where('id', '!=', $offre->categorie->id)->get();
            $offretypes = Offretype::Selection()->where('id', '!=', $offre->offretype->id)->get();
            return view('admin.offre.show')->with('offre', $offre)
                ->with('categories', $categories)
                ->with('offretypes', $offretypes);
        }
    }

    public function update($slug, OffreRequest $request)
    {
//        dd($request->all());
        try {
            $offre = Offre::where('slug', $slug)->first();
            if (!$offre) {
                session()->flash('error', "offre n'existe pas");
                toast(session('error'), 'error');
                return redirect()->route('admin.offres');
            } else {
                $offre->prixOffre->update([
                    'transfert_simple' => $request->prix_transfert,
                    'transfert_aller_retour' => $request->prix_aller_retour,
                    'mise_à_disposition' => $request->prix_mise_disposition,
                    'soiré' => $request->soiré,
                ]);
                Offre::where('slug', $slug)->update([
                    'depart' => $request->depart,
                    'arriver' => $request->arriver,
                    'vehicule_id' => $request->vehicule
                ]);
            }
            session()->flash('success', "offre est modifier avec  Sucées");
            toast(session('success'), 'success');
            return redirect()->route('admin.offres');
        } catch (\Exception $ex) {
            return $ex;
            session()->flash('error', "erreur");
            toast(session('error'), 'erreur update');
            return redirect()->route('admin.offres');
        }
    }


    public function destroy($slug)
    {
        $offre = Offre::where('slug', $slug)->first();
        if (!$offre) {
            session()->flash('error', "offre n'existe pas");
            toast(session('error'), 'error');
            return redirect()->route('admin.categories');
        } else {
            $offre->delete();
            session()->flash('success', "offre est supprimer avec Sucées");
            toast(session('success'), 'success');
            return redirect()->route('admin.offres');
        }
    }
}
