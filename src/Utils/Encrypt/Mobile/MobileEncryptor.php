<?php declare(strict_types=1);


namespace Bytedance\Utils\Encrypt\Mobile;


use Bytedance\Kernel\Exceptions\DecryptException;
use Bytedance\Kernel\Handler;
use Bytedance\Kernel\HandlerInterface;
use Bytedance\Utils\Encrypt\Encryptor;

class MobileEncryptor extends Handler
{
    /**
     * @var Encryptor
     */
    protected $encryptor;

    public function __construct()
    {
        $this->encryptor = new Encryptor();
    }

    public function process($arguments)
    {
        [$sessionKey, $iv, $encrypted] = $arguments;
        return $this->decrypt($sessionKey, $iv, $encrypted);
    }

    /**
     * 解密手机数据
     * @param string $sessionKey
     * @param string $iv
     * @param string $encrypted
     * @return DecryptedMobile
     * @throws DecryptException
     */
    public function decrypt(
        string $sessionKey,
        string $iv,
        string $encrypted
    ): DecryptedMobile
    {
        return DecryptedMobile::createFromArray(
            $this->encryptor->decrypt(
                $sessionKey,
                $iv,
                $encrypted
            )
        );
    }

    protected function getParamNameWithDefault(): array
    {
        return [];
    }
}
