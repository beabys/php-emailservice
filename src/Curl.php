<?php

namespace EmailServicePHP\Client;

use Exception;

/**
 * Class Curl
 * @package EmailServicePHP\Client
 */
class Curl
{

    const UNDEFINED = 'Undefined';
    /**
     * @param $content
     * @param $endpoint
     * @param $username
     * @param $password
     * @return mixed
     * @throws Exception
     */
    public function doCurl($content, $endpoint, $username, $password)
    {
        $dataString = json_encode($content);
        $headers = [
            'Connection: Keep-Alive',
            'Content-Type: application/json',
            'Content-Length: ' . strlen($dataString),
        ];

        $cURL = curl_init();

        curl_setopt($cURL, CURLOPT_URL, $endpoint);
        curl_setopt($cURL, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($cURL, CURLOPT_TIMEOUT, 30);
        curl_setopt($cURL, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($cURL, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($cURL, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($cURL, CURLOPT_POST, 1);
        curl_setopt($cURL, CURLOPT_POSTFIELDS, $dataString);
        if (
            ($username && $username != '') &&
            ($password && $password != '')
        ) {
            curl_setopt($cURL, CURLOPT_USERPWD, $username . ":" . $password);
        }

        try {
            $response = curl_exec($cURL);
            if($errno = curl_errno($cURL)) {
                $error_message = curl_strerror($errno);
                throw new Exception("cURL error ({$errno}):\n {$error_message}");
            }
            $responseCode = curl_getinfo($cURL, CURLINFO_HTTP_CODE);
            $response = [
                'html_code' => $responseCode,
                'response' => $response
            ];
            curl_close($cURL);
        } catch (Exception $e) {
            $response = [
                'html_code' => self::UNDEFINED,
                'response' => $e
            ];
        }
        return $response;
    }
}
