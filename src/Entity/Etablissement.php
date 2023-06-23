<?php

namespace App\Entity;

class Etablissement
{

    private int $id;

    private bool $est_importe;

    private int $idprevarisc;

    /**
     * @param int $id
     * @param bool $est_importe
     * @param int $idprevarisc
     */
    public function __construct( bool $est_importe, int $idprevarisc)
    {
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
    public function IsImporte(): bool
    {
        if ($this->est_importe==0){
            return false;
        }
            return true;
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
    public function getIdPrevarisc(): int
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