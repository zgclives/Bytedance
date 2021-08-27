<?php declare(strict_types=1);


namespace Bytedance\Support;


class AES
{
    /**
     * aes-128-cbc decrypt
     * @param string $cipherText
     * @param string $key
     * @param string $iv
     * @return string
     */
    public static function decrypt(
        string $cipherText,
        string $key,
        string $iv
    ): string
    {
        return openssl_decrypt(
            $cipherText,
            'AES-128-CBC',
            $key,
            OPENSSL_RAW_DATA | OPENSSL_ZERO_PADDING,
            $iv
        );
    }

}
