<?php

namespace Tests\Unit;

use App\Models\GestorDeTasques;
use App\Models\Tasca;
use Carbon\Carbon;
use Tests\TestCase;
use App\Exceptions\TascaNotExistException;

class GestorDeTasquesTest extends TestCase
{
    public function test_construct_gestorDeTasques(): void
    {
        $gestorDeTasques = new GestorDeTasques();
        $this->assertEquals([], $gestorDeTasques->llistarTasques());
        $this->assertEmpty($gestorDeTasques->llistarTasques());
    }

    public function test_llistat_not_empty_gestorDeTasques(): void
    {
        $gestorDeTasques = new GestorDeTasques();
        $gestorDeTasques->afegirTasca("Tasca1", "Descripció", Carbon::parse("2021-01-01"));
        $this->assertNotEmpty($gestorDeTasques->llistarTasques());
    }

    public function test_validar_afegirTasca_gestorDeTasques(): void
    {
        $gestorDeTasques = new GestorDeTasques();
        $gestorDeTasques->afegirTasca("Tasca1", "Descripció", Carbon::parse("2021-01-01"));

        $this->assertEquals(1, count($gestorDeTasques->llistarTasques()));

        $array = [];
        $array[] = new Tasca("Tasca1", "Descripció", Carbon::parse("2021-01-01"));
        // Asegúrate de que Tasca implemente un método adecuado para comparar igualdad si es necesario
        $this->assertEquals($array, $gestorDeTasques->llistarTasques());
    }

    public function test_eliminarTasca_gestorDeTasques(): void
    {
        $gestorDeTasques = new GestorDeTasques();
        $gestorDeTasques->afegirTasca("Tasca1", "Descripció", Carbon::parse("2021-01-01"));
        $gestorDeTasques->afegirTasca("Tasca2", "Descripció", Carbon::parse("2021-01-01"));

        $gestorDeTasques->eliminarTasca("Tasca2");
        $this->assertCount(1, $gestorDeTasques->llistarTasques());
    }

    public function test_eliminarTasca_notexist_gestorDeTasques(): void
    {
        $this->expectException(TascaNotExistException::class);
        $gestorDeTasques = new GestorDeTasques();
        $gestorDeTasques->afegirTasca("Tasca1", "Descripció", Carbon::parse("2021-01-01"));
        $gestorDeTasques->afegirTasca("Tasca2", "Descripció", Carbon::parse("2021-01-01"));

        $gestorDeTasques->eliminarTasca("Tasca3");
    }

    public function test_gestorTasques_actualitzarEstatTasca(): void
    {
        $gestorTasques = new GestorDeTasques();
        $gestorTasques->afegirTasca("Tasca 1", "Descripció de la tasca 1", Carbon::parse("2021-10-10"));
        $gestorTasques->afegirTasca("Tasca 2", "Descripció de la tasca 2", Carbon::parse("2021-06-02"));
        $gestorTasques->afegirTasca("Tasca 3", "Descripció de la tasca 3", Carbon::parse("2021-03-09"));

        $gestorTasques->actualitzarEstatTasca("Tasca 2", "Acabat");
        // Asumiendo que Tasca tiene métodos getEstat y que el estado predeterminado es "Pendent"
        $this->assertEquals("Acabat", $gestorTasques->llistarTasques()[1]->getEstat());
        $this->assertEquals("Pendent", $gestorTasques->llistarTasques()[0]->getEstat());
    }
}
