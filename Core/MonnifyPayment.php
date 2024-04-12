<?php

namespace Hitek\Slimez\Payments\Core;

use Hitek\Slimez\Payments\Configs\Env;

class MonnifyPayment extends HttpVerbs
{
    protected $baseUrl;
    protected $secKey;
    protected $contractNumber;
    protected $apiKey;
    protected $accountNumber;
    protected $bearerToken = '';

    function __construct()
    {
        $this->baseUrl = Env::MONNIFY_BASE_URL;
        $this->secKey = Env::MONNIFY_SEC_KEY;
        $this->contractNumber = Env::MONNIFY_CONTRACT_NUMBER;
        $this->apiKey = Env::MONNIFY_API_KEY;
        $this->accountNumber = Env::MONNIFY_WALLET_ACC_NUMBER;
        /**endpoint */
        $endpoint = Env::MONNIFY_BASE_URL . "/api/v1/auth/login/";
        /**post params */
        $postData = []; /*make an authencation request to the endpoint to fetch the bearer token */
        /*set the bearer token */
        $this->bearerToken =  $this->authenticate(postParams: $postData, endPoint: $endpoint);
    }

    /**get list of transactions */
    public function getTransactions(string $limit = '20')
    {
        /**endpoint */
        $endpoint = $this->baseUrl . "/api/v1/transactions/search?size=" . trim($limit);
        /**pass the bearerToken to the Authorization header of the request */
        /**send the post resquest */
        $response = $this->getVerb(endPoint: $endpoint, bearerToken: $this->bearerToken);
        return $response;
    }
    /**get banks with ussd short code */
    public function getListOfBanksWithUssd()
    {
        /**endpoint */
        $endpoint = $this->baseUrl . "/api/v1/sdk/transactions/banks/";
        /**pass the bearerToken to the Authorization header of the request */
        /**send the post resquest */
        $response = $this->getVerb(endPoint: $endpoint, bearerToken: $this->bearerToken);
        return $response;
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
    /**get by settlement reference*/
    public function getTransactionBySettlementRef(string $ref)
    {
        /**endpoint */
        $endpoint = $this->baseUrl . "/api/v2/transactions/find-by-settlement-reference?reference=" . trim($ref);
        /**send the post resquest */
        $response = $this->getVerb(endPoint: $endpoint, bearerToken: $this->bearerToken);
        return $response;
    }
    /**get the settlement details */
    public function getSettlementDetails(string $ref)
    {
        /**endpoint */
        $endpoint = $this->baseUrl . "/api/v1/settlement-detail?transactionReference=" . trim($ref);
        /**send the post resquest */
        $response = $this->getVerb(endPoint: $endpoint, bearerToken: $this->bearerToken);
        return $response;
    }

    /**Validate Bank Account */
    public function verifyBankAccount(string $accountNumber, string $bankCode)
    {
        /**endpoint */
        $endpoint = $this->baseUrl . "/api/v1/disbursements/account/validate?accountNumber=" . trim($accountNumber) . "&bankCode=" . trim($bankCode);
        /**send the post resquest */
        $response = $this->getVerb(endPoint: $endpoint, bearerToken: $this->bearerToken);
        return $response;
    }

    /**Validate User BVN */
    public function verifyBVN(string $bvn, string $fullname, string $dateOfBirth, string $mobileNumber)
    {
        /**endpoint */
        $endpoint = $this->baseUrl . "/api/v1/vas/bvn-details-match";
        /**post params data */
        $postParams = [
            'bvn' => trim($bvn),
            'name' => trim($fullname),
            'dateOfBirth' => trim($dateOfBirth),
            'mobileNo' => trim($mobileNumber),
        ];
        /**send the post resquest */
        $response = $this->postVerb(postParams: $postParams, endPoint: $endpoint, bearerToken: $this->bearerToken);
        return $response;
    }

    /**Validate User BVN and Bank Account */
    public function verifyBVNAndAccount(string $bankCode, string $accountNumber, string $bvn)
    {
        /**endpoint */
        $endpoint = $this->baseUrl . "/api/v1/vas/bvn-account-match";
        /**post params data */
        $postParams = [
            'bankCode' => trim($bankCode),
            'accountNumber' => trim($accountNumber),
            'bvn' => trim($bvn),
        ];
        /**send the post resquest */
        $response = $this->postVerb(postParams: $postParams, endPoint: $endpoint, bearerToken: $this->bearerToken);
        return $response;
    }

    public function singleTransferOb($json)
    {
        /**endpoint */
        $endpoint = $this->baseUrl . "/api/v2/disbursements/single";
        /**send the post resquest */
        $response = $this->postVerb($json, endPoint: $endpoint, bearerToken: $this->bearerToken);
        return $response;
    }
    /**initiate a single transfer */
    public function singleTransfer(array $postData)
    {
        /**endpoint */
        $endpoint = $this->baseUrl . "/api/v2/disbursements/single";
        /**post params data */

        $postData['reference'] =  (string)Security::OTPGen(length: 6) . "-HITEK-" . (string)Security::OTPGen(length: 6);

        /**send the post resquest */
        $response = $this->postVerb(postParams: array_filter($postData), endPoint: $endpoint, bearerToken: $this->bearerToken);
        return $response;
    }

    /**initiate a bulk transfer */
    public function bulkTransfer(
        string $title,
        string $batchReference,
        string $narration,
        string $sourceAccountNumber,
        array  $transactionList,
    ) {
        /**endpoint */
        $endpoint = $this->baseUrl . "/api/v2/disbursements/batch";
        /**post params data */
        $postParams = [
            'title' => trim($title),
            'batchReference' => trim($batchReference),
            'narration' => trim($narration),
            'sourceAccountNumber' => trim($sourceAccountNumber),
            'onValidationFailure' => trim("CONTINUE"),
            'notificationInterval' => trim(10),
            'transactionList' => $transactionList,
        ];
        /**send the post resquest */
        $response = $this->postVerb(postParams: $postParams, endPoint: $endpoint, bearerToken: $this->bearerToken);
        return $response;
    }
    /**get transfer status */
    public function getTransferStatus(string $ref, bool $isBulk = false)
    {
        /**endpoint */
        $endpoint = $isBulk == false ? $this->baseUrl . "/api/v2/disbursements/single/summary?reference=" . trim($ref) : $this->baseUrl . "/api/v2/disbursements/batch/summary?reference=" . trim($ref);
        /**send the post resquest */
        $response = $this->getVerb(endPoint: $endpoint, bearerToken: $this->bearerToken);
        return $response;
    }

    /**get monnify wallet balance */
    public function walletBalance(string $walletAccountNumber)
    {
        /**endpoint */
        $endpoint = $this->baseUrl . "/api/v2/disbursements/wallet-balance?accountNumber=" . trim($walletAccountNumber);
        /**send the post resquest */
        $response = $this->getVerb(endPoint: $endpoint, bearerToken: $this->bearerToken);
        return $response;
    }
    /**update customer details */
    public function updateCustomerDetails(string $customerEmail, string $currentCustomerEmail, string $customerFullName)
    {
        /**endpoint */
        $endpoint = $this->baseUrl . "/customer/update/" . trim($customerEmail);
        /**put data array params */
        $putParams = [
            'currentCustomerEmail' => $currentCustomerEmail,
            'customerEmail' => $customerEmail,
            'customerFullName' => $customerFullName,
        ];
        /**send the post resquest */
        $response = $this->putVerb(putParams: $putParams, endPoint: $endpoint, bearerToken: $this->bearerToken);
        return $response;
    }
    /**reserve a virtual account */
    public function reserveVirtualAccount(string $reference, string $customerFullName, string $customerEmail, string $bvn = '00000000000')
    {
        /**endpoint */
        $endpoint = $this->baseUrl . "/api/v2/bank-transfer/reserved-accounts";

        /**post params data */
        $postParams = [
            "accountReference" => trim($reference),
            "accountName" => trim(Env::SYSTEM_NAME . " VPN Services"),
            "currencyCode" => trim("NGN"),
            "contractCode" => trim(Env::MONNIFY_CONTRACT_NUMBER),
            "customerEmail" => trim($customerEmail),
            "bvn" => trim($bvn),
            "customerName" => trim($customerFullName),
            "getAllAvailableBanks" => true
        ];
        /**send the post resquest */
        $response = $this->postVerb(postParams: $postParams, endPoint: $endpoint, bearerToken: $this->bearerToken);
        return $response;
    }

    public function getAllTransfers($size = 5, $page = 1)
    {

        $endPoint = $this->baseUrl . "/api/v2/disbursements/single/transactions?pageSize=" . trim($size) . "&pageNo=" . trim($page);

        /**send the post resquest */
        $response = $this->getVerb(endPoint: $endPoint, bearerToken: $this->bearerToken);
        return $response;
    }

    public function getSingleTransfer($ref = "")
    {
        $endPoint = $this->baseUrl . "/api/v2/disbursements/single/summary?reference=" . trim($ref);
        /**send the post resquest */
        $response = $this->getVerb(endPoint: $endPoint, bearerToken: $this->bearerToken);
        return $response;
    }
    /**delete a reserved virtual account */
    public function deleteReservedVirtualAccount(string $accountRef)
    {
        /**endpoint */
        $endpoint = $this->baseUrl . "/api/v1/bank-transfer/reserved-accounts/reference/" . trim($accountRef);
        /**send the post resquest */
        $response = $this->deleteVerb(endPoint: $endpoint, bearerToken: $this->bearerToken);
        return $response;
    }

    /**
     * generate virtual accounts
     */
    public function virtualAccount(?array $postData = []): mixed
    {
        if (!empty($postData)) {
            /*declare the endpoint */
            $endPoint = $this->baseUrl."/api/v2/virtual-accounts/";
            /*prepare the post payload */
            $postParams = json_encode([
                "publicKey" => "",
                "fullName" => "Jane Smith",
                "bankVerificationNumber" => "",
                "currency" =>"NGN",
                "country" => "NG",
                "reference" => "FIRST_VIRTUAl_17",
                "email" => "js@emaildomain.com"
            ]);

            /*make api call to server */
            $response = $this->postVerb(postParams: $postParams, endPoint: $endPoint, bearerToken: $this->bearerToken);
            /*check the response data */
            // if (!empty($response) && isset($response['requestSuccessful'])) {
            //     return $response['responseBody']['checkoutUrl'];
            // }
            return $response;
        }
        return false;

    }

    /**make payment out
     * 
     * @array [
     *  "amount" => "",
     *  "currencyCode" => "",
     *  "destinationBankCode" => "",
     *  "destinationAccountNumber" => "",
     *  "destAccountFirstName" => ""
     *  "destAccountLastName" => "",
     *  "narration" => ",
     * ]
     */
    public function transferOut(?array $postData = []): mixed
    {
        if (!empty($postData)) {
            /*declare the endpoint */
            $endPoint = $this->baseUrl . "/api/v2/disbursements/single";
            /*prepare the post payload */
            $postParams = json_encode([
                "amount" => trim($postData['amount']),
                "reference" => "MONN-" . (string)Security::OTPGen(7) . "-" . strtoupper(substr(Security::removeSpaces(Env::SYSTEM_NAME), 2)) . "-" . (string)time(),
                "narration" => trim($postData['narration']),
                "destinationBankCode" => trim($postData['destinationBankCode']),
                "destinationAccountNumber" => Security::removeSpaces($postData['destinationAccountNumber']),
                "currency" => strtoupper(trim($postData['currencyCode'])),
                "sourceAccountNumber" => Security::removeSpaces($this->accountNumber),
                "destinationAccountName" => trim($postData['destinationAccountName'])
            ]);

            /*make api call to server */
            $response = $this->postVerb(postParams: $postParams, endPoint: $endPoint, bearerToken: $this->bearerToken);
            /*check the response data */
            // if (!empty($response) && isset($response['requestSuccessful'])) {
            //     return $response['responseBody']['checkoutUrl'];
            // }
            return $response;
        }
        return false;
    }

    /*
    * Monnify Verify Payment
    * 
    */
    public function verifyPayment(?string $referenceNumber): mixed
    {
        if (!empty($referenceNumber)) {
            $endPoint = $this->baseUrl . "/api/v2/transactions/" . Security::removeSpaces($referenceNumber);

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
            /**endpoint */
            $endPoint = $this->baseUrl . "/api/v1/merchant/transactions/init-transaction";
            /**post params data */
            $postParams = json_encode([
                "amount" => (int)trim($postData['amount']),
                "customerName" => trim($postData['firstName']) . " " . trim($postData['lastName']),
                "customerEmail" => trim($postData['email']),
                "paymentReference" => "MONN-" . (string)Security::OTPGen(7) . "-" . strtoupper(substr(Security::removeSpaces(Env::SYSTEM_NAME), 2)) . "-" . (string)time(),
                "paymentDescription" => trim($postData['narration']),
                "currencyCode" => trim($postData['currencyCode']),
                "contractCode" => $this->contractNumber,
                "redirectUrl" => trim($postData['callbackUrl']),
                "paymentMethods" => ["CARD", "ACCOUNT_TRANSFER", "USSD"]
            ]);
            /*make api call to server */
            $response = $this->postVerb(postParams: $postParams, endPoint: $endPoint, bearerToken: $this->bearerToken);
            /*check the response data */
            if (!empty($response) && isset($response['requestSuccessful'])) {
                return $response['responseBody']['checkoutUrl'];
            }
            return false;
        }
        return false;
    }

    /*link a new account to an existing user account */
    public function linkNewAccountToACustomer(string $accountReference)
    {
        /**endpoint */
        $endpoint = $this->baseUrl . "/api/v1/bank-transfer/reserved-accounts/add-linked-accounts/" . trim($accountReference);
        /**put data array params */
        $putParams = [];
        /**send the post resquest */
        $response = $this->putVerb(putParams: $putParams, endPoint: $endpoint, bearerToken: $this->bearerToken);
        return $response;
    }
    /**update  a reserved virtual account bvn*/
    public function updateVirtualAccountBVN(string $accountReference, string $bvn)
    {
        /**endpoint */
        $endpoint = $this->baseUrl . "/api/v1/bank-transfer/reserved-accounts/update-customer-bvn/" . trim($accountReference);
        /**put data array params */
        $putParams = [
            'bvn' => trim($bvn)
        ];
        /**send the post resquest */
        $response = $this->putVerb(putParams: $putParams, endPoint: $endpoint, bearerToken: $this->bearerToken);
        return $response;
    }
    /**get all the reserved virtual accounts Transaction*/
    public function allTransactionsInReservedAccount(string $accountReference,  int $limitSize, int $pageNumber = 0)
    {
        /**endpoint */
        $endpoint = $this->baseUrl . "/api/v1/bank-transfer/reserved-accounts/transactions
         ?accountReference=" . trim($accountReference) . "&page=" . trim($pageNumber) . "&size=" . trim($limitSize);
        /**send the post resquest */
        $response = $this->getVerb(endPoint: $endpoint, bearerToken: $this->bearerToken);
        return $response;
    }

    /**update  a reserved virtual account bvn*/
    public function allowedPaymentSource(string $accountReference, string $bvn)
    {
        /**endpoint */
        $endpoint = "/v1/bank-transfer/reserved-accounts/update-payment-source-filter/" . trim($accountReference);
        /**put data array params */
        $putParams = [
            'bvn' => trim($bvn)
        ];
        /**send the post resquest */
        $response = $this->putVerb(putParams: $putParams, endPoint: $endpoint, bearerToken: $this->bearerToken);
        return $response;
    }

    /**get reserved account details*/
    public function reservedAccountDetails(string $accountReference)
    {
        /**endpoint */
        $endpoint = $this->baseUrl . "/api/v2/bank-transfer/reserved-accounts/" . trim($accountReference);
        /**send the post resquest */
        $response = $this->getVerb(endPoint: $endpoint, bearerToken: $this->bearerToken);
        return $response;
    }


    /**get all banks in Nigeria*/
    public function getBanks()
    {
        /**endpoint */
        $endpoint = $this->baseUrl . "/api/v1/banks";
        /**send the post resquest */
        $response = $this->getVerb(endPoint: $endpoint, bearerToken: $this->bearerToken);
        return $response;
    }

    /**get all refunds*/
    public function getAllRefunds(int $limitSize, int $pageNumber = 0)
    {
        /**endpoint */
        $endpoint = $this->baseUrl . "/api/v1/refunds?page=" . trim($pageNumber) . "&size=" . trim($limitSize);
        /**send the post resquest */
        $response = $this->getVerb(endPoint: $endpoint, bearerToken: $this->bearerToken);
        return $response;
    }

    /**get refund status*/
    public function getRefundStatus(string $reference)
    {
        /**endpoint */
        $endpoint = $this->baseUrl . "/api/v1/refunds/" . trim($reference);
        /**send the post resquest */
        $response = $this->getVerb(endPoint: $endpoint, bearerToken: $this->bearerToken);
        return $response;
    }

    /**recurring payments */
    public function recurringPayments(string $cardRef, float $amount, string $customerName, string $customerEmail, string $reference, string $paymentRemark)
    {
        /**endpoint */
        $endpoint = $this->baseUrl . "/api/v1/merchant/cards/charge-card-token";
        /**post params data */
        $postParams = [
            "cardToken" => trim($cardRef),
            "amount" => trim($amount),
            "customerName" => trim($customerName),
            "customerEmail" => trim($customerEmail),
            "paymentReference" => trim($reference),
            "paymentDescription" => trim($paymentRemark),
            "currencyCode" => trim("NGN"),
            "contractCode" => trim(Env::MONNIFY_CONTRACT_NUMBER),
            "apiKey" => trim(Env::MONNIFY_API_KEY),
        ];
        /**send the post resquest */
        $response = $this->postVerb(postParams: $postParams, endPoint: $endpoint, bearerToken: $this->bearerToken);
        return $response;
    }

    /**initiate a limit */
    public function initiateRefund(string $tranRef, string $merchantRefundRef, float $amount, string $refundReasonRemark, string $customerNote, string $destinationAccountNumber, string $destinationAccountBankCode)
    {
        /**endpoint */
        $endpoint = $this->baseUrl . "/api/v1/refunds/initiate-refund";
        /**post params data */
        $postParams = [
            "transactionReference" => trim($tranRef),
            "refundReference" => trim($merchantRefundRef),
            "refundAmount" => trim($amount),
            "refundReason" => trim($refundReasonRemark),
            "customerNote" => trim($customerNote),
            "destinationAccountNumber" => trim($destinationAccountNumber),
            "destinationAccountBankCode" => trim($destinationAccountBankCode)
        ];
        /**send the post resquest */
        $response = $this->postVerb(postParams: $postParams, endPoint: $endpoint, bearerToken: $this->bearerToken);
        return $response;
    }

    /**process post requests*/
    public function authenticate(array $postParams = [], string $endPoint = '')
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
                "Authorization: Basic " . trim(base64_encode(Env::MONNIFY_API_KEY . ":" . Env::MONNIFY_SEC_KEY)),
                'Content-Type: application/json'
            ),
        ));

        $response = json_decode(curl_exec($curl), true);
        if (isset($response['responseBody']['accessToken'])) {
            return $response['responseBody']['accessToken'];
        }
        return $response;
    }

    //  Monify payment receievd event webhook

    public function webhook()
    {
    }
}
