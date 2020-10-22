<?php

declare(strict_types=1);

class Customer
{
    private int $id;
    private string $firstname;
    private string $lastname;
    private int $group_id;
    private $fixed_discount;
    private $variable_discount;

    /**
     * Customer constructor.
     * @param int $id
     * @param string $firstname
     * @param string $lastname
     * @param int $group_id
     * @param int $fixed_discount
     * @param int $variable_discount
     */
    public function __construct(int $id, string $firstname, string $lastname, int $group_id, $fixed_discount, $variable_discount)
    {
        $this->id = $id;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->group_id = $group_id;
        $this->fixed_discount = $fixed_discount;
        $this->variable_discount = $variable_discount;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
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
     * @return int
     */
    public function getGroupId(): int
    {
        return $this->group_id;
    }

    /**
     * @return int
     */
    public function getFixedDiscount()
    {
        return $this->fixed_discount;
    }

    /**
     * @return int
     */
    public function getVariableDiscount()
    {
        return $this->variable_discount;
    }

}
