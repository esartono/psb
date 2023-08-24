<?php

namespace App\Maja;

use Cache;

use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Request;

class Maja
{
    private $client = null;
    const API_TOKEN = 'https://account.makaramas.com/auth/realms/bpi/protocol/openid-connect/token';
    const API_URL = 'https://billing-bpi.maja.id';

    // const API_TOKEN = 'https://account.makaramas.com/auth/realms/bpi-dev/protocol/openid-connect/token';
    // const API_URL = 'https://billing-bpi-dev.maja.id';

    var $accessToken;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function test1()
    {
        Cache::flush();
    }

    public function prepare_access_token()
    {
        try {
            $getToken = true;
            $url = self::API_TOKEN;
            $cekToken = Cache::get('token');

            $data = [
                'grant_type' => 'password',
                'client_id' => config('edupay.id'),
                'client_secret' => config('edupay.secret'),
                'username' => config('edupay.user'),
                'password' => config('edupay.password'),
            ];

            if (!$cekToken) {
                $response = $this->client->request('POST', $url, [
                    'headers' => ['Content-type: application/x-www-form-urlencoded'],
                    'form_params' => $data,
                    'timeout' => 20, // Response timeout
                    'connect_timeout' => 20, // Connection timeout
                ]);

                $result = json_decode($response->getBody()->getContents());
                Cache::put('token', $result->access_token, $result->expires_in);
                // Cache::put('token', $result->access_token, 10);
            }

            $this->accessToken = Cache::get('token');
        } catch (RequestException $e) {
            $response = $this->StatusCodeHandling($e);
            return $response;
        }
    }

    public function StatusCodeHandling($e)
    {
        if ($e->getResponse()->getStatusCode() == '400') {
            $this->prepare_access_token();
        } elseif ($e->getResponse()->getStatusCode() == '422') {
            $response = json_decode($e->getResponse()->getBody(true)->getContents());
            return $response;
        } elseif ($e->getResponse()->getStatusCode() == '500') {
            $response = json_decode($e->getResponse()->getBody(true)->getContents());
            return $response;
        } elseif ($e->getResponse()->getStatusCode() == '401') {
            $response = json_decode($e->getResponse()->getBody(true)->getContents());
            return $response;
        } elseif ($e->getResponse()->getStatusCode() == '403') {
            $response = json_decode($e->getResponse()->getBody(true)->getContents());
            return $response;
        } else {
            $response = json_decode($e->getResponse()->getBody(true)->getContents());
            return $response;
        }
    }

    public function test()
    {
        try {
            $url = self::API_URL . '/api/v2/register';
            // $url = self::API_URL . '/api/v2/update/805318462099425244';
            // $url = self::API_URL . '/api/v2/inquiry';

            $data = [
                'date' => date('Y-m-d'),
                'amount' => 100,
                'name' => 'Eko Sartono',
                'email' => 'eko.sartono@nurulfikri.sch.id',
                'va' =>  '12345',
                'openPayment' => false,
                'attribute1' => 'PPDB SIT Nurul Fikri',
                'items' => [],
                'attributes' => []
            ];
            // $data = [
            //     'va' => '12345',
            //     'invoiceNumber' => '805318462099425244'
            // ];

            $cekToken = Cache::get('token');

            if (!$cekToken) {
                $this->prepare_access_token();
            }

            $cekToken = Cache::get('token');

            $response = $this->client->request('POST', $url, [
                'headers' => ['Content-Type' => 'application/json', 'Authorization' => 'Bearer ' . $cekToken],
                'body' => json_encode($data),
            ]);

            return json_decode($response->getBody()->getContents());
        } catch (RequestException $e) {
            $response = $this->StatusCodeHandling($e);
            return $response;
        }
    }

    public function view($idtagihan, $idTransaction)
    {
        try {
            $url = self::API_URL . '/api/v2/inquiry';
            $data = [
                'va' =>  $idtagihan,
                'invoiceNumber' => $idTransaction
            ];

            $cekToken = Cache::get('token');

            if (!$cekToken) {
                $this->prepare_access_token();
            }

            $cekToken = Cache::get('token');

            $response = $this->client->request('POST', $url, [
                'headers' => ['Content-Type' => 'application/json', 'Authorization' => 'Bearer ' . $cekToken],
                'body' => json_encode($data),
            ]);

            return json_decode($response->getBody()->getContents());
        } catch (RequestException $e) {
            $response = $this->StatusCodeHandling($e);
            return $response;
        }
    }

    public function create($idtagihan, $total, $nama, $start, $end, $email)
    {
        try {
            $url = self::API_URL . '/api/v2/register';
            $data = [
                'date' => date_format($start, "Y-m-d"),
                'activeDate' => date_format($start, "Y-m-d"),
                'inactiveDate' => $end . " 23:59:59",
                'amount' => $total,
                'name' => $nama,
                'email' => $email,
                'va' =>  $idtagihan,
                'openPayment' => false,
                'attribute1' => 'PPDB SIT Nurul Fikri',
                'items' => [],
                'attributes' => []
            ];

            $cekToken = Cache::get('token');

            if (!$cekToken) {
                $this->prepare_access_token();
            }

            $cekToken = Cache::get('token');

            $response = $this->client->request('POST', $url, [
                'headers' => ['Content-Type' => 'application/json', 'Authorization' => 'Bearer ' . $cekToken],
                'body' => json_encode($data),
            ]);

            return json_decode($response->getBody()->getContents());
        } catch (RequestException $e) {
            $response = $this->StatusCodeHandling($e);
            return $response;
        }
    }

    public function edit($idtagihan, $total, $nama, $end, $idTransaction)
    {
        try {
            $url = self::API_URL . '/api/v2/update/' . $idTransaction;
            $data = [
                'date' => date('Y-m-d'),
                'activeDate' => date('Y-m-d'),
                'inactiveDate' => $end . " 23:59:59",
                'amount' => $total,
                'name' => $nama,
                'va' =>  $idtagihan,
                'openPayment' => false,
                'attribute1' => 'PPDB SIT Nurul Fikri',
                'items' => [],
                'attributes' => []
            ];

            $cekToken = Cache::get('token');

            if (!$cekToken) {
                $this->prepare_access_token();
            }

            $cekToken = Cache::get('token');

            $response = $this->client->request('POST', $url, [
                'headers' => ['Content-Type' => 'application/json', 'Authorization' => 'Bearer ' . $cekToken],
                'body' => json_encode($data),
            ]);

            return json_decode($response->getBody()->getContents());
        } catch (RequestException $e) {
            $response = $this->StatusCodeHandling($e);
            return $response;
        }
    }

    public function delete($idtagihan, $idTransaction)
    {
        try {
            $url = self::API_URL . '/api/v2/cancel';
            $data = [
                'va' =>  $idtagihan,
                'invoiceNumber' => $idTransaction
            ];

            $cekToken = Cache::get('token');

            if (!$cekToken) {
                $this->prepare_access_token();
            }

            $cekToken = Cache::get('token');

            $response = $this->client->request('POST', $url, [
                'headers' => ['Content-Type' => 'application/json', 'Authorization' => 'Bearer ' . $cekToken],
                'body' => json_encode($data),
            ]);

            return json_decode($response->getBody()->getContents());
        } catch (RequestException $e) {
            $response = $this->StatusCodeHandling($e);
            return $response;
        }
    }
}
