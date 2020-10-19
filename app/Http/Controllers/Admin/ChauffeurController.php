<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChauffeurRequest;
use App\Http\Requests\DemandeCauffeurRequest;
use App\Models\Categorie;
use App\Models\Chauffeur;
use App\Models\ChauffeurOffre;
use App\Models\ImageVehicule;
use App\Models\OffreDetail;
use App\Models\Vehicule;
use App\User;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;


class ChauffeurController extends Controller
{
    public function index()
    {
        $chauffeurs = Chauffeur::Selection()->where('active', 1)->get();
        //        dd($chauffeurs);
        foreach ($chauffeurs as $chauffeur) {
            $chauffeur->setAttribute('categorie', $chauffeur->categorie);
        }
        return view('admin.chauffeur.index', compact('chauffeurs'));
    }

    public function create()
    {
        $categories = Categorie::Selection()->get();
        return view('admin.chauffeur.create', compact('categories'));
    }

    public function store(ChauffeurRequest $request)
    {
        try {
            $filepath = '';
            if ($request->has('image')) {
                $filepath = uploadImage('chauffeur', $request->image);
            } else {
                $filepath = 'images/chauffeur/avatarChauffeur.png';
            }
            $slug = SlugService::createSlug(Chauffeur::class, 'slug', $request->nom, ['unique' => true]);
            //            'nom', 'prenom', 'email', 'password', 'address', 'active', 'telephone', 'typePermi', 'categorie_id', 'numeroPermi'
            Chauffeur::create([
                'nom' => $request->nom,
                'prenom' => $request->prenom,
                'address' => $request->address,
                'telephone' => $request->telephone,
                'typePermi' => $request->typePermi,
                'categorie_id' => $request->id,
                'numeroPermi' => $request->numeroPermi,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'image' => $filepath,
                'slug' => $slug,
                'active' => 1,
            ]);


            session()->flash('success', "le chauffeur  est creé avec suceé");
            toast(session('success'), 'success');
            return redirect()->route('admin.chauffeur');
        } catch (\Exception $e) {
            //            session()->flash('error', "erreur l'ors de creation de chauffeur");
            //            toast(session('error'), 'error');
            //            return redirect()->route('admin.chauffeur');
            return $e;
        }
    }

    public function destroy($slug)
    {
        $chauffeur = Chauffeur::where('slug', $slug)->first();
        if (!$chauffeur) {
            session()->flash('error', "chauffeur n'existe pas");
            toast(session('error'), 'error');
            return redirect()->route('admin.chauffeur');
        } else {
            $chauffeur->delete();
            session()->flash('success', "chauffeur est supprimer avec Sucées");
            toast(session('success'), 'success');
            return redirect()->route('admin.chauffeur');
        }
    }

    public function edit($slug)
    {
        $chauffeur = Chauffeur::where('slug', $slug)->first();
        if (!$chauffeur) {
            session()->flash('error', "Chauffeur n'existe pas");
            toast(session('error'), 'error');
            return redirect()->route('admin.chauffeur');
        } else {
            $chauffeur->setAttribute('categorie', $chauffeur->categorie);
            if (isset($chauffeur->categorie)) {
                $categories = Categorie::Selection()->where('id', '!=', $chauffeur->categorie->id)->get();
            } else {
                $categories = Categorie::Selection()->get();
            }

            return view('admin.chauffeur.edit')->with([
                'categories' => $categories,
                'chauffeur' => $chauffeur
            ]);
        }
    }

    public function update($slug, Request $request)
    {
        $chauffeur = Chauffeur::where('slug', $slug)->first();
        //        dd($chauffeur);
        //        return $chauffeur;
        if (!$chauffeur) {
            session()->flash('error', "chauffeur n'existe pas");
            toast(session('error'), 'error');
            return redirect()->route('admin.chauffeur');
        } else {
            $request->validate([
                'nom' => 'required|string|max:20',
                'prenom' => 'required|string|max:20',
                'address' => 'required|string|max:50',
                'telephone' => ["required", "regex:/^(0|\+212)[1-9]([-.]?[0-9]{2}){4}$/", \Illuminate\Validation\Rule::unique('chauffeurs')->ignore($chauffeur->id)],
                'numeroPermi' => 'required|string|max:30', \Illuminate\Validation\Rule::unique('chauffeurs')->ignore($chauffeur->id),
                'categorie_id' => 'required|numeric|min:1',
                'image.*' => 'image|mimes:jpg,jpeg',
            ]);
            try {
                $active = 0;
                if ($request->has('active')) {
                    $active = 1;
                }
                if ($request->has('image')) {
                    $filepath = uploadImage('chauffeur', $request->image);
                    Chauffeur::where('slug', $slug)->update([
                        'nom' => $request->nom,
                        'prenom' => $request->prenom,
                        'address' => $request->address,
                        'telephone' => $request->telephone,
                        'numeroPermi' => $request->numeroPermi,
                        'typePermi' => $request->typePermi,
                        'categorie_id' => $request->categorie_id,
                        'image' => $filepath,
                        'active' => $active
                    ]);
                } else {
                    Chauffeur::where('slug', $slug)->update([
                        'nom' => $request->nom,
                        'prenom' => $request->prenom,
                        'address' => $request->address,
                        'telephone' => $request->telephone,
                        'numeroPermi' => $request->numeroPermi,
                        'categorie_id' => $request->categorie_id,
                        'typePermi' => $request->typePermi,
                        'active' => $active,
                    ]);
                }
                $chuf = Chauffeur::find($chauffeur->id);
                session()->flash('success', "chauffeur est modifier avec Sucées");
                toast(session('success'), 'success');
                return redirect()->route('admin.chauffeur');
            } catch (\Exception $ex) {
                //                session()->flash('error', "erreur l'ors de la modification de chauffeur");
                //                toast(session('error'), 'error');
                //                return redirect()->route('admin.chauffeur');
                return $ex;
            }
        }
    }

    public function demadeInscription()
    {
        $categories = Categorie::selection()->get();
        return view('site.chauffeur.create', compact('categories'));
    }

    public function enregistreDemande(DemandeCauffeurRequest $request)
    {
//        dd($request->all());
        try {
            DB::beginTransaction();
            //            'nom', 'prenom', 'email', 'password', 'address','slug', 'image', 'active', 'telephone', 'typePermi', 'categorie_id', 'numeroPermi'
            $categorieId = DB::table('categories')->where('designation', $request->designation)->value('id');
            $slug = SlugService::createSlug(Chauffeur::class, 'slug', $request->nom, ['unique' => true]);
            $slugV = SlugService::createSlug(Vehicule::class, 'slug', $request->model . "-" . $request->marque, ['unique' => true]);
            $idChauffeur = Chauffeur::insertGetId([
                'nom' => $request->nom,
                'prenom' => $request->prenom,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'address' => $request->address,
                'slug' => $slug,
                'telephone' => $request->telephone,
                'typePermi' => $request->typePermi,
                'categorie_id' => $categorieId,
                'numeroPermi' => $request->numeroPermi,
                'image' => 'images/chauffeur/avatarChauffeur.png',
            ]);
            if ($request->has('image')) {
                $filepath = uploadImage('vehicule', $request->image);
            }
            $id_vhicule = Vehicule::insertGetId([
                'model' => $request->model,
                'marque' => $request->marque,
                'matricule' => $request->matricule,
                'categorie_id' => $categorieId,
                'chauffeur_id' => $idChauffeur,
                'image' => $filepath,
                'slug' => $slugV,
            ]);
            DB::commit();
            session()->flash('success', "Un email sera vous envoyer pour valider votre compte ");
            toast(session('success'), 'success');
            return redirect()->route('home');
        } catch (\Exception $ex) {
            DB::rollBack();
            return $ex;
        }
    }

    public function getAlldemande()
    {
        $chauffeurs = Chauffeur::where('active', 0)->get();
        //        dd($chauffeurs);
        foreach ($chauffeurs as $chauffeur) {
            $chauffeur->setAttribute('categorie', $chauffeur->categorie);
        }
        return view('admin.chauffeur.index', compact('chauffeurs'));
    }

    public function connexion(Request $request)
    {
        if (auth()->guard('chauffeur')->attempt(['email' => $request->input("email"), 'password' => $request->input("password")], false)) {
            $email = $request->input('email');
            $chauffeur = Chauffeur::where('email', '=', $email)->first();
            session()->put('id', $chauffeur->id);
            return response()->json(['status' => true, 'message' => 'success']);
        }
        return response()->json(['status' => false, 'message' => 'email ou mot de passe sont incorrect']);
    }

    public function deconnecter(Request $request)
    {
        //          auth()->gaurd('chauffeur')->logout();
        if ($request->session()->has('id')) {
            $request->session()->forget('id');
            session()->flash('success', "Vous avez déconnecter");
            toast(session('success'), 'success');
            return redirect()->route('home');
        }
        return redirect()->route('home');
    }

    public function espaceChaufeur()
    {
        $idChau = Session::get('id');
        $chauffeur = Chauffeur::find($idChau);
        if (!$chauffeur) {
            session()->flash('error', "Chauffeur n'existe pas");
            toast(session('error'), 'error');
            return redirect()->route('chauffeur.espace');
        }
        $offredetail = OffreDetail::where('chauffeur_id', $idChau)->whereDate('date_rdv', date('yy-m-d'))->where('status', 1)->orWhere('status', 2)->get();
        //        dd($offredetail);
        if (count($offredetail) > 0) {
            $userOffre = DB::table('detail_offre_users')->where('offreDetail_id', $offredetail[0]->id)->get();
            $user = User::find($userOffre[0]->user_id);
            return view('site.chauffeur.index', compact('offredetail', 'user'));
        } else {
            return view('site.chauffeur.index', compact('offredetail'));
        }
    }

    public function commencer(Request $request)
    {
        $offreDetail = OffreDetail::find($request->idDetailOffre);
        if (!$offreDetail) {
            return response()->json([
                'status' => false,
                'msg' => 'une errur produit!!!',
            ]);
        }
        OffreDetail::where('id', $request->idDetailOffre)->update([
            'status' => 2
        ]);
        // on peut modifier le chauffeur ==>n'est pas disponible
        return response()->json([
            'status' => true,
            'msg' => 'bon courage',
        ]);
    }

    public function terminer(Request $request)
    {

        $offreDetail = OffreDetail::find($request->idDetailOffre);
        $chuffeur = Chauffeur::find($request->chuffeurId);
        if (!$offreDetail) {
            return response()->json([
                'status' => false,
                'msg' => 'une errur produit!!!',
            ]);
        }
        if (!$chuffeur) {
            return response()->json([
                'status' => false,
                'msg' => 'une errur produit!!!',
            ]);
        }
        OffreDetail::where('id', $request->idDetailOffre)->update([
            'status' => 3
        ]);
        Chauffeur::where('id', $request->chuffeurId)->update([
            'disponible' => 1
        ]);
        return response()->json([
            'status' => true,
            'msg' => 'Vous avez terminer votre mission,maintenant vout etes disponible pour d\'autre mission ',
        ]);
    }
}
