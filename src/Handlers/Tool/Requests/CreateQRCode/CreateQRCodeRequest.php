<?php

namespace Bytedance\Handlers\Tool\Requests\CreateQRCode;

use Bytedance\Kernel\Http\Request;
use Bytedance\Kernel\Http\Response;

class CreateQRCodeRequest extends Request
{
    protected function getParamNameWithDefault(): array
    {
        return [
            [
                'name'    => 'accessToken',
                'default' => '',
            ],
            [
                'name'    => 'appName',
                'default' => '',
            ],
            [
                'name'    => 'path',
                'default' => '',
            ],
            [
                'name'    => 'setIcon',
                'default' => false,
            ],
            [
                'name'    => 'width',
                'default' => 430,
            ],
            [
                'name'    => 'lineColor',
                'default' => '',
            ],
            [
                'name'    => 'background',
                'default' => '',
            ],
        ];
    }

    public static function format($response): Response
    {
        return CreateQRCodeResponse::create($response);
    }

    public function sendRequest($arguments)
    {
        [
            $accessToken,
            $appName,
            $path,
            $setIcon,
            $width,
            $lineColor,
            $background,
        ]
            = $arguments;

        $params = [
            'access_token' => $accessToken,
            'appname'      => $appName,
            'path'         => $path,
            'set_icon'     => $setIcon,
            'width'        => $width,
            'line_color'   => $lineColor,
            'background'   => $background,
        ];

        $params = array_filter($params);
        // print_r($params);
        // exit;
        return $this->http->post(
            'https://developer.toutiao.com/api/apps/qrcode',
            $params,
            [],
            false
        );
    }
}
