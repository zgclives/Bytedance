<?php declare(strict_types=1);

namespace Bytedance\Handlers\Login;

use Bytedance\Handlers\Login\Requests\AccessToken;
use Bytedance\Handlers\Login\Requests\Code2Session\Code2SessionRequest;
use Bytedance\Handlers\Login\Requests\Code2Session\Code2SessionResponse;

/**
 * @method AccessToken\AccessTokenResponse accessToken()
 * @method Code2SessionResponse code2Session(string $code)
 * @package Bytedance\Handlers\Login
 */
class Manager extends \Bytedance\Kernel\Manager
{
    protected function getClassMap(): array
    {
        return [
            'accessToken' => AccessToken\AccessTokenRequest::class,
            'code2Session' => Code2SessionRequest::class,
        ];
    }
}
