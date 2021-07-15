<?php

namespace App\Http\Controllers\Auth;

use App\Events\LogoutHistory;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\UserActivities;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Illuminate\Auth\Events\Logout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */

    public function UserAuth(){
        $user_info         = Auth::user();

        $current_timestamp = Carbon::now()->toDateTimeString();
        $activity          = UserActivities::where(['user_id' => $user_info->id])->latest()->first();

        if(isset($activity)){
            $loginTime         = Carbon::parse($activity->login_time);
            $logoutTime        = Carbon::parse($current_timestamp);

            $total_hour        = $logoutTime->diffForHumans($loginTime);

            UserActivities::where(['id' => $activity->id ])->update([ 'logout_time' => $current_timestamp , 'total_hour' => $total_hour]);
        }

    }


    public function destroy(Request $request)
    {
        $this->UserAuth();
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
