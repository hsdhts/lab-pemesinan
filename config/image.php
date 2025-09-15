<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Image Driver
    |--------------------------------------------------------------------------
    |
    | Intervention Image supports "GD Library" and "Imagick" to process images
    | internally. You may choose one of them according to your PHP
    | configuration. By default PHP's "GD Library" implementation is used.
    |
    | Supported: "gd", "imagick"
    |
    */

    'driver' => 'gd',

    /*
    |--------------------------------------------------------------------------
    | Image Quality Settings
    |--------------------------------------------------------------------------
    |
    | Default quality settings for different image operations
    |
    */

    'quality' => [
        'default' => 85,
        'thumbnail' => 80,
        'high' => 95,
        'low' => 60,
    ],

    /*
    |--------------------------------------------------------------------------
    | Image Size Settings
    |--------------------------------------------------------------------------
    |
    | Default size settings for different image operations
    |
    */

    'sizes' => [
        'large' => [
            'width' => 1200,
            'height' => 800,
        ],
        'medium' => [
            'width' => 800,
            'height' => 600,
        ],
        'small' => [
            'width' => 400,
            'height' => 300,
        ],
        'thumbnail' => [
            'width' => 300,
            'height' => 200,
        ],
    ],

];