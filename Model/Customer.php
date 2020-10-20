<?php

class Customer{

    private string $firstname;
    private string $lastname;
    private int $group_id;
    private int $fixed_discount;
    private int $variable_discount;

    /**
     * Customer constructor.
     * @param string $firstname
     * @param string $lastname
     * @param string $group_id
     * @param string $fixed_discount
     * @param string $variable_discount
     */
    public function __construct(string $firstname, string $lastname, int $group_id, int $fixed_discount, int $variable_discount)
    {
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->group_id = $group_id;
        $this->fixed_discount = $fixed_discount;
        $this->variable_discount = $variable_discount;
    }

    /**
     * @return string
     */
    public function getFirstname(): string
    {
        return $this->firstname;
    }

    /**
     * @return string
     */
    public function getLastname(): string
    {
        return $this->lastname;
    }

    /**
     * @return string
     */
    public function getGroupId(): int
    {
        return $this->group_id;
    }

    /**
     * @return string
     */
    public function getFixedDiscount(): int
    {
        return $this->fixed_discount;
    }

    /**
     * @return string
     */
    public function getVariableDiscount(): int
    {
        return $this->variable_discount;
    }



}