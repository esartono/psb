<?php

//Untuk koneksi ke API BSM Edupay
return [
    'edupay' => env('EDUPAY_API_KEY').env('EDUPAY_BILLER'),
    'api' => env('EDUPAY_API_KEY'),
    'biller' => env('EDUPAY_BILLER')
];
