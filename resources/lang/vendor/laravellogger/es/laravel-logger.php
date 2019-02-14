<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Laravel Logger Language Lines - Global
    |--------------------------------------------------------------------------
    */
    'userTypes' => [
        'guest'      => 'Invitado',
        'registered' => 'Registrado',
        'crawler'    => 'Crawler',
    ],

    'verbTypes' => [
        'created'    => 'Se creó elemento con Id: ',
        'edited'     => 'Se modificó el elemento',
        'deleted'    => 'Se eliminó el elemento',
        'viewed'     => 'Visto',
        'crawled'    => 'crawled',
    ],

    'tooltips' => [
        'viewRecord' => 'Ver detalles',
    ],

    /*
    |--------------------------------------------------------------------------
    | Laravel Logger Admin Dashboard Language Lines
    |--------------------------------------------------------------------------
    */
    'dashboard' => [
        'title'     => 'Registro de actividad',
        'subtitle'  => 'Eventos',

        'labels'    => [
            'id'            => 'Id',
            'time'          => 'Tiempo',
            'description'   => 'Descripción',
            'user'          => 'Usuario',
            'method'        => 'Método',
            'route'         => 'Ruta',
            'ipAddress'     => '<span class="hidden-sm hidden-xs">Dirección Ip</span>',
            'agent'         => '<span class="hidden-sm hidden-xs">Agente de </span>Usuario',
            'actions'         => 'Restablecer',
            'data'         => 'Datos',
            'deleteDate'    => '<span class="hidden-sm hidden-xs">Fecha </span>Eliminación',
        ],

        'menu'      => [
            'alt'           => 'Log Menú de Actividad',
            'clear'         => 'Limpiar Registro de actividad',
            'show'          => 'Mostrar registros limpiados',
            'back'          => 'Volver a registro de actividades',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Laravel Logger Admin Drilldown Language Lines
    |--------------------------------------------------------------------------
    */

    'drilldown' => [
        'title'                 => 'Registro de Actividad :id',
        'title-details'         => 'Detalles de Actividad',
        'title-ip-details'      => 'Detalles de Dirección Ip',
        'title-user-details'    => 'Detalles de Usuario',
        'title-user-activity'   => 'Actividad de Usuario Adicional',

        'buttons'   => [
            'back'      => '<span class="hidden-xs hidden-sm">Volver a </span><span class="hidden-xs">Registro de Actividad</span>',
        ],

        'labels' => [
            'userRoles'     => 'Roles de Usuario',
            'userLevel'     => 'Nivel',
        ],

        'list-group' => [
            'labels'    => [
                'id'            => 'Registro de Actividad ID:',
                'ip'            => 'Dirección IP',
                'description'   => 'Descripción',
                'userType'      => 'Tipo de Usuario',
                'userId'        => 'Id Usuario',
                'route'         => 'Ruta',
                'agent'         => 'Agente de Usuario',
                'locale'        => 'Local',
                'referer'       => 'Referente',

                'methodType'    => 'Tipo de Método',
                'createdAt'     => 'Event Time',
                'updatedAt'     => 'Updated At',
                'deletedAt'     => 'Deleted At',
                'timePassed'    => 'Time Passed',
                'userName'      => 'Username',
                'userFirstName' => 'First Name',
                'userLastName'  => 'Last Name',
                'userFulltName' => 'Full Name',
                'userEmail'     => 'User Email',
                'userSignupIp'  => 'Signup Ip',
                'userCreatedAt' => 'Created',
                'userUpdatedAt' => 'Updated',
            ],
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Laravel Logger Modals
    |--------------------------------------------------------------------------
    */

    'modals' => [
        'shared' => [
            'btnCancel'     => 'Cancelar',
            'btnConfirm'    => 'Confirmar',
        ],
        'clearLog' => [
            'title'     => 'Clear Activity Log',
            'message'   => 'Are you sure you want to clear the activity log?',
        ],
        'deleteLog' => [
            'title'     => 'Permanently Delete Activity Log',
            'message'   => 'Are you sure you want to permanently DELETE the activity log?',
        ],
        'restoreLog' => [
            'title'     => 'Restore Cleared Activity Log',
            'message'   => 'Are you sure you want to restore the cleared activity logs?',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Laravel Logger Flash Messages
    |--------------------------------------------------------------------------
    */

   'messages' => [
        'logClearedSuccessfuly'   => 'Registro de Actividad limpiado exitosamente',
        'logDestroyedSuccessfuly' => 'Registro de Actividad borrado exitosamente',
        'logRestoredSuccessfuly'  => 'Registro de Actividad restaurado exitosamente',
   ],

    /*
    |--------------------------------------------------------------------------
    | Laravel Logger Cleared Dashboard Language Lines
    |--------------------------------------------------------------------------
    */

    'dashboardCleared' => [
        'title'     => 'Actividades Limpiadas',
        'subtitle'  => 'Eventos limpiados',

        'menu'      => [
            'deleteAll'  => 'Borrar todos los registros',
            'restoreAll' => 'Restaurar todos los registros',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Laravel Logger Pagination Language Lines
    |--------------------------------------------------------------------------
    */
    'pagination' => [
        'countText' => 'Mostrando :firstItem - :lastItem de :total resultados <small>(:perPage por página)</small>',
    ],

];
