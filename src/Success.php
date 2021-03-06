<?php

namespace EmailServicePHP\Client;

/**
 * Class Success
 * @package EmailServicePHP\Client
 * @author Alfonso Rodriguez <beabys@gmail.com>
 */
class Success
{

    const GENERIC = 'Message Sent';
    /**
     * @var string
     */
    protected $message;

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param string $message
     */
    public function setMessage($message = self::GENERIC)
    {
        $this->message = $message;
    }



}