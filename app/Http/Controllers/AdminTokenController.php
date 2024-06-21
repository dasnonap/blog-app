<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminTokenController extends Controller
{
    //
    function index(Request $request)
    {
        $tokens = $request->user()->tokens()->get();

        return Inertia::render('Tokens', [
            'tokens' => $tokens->map(fn ($token) => $token->token)->all(),
        ]);
    }

    function create(Request $request)
    {
        $token = $request->user()->createToken('dev-api', ['dev-api']);

        return ['token' => $token->plainTextToken];
    }
}
