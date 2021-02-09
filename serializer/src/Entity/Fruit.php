<?php

namespace App\Entity;

class Fruit
{
    private string $name;
    private int $count;

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setCount(string $count): self
    {
        $this->count = $count;

        return $this;
    }

    public function getCount(): string
    {
        return $this->count;
    }
}
