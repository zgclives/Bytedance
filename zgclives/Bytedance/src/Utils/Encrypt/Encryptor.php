<?php declare(strict_types=1);


namespace Bytedance\Utils\Encrypt;


use Bytedance\Kernel\Exceptions\DecryptException;
use Bytedance\Support\AES;
use Bytedance\Support\PKCS7Encoder;

class Encryptor
{
    /**
     * 解密
     * @param string $sessionKey
     * @param string $iv
     * @param string $encrypted
     * @return array
     * @throws DecryptException
     */
    public function decrypt(
        string $sessionKey,
        string $iv,
        string $encrypted
    ): array
    {
        $tempDecrypted = AES::decrypt(
            base64_decode($encrypted),
            base64_decode($sessionKey),
            base64_decode($iv)
        );

        $decrypted = json_decode(PKCS7Encoder::decode($tempDecrypted), true);
        if ($decrypted === null) {
            throw new DecryptException('The given payload is invalid.');
        }

        return $decrypted;
    }
}
