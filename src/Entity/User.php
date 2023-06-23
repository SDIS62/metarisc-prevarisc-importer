<?php

namespace App\Entity;


class User
{

    private int $id;

    private string $username;

    private int $idMetarisc;

    public function __construct( string $username, int $idMetarisc)
    {
        $this->username = $username;
        $this->idMetarisc = $idMetarisc;
    }


    public function getIdMetarisc(): int
    {
        return $this->idMetarisc;
    }

    public function setIdMetarisc(int $idMetarisc): void
    {
        $this->idMetarisc = $idMetarisc;
    }



    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function setUsername(string $username): void
    {
        $this->username = $username;
    }


}
