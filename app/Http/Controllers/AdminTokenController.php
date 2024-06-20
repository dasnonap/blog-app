<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminTokenController extends Controller
{
    //
    function index(Request $request)
    {
    }

    function create(Request $request)
    {
        $token = $request->user()->createToken('dev-api');

        return ['token' => $token->plainTextToken];
    }
}
