<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\Role;

class RegisteredUserController extends Controller
{
    /**
     *  Determines what role should the new user is based on logic
     * @param Request $request incoming request
     * @return Role the role of the new user
     */
    private function getUserRole(Request $request): Role
    {
        $type = 'user';

        if ($request->email === env('APP_ADMINISTRATOR_EMAIL')) {
            $type = 'admin';
        }

        $role = Role::where('type', '=', $type)->get()->first();

        return $role;
    }

    /**
     * Display the registration view.
     */
    public function create(): Response
    {
        return Inertia::render('Auth/Register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|lowercase|email|max:255|unique:' . User::class,
            'password' => [
                'required', 'confirmed', Rules\Password::defaults(),
            ],
            'username' => 'required|string|max:255'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'username' => $request->username,
            'role_id' => $this->getUserRole($request)->id
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
