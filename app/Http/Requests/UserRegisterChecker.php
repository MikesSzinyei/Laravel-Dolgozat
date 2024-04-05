<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rules\Password;

class UserRegisterChecker extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            
            "name"=>["required","max:50"],
            "username"=>["required","max:20", "unique:users"],
            "email"=>["required","regex:/(.+)@(.+)\.(.+)/i","unique:users"],
            "city_id"=>["required"],
            "borndate"=>["required"],
            "password"=>["required",Password::min(6)->letters()->mixedCase()->numbers()->symbols(),"confirmed"],
            "password_confirmation"=>"required",
            
        ];
    }

    public function messages() {

        return [
            "name.required" => "Név elvárt",
            "name.max"=> "Túl hosszú név",
            "username.required" => "Felhasználónév elvárt",
            "username.max"=> "Túl hosszúfelhasználó név",
            "email.required"=> "Email elvárt",
            "email.email"=> "Invalid email cím",
            "city_id"=>"Város Id elvárt",
            "borndate"=>"Születési dátum elvárt",
            "password.required" => "Jelszó elvárt",
            "password.min" => "Túl rövid a jelszó",
            "password.letters" => "Betűnek kell lennie",
            "password.mixedCase" => "Kis és nagybetűnek lennie kell",
            "password.numbers" => "Számnak kell lennie",
            "password.symbols" => "Különleges karakternek kell lennie",
            "confirm_password.required"=>"Hiányzó jelszó megerősítés",
            "confirm_password.same" => "Nem egyező jelszó" 
        ];
    }

    public function failedValidation(Validator $validator){
        throw new HttpResponseException(response()->json([
            "success"=>false,
            "message"=>"Adatbeviteli hiba",
            "data"=>$validator->errors()
        ]));
    }
    
}
