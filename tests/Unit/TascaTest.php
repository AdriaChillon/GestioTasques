<?php

namespace Tests\Unit;

use Tests\TestCase; // Cambiar según necesidad
use App\Models\Tasca;
use Carbon\Carbon; // Uso de Carbon para manejar fechas

class TascaTest extends TestCase
{
    public function test_constructor_de_tasca(): void
    {
        $tasca = new Tasca("Tasca1", "Descripció", Carbon::parse("2021-01-01"));
        $this->assertEquals("Tasca1", $tasca->getTitol());
        $this->assertEquals("Descripció", $tasca->getDescripcio());
        $this->assertEquals("Pendent", $tasca->getEstat());
        $this->assertTrue($tasca->getEstat() == "Pendent");
    }

    public function test_setEstat(): void
    {
        $tasca = new Tasca("Tasca1", "Descripció", Carbon::parse("2021-01-01"));
        $tasca->setEstat("Acabada");
        $this->assertEquals("Acabada", $tasca->getEstat());
    }

    public function test_toString(): void
    {
        $tasca = new Tasca("Tasca1", "Descripció", Carbon::parse("2021-01-01"));
        // Asegúrate de que el método __toString() de Tasca formatea la fecha correctamente
        $this->assertEquals("Tasca1 Descripció 2021-01-01", $tasca->__toString());
    }
}
