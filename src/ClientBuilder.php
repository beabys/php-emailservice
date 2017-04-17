<?php
namespace EmailServicePHP\Client;

/**
 * Class ClientBuilder
 * @package EmailServicePHP\Client
 * @author Alfonso Rodriguez <beabys@gmail.com>
 */
class ClientBuilder
{

    protected $endpoint;

    protected $user;

    protected $password;

    /**
     * @return mixed
     */
    public function getEndpoint()
    {
        return $this->endpoint;
    }

    /**
     * @param $endpoint
     * @return $this
     */
    public function setEndpoint($endpoint)
    {
        $this->endpoint = $endpoint;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param $user
     * @return $this
     */
    public function setUser($user)
    {
        $this->user = $user;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param $password
     * @return $this
     */
    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @return Client
     */
    public function build()
    {
        $client = new Client(
            $this->getEndpoint(),
            $this->getUser(),
            $this->getPassword()
        );
        return $client;
    }
}
