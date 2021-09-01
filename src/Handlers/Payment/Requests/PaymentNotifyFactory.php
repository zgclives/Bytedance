<?php declare(strict_types=1);


namespace Bytedance\Handlers\Payment\Requests;


use Bytedance\Handlers\Payment\Requests\PaymentNotify\PaymentNotify;
use Bytedance\Handlers\Payment\Requests\RefundNotify\RefundNotify;
use Bytedance\Handlers\Payment\Requests\SettleNotify\SettleNotify;
use Bytedance\Kernel\Exceptions\InvalidClassException;
use Bytedance\Kernel\Exceptions\InvalidSignatureException;
use Bytedance\Kernel\Handler;
use Bytedance\Support\PaymentNotifySignature;

class PaymentNotifyFactory extends Handler
{
    public function process($arguments)
    {
        $arguments = $arguments[0];

        $isValid = PaymentNotifySignature::valid($arguments['msg_signature'], $arguments, $this->config->token);
        if ($isValid === false) {
            throw new InvalidSignatureException();
        }

        $handlers = [
            'payment' => PaymentNotify::class,
            'refund'  => RefundNotify::class,
            'settle'  => SettleNotify::class,
        ];

        $handler = $handlers[$arguments['type']] ?? null;

        if ($handler === null) {
            throw new InvalidClassException("invalid notify type - {$arguments['type']}");
        }

        return $handler::createFromResponse($arguments);
    }

    protected function getParamNameWithDefault(): array
    {
        return [];
    }
}
