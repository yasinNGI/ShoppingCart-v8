<?php

namespace App\Listeners;

use App\Events\LogoutHistory;
use App\Models\UserActivities;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class storeUserLogoutHistory
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
     * @param storeUserLogoutHistory $event
     * @return void
     */
    public function handle(LogoutHistory $event)
    {
        $user_info         = $event->user;

        $current_timestamp = Carbon::now()->toDateTimeString();
        $activity          = UserActivities::where(['user_id' => $user_info->id])->latest()->first();

        $loginTime         = Carbon::parse($activity->login_time);
        $logoutTime        = Carbon::parse($current_timestamp);

        $total_hour        = $logoutTime->diffForHumans($loginTime);

        $saveHistory       = UserActivities::where(['id' => $activity->id ])->update([ 'logout_time' => $current_timestamp , 'total_hour' => $total_hour]);

        return $saveHistory;
    }
}
