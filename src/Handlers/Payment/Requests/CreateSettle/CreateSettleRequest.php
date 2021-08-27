<?php declare(strict_types=1);


namespace Bytedance\Handlers\Payment\Requests\CreateSettle;


use Bytedance\Kernel\Http\Request;
use Bytedance\Kernel\Http\Response;
use Bytedance\Utils\Encrypt\Payment\RequestSigner;

class CreateSettleRequest extends Request
{
    protected function getParamNameWithDefault(): array
    {
        return [
            [
                'name' => 'outSettleNo',
                'default' => null,
            ],
            [
                'name' => 'outOrderNo',
                'default' => null,
            ],
            [
                'name' => 'settleDesc',
                'default' => null,
            ],
            [
                'name' => 'settleParams',
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
        ];
    }

    public static function format(array $response): Response
    {
        return CreateSettleResponse::createFromArray($response);
    }

    public function sendRequest($arguments): array
    {
        [
            $outSettleNo,
            $outOrderNo,
            $settleDesc,
            $settleParams,
            $cpExtra,
            $notifyUrl,
            $thirdPartyId,
        ] = $arguments;

        $params = [
            'app_id' => $this->config->appId,
            'out_settle_no' => $outSettleNo,
            'out_order_no' => $outOrderNo,
            'settle_desc' => $settleDesc,
            'settle_params' => json_encode($settleParams),
            'cp_extra' => $cpExtra,
            'notify_url' => $notifyUrl,
            'thirdparty_id' => $thirdPartyId,
        ];

        return $this->http->postWithPaymentSignature(
            $this->config->salt,
            'https://developer.toutiao.com/api/apps/ecpay/v1/settle',
            $params
        );
    }
}
