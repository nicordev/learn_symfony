<?php

namespace App\Dto;

class CustomerBasketDto
{
    private string $firstName;
    private string $lastName;
    private string $email;
    private string $fruits;

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getFruits(): string
    {
        return $this->fruits;
    }

    public function setFruits(string $fruits): self
    {
        $this->fruits = $fruits;

        return $this;
    }
}