<?php declare(strict_types=1);


namespace Bytedance\Handlers\Payment\Requests\QueryRefund;


use Bytedance\Handlers\Payment\Requests\QueryOrder\QueryOrderResponse;
use Bytedance\Kernel\Http\Request;
use Bytedance\Kernel\Http\Response;
use Bytedance\Utils\Encrypt\Payment\RequestSigner;

class QueryRefundRequest extends Request
{
    protected function getParamNameWithDefault(): array
    {
        return [
            [
                'name' => 'outRefundNo',
                'default' => '',
            ],
            [
                'name' => 'thirdpartyId',
                'default' => null,
            ]
        ];
    }

    public static function format(array $response): Response
    {
        return QueryRefundResponse::createFromArray($response);
    }

    public function sendRequest($arguments): array
    {
        [
            $outRefundNo,
            $thirdPartyId,
        ] = $arguments;

        $params = [
            'app_id' => $this->config->appId,
            'out_refund_no' => $outRefundNo,
            'thirdparty_id' => $thirdPartyId,
        ];

        $params = array_filter($params);
        $params['sign'] = RequestSigner::signature($params, $this->config->salt);

        return $this->http->post(
            'https://developer.toutiao.com/api/apps/ecpay/v1/query_refund',
            $params
        );
    }
}
