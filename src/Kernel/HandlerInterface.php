<?php


namespace Bytedance\Kernel;


interface HandlerInterface
{
    /**
     * @return mixed
     */
    public function handle($arguments);

    /**
     * 补全参数
     * @param array $arguments
     * @return array
     */
    public function getCompletedParam(array $arguments): array;
}
