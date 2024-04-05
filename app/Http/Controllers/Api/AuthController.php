<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserRegisterChecker;

class AuthController extends Controller {
    
    public function register( UserRegisterChecker $request ) {

        $request->validate([

        ]);

        $input = $request->all();
        $input[ "password" ] = bcrypt($input["password"]);
        // $input[ "borndate" ] = null;
        // $input[ "city_id" ] = null;
        $user = User::create( $input );
        $success[ "name" ] = $user->name;

        return response()->json([ "message" => "Sikeres regisztráció",
                                  "success" => $success ]);
    }

    public function login( Request $request ) {

        $request->validate([

        ]);

        if(( Auth::attempt([ "username" => $request->username,
                             "password" => $request->password ]))) {

            $authUser = Auth::user();
            $success[ "username" ] = $authUser->username;
            $success[ "token" ] = $authUser->createToken( $authUser->username."token" )->plainTextToken;
            
        }

        return response()->json([ "message" => "Sikeres azonosítás",
                                 "success" => $success ]);
    }

    public function logout( Request $request ) {

        auth( "sanctum" )->user()->currentAccessToken()->delete();

        return response()->json([ "message" => "Sikeres kijelentkezés" ]);
    }
}
