<?php declare(strict_types=1);


namespace Bytedance\Handlers\Payment\Requests\QuerySettle;


use Bytedance\Kernel\Http\Request;
use Bytedance\Kernel\Http\Response;
use Bytedance\Utils\Encrypt\Payment\RequestSigner;

class QuerySettleRequest extends Request
{
    protected function getParamNameWithDefault(): array
    {
        return [
            [
                'name' => 'outSettleNo',
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
        return QuerySettleResponse::createFromArray($response);
    }

    public function sendRequest($arguments): array
    {
        [$outSettleNo, $thirdPartyId] = $arguments;
        $result = [
            'app_id' => $this->config->appId,
            'out_settle_no' => $outSettleNo,
            'thirdparty_id' => $thirdPartyId,
        ];
        $result = array_filter($result);
        $result['sign'] = RequestSigner::signature($result, $this->config->salt);

        return $this->http->post(
            'https://developer.toutiao.com/api/apps/ecpay/v1/query_settle',
            $result
        );
    }
}
