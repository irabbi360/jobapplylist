<?php

namespace App\Http\Controllers\API;

use App\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
    	$this->validate($request,[
    		'name' => 'required',
    		'email' => 'required',
    		'password' => 'required',
    	]);

    	$name = $request->name;
    	$email = $request->email;
    	$password = $request->password;

    	$user = new User();
    	$user->name = $name;
    	$user->email = $email;
    	$user->password = bcrypt($password);
    	$user->save();

        $http = new Client;

        $response = $http->post(url('oauth/token'), [
            'form_params' => [
                'grant_type' => 'password',
                'client_id' => '2',
                'client_secret' => 'rTVnWWlg1Uwo1FC2tc9AaStA54ZDFXBp3DtB3GIj',
                'username' => $email,
                'password' => $password,
                'scope' => '',
            ],
        ]);

        return response(['data' => json_decode((string) $response->getBody(), true)]);
    }

    public function login(Request $request)
    {
        $this->validate($request,[
            'email' => 'required',
            'password' => 'required',
        ]);

        $email = $request->email;
        $password = $request->password;

        $user = User::where('email', $email)->first();
        if (!$user){
            return response(['status' => 'error', 'message' => 'User not found']);
        }
        if (Hash::check($password, $user->password)){
            $http = new Client;

            $response = $http->post(url('oauth/token'), [
                'form_params' => [
                    'grant_type' => 'password',
                    'client_id' => '2',
                    'client_secret' => 'rTVnWWlg1Uwo1FC2tc9AaStA54ZDFXBp3DtB3GIj',
                    'username' => $email,
                    'password' => $password,
                    'scope' => '',
                ],
            ]);

            return response(['data' => json_decode((string) $response->getBody(), true)]);
        }
    }
}
