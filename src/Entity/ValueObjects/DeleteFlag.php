<?php


namespace Task\GetOnBoard\Entity\ValueObjects;


class DeleteFlag
{
    private bool $deleted;

    /**
     * DeleteFlag constructor.
     * @param bool $deleted
     */
    public function __construct($deleted = false)
    {
        $this->deleted =  $deleted;
    }

    public function getDeleted()
    {
        return $this->deleted;
    }

    /**
     * @param bool $deleted
     */
    public function setDeleted(bool $deleted): void
    {
        $this->deleted = $deleted;
    }

}