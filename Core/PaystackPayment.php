<?php

namespace Hitek\Slimez\Payments\Core;
/* @author: Usiobaifo Kenneth
 * @developer: Usiobaifo Kenneth
 * @year: 2024
 * @rights: Usiobaifo Kenneth
 * */

use Hitek\Slimez\Payments\Configs\Env;

class PaystackPayment extends HttpVerbs
{
    protected $baseUrl;
    protected $bearerToken;
    protected $secKey;
    protected $pubKey;

    function __construct()
    {
        $this->baseUrl = Env::PAYSTACK_BASE_URL;
        $this->pubKey = Env::PAYSTACK_PUB_KEY;
        $this->secKey = Env::PAYSTACK_SEC_KEY;
        $this->bearerToken = Env::PAYSTACK_SEC_KEY;
    }
    /*
      VERIFY CUSTOMERS
    */
    public function verifyCustomer(?array $postData = []): mixed
    {

        if (!empty($postData)) {

            $endPoint = $this->baseUrl . "/customer/" . $$postData['countryCode'] . "/identification";

            $postParams = [
                "country" => strtoupper($postData['countryCode']),
                "type" => Security::removeSpaces($postData['bvn']),
                "value" => trim($postData['value']),
                "first_name" => trim($postData['firstName']),
                "last_name" => trim($postData['lastName'])
            ];

            $response = $this->postVerb(postParams: $postParams, endPoint: $endPoint, bearerToken: $this->bearerToken);
            return $response;
        }
        return false;
    }
    /*BULK TRANSFER */
    public function transferToMultipleRecepient(?array $postData = []): mixed
    {
        if (!empty($postData)) {
            $endPoint = $this->baseUrl . "/transfer/bulk";
            $postParams = [
                'currency' => trim(strtoupper($postData['currency'])),
                'source' => trim($postData['balance']),
                'transfers' => trim($postData['transfers'])
            ];
            $response = $this->postVerb(postParams: $postParams, endPoint: $endPoint, bearerToken: $this->bearerToken);
            return $response;
        }
        return false;
    }
    /* AUTHENTICATE WITH OTP */
    public function OTPAuthenticate(?array $postData = []): mixed
    {
        if (!empty($postData)) {

            $endPoint = $this->baseUrl . "/transfer/finalize_transfer";
            $postParams = [
                "transfer_code" => trim($postData['transferCode']),
                "otp" => trim($postData['otpCode'])
            ];
            $response = $this->postVerb(postParams: $postParams, endPoint: $endPoint, bearerToken: $this->bearerToken);
            return $response;
        }
        return false;
    }

    /*INITIATE TRANSFER*/
    public function initiateTransfer(?array $postData = []): mixed
    {
        if (!empty($postData)) {
            $endPoint = $this->baseUrl . "/transfer";
            $postParams = [
                'source' => trim($postData['source']),
                'amount' => trim($postData['amount']),
                'recipient' => trim($postData['recipient']),
                'reason' => trim($postData['reason'])
            ];
            $response = $this->postVerb(postParams: $postParams, endPoint: $endPoint, bearerToken: $this->bearerToken);
            return $response;
        }
        return false;
    }

    /*CREATE A TRANSFER RECEPIENT*/
    public function createTransferRecepient(?array $postData = []): mixed
    {
        if (!empty($postData)) {
            $endPoint = $this->baseUrl . "/transferrecipient";
            $postParams = [
                'type' => trim($postData['nuban']),
                'name' => trim($postData['receiverAccountName']),
                'account_number' => Security::removeSpaces($postData['accountNumber']),
                'bank_code' => trim($postData['bank_code']),
                'currency' => trim($postData['currency'])
            ];
            $response = $this->postVerb(postParams: $postParams, endPoint: $endPoint, bearerToken: $this->bearerToken);
            return $response;
        }
        return false;
    }

    /*get all the list of banks available */
    public function getListOfBanks(): mixed
    {

        $endPoint = $this->baseUrl . "/bank";
        $response = $this->getVerb(endPoint: $endPoint, bearerToken: $this->bearerToken, headers: ['Cache-Control: no-cache']);
        if(isset($response['data'])){
            return $response['data'];
        }
        return false;
        
    }
    /*verify account number */
    public function verifyAccountNumber(?array $postData = []): mixed
    {
        if (!empty($postData)) {

            $endPoint = $this->baseUrl . "/bank/resolve?account_number=" . Security::removeSpaces($postData['accountNumber']) . "&bank_code=" . trim($postData['bankCode']);
            $response = $this->getVerb(endPoint: $endPoint, bearerToken: $this->bearerToken, headers: ['Cache-Control: no-cache']);
            return $response;
        }
        return false;
    }
    /*verify bvn number */
    public function verifyBVN(?array $postData = []): mixed
    {

        if (!empty($postData)) {
            $endPoint = $this->baseUrl . "/bvn/match";
            $postParams = [
                "bvn" => Security::removeSpaces($postData['bvn']),
                "account_number" => Security::removeSpaces($postData['accountNumber']),
                "bank_code" => Security::removeSpaces($postData['bankCode']),
                "first_name" => trim($postData['firstName']),
                "last_name" => trim($postData['lastName'])
            ];
            $response = $this->postVerb(postParams: $postParams, endPoint: $endPoint, bearerToken: $this->bearerToken);
            return $response;
        }
        return false;
    }
    /*list all the refunds made*/
    public function listAllRefunds()
    {
        $endPoint = $this->baseUrl . "/bank/refund";
        $response = $this->getVerb(endPoint: $endPoint, bearerToken: $this->bearerToken, headers: ['Cache-Control: no-cache']);
        return $response;
    }
    /*paystack refunds*/
    public function refundPayment(?array $postData = []): mixed
    {

        if (!empty($postData)) {
            $endPoint = $this->baseUrl . "/refund";
            $postParams = [
                'transaction' => Security::removeSpaces($postData['referenceNumber']),
                'amount' => Security::removeSpaces($postData['amount']),
            ];
            $response = $this->postVerb(postParams: $postParams, endPoint: $endPoint, bearerToken: $this->bearerToken);
            return $response;
        }
        return false;
    }

    /*
    * Paystack Verify Payment
    * 
    */
    public function verifyPayment(?string $referenceNumber): mixed
    {
        if (!empty($referenceNumber)) {
            $endPoint = $this->baseUrl . "/transaction/verify/" . Security::removeSpaces($referenceNumber);
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
    public function paymentLink(?array $postData = []): mixed
    {
        if (!empty($postData)) {
            $endPoint = $this->baseUrl . "/transaction/initialize";
            $postParams = json_encode([
                'email' => Security::removeSpaces($postData['email']),
                'amount' => Security::removeSpaces($postData['amount']) . "00",
                'label' => trim(Env::SYSTEM_NAME),
                'first_name' => trim($postData['firstName']),
                'last_name' => trim($postData['lastName']),
                'reference' => "PAYS-".(string)Security::OTPGen(7) . "-" . strtoupper(substr(Security::removeSpaces(Env::SYSTEM_NAME), 2)) . "-" . (string)time(),
                'callback_url' =>  trim($postData['callbackUrl']),
                'onClose' => trim($postData['oncloseUrl'])
            ]);
            /*make api call to server */
            $response = $this->postVerb(postParams: $postParams, endPoint: $endPoint, bearerToken: $this->bearerToken);
            /*check the response data */
            if(!empty($response) && isset($response['status']) == true){
                return $response['data']['authorization_url'];
            }
            return false;
        }
        return false;
    }


    /*paystack subaccount*/
    public function subaccount(?array $postData = []): mixed
    {
        if (!empty($postData)) {
            $endPoint = $this->baseUrl . "/subaccount";
            $postParams = [
                'business_name' => ucfirst(strtolower(trim($postData['storeName']))),
                'bank_code' => trim($postData['bankCode']),
                'account_number' => Security::removeSpaces($postData['accountNumber']),
                'percentage_charge' => trim($postData['percentage']),
                'settlement_bank' => trim($postData['bankName']),
            ];
            $response = $this->postVerb(postParams: $postParams, endPoint: $endPoint, bearerToken: $this->bearerToken);
            return $response;
        }
        return false;
    }
    /**recurrent charging */
    public function recurrentCharge(?array $postData = []): mixed
    {
        if (!empty($postData)) {
            $endPoint = $this->baseUrl . "/transaction/charge_authorization";
            $postParams = [
                'authorization_code' => trim($postData['authCode']),
                'email' => trim($postData['email']),
                'amount' => trim($postData['amount'])
            ];
            $response = $this->postVerb(postParams: $postParams, endPoint: $endPoint, bearerToken: $this->bearerToken);
            return $response;
        }
        return false;
    }

    public function webhook()
    {
        // only a post with paystack signature header gets our attention
        if ((strtoupper($_SERVER['REQUEST_METHOD']) != 'POST') || !array_key_exists('HTTP_X_PAYSTACK_SIGNATURE', $_SERVER))
            exit();

        // Get the IP address of the server sending the request
        $serverIp = $_SERVER['REMOTE_ADDR'];
        
        // Check if the server's IP is not in the allowed list
        if (!in_array($serverIp, Env::PAYSTACK_ALLOW_IP_WEBHOOK_EVENTS)) {
            exit(); // Ignore the request
        }

        // Retrieve the request's body
        $input = @file_get_contents("php://input");

        // validate event do all at once to avoid timing attack
        if ($_SERVER['HTTP_X_PAYSTACK_SIGNATURE'] !== hash_hmac('sha512', $input, $this->secKey))
            exit();

        http_response_code(200);

        // parse event (which is a json string) as an object
        // Do something - that will not take long - with $event
        $event = json_decode($input);

        exit();
    }
}
