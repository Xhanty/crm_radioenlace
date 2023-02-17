<?php

namespace App\Http\Controllers\Admin\Siigo;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class FacturasController extends Controller
{
    public function siigo()
    {
        $url = env('SIIGO_URL_AUTH') . 'auth';
        $body = [
            'username' => env('SIIGO_USERNAME'),
            'access_key' => env('SIIGO_ACCESS_KEY'),
        ];

        $client = new Client();

        $response = $client->request('POST', $url, [
            'headers' => [
                'Content-Type' => 'application/json'
            ],
            'json' => $body
        ]);

        $token = json_decode($response->getBody()->getContents());

        return $token->access_token;
    }

    public function get_facturas()
    {
        try {
            $access_token = $this->siigo();
            $client = new Client();

            $response = $client->request('GET', env('SIIGO_URL') . 'invoices', [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Authorization' => $access_token
                ]
            ]);

            $facturas = json_decode($response->getBody()->getContents());

            echo '<pre>';
            print_r($facturas);
            echo '</pre>';

            return view('admin.siigo.facturas', compact('facturas'));
        } catch (Exception $ex) {
            return $ex->getMessage();
            return view('errors.500');
        }
    }
}
