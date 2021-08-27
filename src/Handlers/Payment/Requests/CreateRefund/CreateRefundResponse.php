<?php declare(strict_types=1);


namespace Bytedance\Handlers\Payment\Requests\CreateRefund;


use Bytedance\Kernel\Http\Response;

class CreateRefundResponse extends Response
{
    public  $refundNo;

    public function __construct(string $refundNo)
    {
        $this->refundNo = $refundNo;
    }

    public static function createFromArray(array $array)
    {
        return new static($array['refund_no']);
    }
}
