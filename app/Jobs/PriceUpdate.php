<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\File;

class PriceUpdate implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

      //  $skus = ["39", "933", "10014", "10015", "10028", "10029", "10032",  "10029", "10032", "10033", "10034", "10039", "10044", "10045", "10050", "10051", "10055", "10060", "10029", "10032", "10033", "10034", "10039", "10044", "10045", "10050", "10051", "10055", "10060", "10029", "10032", "10033", "10034", "10039", "10044", "10045", "10050", "10051", "10055", "10060", "10029", "10032", "10033", "10034", "10039", "10044", "10045", "10050", "10051", "10055", "10060", "10029", "10032", "10033", "10034", "10039", "10044", "10045", "10050", "10051", "10055", "10060", "10029", "10032", "10033", "10034", "10039", "10044", "10045", "10050", "10051", "10055", "10060", "10029", "10032", "10033", "10034", "10039", "10044", "10045", "10050", "10051", "10055", "10060", "10029", "10032", "10033", "10034", "10039", "10044", "10045", "10050", "10051", "10055", "10060", "10029", "10032", "10033", "10034", "10039", "10044", "10045", "10050", "10051", "10055", "10060", "10029", "10032", "10033", "10034", "10039", "10044", "10045", "10050", "10051", "10055", "10060", "10029", "10032", "10033", "10034", "10039", "10044", "10045", "10050", "10051", "10055", "10060", "10029", "10032", "10033", "10034", "10039", "10044", "10045", "10050", "10051", "10055", "10060", "10029", "10032", "10033", "10034", "10039", "10044", "10045", "10050", "10051", "10055", "10060", "10029", "10032", "10033", "10034", "10039", "10044", "10045", "10050", "10051", "10055", "10060", "10029", "10032", "10033", "10034", "10039", "10044", "10045", "10050", "10051", "10055", "10060", "10029", "10032", "10033", "10034", "10039", "10044", "10045", "10050", "10051", "10055", "10060", "10029", "10032", "10033", "10034", "10039", "10044", "10045", "10050", "10051", "10055", "10060", "10029", "10032", "10033", "10034", "10039", "10044", "10045", "10050", "10051", "10055", "10060", "10029", "10032", "10033", "10034", "10039", "10044", "10045", "10050", "10051", "10055", "10060", "10029", "10032", "10033", "10034", "10039", "10044", "10045", "10050", "10051", "10055", "10060", "10029", "10032", "10033", "10034", "10039", "10044", "10045", "10050", "10051", "10055", "10060", "10029", "10032", "10033", "10034", "10039", "10044", "10045", "10050", "10051", "10055", "10060","10033", "10034", "10039", "10044", "10045", "10050", "10051", "10055", "10060", "10061", "10062", "10064", "10066", "10067", "10068", "10069", "10070", "10071", "10074", "10075", "10076", "10077", "10078", "10088", "10089", "10090", "10115", "10116", "10131", "10137", "10146", "10170", "10171", "10176", "10186", "10200", "10203", "10204", "10215", "10219", "10221", "10222", "10223", "10226", "10227", "10229", "10230", "10251", "10252", "10253", "10277", "10282", "10285", "10292", "10293", "10295", "10304", "10305", "10309", "10317", "10320", "10321", "10327", "10330", "10331", "10333", "10334", "10335", "10339", "10340", "10341", "10353", "10354", "10373", "10377", "10379", "10384", "10385", "10391", "10394", "10400", "10402", "10403", "10404", "10409", "10410", "10411", "10414", "10415", "10421", "10422", "10425", "10427"];

        $skus = [
        "39",
         "933",
         "10014",
         "10015",
         "10028",
         "10029",
         "10032",
         "10033",
         "10034",
         "10039",
         "10044",
         "10045",
         "10050",
         "10051",
         "10055",
         "10060",
         "10061",
         "10062",
         "10064",
         "10066"];

        $storeid = "114";
        $result = [];
        foreach ($skus as $sku) {
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
                    'SKU_Current_Price' => $sku_current_price
                ];

                $result[] = $data;
            } else {
                // Handle the case where response is empty or not in the expected format
                // You might want to log or handle this situation differently
                $result[] = ['SKU_Number' => null, 'SKU_Current_Price' => null];
            }

            sleep(1.2);


        }
        $csvDataArray = $result;
        if (!empty($csvDataArray)) {
            $csvHeaders = array_keys($csvDataArray[0]);


            $csvData = implode(',', $csvHeaders) . "\n";

            foreach ($csvDataArray as $data) {
                $csvData .= '"' . implode('","', $data) . "\"\n";
            }
            $csvFilePath = public_path('GrabSftp/Price-Update.csv'); // Adjust the file name as needed

            // Save the CSV data to the specified file
            file_put_contents($csvFilePath, $csvData);

            return response()->download($csvFilePath, 'Price-Update.csv');
            //  return response()->json($csvDataArray, 200);

        }
    }
}
