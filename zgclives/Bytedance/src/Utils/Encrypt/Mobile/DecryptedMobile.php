<?php declare(strict_types=1);


namespace Bytedance\Utils\Encrypt\Mobile;


class DecryptedMobile
{
    /**
     * 用户绑定的手机号（国外手机号会有区号）
     * @var string
     */
    public $phoneNumber;

    /**
     * 没有区号的手机号
     * @var string
     */
    public $purePhoneNumber;

    /**
     * 区号
     * @var string
     */
    public $countryCode;

    /**
     * watermark.appId
     * @var string
     */
    public $appId;

    /**
     * watermark.timestamp
     * @var int
     */
    public $timestamp;

    /**
     * @param array $array
     * @return DecryptedMobile
     */
    public static function createFromArray(array $array): DecryptedMobile
    {
        $self = new static();

        $self->timestamp = $array['watermark']['timestamp'];
        $self->appId = $array['watermark']['appid'];
        $self->countryCode = $array['countryCode'];
        $self->purePhoneNumber = $array['purePhoneNumber'];
        $self->phoneNumber = $array['phoneNumber'];
        return $self;
    }
}
