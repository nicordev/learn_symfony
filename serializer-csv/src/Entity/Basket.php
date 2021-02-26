<?php

namespace App\Entity;

class Basket
{
    private int $itemCount = 0;
    private array $fruits = [];

    public function getFruits(): array
    {
        return $this->fruits;
    }

    public function setFruits(array $fruits): self
    {
        $this->fruits = $fruits;

        foreach ($fruits as $fruit) {
            $this->itemCount += $fruit->getCount();
        }

        return $this;
    }

    public function addFruit(Fruit $fruit): self
    {
        $this->fruits[] = $fruit;
        $this->itemCount += $fruit->getCount();

        return $this;
    }

    public function getItemCount(): int
    {
        return $this->itemCount;
    }
}
