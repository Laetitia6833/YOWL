<?php

namespace App\Http\Controllers;

use Error;
use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Notifications\Notifiable;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserController extends Controller
{

    use HasApiTokens, HasFactory, Notifiable;
    public function index(){
        $users = User::all()->toArray();
        return array($users);
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:users'],
            'location_id' => ['required'],
            'password' => ['required', 'confirmed'], // min:6 confirmed
            'password_confirmation' => ['required'],
        ]);


        try {
            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->location_id = $request->location_id;
            $user->password = Hash::make($request->password);
            $user->save();
            // $user  = User::create($request->all());
        } catch (Error $e) {
            var_dump($e);
            return response()->json(['responseText' => $e->getMessage()]);
        };
    }

    public function login(Request $request)
    {

        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            // 'device_name' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();


        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        return $user->createToken($request->device_name)->plainTextToken;

        // $credantials = [
        //     'email' => $request->email,
        //     'password' => $request->password,
        // ];

        // if (Auth::attempt($credantials)) {
        //     $success = true;
        // } else {
        //     $success = false;
        // }

        // $response = [
        //     'success' => $success,
        // ];

        // return response()->json($response);
    }

    public function getUser($email)
    {
        return User::where('email', $email)->first();
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['msg' => 'Logout success']);
    }
    public function update($id, Request $request){
        $user = User::find($id);
        $user ->update($request->all());

        return response()->json('Profil mis à jour avec succès');
    }
    public function delete($id){
        $user = User::find($id);
        $user -> delete();

        return response()->json('Profil supprimé avec succès');
    }
 
}