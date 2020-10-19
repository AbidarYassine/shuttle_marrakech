<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\VehiculeRequest;
use App\Models\Categorie;
use App\Models\Chauffeur;
use App\Models\ImageVehicule;
use App\Models\PrixOffre;
use App\Models\Vehicule;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VehiculeController extends Controller
{
    public function index()
    {
        $vehicules = Vehicule::selection()->activeCauff()->get();
        foreach ($vehicules as $vehicule) {
            $vehicule->setAttribute('chauffeur', $vehicule->chauffeur);
        }

        return view('admin.vehicule.index', compact('vehicules'));
    }

    public function create()
    {
        $chauffeurs = Chauffeur::selection()->get();
        $categories = Categorie::selection()->get();
        return view('admin.vehicule.create', compact('chauffeurs', 'categories'));
    }

    public function store(VehiculeRequest $request)
    {


        try {
            DB::beginTransaction();
            if ($request->has('image')) {
                $filepath = uploadImage('vehicule', $request->image);
            }
            $slug = SlugService::createSlug(Vehicule::class, 'slug', $request->marque, ['unique' => true]);
//            $id_prix = PrixOffre::insertGetId([
//                'transfert_simple' => $request->prix_transfert,
//                'Transfert_aller_retour' => $request->prix_aller_retour,
//                'mise_à_disposition' => $request->prix_mise_disposition,
//                'soiré' => $request->soiré,
//            ]);
            $idVehicule = Vehicule::insertGetId([
                'matricule' => $request->matricule,
                'model' => $request->model,
                'marque' => $request->marque,
                'nombre_valise' => $request->nombre_valise,
                'image' => $filepath,
                'chauffeur_id' => $request->chauffeur_id,
                'categorie_id' => $request->categorie_id,
                'slug' => $slug,
            ]);
            DB::commit();
            session()->flash('success', "véhicule est creé avec suceé");
            toast(session('success'), 'success');
            return redirect()->route('admin.vehicule');
        } catch (\Exception $ex) {
            DB::rollBack();
            return $ex;
        }
    }


    // delete vehcule and image
    public function destroy($id)
    {
        $vehicule = Vehicule::where('id', $id)->first();
        if (!$vehicule) {
            session()->flash('error', "vehicule n'existe pas");
            toast(session('error'), 'error');
            return redirect()->route('admin.vehicule');
        } else {
            $vehicule->delete();
            session()->flash('success', "vehicule est supprimer avec Sucées");
            toast(session('success'), 'success');
            return redirect()->route('admin.vehicule');
        }
    }

    public function edit($id)
    {
        $vehicule = Vehicule::where('id', $id)->first();
        if (!$vehicule) {
            session()->flash('error', "vehicule n'existe pas");
            toast(session('error'), 'error');
            return redirect()->route('admin.vehicule');
        } else {
            $chauffeurs = Chauffeur::Selection()->where('id', '!=', $vehicule->chauffeur->id)->get();
            $categories = Categorie::Selection()->where('id', '!=', $vehicule->categorie->id)->get();
            return view('admin.vehicule.edit')->with([
                'vehicule' => $vehicule,
                'chauffeurs' => $chauffeurs,
                'categories' => $categories,
            ]);
        }
    }

    public function update($id, Request $request)
    {
        try {
            $vehicule = Vehicule::where('id', $id)->first();
            if (!$vehicule) {
                session()->flash('error', "vehicule n'existe pas");
                toast(session('error'), 'error');
                return redirect()->route('admin.vehicule');
            } else {
                // dd($request->all());
                $request->validate([
                    'matricule' => 'required|string|max:30', \Illuminate\Validation\Rule::unique('vehicules')->ignore($vehicule->id),
                    'model' => 'required|string|max:50',
                    'marque' => 'required|string|max:50',
                    'categorie_id' => 'required|numeric|min:1',
                    'chauffeur_id' => 'required|numeric|min:1',
                    'nombre_valise' => 'required|numeric|min:1',
                    'image.*' => 'image|mimes:jpg,jpeg,png',
                ]);
                DB::beginTransaction();
                if (($request->has('image'))) {
                    $filepath = '';
                    $filepath = uploadImage('vehicule', $request->image);
                    Vehicule::where('id', $vehicule->id)->update([
                        'image' => $filepath,
                    ]);
                }
//                PrixOffre::where('id', $vehicule->prixoffre_id)->update([
//                    'transfert_simple' => $request->prix_transfert,
//                    'Transfert_aller_retour' => $request->prix_aller_retour,
//                    'mise_à_disposition' => $request->prix_mise_disposition,
//                    'soiré' => $request->soiré,
//                ]);
                Vehicule::where('id', $vehicule->id)->update([
                    'matricule' => $request->matricule,
                    'model' => $request->model,
                    'marque' => $request->marque,
                    'nombre_valise' => $request->nombre_valise,
                    'chauffeur_id' => $request->chauffeur_id,
                    'categorie_id' => $request->categorie_id,
                ]);
                DB::commit();
                session()->flash('success', "vehicule est modifier avec  Sucées");
                toast(session('success'), 'success');
                return redirect()->route('admin.vehicule');
            }
        } catch (\Exception $ex) {
            DB::rollBack();
            return $ex;
        }
    }
}
