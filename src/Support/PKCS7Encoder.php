<?php declare(strict_types=1);


namespace Bytedance\Support;


class PKCS7Encoder
{
    public static $blockSize = 16;

    public static function encode(string $text): string
    {
        $textLength = strlen($text);
        //计算需要填充的位数
        $amountToPad = self::$blockSize - ($textLength % self::$blockSize);
        if ($amountToPad == 0) {
            $amountToPad = self::$blockSize;
        }

        return $text . str_repeat(chr($amountToPad), $amountToPad);
    }

    /**
     * @param string $text
     * @return string
     */
    public static function decode(string $text): string
    {
        $pad = ord(substr($text, -1));
        if ($pad < 1 || $pad > self::$blockSize) {
            $pad = 0;
        }

        return substr($text, 0, (strlen($text) - $pad));
    }
}
