<?php

namespace EmailServicePHP\Client;

use EmailServicePHP\Client\Curl as ClientService;
use Exception;

/**
 * Class Client
 * @package EmailServicePHP\Client
 * @author Alfonso Rodriguez <beabys@gmail.com>
 */
class Client
{

    const HTML_CODE = 'html_code';
    const RESPONSE = 'response';

    /**
     * @var string
     */
    protected $user  = '';

    /**
     * @var string
     */
    protected $password = '';

    /**
     * @var string
     */
    protected $endpoint = '';

    /**
     * @var Curl
     */
    protected $curl;

    /**
     * @var array
     */
    protected $errorCodes = [
        401,
        400,
        500,
        'Undefined'
    ];

    /**
     * Client constructor.
     * @param $endpoint
     * @param $user
     * @param $password
     */
    public function __construct($endpoint, $user, $password)
    {
        $this->curl = new ClientService();
        $this->endpoint = $endpoint;
        $this->user = $user;
        $this->password = $password;
    }

    /**
     * @param array $params
     * @return Error|Success
     */
    public function send(array $params)
    {
        $error = false;
        try {
            $sendMessage = $this->curl->doCurl($params, $this->endpoint, $this->user, $this->password);
        } catch(Exception $e) {
            $error = true;
            $sendMessage = $e;
        }
        return $this->handleResult($sendMessage, $error);
    }

    /**
     * @param $response
     * @param $error
     * @return Error|Success
     */
    public function handleResult($response, $error)
    {
        $result = new Success();

        if ($error || in_array($response[self::HTML_CODE], $this->errorCodes)) {

            $result = new Error();

            if ($response[self::HTML_CODE] == 401) {
                $response[self::RESPONSE] = json_encode([
                     'SUCCESS' => false,
                     'status' => "error",
                     'errors' => [
                        'message' => "Unauthorized",
                        'code' => $response[self::HTML_CODE]
                     ]
                ]);
            }
        }
        $result->setMessage($response[self::RESPONSE]);
        return $result;
    }
}
