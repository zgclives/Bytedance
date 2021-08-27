<?php declare(strict_types=1);


namespace Bytedance\Handlers\Payment\Requests\QuerySettle;


use Bytedance\Kernel\Http\Response;

class QuerySettleResponse extends Response
{
    /**
     * 分账状态
     * SUCCESS-成功
     * FAIL-失败
     */
    const SUCCESS = 'SUCCESS';
    const FAIL = 'FAIL';

    /**
     * 分账金额 单位分
     * @var string
     */
    public $settleNo;

    /**
     * 订单状态
     * @var string
     */
    public $settleStatus;

    /**
     * 分账金额 单位分
     * @var int
     */
    public $settleAmount;

    public function __construct(
        string $settleNo,
        string $settleStatus,
        int    $settleAmount
    )
    {
        $this->settleNo     = $settleNo;
        $this->settleStatus = $settleStatus;
        $this->settleAmount = $settleAmount;
    }

    public static function createFromArray(array $array)
    {
        $settleInfo = $array['settle_info'];
        return new static(
            $settleInfo["settle_no"],
            $settleInfo["settle_status"],
            $settleInfo["settle_amount"]
        );
    }

    /**
     * 判断是否成功
     * @return bool
     */
    public function isSuccess(): bool
    {
        return $this->settleStatus === self::SUCCESS;
    }
}
