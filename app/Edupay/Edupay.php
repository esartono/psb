<?php

namespace App\Edupay;

use SimpleXMLElement;

class Edupay
{
    public function view($idtagihan)
    {
        // if ($idtagihan === '202134292')
        // {
        //     $idtagihan = 'inv9000329220200709176315';
        // }
        $apikey = config('edupay.api');
        $biller = config('edupay.biller');
        $checksum = sha1($biller.$apikey.$idtagihan);
        $fields = array(
            'billerid' => $biller,
            'id_tagihan' => $idtagihan,
            'checksum' => $checksum,
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,'https://bsm.edupay.co.id/legacy/index.php/apiprod/view/');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $output = curl_exec($ch);
        if (curl_errno($ch)) {
            return "Error ND";
        } else {
            curl_close($ch);
            $xml = simplexml_load_string($output);
            $json = json_encode($xml);
            return json_decode($json, TRUE);
        }

    }

    public function create($idtagihan, $total, $nama, $start, $end)
    {
        $apikey = config('edupay.api');
        $biller = config('edupay.biller');
        $checksum = sha1($biller.$apikey.$idtagihan);
        $fields = array(
            'billerid' => $biller,
            'id_tagihan' => $idtagihan,
            'checksum' => $checksum,
            'nomor_pembayaran' => $idtagihan,
            'total_nominal_tagihan' => $total,
            'is_tagihan_aktif'=>'1',
            'waktu_berlaku'=>$start,
            'waktu_berakhir'=>$end.' 23:59:59',
            'inquiry_response_nama' => $nama,
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,'https://bsm.edupay.co.id/legacy/index.php/apiprod/create/');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $output = curl_exec($ch);
        if (curl_errno($ch)) {
            echo "Error ND";
        } else {
            curl_close($ch);
            try {
                $xml = simplexml_load_string($output);
                $json = json_encode($xml);
                return json_decode($json, TRUE);
            } catch (Exception $e) {
                print_r($e);
            }
        }
    }

    public function edit($idtagihan, $total, $nama, $end)
    {
        $apikey = config('edupay.api');
        $biller = config('edupay.biller');
        $checksum = sha1($biller.$apikey.$idtagihan);
        $fields = array(
            'billerid' => $biller,
            'id_tagihan' => $idtagihan,
            'checksum' => $checksum,
            'nomor_pembayaran' => $idtagihan,
            'total_nominal_tagihan' => $total,
            'is_tagihan_aktif'=>'1',
            'waktu_berlaku'=>date('Y-m-d'),
            'waktu_berakhir'=>$end.' 23:59:59',
            'inquiry_response_nama' => $nama,
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,'https://bsm.edupay.co.id/legacy/index.php/apiprod/update/');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $output = curl_exec($ch);
        if (curl_errno($ch)) {
            return "Error ND";
        } else {
            curl_close($ch);
            $xml = simplexml_load_string($output);
            $json = json_encode($xml);
            return json_decode($json, TRUE);
        }
    }

    public function delete($idtagihan)
    {
        $apikey = config('edupay.api');
        $biller = config('edupay.biller');
        $checksum = sha1($biller.$apikey.$idtagihan);
        $fields = array(
            'billerid' => $biller,
            'id_tagihan' => $idtagihan,
            'checksum' => $checksum,
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,'https://bsm.edupay.co.id/index.php/apiprod/delete/');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $output = curl_exec($ch);
        if (curl_errno($ch)) {
            return "Error ND";
        } else {
            curl_close($ch);
            $xml = simplexml_load_string($output);
            $json = json_encode($xml);
            return json_decode($json, TRUE);
        }
    }
}
