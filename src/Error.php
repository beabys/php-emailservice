<?php

namespace EmailServicePHP\Client;

/**
 * Class Error
 * @package EmailServicePHP\Client
 * @author Alfonso Rodriguez <beabys@gmail.com>
 */
class Error
{

    const GENERIC = 'Error in transaction';
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
     * @param null $message
     */
    public function setMessage($message = null)
    {
        if (!$message) {
            $this->message = self::GENERIC;
        } else {
            $this->message = $message;
        }
    }



}