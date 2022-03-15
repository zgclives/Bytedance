<?php declare(strict_types=1);


namespace Bytedance\Handlers\Payment\Requests\RefundNotify;


class RefundNotify
{
    const PROCESSING = 'PROCESSING';
    const SUCCESS = 'SUCCESS';
    const FAIL = 'FAIL';

    /**
     * 小程序 appId
     * @var string
     */
    public $appId;

    /**
     * 开发者自定义的退款单号
     * @var string
     */
    public $cpRefundNo;

    /**
     * 开发者传的额外参数
     * @var string
     */
    public $cpExtra;

    /**
     * 退款状态 PROCESSING-处理中|SUCCESS-成功|FAIL-失败
     * @var string
     */
    public $status;

    /**
     * 退款金额
     * @var int
     */
    public $refundAmount;

    public function __construct(
        string $appId,
        string $cpRefundNo,
        string $cpExtra,
        string $status,
        int    $refundAmount
    )
    {
        $this->appId        = $appId;
        $this->cpRefundNo   = $cpRefundNo;
        $this->cpExtra      = $cpExtra;
        $this->status       = $status;
        $this->refundAmount = $refundAmount;
    }

    public static function createFromResponse(array $response)
    {
        return self::createFromArray(json_decode($response['msg'], true));
    }

    public static function createFromArray(array $array)
    {
        return new static(
            $array['appid'],
            $array['cp_refundno'],
            $array['cp_extra'],
            $array['status'],
            $array['refund_amount']
        );
    }

    public function isSuccess(): bool
    {
        return $this->status === self::SUCCESS;
    }

    public function toSuccessResponse(): string
    {
        return json_encode([
            "err_no"   => 0,
            "err_tips" => "success",
        ]);
    }
}
