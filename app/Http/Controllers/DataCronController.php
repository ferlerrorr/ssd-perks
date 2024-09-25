<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sku;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;

class DataCronController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result = [];
        $skus = DB::table('sku')->take(1)->pluck('SKU_number')->toArray();
        $storeid = "114";

        // Convert the array of SKU numbers to a comma-separated string
        // $sku_numbers = implode(',', $skus);

        $url = 'http://10.60.15.110/JDA_Connect_SFY/JDA_ConnectService.asmx';
        $xmlBody = '<?xml version="1.0" encoding="utf-8"?>
        <soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
        xmlns:xsd="http://www.w3.org/2001/XMLSchema"
        xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
        <soap:Body>
            <SKU_Inquiry xmlns="http://tempuri.org/">
                <IP_Address>10.88.40.36</IP_Address>
                <machine_Name>RRGJDAP06</machine_Name>
                <JDA_Env>SSD</JDA_Env>
                <App_ID>TP</App_ID>
                <user>IFSSQLK1</user>
                <password>$$D1i2O16</password>
                <store_number>' . $storeid . '</store_number>
                <sku_number>' . 31053 . '</sku_number>
                <pel_ID></pel_ID>
            </SKU_Inquiry>
        </soap:Body>
    </soap:Envelope>';

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: text/xml; charset=utf-8'));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $xmlBody);

        $response = curl_exec($ch);
        curl_close($ch);

        $xml = simplexml_load_string($response);

        $sku_details = $xml->children('soap', true)->Body->children()->SKU_InquiryResponse->SKU_InquiryResult;

        if ($sku_details) {
            $decodedData = json_decode($sku_details, true);

            $sku_number = isset($decodedData['SKU_Number']) ? $decodedData['SKU_Number'] : null;
            $sku_current_price = isset($decodedData['SKU_Current_Price']) ? $decodedData['SKU_Current_Price'] : null;

            $data = [
                'SKU_Number' => $sku_number,
                'SKU_Current_Price' => str_replace(',', '', $sku_current_price),
            ];
            $result[] = $data;
        } else {
            $result[] = ['SKU_Number' => null, 'SKU_Current_Price' => null];
        }

        return response($result);
    }
    public function dataPriceUpdate()

    {
        ini_set('memory_limit', '10048M');
        $skus = Sku::pluck('SKU_number');
        // $skus = DB::table('sku')->where('SKU_Current_Price', null)->pluck('SKU_number');
        // $skus = DB::table('sku')->take(10)->pluck('SKU_number');
        $result = [];
        $storeid = "31";

        foreach ($skus as $sku) {
            $retryCount = 3;
            $skuDetails = null;

            while ($retryCount > 0) {
                $url = 'http://10.60.15.110/JDA_Connect_SFY/JDA_ConnectService.asmx';
                $xmlBody = '<?xml version="1.0" encoding="utf-8"?>
                    <soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
                        xmlns:xsd="http://www.w3.org/2001/XMLSchema"
                        xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
                        <soap:Body>
                            <SKU_Inquiry xmlns="http://tempuri.org/">
                                <IP_Address>10.88.40.36</IP_Address>
                                <machine_Name>RRGJDAP06</machine_Name>
                                <JDA_Env>SSD</JDA_Env>
                                <App_ID>TP</App_ID>
                                <user>IFSSQLK1</user>
                                <password>$$D1i2O16</password>
                                <store_number>' . $storeid . '</store_number>
                                <sku_number>' . $sku . '</sku_number>
                                <pel_ID></pel_ID>
                            </SKU_Inquiry>
                        </soap:Body>
                    </soap:Envelope>';

                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_TIMEOUT, 120);
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: text/xml; charset=utf-8'));
                curl_setopt($ch, CURLOPT_POSTFIELDS, $xmlBody);

                $response = curl_exec($ch);

                // Check if cURL request was successful
                if ($response === false) {
                    // Handle error, you might want to log it
                    echo 'cURL error: ' . curl_error($ch);
                } else {
                    $xml = simplexml_load_string($response);

                    $skuDetails = $xml->children('soap', true)->Body->children()->SKU_InquiryResponse->SKU_InquiryResult;
                    $decodedData = json_decode($skuDetails, true);

                    if ($skuDetails) {
                        // Break the loop if successful response
                        break;
                    }
                }

                // Close cURL handle
                curl_close($ch);
                // Decrement retry count
                $retryCount--;
            }

            if ($skuDetails) {
                $sku_number = isset($decodedData['SKU_Number']) ? $decodedData['SKU_Number'] : null;
                $sku_current_price = isset($decodedData['SKU_Current_Price']) ? $decodedData['SKU_Current_Price'] : null;

                $data = [
                    'SKU_Number' => $sku_number,
                    'SKU_Current_Price' => str_replace(',', '', $sku_current_price),
                ];
                $result[] = $data;
            }
        }

        //-------------------------------------
        $resultChunks = array_chunk($result, 500);

        foreach ($resultChunks as $chunk) {
            foreach ($chunk as $data) {
                Sku::where('SKU_Number', $data['SKU_Number'])
                    ->update([
                        'SKU_Current_Price' => $data['SKU_Current_Price']
                    ]);
            }
        }

        $dd = count($result);

        $resp = [$dd, $result];

        return response()->json($resp, 200);
    }
}
