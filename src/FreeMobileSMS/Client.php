<?php
/**
 * Created by PhpStorm.
 * User: gbretou
 * Date: 04/08/2015
 * Time: 13:45
 */

namespace FreeMobileSMS;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\RequestException;

class Client
{
    /**
     * Service API URL
     */
    const BASE_URI = 'https://smsapi.free-mobile.fr/sendmsg';

    /**
     * @var string
     */
    protected $login;

    /**
     * @var string
     */
    protected $password;

    /**
     * @var GuzzleClient
     */
    protected $driver;

    /**
     * @param string $login
     * @param string $password
     */
    public function __construct($login, $password)
    {
        $this->login    = $login;
        $this->password = $password;
        $this->driver   = new GuzzleClient();
    }

    /**
     * Sets the driver (must be an instance of GuzzleHttp\Client because it rocks)
     *
     * @param GuzzleClient $driver
     */
    public function setDriver(GuzzleClient $driver)
    {
        $this->driver = $driver;
    }

    /**
     * Sends a message to the user
     *
     * @param string $message
     *
     * @return Response
     */
    public function send($message)
    {
        try
        {
            $response = $this->driver->get(self::BASE_URI, [
                'query' => [
                    'user' => $this->login,
                    'pass' => $this->password,
                    'msg'  => $message,
                ]
            ]);
            return new Response(true, '');
        }
        catch (RequestException $e)
        {
            return new Response(false, $e->getMessage());
        }
    }
}