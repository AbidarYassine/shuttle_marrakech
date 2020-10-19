<?php

use App\User;
use Illuminate\Support\Facades\Hash;

function test()
{
    return "abidar yassine";
}

function uploadImage($folder, $image)
{

    $image->store('/', $folder);
    $filename = $image->hashName();
    $path = 'images/' . $folder . '/' . "$filename";
    return $path;

}

function uploadImage2($floder, $arryImage, $idVehicule)
{
    $ImageForSvae = [];
    foreach ($arryImage as $image) {
        $ImageForSvae[] = [
            'image' => uploadImage('vehicule', $image),
            'vehicule_id' => $idVehicule,
        ];
    }
    return $ImageForSvae;

}
function getUser($request){
    $user = User::where('email', $request['email'])->first();
    $userId = 0;
//    dd($user);
    if (!$user) {
        $userId = User::insertGetId([
            'name' => $request['name'],
            'email' => $request['email'],
            'telephone' => $request['telephone'],
            'password' => Hash::make($request['password']),
        ]);
    } else {
        $user->update([
            'telephone' => $request['telephone'],
        ]);
        $userId = $user->id;
    }
    $user = User::find($userId);
    return $user;
}
