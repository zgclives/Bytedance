<?php declare(strict_types=1);


namespace Bytedance\Kernel;


use Bytedance\Kernel\Exceptions\Exception;
use Bytedance\Kernel\Http\HttpClient;
use Bytedance\Kernel\Log\Logger;
use Psr\Log\LoggerInterface;
use Psr\SimpleCache\CacheInterface;

class Kernel
{
    /**
     * @var HttpClient
     */
    protected $client;

    /**
     * @var Config
     */
    protected $config;

    /**
     * @var Logger|null
     */
    protected $logger;

    /**
     * @var CacheInterface|null
     */
    protected $cache;

    public function __construct(HttpClient $client, Config $config)
    {
        $this->client = $client;
        $this->config = $config;
    }

    /**
     * 获取token
     * @return string
     */
    public function getAccessToken(): string
    {
        return \Bytedance\Handlers\Login\Manager::createFromKernel($this)
            ->accessToken()
            ->accessToken;
    }

    /**
     * @param LoggerInterface|null $logger
     * @return $this
     */
    public function withLoggerFormLoggerInterface(?LoggerInterface $logger): Kernel
    {
        $this->logger = $logger !== null
            ? new Logger($logger)
            : null;

        return $this;
    }

    /**
     * @param CacheInterface|null $cache
     * @return $this
     */
    public function withCache(?CacheInterface $cache): Kernel
    {
        $this->cache = $cache;
        return $this;
    }

    /**
     * @return HttpClient
     */
    public function getClient(): HttpClient
    {
        return $this->client;
    }

    /**
     * @return Logger|null
     */
    public function getLogger(): ?Logger
    {
        return $this->logger;
    }

    /**
     * @return Config
     */
    public function getConfig(): Config
    {
        return $this->config;
    }
}
