<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use jeremykenedy\LaravelLogger\App\Http\Controllers\LaravelLoggerController;
use App\Models\Activity;
use Carbon\Carbon;
use jeremykenedy\LaravelLogger\App\Http\Traits\UserAgentDetails;
use App\Models\User;

class LoggerController extends LaravelLoggerController
{
    public function showAccessLog()
    {
        $filter = request()->validate([
            'method' => '',
            'user' => '',
            'daterange' => '',
        ]);
        $matchThese = array();
        $daterange = '';

        if(isset($filter['method'])){
            $matchThese['methodType'] = $filter['method'];
        }
        if(isset($filter['user'])){
            $matchThese['userId'] = $filter['user'];
        }
        if(isset($filter['daterange'])){
            $daterange = $filter['daterange'];
            $fechas = explode(' - ', $filter['daterange']);
            $de = date('Y-m-d', strtotime($fechas[0]));
            $a = date('Y-m-d', strtotime($fechas[1]));
        }
        //dd($matchThese);
        if (config('LaravelLogger.loggerPaginationEnabled')) {
            if(isset($filter['daterange'])){
                $activities = Activity::orderBy('created_at', 'desc')
                    ->where($matchThese)
                    ->whereBetween('created_at', [$de.' 00:00:00', $a.' 23:59:59'])
                    ->paginate(config('LaravelLogger.loggerPaginationPerPage'));
            }else{
                $activities = Activity::orderBy('created_at', 'desc')
                    ->where($matchThese)
                    ->paginate(config('LaravelLogger.loggerPaginationPerPage'));
            }

            $totalActivities = $activities->total();
        } else {
            $activities = Activity::orderBy('created_at', 'desc')->get();
            $totalActivities = $activities->count();
        }

        self::mapAdditionalDetails($activities);

        $users = User::all();

        $data = [
            'activities'        => $activities,
            'totalActivities'   => $totalActivities,
            'users'             => $users,
            'daterange'         => $daterange,
        ];

        //return view('LaravelLogger::logger.activity-log', compact('data', 'user'));

        return View('vendor.laravellogger.logger.activity-log', $data);
    }

    /**
     * Add additional details to a collections.
     *
     * @param collection $collectionItems
     *
     * @return collection
     */
    private function mapAdditionalDetails($collectionItems)
    {
        $collectionItems->map(function ($collectionItem) {
            $eventTime = Carbon::parse($collectionItem->updated_at);
            $collectionItem['timePassed'] = $eventTime->diffForHumans();
            $collectionItem['userAgentDetails'] = UserAgentDetails::details($collectionItem->useragent);
            $collectionItem['langDetails'] = UserAgentDetails::localeLang($collectionItem->locale);
            $collectionItem['userDetails'] = config('LaravelLogger.defaultUserModel')::find($collectionItem->userId);

            return $collectionItem;
        });

        return $collectionItems;
    }
}
