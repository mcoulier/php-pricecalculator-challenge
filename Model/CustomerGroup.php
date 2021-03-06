<?php

class CustomerGroup
{
    private int $id;
    private string $name;
    private $parent_id;
    private $fixed_discount;
    private $variable_discount;

    /**
     * CustomerGroup constructor.
     * @param int $id
     * @param string $name
     * @param $parent_id
     * @param int $fixed_discoount
     * @param int $variable_discount
     */
    public function __construct(int $id, string $name, $parent_id, $fixed_discount, $variable_discount)
    {
        $this->id = $id;
        $this->name = $name;
        $this->parent_id = $parent_id;
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
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getParentId()
    {
        return $this->parent_id;
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