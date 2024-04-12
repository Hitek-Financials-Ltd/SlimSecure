<?php

namespace Hitek\Slimez\Payments\Core;

use Hitek\Slimez\Payments\Configs\Env;

class SeerbitPayment extends HttpVerbs
{
    protected $baseUrl;
    protected $secKey;
    protected $pubKey;
    protected $encryptUrl;
    protected $bearerToken = '';

    function __construct()
    {
        $this->baseUrl = Env::SEERBIT_BASE_URL;
        $this->secKey = Env::SEERBIT_SEC_KEY;
        $this->pubKey = Env::SEERBIT_PUB_KEY;
        $this->encryptUrl = Env::SEERBIT_ENCRYPT_URL_KEY;

        $endpoint = $this->baseUrl . "/api/v2/encrypt/keys";
        $keys = Env::SEERBIT_SEC_KEY . "." . Env::SEERBIT_PUB_KEY;
        /*check if the bearer token is already in the session */
        $this->bearerToken = trim($this->authenticate($endpoint, $keys));
    }


    public function bearerToken()
    {
        return $this->bearerToken;
    }

    /**
     * generate virtual accounts
     * @array [
     *  "currencyCode" => "",
     *  "countryCode" => "",
     *  "email" => "",
     *  "firstName" => ""
     *  "lastName" => "",
     *  "bvn" => ""
     * ]
     */
    public function virtualAccount(?array $postData = []): mixed
    {

        if (!empty($postData)) {
            /**check if the account already exist */
            if(isset($postData['gateWayValidate']) == "Seerbit"){
                return false;
            }
            /*declare the endpoint */
            $endPoint = $this->baseUrl."/api/v2/virtual-accounts";
            /*prepare the post payload */
            $postParams = json_encode([
                "publicKey" => trim($this->pubKey),
                "fullName" => trim($postData['firstName'])." ".trim($postData['lastName']),
                "bankVerificationNumber" => trim($postData['bvn']),
                "currency" => strtoupper(trim($postData['currencyCode'])),
                "country" => strtoupper(trim($postData['countryCode'])),
                "reference" => "SEER-".(string)Security::OTPGen(7) . "-" . strtoupper(substr(Security::removeSpaces(Env::SYSTEM_NAME), 2)) . "-" . (string)time(),
                "email" => trim($postData['email'])
            ]);
            /*make api call to server */
            $response = $this->postVerb(postParams: $postParams, endPoint: $endPoint, bearerToken: $this->bearerToken);
            /*check the response data */
            if (!empty($response) && isset($response['data'])) {
                return [
                    "accountNumber" => $response['data']['payments']['accountNumber'],
                    "bankName" => $response['data']['payments']['bankName'],
                    "accountName" => $response['data']['payments']['walletName'],
                    "gatewayProvider" => "Seerbit",
                    "accountReference" => $response['data']['payments']['reference'],
                ];
            }
            return $response;
        }
        return false;

    }

    /**make payment out */
    public function transferOut(array $postData = []){
        
    }

    /*
    * Seerbit Verify Payment
    * 
    */
    public function verifyPayment(?string $referenceNumber): mixed
    {
        if (!empty($referenceNumber)) {
            $endPoint = $this->baseUrl . "/api/v3/payments/query/" . Security::removeSpaces($referenceNumber);
            $response = $this->getVerb(endPoint: $endPoint, bearerToken: $this->bearerToken, headers: ['Cache-Control: no-cache']);
            return $response;
        }
        return false;
    }


    /**
     * generate a payment link to process payment
     * @array [
     *  "amount" => "",
     *  "currencyCode" => "",
     *  "countyCode" => "",
     *  "email" => "",
     *  "firstName" => ""
     *  "lastName" => "",
     *  "callbackUrl" =>  "",
     *  "oncloseUrl" => "",
     *  "bvn" => "",
     *  "narration" => ",
     * ]
     */
    public function paymentLink(array $postData = []):mixed
    {
        if (!empty($postData)) {
            $endPoint = $this->baseUrl . "/api/v2/payments";
            $postParams = json_encode([
                "publicKey" => $this->pubKey,
                "amount" => trim($postData['amount']),
                "currency" => trim(strtoupper($postData['currencyCode'])),
                "country" => trim(strtoupper($postData['countyCode'])),
                "paymentReference" => "SEER-".(string)Security::OTPGen(7) . "-" . strtoupper(substr(Security::removeSpaces(Env::SYSTEM_NAME), 2)) . "-" . (string)time(),
                "email" => trim($postData['email']),
                "fullName" => trim($postData['firstName'])." ".trim($postData['lastName']),
                "tokenize" => "false",
                "callbackUrl" => trim($postData['callbackUrl'])
            ]);
            /*make api call */
            $response = $this->postVerb(postParams: $postParams, endPoint: $endPoint, bearerToken: $this->bearerToken);
            /*check the response data */
            if(!empty($response) && isset($response['data']['message'])){
                if(strtolower($response['data']['message']) == "successful"){
                   return  $response['data']['payments']['redirectLink'];
                }
            }
            return false;
        }
        return false;
    }

    /**get the list of banks */
    public function getListOfBanks()
    {
        /**endpoint */
        $endpoint = $this->baseUrl . "/api/v1/banks/";
        /**pass the bearerToken to the Authorization header of the request */
        /**send the post resquest */
        $response = $this->getVerb(endPoint: $endpoint, bearerToken: $this->bearerToken);
        return $response;
    }

    /*process webhook events */
    public function webhook($postedEvent)
    {
        if ((strtoupper($_SERVER['REQUEST_METHOD']) != 'POST'))
            exit();

        // Get the IP address of the server sending the request
        // $serverIp = $_SERVER['REMOTE_ADDR'];
        
        // // Check if the server's IP is not in the allowed list
        // if (!in_array($serverIp, Env::PAYSTACK_ALLOW_IP_WEBHOOK_EVENTS)) {
        //     exit(); // Ignore the request
        // }

        

        // // validate event do all at once to avoid timing attack
        // if ($_SERVER['HTTP_X_PAYSTACK_SIGNATURE'] !== hash_hmac('sha512', $input, $this->secKey))
        //     exit();

        http_response_code(200);

        // parse event (which is a json string) as an object
        // Do something - that will not take long - with $event
        // $event = (string)json_encode(json_decode($input));
        // return $event;
        exit();

        // $webhookDataModel = json_decode(WebhookSampleData::$seerbitVirtualAccountEvent, true);

        // return (string)json_encode($webhookDataModel);

    }

    public function authenticate($endpoint, $keys)
    {
        /*The keys is the secret.pubic key ["key" => "secret.public"] */
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => trim($endpoint),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{
                "key": ' . $keys . '}',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));

        $response = json_decode(curl_exec($curl), true);
        if (isset($response['status']) && strtolower($response['status']) == "success") {
            return $response['data']['EncryptedSecKey']['encryptedKey'];
        }
        return $response;
    }
}
