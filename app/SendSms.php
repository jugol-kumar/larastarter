<?php

namespace App;

class SendSms
{
    public static function sendSms($phone){
        $code = rand(0000,9999);
        $text = "Your Sms Code is:  ".$code;
        $cURLConnection = curl_init();
        $text=\urlencode($text);
        $url='https://easybulksmsbd.com/sms/api?action=send-sms&api_key=VHVpdGlvbiBUZXJtaW5hbDoxMjM0NTY3&to='.'+88'.$phone.'&from=SenderID&sms='.$text;
        //    dd($url);
        curl_setopt($cURLConnection, CURLOPT_URL, $url);
        curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);

        $res = curl_exec($cURLConnection);
        curl_close($cURLConnection);
        $data = [$res, $code];
        return $data;
    }



}
