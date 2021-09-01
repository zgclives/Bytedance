<?php declare(strict_types=1);


namespace Bytedance\Handlers\Payment\Requests\PaymentNotify;


class PaymentNotify
{
    /**
     * 小程序 id
     * @var string
     */
    public $appId;

    /**
     * 开发者传入订单号
     * @var string
     */
    public $cpOrderNo;

    /**
     * way 字段中标识了支付渠道：2-支付宝，1-微信
     * @var string
     */
    public $way;

    /**
     * 预下单时开发者传入字段
     * @var string
     */
    public $cpExtra;

    public function __construct(
        string $appId,
        string $cpOrderNo,
        string $way,
        string $cpExtra
    )
    {
        $this->appId     = $appId;
        $this->cpOrderNo = $cpOrderNo;
        $this->way       = $way;
        $this->cpExtra   = $cpExtra;
    }

    /**
     * @param array $response
     * @return static
     */
    public static function createFromResponse(array $response)
    {
        return self::createFromArray(json_decode($response['msg'], true));
    }

    /**
     * @param array $array
     */
    public static function createFromArray(array $array)
    {
        return new static(
            $array['appid'],
            $array['cp_orderno'],
            $array['way'],
            $array['cp_extra']
        );
    }

    /**
     * 返回成功
     * @return string
     */
    public function toSuccessResponse(): string
    {
        return json_encode([
            "err_no"   => 0,
            "err_tips" => "success",
        ]);
    }
}
