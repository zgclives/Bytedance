<?php declare(strict_types=1);


namespace Bytedance\Kernel;


class Config
{
    /**
     * api app id
     * @var string
     */
    public $appId;

    /**
     * api secret
     * @var string
     */
    public $secret;

    /**
     * debug mode
     * if enable debug can log response
     * @var bool
     */
    public $isDebug;

    /**
     * payment salt
     * @var string
     */
    public $salt;

    /**
     * payment token
     * @var string
     */
    public $token;

    public function __construct(
        string $appId,
        string $secret,
        string $salt,
        string $token,
        bool $isDebug = false
    )
    {
        $this->appId   = $appId;
        $this->secret  = $secret;
        $this->salt = $salt;
        $this->token = $token;
        $this->isDebug = $isDebug;
    }
}
