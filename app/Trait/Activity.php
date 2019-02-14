<?php
namespace App\Http\Traits;
use jeremykenedy\LaravelLogger\App\Http\Traits\ActivityLogger;
use Crawler;
use Validator;

trait Activity
{
    use ActivityLogger;

    public function setActivity($descripcion = null, $entity = null, $id_entity = null, $data_save = null, $method = null) {
        $this->activity($descripcion, $entity, $id_entity, $data_save, $method);
    }

    public function activity($description = null, $entity = null, $id_entity = null, $data_save = null, $method = null, $extras = [])
    {
        $userType = trans('LaravelLogger::laravel-logger.userTypes.guest');
        $userId = null;

        if (\Auth::check()) {
            $userType = trans('LaravelLogger::laravel-logger.userTypes.registered');
            $userId = \Request::user()->id;
        }

        if (Crawler::isCrawler()) {
            $userType = trans('LaravelLogger::laravel-logger.userTypes.crawler');
            $description = $userType.' '.trans('LaravelLogger::laravel-logger.verbTypes.crawled').' '.\Request::fullUrl();
        }

        if (!$description) {
            switch (strtolower(\Request::method())) {
                case 'post':
                    $verb = trans('LaravelLogger::laravel-logger.verbTypes.created') . $id_entity;
                    break;

                case 'patch':
                case 'put':
                    $verb = trans('LaravelLogger::laravel-logger.verbTypes.edited');
                    break;

                case 'delete':
                    $verb = trans('LaravelLogger::laravel-logger.verbTypes.deleted');
                    break;

                case 'get':
                default:
                    $verb = trans('LaravelLogger::laravel-logger.verbTypes.viewed');
                    break;
            }

            //$description = $verb.' '.\Request::path();
            $description = $verb;
        }

        $url = explode('/', \Request::fullUrl());

        if(end($url) == 'logout'){
            $description = 'Cerró sesión';
            $method = 'AUTH';
        }

        if($method == null)
            $method = \Request::method();


        $data = [
            'description'   => $description,
            'userType'      => $userType,
            'userId'        => $userId,
            'entity'        => $entity,
            'id_entity'     => $id_entity,
            'data_save'     => $data_save,
            'route'         => \Request::fullUrl(),
            'ipAddress'     => \Request::ip(),
            'userAgent'     => \Request::header('user-agent'),
            'locale'        => \Request::header('accept-language'),
            'referer'       => \Request::header('referer'),
            'methodType'    => $method,
        ];


        // Validation Instance
        $validator = Validator::make($data, \App\Models\Activity::Rules([]));
        if ($validator->fails()) {
            $errors = json_encode($validator->errors(), true);
            if (config('LaravelLogger.logDBActivityLogFailuresToFile')) {
                \Log::error('Failed to record activity event. Failed Validation: '.$errors);
            }
        } else {
            $activity = self::storeActivity($data);
            return $activity;
        }

    }

    /**
     * Store activity entry to database.
     *
     * @param array $data
     *
     * @return void
     */
    private static function storeActivity($data)
    {
        $activity = \App\Models\Activity::create([
            'description'   => $data['description'],
            'userType'      => $data['userType'],
            'userId'        => $data['userId'],
            'entity'        => $data['entity'],
            'id_entity'     => $data['id_entity'],
            'data_save'     => $data['data_save'],
            'route'         => $data['route'],
            'ipAddress'     => $data['ipAddress'],
            'userAgent'     => $data['userAgent'],
            'locale'        => $data['locale'],
            'referer'       => $data['referer'],
            'methodType'    => $data['methodType'],
        ]);
        return $activity;
    }
}