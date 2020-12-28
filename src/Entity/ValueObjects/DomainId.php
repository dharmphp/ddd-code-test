<?php


namespace Task\GetOnBoard\Entity\ValueObjects;


abstract class DomainId
{
    private string $id;

    /**
     * DomainId constructor.
     */
    public function __construct()
    {
        $this->id =  uniqid();
    }

    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId(string $id): void
    {
        $this->id = $id;
    }

}