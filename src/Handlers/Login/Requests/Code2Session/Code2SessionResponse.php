<?php declare(strict_types=1);


namespace Bytedance\Handlers\Login\Requests\Code2Session;


use Bytedance\Kernel\Http\Response;

class Code2SessionResponse extends Response
{
    /**
     * 会话密钥，如果请求时有 code 参数才会返回
     * @var string
     */
    public $sessionKey;

    /**
     * 用户在当前小程序的 ID，如果请求时有 code 参数才会返回
     * @var string
     */
    public $openId;

    /**
     * 用户在小程序平台的唯一标识符，请求时有 code 参数才会返回。如果开发者拥有多个小程序，可通过 unionId 来区分用户的唯一性。
     * @var string|null
     */
    public $unionId;

    public function __construct(
        string $sessionKey,
        string $openId,
        ?string $unionId
    )
    {
        $this->sessionKey = $sessionKey;
        $this->openId = $openId;
        $this->unionId = $unionId;
    }

    public static function createFromArray(array $array)
    {
        return new static(
            $array['session_key'],
            $array['openid'],
            $array['unionid'] ?? null
        );
    }
}
