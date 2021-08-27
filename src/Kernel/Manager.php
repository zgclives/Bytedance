<?php declare(strict_types=1);


namespace Bytedance\Kernel;


use Bytedance\Kernel\Exceptions\Exception;
use Bytedance\Kernel\Http\HttpClient;
use Bytedance\Kernel\Http\OpenApiInterface;
use Bytedance\Kernel\Log\Logger;

abstract class Manager
{
    /**
     * @var HttpClient
     */
    protected $http;

    /**
     * @var Config
     */
    protected $config;

    /**
     * @var Logger|null
     */
    protected $logger;

    public function __construct(
        HttpClient $http,
        Config $config,
        ?Logger $logger
    )
    {
        $this->http   = $http;
        $this->config = $config;
        $this->logger = $logger;
    }

    /**
     * @param Kernel $kernel
     * @return static
     */
    public static function createFromKernel(Kernel $kernel)
    {
        return new static(
            $kernel->getClient(),
            $kernel->getConfig(),
            $kernel->getLogger(),
        );
    }

    /**
     * @return array
     */
    abstract protected function getClassMap(): array;

    public function __call($name, $arguments)
    {
        $classMap = $this->getClassMap();
        $handler  = new $classMap[$name](
            $this->http,
            $this->config,
            $this->logger
        );

        try {
            if ($handler instanceof OpenApiInterface) {
                return $handler->handle($arguments);
            } elseif ($handler instanceof HandlerInterface) {
                return $handler->handle($arguments);
            }
        }catch (Exception $exception) {
            if ($this->logger !== null) {
                $this->logger->errorFromException($exception);
            }
            throw $exception;
        }
    }
}
