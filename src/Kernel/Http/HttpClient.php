<?php declare(strict_types=1);


namespace Bytedance\Kernel\Http;


use Bytedance\Utils\Encrypt\Payment\RequestSigner;
use Psr\Http\Client\ClientInterface;

class HttpClient
{
    /**
     * get request
     * @param string $uri
     * @param array $queries
     * @param array $headers
     * @return array
     */
    public function get(string $uri, array $queries = [], array $headers = []): array
    {
        $ch    = curl_init();
        $query = http_build_query($queries);
        curl_setopt($ch, CURLOPT_URL, "$uri?$query");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $output = curl_exec($ch);
        curl_close($ch);

        return json_decode($output, true);
    }

    /**
     * post request
     * @param string $uri
     * @param array $params
     * @param array $headers
     * @param bool $format
     * @return array|string
     */
    public function post(string $uri, array $params = [], array $headers = [], bool $format = true)
    {
        $headers[] = 'Content-type: application/json';

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $uri);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));

        $output = curl_exec($ch);
        curl_close($ch);

        return $format ? json_decode($output, true) : $output;
    }

    /**
     * @param string $salt
     * @param string $uri
     * @param array $params
     * @param array $headers
     * @return array
     */
    public function postWithPaymentSignature(
        string $salt,
        string $uri,
        array $params = [],
        array $headers = []
    ): array
    {
        $params = array_filter($params);
        $params['sign'] = RequestSigner::signature($params, $salt);
        return self::post($uri, $params, $headers);
    }
}
