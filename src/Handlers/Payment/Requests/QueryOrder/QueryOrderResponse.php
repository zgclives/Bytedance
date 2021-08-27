<?php declare(strict_types=1);


namespace Bytedance\Handlers\Payment\Requests\QueryOrder;


use Bytedance\Kernel\Http\Response;

class QueryOrderResponse extends Response
{
    /**
     * 状态
     * PROCESSING-处理中
     * SUCCESS-成功
     * FAIL-失败
     * TIMEOUT-超时
     */
    const PROCESSING = 'PROCESSING';
    const SUCCESS = 'SUCCESS';
    const FAIL = 'FAIL';
    const TIMEOUT = 'TIMEOUT';

    /**
     * 总金额 单位分
     * @var int
     */
    public $totalFee;

    /**
     * 订单状态
     * @var string
     */
    public $orderStatus;

    /**
     * 支付时间
     * @var string
     */
    public $payTime;

    /**
     * way 字段中标识了支付渠道：2-支付宝，1-微信，3-银行卡
     * @var int
     */
    public $way;

    /**
     * 渠道单号
     * @var string
     */
    public $channelNo;

    /**
     * 渠道网关号
     * @var string
     */
    public $channelGatewayNo;

    public function __construct(
        int $totalFee,
        string $orderStatus,
        string $payTime,
        int $way,
        string $channelNo,
        string $channelGatewayNo
    )
    {
        $this->totalFee         = $totalFee;
        $this->orderStatus      = $orderStatus;
        $this->payTime          = $payTime;
        $this->way              = $way;
        $this->channelNo        = $channelNo;
        $this->channelGatewayNo = $channelGatewayNo;
    }

    public static function createFromArray(array $array)
    {
        $paymentInfo = $array['payment_info'];
        return new static(
            $paymentInfo["total_fee"],
            $paymentInfo["order_status"],
            $paymentInfo["pay_time"],
            $paymentInfo["way"],
            $paymentInfo["channel_no"],
            $paymentInfo["channel_gateway_no"],
        );
    }

    /**
     * 判断是否支付成功
     * @return bool
     */
    public function isSuccess(): bool
    {
        return $this->orderStatus === self::SUCCESS;
    }
}
