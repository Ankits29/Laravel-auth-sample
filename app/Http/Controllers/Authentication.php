<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use Validator;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;

class Authentication extends Controller
{
    /* API for customer login with laravel passport token generation */
    public function login(Request $request)
    {
        try
        {
            //--check required params
            $request->validate(
            [
                'cust_email' => ['required', 'email'],
                'cust_password' => ['required']
            ]);
   
            //--get & set params in array
            $input = $request->all();
            $credentials = [
                'cust_email' => $input['cust_email'],
                'password' => $input['cust_password']
            ];
            
            //--check email and password
            if (Auth::guard('customers')->attempt($credentials)) 
            {
                //--get user data & create token
                $data = Auth::guard('customers')->user();
                $token = $data->createToken(env('APP_NAME'))->accessToken;
                $data->access_token = $token;
                $data->token_type = 'Bearer';

                //--return reponse
                return response()->json(['status' => 200,'message' => 'Login successfully.','data' => $data ]);
            }
            else
            {
                return response()->json(['status' => 403, 'message' => 'Email or password does not match.' ]);
            }
        }
        catch (\Exception $e) 
        {
            return response()->json(['status' => 500, 'message' => $e->getMessage() ]);  
        }
    }

    /* Method for logout customer */
    public function logout(Request $request)
    {   
        try
        {
            //--revoke token and return reponse
            if ($request->user()->token()->revoke())
                return response()->json(['status' => 200, 'message' => 'Logout successfully.' ]);
            else
                return response()->json(['status' => 401, 'message' => 'Authentication failed, please try again.' ]);
        }
        catch (\Exception $e) 
        {
            return $this->sendResponse(500, $e->getMessage());  
        }
    }
}
