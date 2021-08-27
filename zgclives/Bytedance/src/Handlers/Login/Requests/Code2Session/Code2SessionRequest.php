<?php declare(strict_types=1);

namespace Bytedance\Handlers\Login\Requests\Code2Session;

use Bytedance\Kernel\Http\HttpClient;
use Bytedance\Kernel\Http\Request;
use Bytedance\Kernel\Http\Response;

class Code2SessionRequest extends Request
{
    protected function getParamNameWithDefault(): array
    {
        return [
            [
                'name' => 'code',
                'default' => null,
            ]
        ];
    }

    public static function format(array $response): Response
    {
        return Code2SessionResponse::createFromArray($response);
    }

    public function sendRequest($arguments): array
    {
        [$code] = $arguments;

        return $this->http->get(
            'https://developer.toutiao.com/api/apps/jscode2session',
            [
                'appid' => $this->config->appId,
                'secret' => $this->config->secret,
                'code' => $code,
            ]
        );
    }
}
