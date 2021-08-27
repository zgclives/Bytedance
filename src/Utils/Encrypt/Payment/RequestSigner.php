<?php declare(strict_types=1);


namespace Bytedance\Utils\Encrypt\Payment;


class RequestSigner
{
    /**
     * payment api signature
     * @param array $body
     * @param string $secret
     * @return string
     */
    public static function signature(array $body, string $secret): string
    {
        $filtered = [];
        foreach ($body as $key => $value) {
            if (in_array($key, ['sign', 'app_id', 'thirdparty_id'])) {
                continue;
            }

            $filtered[] =
                is_string($value)
                    ? trim($value)
                    : $value;
        }

        $filtered[] = trim($secret);
        sort($filtered, SORT_STRING);
        return md5(trim(implode('&', $filtered)));
    }
}
