<?php

namespace Task\GetOnBoard\Entity;

use Task\GetOnBoard\Entity\ValueObjects\DomainId;

class Comment extends DomainId
{
    private $text;

    public function setText($text)
    {
        $this->text = $text;
    }

    public function getText()
    {
        return $this->text;
    }
}
