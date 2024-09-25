<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default filesystem disk that should be used
    | by the framework. The "local" disk, as well as a variety of cloud
    | based disks are available to your application. Just store away!
    |
    */

    'default' => env('FILESYSTEM_DISK', 'local'),

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | Here you may configure as many filesystem "disks" as you wish, and you
    | may even configure multiple disks of the same driver. Defaults have
    | been setup for each driver as an example of the required options.
    |
    | Supported Drivers: "local", "ftp", "sftp", "s3"
    |
    */

    'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => storage_path('app'),
        ],

        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => env('APP_URL') . '/storage',
            'visibility' => 'public',
        ],

        's3' => [
            'driver' => 's3',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'region' => env('AWS_DEFAULT_REGION'),
            'bucket' => env('AWS_BUCKET'),
            'url' => env('AWS_URL'),
            'endpoint' => env('AWS_ENDPOINT'),
            'use_path_style_endpoint' => env('AWS_USE_PATH_STYLE_ENDPOINT', false),
        ],
        'sftp' => [
            'driver' => 'sftp',
            'host' => 'bpa-sftp.grab-bat.net',
            'port' => 22,
            'username' => 'phmg20210702094912012127-Nzx1YWb3hq',
            'password' => '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',
            'visibility' => 'public',
            'permPublic' => 0766,
            'root' => '/path/to/remote/directory',
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Symbolic Links
    |--------------------------------------------------------------------------
    |
    | Here you may configure the symbolic links that will be created when the
    | `storage:link` Artisan command is executed. The array keys should be
    | the locations of the links and the values should be their targets.
    |
    */

    'links' => [
        public_path('storage') => storage_path('app/public'),
    ],


];
