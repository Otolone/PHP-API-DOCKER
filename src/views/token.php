<?php
require_once 'vendor/autoload.php';
use ReallySimpleJWT\Token;


class GenerateToken {


    // Method to create a token
    public function createToken(int $user_id): string {
        // Create token
        $payload = [
            'iat' => time(),
            'uid' => $user_id,
            'exp' => time() + 3600,
            'iss' => 'localhost'
        ];

        $secret = base64_encode(random_bytes(32));
        //$secret = 'Hello&MikeFooBar123';
        $token = Token::customPayload($payload, $secret);
        return $token;
    }
    
    // Method to validate a token
    public function validateToken(string $token, string $secret): bool {
        return Token::validate($token, $secret);
    }

    // Method to validate token expiration
    public function expiration(string $token): bool {
        return Token::validateExpiration($token);
    }

    // Method to validate not before
    public function notBefore(string $token): bool {
        return Token::validateNotBefore($token);
    }
}

/*/ Example usage:
$generateToken = new GenerateToken();

// Create token
$iat = time();
$user_id = 1;
$exp = time() + 3600; // Token valid for 1 hour
$issuer = 'localhost';
$token = $generateToken->createToken($iat, $user_id, $exp, $issuer);

echo "Generated Token: " . $token . PHP_EOL;

// Validate token
$is_valid = $generateToken->validateToken($token, $secret);
echo "Is Token Valid: " . ($is_valid ? 'Yes' : 'No') . PHP_EOL;

// Validate token expiration
$is_expired = $generateToken->expiration($token);
echo "Is Token Expired: " . ($is_expired ? 'Yes' : 'No') . PHP_EOL;

// Validate not before
$is_not_before_valid = $generateToken->notBefore($token);
echo "Is Not Before Valid: " . ($is_not_before_valid ? 'Yes' : 'No') . PHP_EOL;
*/

?>
