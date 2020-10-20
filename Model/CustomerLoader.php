<?php


class CustomerLoader
{
    private array $customers = [];

    /**
     * CustomerLoader constructor.
     * @param array $customers
     */
    public function __construct(array $customers)
    {
        $this->customers = $customers;
    }


}