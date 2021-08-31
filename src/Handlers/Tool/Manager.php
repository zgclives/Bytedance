<?php declare(strict_types=1);


namespace Bytedance\Handlers\Tool;

use Bytedance\Handlers\Payment\Requests\QueryOrder\QueryOrderResponse;
use Bytedance\Handlers\Tool\Requests\CreateQRCode\CreateQRCodeRequest;
use Bytedance\Handlers\Tool\Requests\CreateQRCode\CreateQRCodeResponse;

/**
 * @method CreateQRCodeResponse createQRCode(string $accessToken, string $appName, ?string $path, ?int $width = 430, ?string $lineColor = '', ?string $background = '', bool $setIcon = false)
 * @method QueryOrderResponse queryOrder(string $outOrderNo, ?string $thirdPartyId = null)
 * @package Bytedance\Handlers\Tool
 */
class Manager extends \Bytedance\Kernel\Manager
{
    /** 今日头条 */
    const APP_TOUTIAO = 'toutiao';
    /** 抖音 */
    const APP_DOUYIN = 'douyin';
    /** 皮皮虾 */
    const APP_PIPIXIA = 'pipixia';
    /** 火山小视频 */
    const APP_HUOSHAN = 'huoshan';

    protected function getClassMap(): array
    {
        return [
            'createQRCode' => CreateQRCodeRequest::class,
        ];
    }
}
