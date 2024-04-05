<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ProfileController extends Controller {
    
    public function getUserProfileData($id) {
        $user = User::where("id", $id)->first();

        return $user;
    }

    public function setUserProfileData(Request $request) {

        $user = User::find($request["id"]);
        $user -> name = $request["name"];
        $user -> username = $request["username"];
        $user -> email = $request["email"];
        $user -> city_id = $request["city_id"];
        $user -> borndate = $request["borndate"];
        
        $user -> save();
        return $user;
    }

    public function setNewPassword(Request $request) {

        $user = User::find($request["id"]);
        $user -> password = bcrypt($request["password"]);

        $user -> save();
        return "Sikeres jelszó változtatás";
    }

    public function deleteAccount(Request $request) {
        
        $user = User::find($request["id"]);

            $user->delete();
            return "Felhasználó törölve";
    }
}
