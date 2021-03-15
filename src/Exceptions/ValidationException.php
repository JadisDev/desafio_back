<?php

namespace App\Exceptions;

/**
 * @package Sistema\Exception
 */
class ValidationException extends \Exception implements \JsonSerializable
{
    protected $data;

    public function __construct($message = '', $code = 0, \Exception $previous = null,  $data = null)
    {
        parent::__construct($message, $code, $previous);
        $this->data = $data;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }

    /**
     *
     * @return array|mixed
     */
    public function jsonSerialize()
    {
        return array(
            "code"      => $this->code,
            "message"   => $this->message,
            "data"     => $this->data,
            "request"   => $_REQUEST
        );
    }

    /**
     * @return mixed|null
     */
    public function getData()
    {
        return $this->data;
    }

}