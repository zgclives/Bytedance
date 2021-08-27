<?php declare(strict_types=1);


namespace Bytedance\Utils\Encrypt;


use Bytedance\Utils\Encrypt\Mobile\DecryptedMobile;
use Bytedance\Utils\Encrypt\Mobile\MobileEncryptor;

/**
 * @method DecryptedMobile mobile(string $sessionKey, string $iv, string $encrypted)
 * @package Bytedance\Utils\Encrypt
 */
class Manager extends \Bytedance\Kernel\Manager
{
    protected function getClassMap(): array
    {
        return [
            'mobile' => MobileEncryptor::class,
        ];
    }
}
