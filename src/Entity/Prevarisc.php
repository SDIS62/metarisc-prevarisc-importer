<?php

namespace App\Entity;

class Prevarisc
{

    private int $id;

    private string $adresseip;

    private string $port;

    private string $driver;

    /**
     * @param string $adresseip
     * @param string $port
     * @param string $driver
     */
    public function __construct( string $adresseip, string $port, string $driver)
    {
        $this->adresseip = $adresseip;
        $this->port = $port;
        $this->driver = $driver;
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
    public function getAdresseip(): string
    {
        return $this->adresseip;
    }

    /**
     * @param string $adresseip
     */
    public function setAdresseip(string $adresseip): void
    {
        $this->adresseip = $adresseip;
    }

    /**
     * @return int
     */
    public function getPort(): int
    {
        return $this->port;
    }

    /**
     * @param int $port
     */
    public function setPort(string $port): void
    {
        $this->port = $port;
    }

    /**
     * @return string
     */
    public function getDriver(): string
    {
        return $this->driver;
    }

    /**
     * @param string $driver
     */
    public function setDriver(string $driver): void
    {
        $this->driver = $driver;
    }


}