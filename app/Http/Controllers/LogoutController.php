<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LogoutController extends Controller
{
    //
    public function logout()
    {
        // delete token acces
         auth()->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logout succes, token was deleted.'
        ]);
    }
}
