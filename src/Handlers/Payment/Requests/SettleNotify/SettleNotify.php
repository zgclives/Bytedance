<?php declare(strict_types=1);


namespace Bytedance\Handlers\Payment\Requests\SettleNotify;


class SettleNotify
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
    public $cpSettleNo;

    /**
     * 预下单时开发者传入字段
     * @var string
     */
    public $cpExtra;

    /**
     * 分账状态，PROCESSING-处理中|SUCCESS-成功|FAIL-失败
     * @var string
     */
    public $status;

    /**
     * 该笔交易分账环境收取的手续费金额
     * @var int
     */
    public $rake;

    /**
     * 交易参与 CPS 投放等任务时，产生的佣金
     * @var int
     */
    public $commission;

    public function __construct(
        string $appId,
        string $cpSettleNo,
        string $cpExtra,
        string $status,
        int    $rake,
        int    $commission
    )
    {
        $this->appId      = $appId;
        $this->cpSettleNo = $cpSettleNo;
        $this->cpExtra    = $cpExtra;
        $this->status     = $status;
        $this->rake       = $rake;
        $this->commission = $commission;
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
            $array['cp_settle_no'],
            $array['cp_extra'],
            $array['status'],
            $array['rake'],
            $array['commission']
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
