<?php declare(strict_types=1);


namespace Bytedance\Handlers\Payment\Requests\CreateSettle;


use Bytedance\Kernel\Http\Response;

class CreateSettleResponse extends Response
{
    public $settleNo;

    public function __construct(string $settleNo)
    {
        $this->settleNo = $settleNo;
    }

    public static function createFromArray(array $array)
    {
        return new static($array['settle_no']);
    }
}
