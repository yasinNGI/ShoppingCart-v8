<?php

namespace App\Listeners;

use App\Events\LoginHistory;
use App\Models\UserActivites;
use App\Models\UserActivities;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class storeUserLoginHistory
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param LoginHistory $event
     * @return void
     */
    public function handle(LoginHistory $event)
    {
        $current_timestamp = Carbon::now()->toDateTimeString();

        $user_info = $event->user;

        $saveHistory = UserActivities::updateOrCreate([
            'user_id'      => $user_info->id,
            'name'         => $user_info->name,
            'email'        => $user_info->email,
            'login_time'   => $current_timestamp,
            'logout_time'  => null,
            'total_hour'   => null
        ]);
        return $saveHistory;

    }
}
