<?php

//Untuk koneksi ke API BSM Edupay
return [
    'id' => env('EDUPAY_ID'),
    'secret' => env('EDUPAY_SECRET_DEV'),
    'user' => env('EDUPAY_USER')
];
