<?php declare(strict_types=1);


namespace Bytedance\Kernel;


use Bytedance\Kernel\Http\HttpClient;
use Bytedance\Kernel\Log\Logger;

abstract class Handler implements HandlerInterface
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

    abstract public function process($arguments);

    /**
     * @param $arguments
     * @return mixed
     */
    public function handle($arguments)
    {
        return $this->process(
            $this->getCompletedParam($arguments)
        );
    }

    /**
     * @return array [['name' => 'test', 'default' => null]]
     */
    abstract protected function getParamNameWithDefault(): array;

    /**
     * 获取补全的参数
     * @param array $arguments
     * @return array
     */
    public function getCompletedParam(array $arguments): array
    {
        $shouldParams = $this->getParamNameWithDefault();
        if (count($shouldParams) === 0) {
            return $arguments;
        }

        $result = [];
        foreach ($shouldParams as $key => $shouldParam) {
            if (isset($arguments[$key])) {
                $result[$key] = $arguments[$key];
            } else if (isset($arguments[$shouldParam['name']])) {
                //兼容8.0可选参数
                $result[$key] = $arguments[$shouldParam['name']];
            } else {
                $result[$key] = $shouldParam['default'];
            }
        }

        return $result;
    }
}
