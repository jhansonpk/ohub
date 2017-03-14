<?php

namespace mvc\models;

/**
 * Class Book
 * @package models
 */
class FullStack
{
    protected $email;
	protected $address;


    /**
     * FullStack constructor.
     * @param int $email
     * @param string $address
     */
	public function __construct(int $email, string $address)
    {
        try
        {
            $this->setEmail($email);
            $this->setAddress($address);
        }
        catch (\Throwable $exception)
        {
            throw new $this('por favor, verifique a entrada dos dados.');
        }
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getAddress(): string
    {
        return $this->address;
    }

    /**
     * @param string $value
     */
    public function setEmail(string $value)
    {
        $this->email = $value;
    }

    public function setAddress(string $value)
    {
        $this->address = $value;
    }

}
