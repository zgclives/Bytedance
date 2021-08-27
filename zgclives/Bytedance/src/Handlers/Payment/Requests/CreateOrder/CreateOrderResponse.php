<?php declare(strict_types=1);


namespace Bytedance\Handlers\Payment\Requests\CreateOrder;


use Bytedance\Kernel\Http\Response;

class CreateOrderResponse extends Response
{
    /**
     * @var string
     */
    public $orderId;

    /**
     * @var string
     */
    public $orderToken;

    public function __construct(
        string $orderId,
        string $orderToken
    )
    {
        $this->orderId = $orderId;
        $this->orderToken = $orderToken;
    }

    public static function createFromArray(array $array)
    {
        return new static($array['data']['order_id'], $array['data']['order_token']);
    }
}
