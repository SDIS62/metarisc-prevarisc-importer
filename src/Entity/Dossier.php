<?php

namespace App\Entity;

class Dossier
{

    private int $id;

    private bool $est_importe;

    private int $idprevarisc;

    /**
     * @param int $id
     * @param bool $est_importe
     * @param int $idprevarisc
     */
    public function __construct(int $id,  bool $est_importe, int $idprevarisc)
    {
        $this->id =$id;
        $this->est_importe = $est_importe;
        $this->idprevarisc = $idprevarisc;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return bool
     */
    public function isEstImporte(): bool
    {
        return $this->est_importe;
    }

    /**
     * @param bool $est_importe
     */
    public function setEstImporte(bool $est_importe): void
    {
        $this->est_importe = $est_importe;
    }

    /**
     * @return int
     */
    public function getIdprevarisc(): int
    {
        return $this->idprevarisc;
    }

    /**
     * @param int $idprevarisc
     */
    public function setIdprevarisc(int $idprevarisc): void
    {
        $this->idprevarisc = $idprevarisc;
    }




}