<?php declare(strict_types=1);

namespace Bytedance\Handlers\Login\Requests\AccessToken;


use Bytedance\Kernel\Http\Request;
use Bytedance\Kernel\Http\Response;

class AccessTokenRequest extends Request
{
    protected function getParamNameWithDefault(): array
    {
        return [];
    }

    public static function format(array $response): Response
    {
        return AccessTokenResponse::createFromArray($response);
    }

    public function sendRequest($arguments): array
    {
        return $this->http->get(
            'https://developer.toutiao.com/api/apps/token',
            [
                'grant_type' => 'client_credential',
                'appid' => $this->config->appId,
                'secret' => $this->config->secret
            ],
            []
        );
    }
}
