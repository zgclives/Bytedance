<?php declare(strict_types=1);


namespace Bytedance\Utils\Encrypt\Payment;


class NotifySigner
{
    /**
     * notify api signature
     * @param array $body
     * @param string $token
     * @return string
     */
    public static function signature(array $body, string $token): string
    {
        $filtered = [];
        foreach ($body as $key => $value) {
            if (in_array($key, ['msg_signature', 'type']) || empty($value)) {
                continue;
            }

            $filtered[] = $value;
        }

        $filtered[] = $token;
        sort($filtered,SORT_STRING);
        return sha1((implode('', $filtered)));
    }
}
