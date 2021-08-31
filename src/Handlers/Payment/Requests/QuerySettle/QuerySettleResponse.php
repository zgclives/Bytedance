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

    /**
     * 分账说明
     * @var int
     */
    public $settleDetail;

    /**
     * 分账时间
     * @var int
     */
    public $settleAt;

    /**
     * 手续费金额 单位分
     * @var int
     */
    public $rake;

    /**
     * 佣金 单位分
     * @var int
     */
    public $commission;

    /**
     * 自定义参数
     * @var int
     */
    public $cpExtra;

    public function __construct(
        string $settleNo,
        string $settleStatus,
        int    $settleAmount,
        string $settleDetail,
        int    $settleAt,
        int    $rake,
        int    $commission,
        string $cp_extra
    )
    {
        $this->settleNo     = $settleNo;
        $this->settleStatus = $settleStatus;
        $this->settleAmount = $settleAmount;
        $this->settleDetail = $settleDetail;
        $this->settleAt     = date('Y-m-d H:i:s', $settleAt);
        $this->rake         = $rake;
        $this->commission   = $commission;
        $this->cpExtra      = $cp_extra;
    }

    public static function createFromArray(array $array)
    {
        $settleInfo = $array['settle_info'];
        return new static(
            $settleInfo["settle_no"],
            $settleInfo["settle_status"],
            $settleInfo["settle_amount"],
            $settleInfo["settle_detail"],
            $settleInfo["settled_at"],
            $settleInfo["rake"],
            $settleInfo["commission"],
            $settleInfo["cp_extra"]
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
