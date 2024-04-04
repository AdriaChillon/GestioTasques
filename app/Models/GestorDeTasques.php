<?php

namespace App\Models;

use Illuminate\Support\Facades\Date;
use App\Models\Tasca;
use Exception;

class GestorDeTasques
{
    private array $tasques;

    public function __contrsuct()
    {
        $this->tasques = array();
    }

    /**
     * Función per afegir una tasca a l'array de tasques d'aquesta clase de gestor de tasques
     * @param string $titol
     * @param string $descripcio
     * @param string $dataLimit
     * @return void
     * 
     */
    public function afegirTasca(String $titol, String $descripcio, Date $dataLimit)
    {
        $tasca = new Tasca($titol, $descripcio, $dataLimit);
        $this->tasques[] = $tasca;
    }

    /**
     * Función para eliminar una tasca de dentro del array de tasques, en base a un título,
     *  si no se borra nada porque el título no existe, salta una excepción avisando del problema
     * @param string $titol
     * @throws Exception 
     * @return void
     */
    public function eliminarTasca(String $titol)
    {
        $isDeleted = false;
        foreach ($this->tasques as $tasca) {
            if (strtolower($tasca->getTitol()) == strtolower($titol)) {
                unset($tasca);
                $isDeleted = true;
            }
        }
        if (!$isDeleted) {
            throw new Exception("No existeix cap tasca amb aquest títol");
        }
    }

    /**
     * Función para actualizar el estat de una tasca a partir de un titulo que nos pasan
     * @param string $titol
     * @param string $estat
     * @return void
     */
    public function actualitzarEstatTasca(String $titol, String $estat)
    {
        foreach ($this->tasques as $tasca) {
            if ($tasca->getTitol() == $titol) {
                $tasca->setEstat($estat);
            }
        }
    }
    public function llistarTasques(): array
    {
        return $this->tasques;
    }
}
class TascaNotExistException extends Exception
{
    public function __construct($message)
    {
        parent::__construct($message);
    }
}
