<?php

namespace App\Notifications;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Config;

// class Wa extends Notification
class Wa
{
    // use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public static function kirim($number, $message)
    {
        $client = new \GuzzleHttp\Client();

        $url = env('WA_URL');
        $app = env('WA_APP');
        $server = env('WA_SERVERNAME');
        $clientID = env('WA_CLIENTID');
        $passID = env('WA_PASSWORD');

        $response = $client->request('POST', $url, [
            'form_params' => [
                'app' => $app,
                'serverName' => $server,
                'clientID' => $clientID,
                'password' => $passID,
                'number' => $number,
                'message' => $message
            ]
        ]);
    
        // $request = $client->post($url,  ['body'=>$data]);
        // $response = $request->send();

        return json_decode($response->getBody(), true);
    }

}
