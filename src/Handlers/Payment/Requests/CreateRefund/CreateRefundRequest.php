<?php declare(strict_types=1);


namespace Bytedance\Handlers\Payment\Requests\CreateRefund;


use Bytedance\Kernel\Http\Request;
use Bytedance\Kernel\Http\Response;
use Bytedance\Utils\Encrypt\Payment\RequestSigner;

class CreateRefundRequest extends Request
{
    protected function getParamNameWithDefault(): array
    {
        return [
            [
                'name' => 'outOrderNo',
                'default' => null,
            ],
            [
                'name' => 'outRefundNo',
                'default' => null,
            ],
            [
                'name' => 'refundAmount',
                'default' => null,
            ],
            [
                'name' => 'reason',
                'default' => null,
            ],
            [
                'name' => 'cpExtra',
                'default' => null,
            ],
            [
                'name' => 'notifyUrl',
                'default' => null,
            ],
            [
                'name' => 'thirdPartyId',
                'default' => null,
            ],
            [
                'name' => 'disableMsg',
                'default' => null,
            ],
            [
                'name' => 'msgPage',
                'default' => null,
            ],
            [
                'name' => 'allSettle',
                'default' => null,
            ]
        ];
    }

    public static function format(array $response): Response
    {
        return CreateRefundResponse::createFromArray($response);
    }

    public function sendRequest($arguments): array
    {
        [
            $outOrderNo,
            $outRefundNo,
            $refundAmount,
            $reason,
            $cpExtra,
            $notifyUrl,
            $thirdPartyId,
            $disableMsg,
            $msgPage,
            $allSettle,
        ] = $arguments;

        $params = [
            'app_id' => $this->config->appId,
            'out_order_no' => $outOrderNo,
            'out_refund_no' => $outRefundNo,
            'refund_amount' => $refundAmount,
            'reason' => $reason,
            'cp_extra' => $cpExtra,
            'notify_url' => $notifyUrl,
            'thirdparty_id' => $thirdPartyId,
            'disable_msg' => $disableMsg,
            'msg_page' => $msgPage,
            'all_settle' => $allSettle,
        ];

        return $this->http->postWithPaymentSignature(
            $this->config->salt,
            'https://developer.toutiao.com/api/apps/ecpay/v1/create_refund',
            $params
        );
    }
}
