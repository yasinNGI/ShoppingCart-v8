<?php

namespace App\Listeners;

use App\Models\UserActivities;
use Carbon\Carbon;
use Illuminate\Auth\Events\Logout;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class storeUserLogoutHistoryV2
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
     * @param  Logout  $event
     * @return void
     */
    public function handle(Logout $event)
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
