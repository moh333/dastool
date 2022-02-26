<?php

return [

    'calculator' => [
        'debug' => env('CALCULATOR_DEBUG', false),
        'pdf_url' => env('CALCULATOR_PDF_URL'),
    ],

    'matomo' => [
        'domain' => env('MATOMO_DOMAIN'),
        'site_id' => env('MATOMO_SITE_ID')
    ],




];
