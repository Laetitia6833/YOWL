<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Producteur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class ProducteurController extends Controller
{
    public function allProducteurs()
    {
        return Producteur::all();
    }

    public function user($id)
    {
        return Producteur::find($id);
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'business_name' => ['required', 'unique:producteurs'],
            'location_id' => ['required'],
            'email' => ['required', 'email', 'unique:producteurs'],
            'password' => ['required', 'confirmed'], // min:6 confirmed
            'password_confirmation' => ['required'],
        ]);

        $producteur = new Producteur();
        $producteur->name = $request->name;
        $producteur->business_name = $request->business_name;
        $producteur->location_id = $request->location_id;
        $producteur->email = $request->email;
        $producteur->password = Hash::make($request->password);
        $producteur->save();

        return response()->json();

        // return Producteur::create($request->validate());
    }

    public function login(Request $request)
    {

        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            // 'device_name' => 'required',
        ]);

        $user = Producteur::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        return $user->createToken($request->device_name)->plainTextToken;
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'name' => 'required',
            'business_name' => 'required',
            'phone' => 'numeric',
            'email' => 'required|email',
        ]);
        $producteur = Producteur::find($id);
        $producteur->name = $request->name;
        $producteur->business_name = $request->business_name;
        $producteur->phone = $request->phone;
        $producteur->email = $request->email;
        $producteur->description = $request->description;
        $producteur->adress = $request->adress;
        $producteur->location_id = $request->location_id;
        $producteur->bio = $request->bio;

        $producteur->save();

        return response()->json($producteur);
    }
}