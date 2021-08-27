<?php declare(strict_types=1);


namespace Bytedance;


use Bytedance\Kernel\Config;
use Bytedance\Kernel\Exceptions\InvalidClassException;
use Bytedance\Kernel\Http\HttpClient;
use Bytedance\Kernel\Kernel;
use Bytedance\Kernel\Manager;
use Psr\Log\LoggerInterface;
use Psr\SimpleCache\CacheInterface;

/**
 * @property-read Handlers\Login\Manager $login
 * @property-read Handlers\Payment\Manager $payment
 * @property-read Utils\Encrypt\Manager $encrypt
 * @package BytedanceMiniApp
 */
class BytedanceApp
{
    protected $classMap = [
        'login' => Handlers\Login\Manager::class,
        'encrypt' => Utils\Encrypt\Manager::class,
        'payment' => Handlers\Payment\Manager::class,
    ];

    protected $objectPool = [];

    protected $kernel;

    public function __construct(
        string $appId,
        string $secret,
        string $salt,
        string $token,
        ?LoggerInterface $logger = null,
        ?CacheInterface $cache = null,
        bool $isDebug = false,
        HttpClient $http = null
    )
    {
        $this->kernel = (new Kernel(
            $http ?? new HttpClient(),
            new Config(
                $appId,
                $secret,
                $salt,
                $token,
                $isDebug
            )
        ))
            ->withLoggerFormLoggerInterface($logger)
            ->withCache($cache);
    }

    protected function getInstance(string $name): Manager
    {
        if (!isset($this->classMap[$name])) {
            throw new InvalidClassException('BytedanceApp exception: not found class');
        }

        return $this->classMap[$name]::createFromKernel($this->kernel);
    }

    public function __get($name)
    {
        return $this->objectPool[$name] ?? $this->getInstance($name);
    }
}
