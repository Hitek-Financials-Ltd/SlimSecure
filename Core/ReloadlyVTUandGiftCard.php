<?php

namespace Hitek\Slimez\Payments\Core;

use DateTime;
use Exception;
use Hitek\Slimez\Payments\Configs\Env;

class ReloadlyVTUandGiftCard extends HttpVerbs
{
    protected $baseTopUpsUrl;
    protected $secKey;
    protected $bearerToken = '';
    protected $baseUtilityUrl;

    function __construct()
    {

        $this->baseTopUpsUrl = Env::RELOADLY_TOPUPS_BASE_URL;
        $this->baseUtilityUrl = Env::RELOADLY_UTILITY_BASE_URL;
        $this->secKey = Env::RELOADLY_SEC_KEY;

        /**post params */
        $postData = json_encode([
            "client_id" => Env::RELOADLY_CLIENT_ID,
            "client_secret" => Env::RELOADLY_SEC_KEY,
            "grant_type" => "client_credentials",
            "audience" => trim(Env::RELOADLY_AUDIENCE_URL),
        ]);

        /*make an authencation request to the endpoint to fetch the bearer token */
        $response = $this->authenticate(postParams: $postData, endPoint: Env::RELOADLY_AUTH_URL);
        if (!isset($response['errorCode'])) {
            $this->bearerToken = $response;
        }
    }

    /**
     * get account balance
     */

    public function accountBalance()
    {

        /*prepare the endpoint */
        $endPoint = $this->baseTopUpsUrl . "/accounts/balance";
        /* make api call*/
        $response = $this->getVerb(endPoint: $endPoint, bearerToken: $this->bearerToken, headers: ["Accept: application/com.reloadly.topups-v1+json"]);
        return $response;
    }

    /**buy airtime */
    public function buyAirtime(array $postData = [], bool $isAutoDetectOperator = false)
    {
        /*prepare the endpoint */
        $endPoint = $isAutoDetectOperator ? $this->baseTopUpsUrl . "/topups-async" : $this->baseTopUpsUrl . "/topups";
        /*postParams */
        if (!empty($postData)) {
            /**prepare the data to send to server */
            $postParams = json_encode([
                "amount" => $postData['amount'],
                "recipientPhone" => [
                    "countryCode" => (string)$postData['countryCode'],
                    "number" => (string)$postData['number']
                ],
                "operatorId" => $postData['operatorId'],
                "customIdentifier" => "TOPS-" . (string)Security::OTPGen(7) . "-" . strtoupper(substr(Security::removeSpaces(Env::SYSTEM_NAME), 2)) . "-" . (string)time(),
            ]);
            /* make api call*/
            $response = $this->postVerb(postParams: $postParams, endPoint: $endPoint, bearerToken: $this->bearerToken, headers: ["Accept: application/com.reloadly.topups-v1+json"]);
            return $response;
        }
        return false;
    }

    /*get the trasaction status */
    public function transactionStatus(string $transactionId = '')
    {
        /*The transaction endpoint */
        $endPoint = !empty($transactionId) ? $this->baseTopUpsUrl . "/topups/reports/transactions/" . trim($transactionId) : $this->baseTopUpsUrl . "/topups/reports/transactions";
        /* make api call*/
        $response = $this->getVerb(endPoint: $endPoint, bearerToken: $this->bearerToken, headers: ["Accept: application/com.reloadly.topups-v1+json"]);
        return $response;
    }

    /*get the trasaction status */
    public function reloadlyTopupTransactionsDetails(?string $transactionId)
    {
        /*The transaction endpoint */
        $endPoint = empty($transactionId) ? $this->baseTopUpsUrl . "/topups/reports/transactions" : $this->baseTopUpsUrl . "/topups/reports/transactions/" . trim($transactionId);
        /* make api call*/
        $response = $this->getVerb(endPoint: $endPoint, bearerToken: $this->bearerToken, headers: ["Accept: application/com.reloadly.topups-v1+json"]);
        return $response;
    }
    /*verify a mobile number using reloadly */
    public function reloadlyMobileNumberVerificationGet(string $phoneNumber, string $countryCode)
    {
        /*The transaction endpoint */
        $endPoint = empty($transactionId) ? $this->baseTopUpsUrl . "/operators/mnp-lookup/phone/" . trim($phoneNumber) . "/countries/" . trim($countryCode) : $this->baseTopUpsUrl . "/topups/reports/transactions/" . trim($transactionId);
        /* make api call*/
        $response = $this->getVerb(endPoint: $endPoint, bearerToken: $this->bearerToken, headers: ["Accept: application/com.reloadly.topups-v1+json"]);
        return $response;
    }

    /*verify a mobile number using reloadly */
    public function reloadlyMobileNumberVerificationPost(string $phoneNumber, string $countryCode)
    {
        /*prepare the endpoint */
        $endPoint =  $this->baseTopUpsUrl . "/mnp-lookup/operators";
        /*postParams */
        $postParams = [
            "countryCode" => trim($phoneNumber),
            "phone" => trim($countryCode)
        ];
        /* make api call*/
        $response = $this->postVerb(postParams: $postParams, endPoint: $endPoint, bearerToken: $this->bearerToken, headers: ["Accept: application/com.reloadly.topups-v1+json"]);
        return $response;
    }

    /**buy data */

    public function buyData(?string $countryCode, ?array $postParams, bool $isLoacal = true)
    {
        if ($isLoacal) {
            /*prepare the endpoint */
            $endPoint = $this->baseTopUpsUrl . "/operators/countries/" . strtoupper(trim($countryCode)) . "?includeData=true";
            /* make api call*/
            $response = $this->getVerb(endPoint: $endPoint, bearerToken: $this->bearerToken, headers: ["Accept: application/com.reloadly.topups-v1+json"]);
            return $response;
        }

        if (!empty($postParams)) {

            $endPoint = $this->baseTopUpsUrl . "";

            $postParams = [
                "operatorId" => 643,
                "amount" => 4160,
                "useLocalAmount" => false,
                "customIdentifier" => "mtn-ghana-data-topup",
                "recipientEmail" => "anyone@email.com",
                "recipientPhone" => [
                    "countryCode" => "GH",
                    "number" => "233540903921"
                ],
                "senderPhone" => [
                    "countryCode" => "CA",
                    "number" => " 11231231231"
                ]
            ];
            /* make api call*/
            $response = $this->postVerb(postParams: $postParams, endPoint: $endPoint, bearerToken: $this->bearerToken, headers: ["Accept: application/com.reloadly.topups-v1+json"]);
            return $response;
        }

        return false;
    }


    /**buy eletricity bill */
    public function payElectricityBill(string $meterNumber, string $amount, string $billerId)
    {
        /*prepare the endpoint */
        $endPoint =  $this->baseUtilityUrl . "/pay";
        /*postParams */
        $postParams = [
            "subscriberAccountNumber" => Security::removeSpaces($meterNumber),
            "amount" => (int)Security::removeSpaces($amount),
            "billerId" => (int)Security::removeSpaces($billerId),
            "useLocalAmount" => false,
            "referenceId" => (string)Security::OTPGen(6) . "-" . Security::removeSpaces($amount) . "-" . date('d M Y', time()) . "-" . Security::removeSpaces($meterNumber),
            "additionalInfo" => null
        ];
        /* make api call*/
        $response = $this->postVerb(postParams: $postParams, endPoint: $endPoint, bearerToken: $this->bearerToken, headers: ["Accept: application/com.reloadly.topups-v1+json"]);
        return $response;
    }

    /*get all the utility billers */
    public function reloadlyUtilityBillers(?string $countryCode, string $billerType = "ELECTRICITY_BILL_PAYMENT", string $serviceType = "POSTPAID")
    {
        /*prepare the endpoint */
        $endPoint = $this->baseUtilityUrl . "/billers?id=0&name=string&type=" . trim(strtoupper($billerType)) . "&serviceType=" . trim(strtoupper($serviceType)) . "&countryISOCode=" . trim(strtoupper($countryCode)) . "&page=0&size=0";
        /**if the country code is senigal, run this if block to add additional requirement */
        if (trim(strtoupper($countryCode)) == "SN") {
        }
        /* make api call*/
        $response = $this->getVerb(endPoint: $endPoint, bearerToken: $this->bearerToken, headers: ["Accept: application/com.reloadly.topups-v1+json"]);
        return $response;
    }

    /**bill payment status */
    public function reloadlyBillPaymentStatus(?string $transactionId)
    {
        /*prepare the url */
        $endPoint = $this->baseUtilityUrl . "/transactions/" . trim($transactionId);
        /* make api call*/
        $response = $this->getVerb(endPoint: $endPoint, bearerToken: $this->bearerToken, headers: ["Accept: application/com.reloadly.topups-v1+json"]);
        return $response;
    }


    /** buy educational scratch cards */
    public function buyEducationCards()
    {
        /*prepare the endpoint */
        $endPoint = $this->baseTopUpsUrl . "/accounts/balance";
        /* make api call*/
        $response = $this->getVerb(endPoint: $endPoint, bearerToken: $this->bearerToken, headers: ["Accept: application/com.reloadly.topups-v1+json"]);
        return $response;
    }

    /*get countries */
    public function getCountries(string $countryISO = '')
    {
        /*prepare the endpoint */
        $endPoint =  !empty($countryISO) ?  $this->baseTopUpsUrl . "/countries/{$countryISO}" : $this->baseTopUpsUrl . "/countries";
        /* make api call*/
        $response = $this->getVerb(endPoint: $endPoint, bearerToken: $this->bearerToken, headers: ["Accept: application/com.reloadly.topups-v1+json"]);
        return $response;
    }

    /*get operators */
    public function getOperatorsByOperatorId(string $operatorId = '')
    {
        /*prepare the endpoint */
        $endPoint =  !empty($operatorId) ?  $this->baseTopUpsUrl . "/operators/" . strtoupper(trim($operatorId)) : $this->baseTopUpsUrl . "/operators";
        /* make api call*/
        $response = $this->getVerb(endPoint: $endPoint, bearerToken: $this->bearerToken, headers: ["Accept: application/com.reloadly.topups-v1+json"]);
        return $response;
    }
    /**get operator */

    public function getOperator(?string $countryISO = '', array $phoneNumberAndISOcode = [])
    {
        /*prepare the endpoint */
        $endPoint =  !empty($countryISO) ?  $this->baseTopUpsUrl . "/operators/countries/" . strtoupper(trim($countryISO)) : $this->baseTopUpsUrl . "/operators";
        /*check auto detect */
        if (!empty($phoneNumberAndISOcode)) {
            $endPoint = $this->baseTopUpsUrl . "/operators/auto-detect/phone/" . (string)trim($phoneNumberAndISOcode['number']) . "/countries/" . (string)trim($phoneNumberAndISOcode['iso']);
        }
        /* make api call*/
        $response = $this->getVerb(endPoint: $endPoint, bearerToken: $this->bearerToken, headers: ["Accept: application/com.reloadly.topups-v1+json"]);
        return $response;
    }

    /**
     * get the details of a mobile number
     */
    public function mobileNumberInformations(array $paramsData = [])
    {
        if ($paramsData) {
            $endPoint = $this->baseTopUpsUrl . "/operators/mnp-lookup/phone/" . trim($paramsData['number']) . "/countries/" . strtoupper(trim($paramsData['countryCode']));
            /**make a get request call */
            $response = $this->getVerb(endPoint: $endPoint, bearerToken: $this->bearerToken, headers: ["Accept: application/com.reloadly.topups-v1+json"]);
            return $response;
        }
        return false;
    }
    /*get operators fx-rate */
    public function reloadOperatorFxRate(?int $operatorId, ?int $amount)
    {
        /*prepare the endpoint */
        $endPoint =  $this->baseTopUpsUrl . "/operators/fx-rate";
        /*postParams */
        $postParams = [
            "operatorId" => $operatorId,
            "amount" => $amount
        ];
        /* make api call*/
        $response = $this->postVerb(postParams: $postParams, endPoint: $endPoint, bearerToken: $this->bearerToken, headers: ["Accept: application/com.reloadly.topups-v1+json"]);
        return $response;
    }

    /*get operators commissions*/
    public function reloadOperatorCommission(?int $operatorId)
    {
        /*prepare the endpoint */
        $endPoint = empty($operatorId) ? $this->baseTopUpsUrl . "/operators/commissions" : $this->baseTopUpsUrl . "/operators/" . (string)$operatorId . "/commissions";
        /* make api call*/
        $response = $this->getVerb(endPoint: $endPoint, bearerToken: $this->bearerToken, headers: ["Accept: application/com.reloadly.topups-v1+json"]);
        return $response;
    }

    /*get operators promotions*/
    public function reloadOperatorPromotions(?int $operatorId = null, ?string $countrycode = null, ?int $promotionid = null)
    {
        /*prepare the endpoint */
        return $this->bearerToken;

        $endPoint = "";
        if (!empty($operatorId)) {
            $endPoint = $this->baseTopUpsUrl . "/promotions/operators/" . $operatorId;
        } elseif (!empty($countrycode)) {
            $endPoint = $this->baseTopUpsUrl . "/promotions/country-codes/" . $countrycode;
        } elseif (!empty($promotionid)) {
            $endPoint = $this->baseTopUpsUrl . "/promotions/" . $promotionid;
        } else {
            $endPoint = $this->baseTopUpsUrl . "/promotions";
        }
        return $endPoint;
        /* make api call*/
        $response = $this->getVerb(endPoint: $endPoint, bearerToken: $this->bearerToken, headers: ["Accept: application/com.reloadly.topups-v1+json"]);
        return $response;
    }


    /**
     * @param string|null $request - The webhook request from Reloadly
     * @param int|null    $timestamp - The webhook request timestamp, obtain from request header "X-Reloadly-Request-Timestamp"
     * @param string|null $requestSignature - The webhook request signature, obtain from request header "X-Reloadly-Signature"
     * @param string|null $signingKey - Your account webhook signing key
     *
     * @return bool - True if the request signature and the computed signature match, false otherwise.
     * @throws Exception
     */
    public function reloadlyWebhookEventIsValidRequest(?string $request, ?int $timestamp, ?string $requestSignature, ?string $signingKey): bool
    {
        if (microtime(true) - $timestamp > 300) {
            /*
            * If the request timestamp is more than five minutes from local time, it could be a replay attack,
            * so let's ignore it.
            */
            throw new Exception("Possible replay attack!");
        }
        $dataToSign = $request . ":" . $timestamp;
        $computedSignature = hash_hmac('sha256', $dataToSign, $signingKey);
        return $computedSignature == $requestSignature;
    }


    public function webhook()
    {
    }





    /**authenticate the api and return the bearer token */
    private function authenticate(array | string $postParams, array | string $endPoint)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => trim($endPoint),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $postParams,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));

        $response = json_decode(curl_exec($curl), true);
        if (isset($response['access_token'])) {
            return $response['access_token'];
        }
        return $response;
    }
}
