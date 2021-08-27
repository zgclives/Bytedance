<?php declare(strict_types=1);


namespace Bytedance\Kernel\Http;


use Bytedance\Kernel\Exceptions\RequestException;
use Bytedance\Kernel\Handler;

abstract class Request extends Handler implements OpenApiInterface
{
    abstract public function sendRequest($arguments): array;

    public function handle($arguments): Response
    {
        return parent::handle($arguments);
    }

    public function process($arguments): Response
    {
        $response = $this->sendRequest($arguments);

        if ($this->config->isDebug) {
            $this->logger->debug(json_encode($response));
        }

        $this->assertRequestSuccess($response);

        return static::format($response);
    }

    /**
     * assert request success
     * @param array $response
     * @throws RequestException
     */
    protected function assertRequestSuccess(array $response): void
    {
        $errorCode =  $response['error'] ?? $response['err_no'] ?? 0;
        $errMsg = $response['message'] ?? $response['err_tips'] ?? '';

        if ($errorCode !== 0) {
            throw new RequestException($errMsg);
        }
    }
}
