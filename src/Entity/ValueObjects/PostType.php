<?php


namespace Task\GetOnBoard\Entity\ValueObjects;


class PostType
{
    private string $type;

    /**
     * PostType constructor.
     * @param string $type
     */
    public function __construct($type = '')
    {
        $this->type =  $type;
    }

    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }

}