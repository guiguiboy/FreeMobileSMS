<?php
/**
 * Created by PhpStorm.
 * User: gbretou
 * Date: 04/08/2015
 * Time: 14:28
 */

namespace FreeMobileSMS;

class Response
{
    /**
     * @var string
     */
    protected $status;

    /**
     * @var string
     */
    protected $message;

    /**
     * Ctor
     *
     * @param boolean $status
     * @param string  $message
     */
    public function __construct($status, $message)
    {
        if (!is_bool($status))
            throw new \InvalidArgumentException('Status must be boolean');
        $this->status  = $status;
        $this->message = $message;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }
}