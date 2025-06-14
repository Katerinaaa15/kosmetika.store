<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected function redirectTo()
{
    if (Auth::user()->isAdmin()) {
        return route('admin.categories.index');
    } else {
        return route('person.orders.index');
    }
}

protected function credentials(\Illuminate\Http\Request $request)
{
    return array_merge($request->only($this->username(), 'password'), [
        'banned_at' => null, 
    ]);
}




   

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        
    }
}
