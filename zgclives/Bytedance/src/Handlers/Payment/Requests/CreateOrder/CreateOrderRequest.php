<?php declare(strict_types=1);

namespace Bytedance\Handlers\Payment\Requests\CreateOrder;

use Bytedance\Kernel\Http\Request;
use Bytedance\Kernel\Http\Response;
use Bytedance\Utils\Encrypt\Payment\RequestSigner;

class CreateOrderRequest extends Request
{
    protected function getParamNameWithDefault(): array
    {
        return [
            [
                'name' => 'outOrderNo',
                'default' => '',
            ],
            [
                'name' => 'totalAmount',
                'default' => 0,
            ],
            [
                'name' => 'subject',
                'default' => '',
            ],
            [
                'name' => 'body',
                'default' => '',
            ],
            [
                'name' => 'validTimestamp',
                'default' => 0,
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
                'name' => 'storeUid',
                'default' => null,
            ],
        ];
    }

    public static function format(array $response): Response
    {
        return CreateOrderResponse::createFromArray($response);
    }

    public function sendRequest($arguments): array
    {
        [
            $outOrderNo,
            $totalAmount,
            $subject,
            $body,
            $validTimestamp,
            $cpExtra,
            $notifyUrl,
            $thirdPartyId,
            $disableMsg,
            $msgPage,
            $storeUid
        ] = $arguments;

        $params = [
            'app_id' => $this->config->appId,
            'out_order_no' => $outOrderNo,
            'total_amount' => $totalAmount,
            'subject' => $subject,
            'body' => $body,
            'valid_time' => $validTimestamp,
            'cp_extra' => $cpExtra,
            'notify_url' => $notifyUrl,
            'thirdparty_id' => $thirdPartyId,
            'disable_msg' => $disableMsg,
            'msg_page' => $msgPage,
            'store_uid' => $storeUid
        ];

        $params = array_filter($params);
        $params['sign'] = RequestSigner::signature($params, $this->config->salt);

        return $this->http->post(
            'https://developer.toutiao.com/api/apps/ecpay/v1/create_order',
            $params
        );
    }
}
