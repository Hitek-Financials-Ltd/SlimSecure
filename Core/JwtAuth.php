<?php

namespace Hitek\Slimez\Payments\Core;

use Hitek\Slimez\Payments\Configs\Env;
use Hitek\Slimez\Payments\App\Middlewares\Auth;

/**
 * Author: Oaad Global
 * Developer: Hitek Financials Ltd
 * Year: 2024
 * Developer Contact: contact@tekfinancials.ng, kennethusiobaifo@yahoo.com
 * Project Name: Slimez
 * Description: Slimez.
 */

/**
 * Class JwtAuth
 *
 * This class provides JWT token generation and validation functionalities.
 */
class JwtAuth
{
    /**
     * Generate a JWT token with the given payload.
     *
     * @param mixed $payload The payload to be included in the token.
     * @return string The generated JWT token.
     */
    public static function generateJWTToken($payload)
    {
        $header = self::base64UrlClean(json_encode([
            'alg' => 'HS256',
            'typ' => 'JWT',
            'iss' => Security::encryption(Env::SYSTEM_NAME), // Issuer claim
            'exp' => (Env::JWT_SECRET_EXPIRING_TIME_IN_HOUR*60) + time(),
        ]));

        $payload = self::base64UrlClean(json_encode($payload));

        $signature = self::base64UrlClean(hash_hmac('sha256', $header . $payload, Env::JWT_SECRET_KEY, true));

        $token = "$header.$payload.$signature";

        return $token;
    }

    /**
     * Validate a JWT token.
     *
     * @param string $token The JWT token to validate.
     * @return bool True if the token is valid, false otherwise.
     */
    public static function validateJWTToken($token)
    {
        list($header, $payload, $signature) = explode('.', $token);

        $decodedHeader = json_decode(self::base64UrlClean(text: $header, isEncode: false), true);
        $decodedPayload = json_decode(self::base64UrlClean(text: $payload, isEncode: false), true);

        if (!$decodedHeader || !$decodedPayload) {
            return false; // Invalid token encoding
        }
        // Validate issuer claim
        if (Security::decryption($decodedHeader['iss']) !== Env::SYSTEM_NAME) {
            return false; // Invalid issuer
        }
        // Validate token expiration
        $currentTime = time();
        
        if(Env::ISJWTTOKENEXPIRES){
          if($decodedHeader['exp'] < $currentTime){
            return false; // Token has expired
          }
        }
        
        // Verify the token's signature
        $expectedSignature = self::base64UrlClean(hash_hmac('sha256', $header . $payload, Env::JWT_SECRET_KEY, true));

        if (trim($signature) !== trim($expectedSignature)) {
            return false; // Invalid signature
        }
        
        // Validate the user
        if (!self::validateJWTUser($decodedPayload)) {
            return false;
        }

        // Token is valid
        return true;
    }

    /**
     * Clean and sanitize a base64url string.
     *
     * @param string $text The text to clean.
     * @param bool $isEncode Determines whether the text is encoded or not. Default is true.
     * @return string The cleaned base64url string.
     */
    public static function base64UrlClean(string $text, bool $isEncode = true)
    {
        if ($isEncode) {
            return str_replace(
                ['+', '/', '='],
                ['-', '_', ''],
                base64_encode($text),
            );
        }
        return str_replace(
            ['-', '_', ''],
            ['+', '/', '='],
            base64_decode($text),
        );
    }

    /**
     * Validate the user data in the JWT token.
     *
     * @param mixed $userToken The user token to validate.
     * @return bool True if the user is valid, false otherwise.
     */
    public static function validateJWTUser($userToken)
    {
        // Retrieve the user credentials from the Redis storage
        $user = Redis::init()->getRedis(Env::JWT_TOKEN_KEY_NAME);

        if (empty($user)) {
            return false;
        }

        list($header, $payload, $signature) = explode('.', $user);

        $decodedPayload = json_decode(self::base64UrlClean(text: $payload, isEncode: false), true);

        // Check the user credentials
        if ($decodedPayload['email'] != $userToken['email'] || $decodedPayload['userId'] != $userToken['userId']) {
            return false;
        }

        return true;
    }
}
