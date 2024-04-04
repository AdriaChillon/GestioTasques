<?php

namespace app\Models;
use Exception;


use Illuminate\Support\Facades\Date;

class Tasca
{
    private String $titol;
    private String $descripcio;
    private Date $dataLimit;
    private String $estat;


    public function _construct(String $titol, String $descripcio, Date $dataLimit, String $estat = "Pendent")
    {
        if (($titol == null || empty($titol)) && ($descripcio == null || empty($descripcio)) && ($estat == null || empty($estat))) {
            throw new Exception("Les dades no poden estar buides!");
        } else {
            $this->titol = $titol;
            $this->descripcio = $descripcio;
            $this->dataLimit = $dataLimit;
            $this->estat = $estat;
        }
    }

    public function __toString()
    {
        return "Titol: " . $this->titol . " Descripció: " . $this->descripcio . " Data Límit: " . $this->dataLimit . " Estat: " . $this->estat;
    }

    public function getTitol(): String
    {
        return $this->titol;
    }

    public function getDescripcio(): String
    {
        return $this->descripcio;
    }

    public function getDataLimit(): Date
    {
        return $this->dataLimit;
    }

    public function getEstat(): String
    {
        return $this->estat;
    }
    public function setEstat(String $estat)
    {
        $this->estat = $estat;
    }
}
