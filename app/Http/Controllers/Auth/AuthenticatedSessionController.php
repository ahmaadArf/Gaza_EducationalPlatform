<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request)
    {

        if ($request->type == 'teacher'){
            $guardName= 'teacher';
        }
        elseif ($request->type == 'student'){
            $guardName= 'student';
        }
        else{
            $guardName= 'web';
        }

        try {
            if(Auth::guard($guardName)->attempt(['email' => $request->email, 'password' => $request->password])){
                $request->session()->regenerate();

                if ($request->type == 'teacher') {
                    return redirect()->route('teacher.dashboard.index');
                }
                elseif ($request->type == 'student') {
                    return redirect()->route('student.dashboard.index');
                }
                else {
                    return redirect()->route('dashboard');
                }
            } else {
                return redirect()->back()->withErrors(['login' => 'Invalid credentials']);
            }
        } catch (\Exception $e) {

            return redirect()->back()->withErrors(['error' => 'Something went wrong, please try again later.']);
        }
    }


    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard($request->type)->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
