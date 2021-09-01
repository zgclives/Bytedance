<?php

namespace Bytedance\Handlers\Tool\Requests\SubscribedMessage;

use Bytedance\Kernel\Http\Request;
use Bytedance\Kernel\Http\Response;

class SendSubscribedMessageRequest extends Request
{
    protected function getParamNameWithDefault(): array
    {
        return [
            [
                'name'    => 'accessToken',
                'default' => '',
            ],
            [
                'name'    => 'tplId',
                'default' => '',
            ],
            [
                'name'    => 'openId',
                'default' => '',
            ],
            [
                'name'    => 'data',
                'default' => [],
            ],
            [
                'name'    => 'page',
                'default' => '',
            ],
        ];
    }

    public static function format($response): Response
    {
        return SendSubscribedMessageResponse::create($response);
    }

    public function sendRequest($arguments)
    {
        [
            $accessToken,
            $tplId,
            $openId,
            $data,
            $page
        ]
            = $arguments;

        $params = [
            'access_token' => $accessToken,
            'app_id'       => $this->config->appId,
            'tpl_id'       => $tplId,
            'open_id'      => $openId,
            'data'         => $data,
        ];

        if ($page) {
            $params['page'] = $page;
        }

        $params = array_filter($params);
        return $this->http->post(
            'https://developer.toutiao.com/api/apps/subscribe_notification/developer/v1/notify',
            $params,
            []
        );
    }
}
