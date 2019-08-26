<?php

namespace App\Edupay;

use SimpleXMLElement;

class Edupay
{
    public function view()
    {
        $idtagihan = 181934001;

        $apikey = config('edupay.api');
        $biller = config('edupay.biller');
        $checksum = sha1($biller.$apikey.$idtagihan);
        $fields = array(
            'billerid' => $biller,
            'id_tagihan' => $idtagihan,
            'checksum' => $checksum,
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,'https://bsm.edupay.co.id/index.php/apidev/view/');
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

    public function create()
    {
        $idtagihan = 202131002;
        $total = 10000;
        $nama = 'Arif Pribadi';
        $start = '2019-08-07 00:00:00';
        $end = '2019-12-10 23:59:59';
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
            'waktu_berakhir'=>$end,
            'inquiry_response_nama' => $nama,
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,'https://bsm.edupay.co.id/index.php/apidev/create/');
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

    public function edit()
    {
        $idtagihan = 202131002;
        $total = 20000;
        $nama = 'Arif Pribadi Banget';
        $end = '2019-12-31 23:59:59';
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
            'waktu_berakhir'=>$end,
            'inquiry_response_nama' => $nama,
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://bsm.edupay.co.id/index.php/apidev/update/');
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

    public function delete()
    {
        $idtagihan = 202131002;
        $apikey = config('edupay.api');
        $biller = config('edupay.biller');
        $checksum = sha1($biller.$apikey.$idtagihan);
        $fields = array(
            'billerid' => $biller,
            'id_tagihan' => $idtagihan,
            'checksum' => $checksum,
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,'https://bsm.edupay.co.id/index.php/apidev/delete/');
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
