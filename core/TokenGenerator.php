<?php
require_once 'autoload.php';
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Syntaxseed\Libsodiumfacade\LibsodiumFacade;

class TokenGenerator
{

    /**
     * Summary of generateToken
     * @param mixed $payload
     * @param mixed $key
     * @return |false
     */
    public static function TokenEncoder(array $payload, string $privateKey): string|array
    {
        $encoded = self::encryptToken($payload, $privateKey);
        $token = JWT::encode((array) $encoded, $privateKey, 'HS256');
        return $token;
    }

    /**
     * Summary of TokenDecoder
     * @param mixed $jwt
     * @param mixed $key
     * @return stdClass|false
     */
    public static function TokenDecoder(string $token, string $privateKey): stdClass
    {
        $decoded = self::decryptToken($token, $privateKey);
        return $decoded;
    }

    /**
     * Summary of GetPrivateKey
     * @param mixed $pk
     * @return OpenSSLAsymmetricKey|bool
     */
    public static function GetPrivateKey(): string
    {

        $passphrase = "1kball-ssh-key-chain-certificate";
        $privateKeyFile = __DIR__ . '/Privatekey.pem';
        $privateKey = openssl_pkey_get_private(file_get_contents($privateKeyFile), $passphrase);
        openssl_pkey_export($privateKey, $private_key_string);
        return (string) $private_key_string;
    }

    /**
     * Summary of GetPublicKey
     * @param mixed $privateKey
     * @return OpenSSLAsymmetricKey
    //  */
    // public static function GetPublicKey($privateKey) : OpenSSLAsymmetricKey {
    //     $publicKey = openssl_pkey_get_details($privateKey)['key'];
    //     return $publicKey;
    // }

    public static function encryptToken($token, $privateKey)
    {
        $AES_256_CBC_ENC = 'aes-256-cbc';
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length($AES_256_CBC_ENC));//initialisation vector
        $encrypted = openssl_encrypt(json_encode($token), $AES_256_CBC_ENC, $privateKey, 0, $iv);
        return $encrypted . ':' . base64_encode($iv);
    }

    public static function decryptToken($token, $secretKey)
    {
        try {
            $decoded = JWT::decode($token, new Key($secretKey, 'HS256'));
            return $decoded;
        } catch (Exception $e) {
            return "Error: " . $e->getMessage();
        }
    }

    public static function isTokenexpired($payload): bool
    {
        try {
            $exp = $payload->expiry;
            $now = time();
            if ($exp < $now)
                return true;
            return false;
        } catch (Exception $e) {
            return "Error: " . $e->getMessage() . "\n";
        }
    }

    public static function sodiumEncrypt(string $secretMessage, string $key): string  // ----- lib sodium
    {
        $encryptedMessage = LibsodiumFacade::symmetricEncrypt($secretMessage, $key);
        return json_encode($encryptedMessage);
    }

    public static function sodiumDecrypt(string $encryptedMessage, string $key)
    {
        $encryptedMessage = json_decode($encryptedMessage, true);
        if (is_array($encryptedMessage)) {
            $decryptedMessage = LibsodiumFacade::symmetricDecrypt(
                $encryptedMessage['encrypted'],
                $encryptedMessage['nonce'],
                $key
            );
            return $decryptedMessage;
        }
        return json_encode(['type' => Response::ERROR, 'message' => Response::INVALID_ACTION]);
    }

    public static function GetSodiumKey(): string
    {
        $privateKeyFile = __DIR__ . '/Sodiumkey.pem';
        $privateKey = file_get_contents($privateKeyFile);
        return (string) $privateKey;
    }

}