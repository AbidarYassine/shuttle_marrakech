<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategorieRequest;
use App\Models\Categorie;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    public function index()
    {
        $categories = Categorie::Selection()->get();
        return view('admin.categorie.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categorie.create');
    }

    public function store(CategorieRequest $request)
    {

        try {
            $filePath = '';
            if ($request->has('image')) {
                $filePath = uploadImage('categories', $request->image);
            }
            $slug = SlugService::createSlug(Categorie::class, 'slug', $request->designation, ['unique' => true]);
            Categorie::create([
                'designation' => $request->designation,
                'NbrPlaceMax' => $request->NbrPlaceMax,
                'image' => $filePath,
                'slug' => $slug,
            ]);
            session()->flash('success', "catégorie est ajouté avec suceé");
            toast(session('success'), 'success');
            return redirect()->route('admin.categories');
        } catch (\Exception $e) {
            return $e;
            return redirect()->route('admin.categories.create')->with(['error' => 'Erreur']);
        }
    }

    public function edit($slug)
    {

        $categorie = Categorie::where('slug', $slug)->first();
        if (!$categorie) {
            session()->flash('error', "catégorie n'existe pas");
            toast(session('error'), 'error');
            return redirect()->route('admin.categories');
        } else {
            return view('admin.categorie.edit', compact('categorie'));
        }
    }

    public function update($slug, Request $request)
    {
        $categorie = Categorie::where('slug', $slug)->first();
        if (!$categorie) {
            session()->flash('error', "catégorie n'existe pas");
            toast(session('error'), 'error');
            return redirect()->route('admin.categories');
        } else {
            ### validation
            $request->validate([
                'designation' => 'required|string|max:30', \Illuminate\Validation\Rule::unique('categories')->ignore($categorie->id),
                'NbrPlaceMax' => 'required|numeric|min:1',
            ]);
            #### update
            if ($request->has('image')) {
                $filePath = uploadImage('categories', $request->image);
                Categorie::where('slug', $slug)->update([
                    'image' => $filePath,
                    'designation' => $request->designation,
                    'NbrPlaceMax' => $request->NbrPlaceMax,
                ]);
            } else {
                Categorie::where('slug', $slug)->update([
                    'designation' => $request->designation,
                    'NbrPlaceMax' => $request->NbrPlaceMax,
                ]);
            }
            session()->flash('success', "catégorie est modifier avec  Sucées");
            toast(session('success'), 'success');
            return redirect()->route('admin.categories');
        }
    }

    public function destroy($slug)
    {
        $categorie = Categorie::where('slug', $slug)->first();
        if (!$categorie) {
            session()->flash('error', "catégorie n'existe pas");
            toast(session('error'), 'error');
            return redirect()->route('admin.categories');
        } else {
            if (isset($categorie->offres)) {
                foreach ($categorie->offres as $offfre) {
                    $offfre->delete();
                }
            }
            $categorie->delete();
            session()->flash('success', "catégorie est supprimer avec Sucées");
            toast(session('success'), 'success');
            return redirect()->route('admin.categories');
        }
    }
}
