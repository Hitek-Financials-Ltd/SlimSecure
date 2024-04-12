<?php
namespace Hitek\Slimez\Payments\Core;

use Hitek\Slimez\Payments\Core\Security;
use Twilio\Rest\Client;


class Twilio
{
    // Your Account SID and Auth Token from console.twilio.com
    public static function sendSMS($to, $message)
    {
        $sid = "MG20a6ba25d17853f819cf994474fa96f3";
        $secret = "38PPiqURtCKyZ73Btv5tdxD1xFhUb44T";
        $client = new Client($sid, $secret);
        // Use the Client to make requests to the Twilio REST API
        $client->messages->create(Security::formatMobile(mobile: $to, intl: true), ['from' => '+15713785743','body' => trim($message)]);
    }
}
