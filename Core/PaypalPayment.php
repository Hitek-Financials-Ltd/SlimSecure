<?php
namespace Hitek\Slimez\Payments\Core;

use Hitek\Slimez\Payments\Configs\Env;
use Hitek\Slimez\Payments\Core\HttpVerbs;

class PaypalPayment extends HttpVerbs{
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
        if(!Session::get('bearer_token_paypal')){
            /*make an authencation request to the endpoint to fetch the bearer token */
            $response = $this->authenticate($endpoint, $keys);
            /**token */
            Session::set('bearer_token_paypal',$response);
        }

        $this->bearerToken = trim(Session::get('bearer_token_paypal'));
    }


    public function bearerToken()
    {
        return $this->bearerToken;
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
    public function webhook(){
        
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
                "key": '.$keys.'}',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));

        $response = json_decode(curl_exec($curl), true);
        if(isset($response['status']) && strtolower($response['status']) == "success"){
            return $response['data']['EncryptedSecKey']['encryptedKey'];
        }
        return $response;
        
    }
}