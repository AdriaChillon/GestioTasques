<?php

namespace Tests\Unit;

use App\Models\TascaNotExistException;
use Exception;
use PHPUnit\Framework\TestCase;
use App\Models\GestorDeTasques;
use App\Models\Tasca;
use Illuminate\Support\Facades\Date;

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
    $gestorDeTasques->afegirTasca("Tasca1","Descripció",new Date("2021-01-01"));
    $this->assertNotEquals([], $gestorDeTasques->llistarTasques());
    $this->assertNotEmpty($gestorDeTasques->llistarTasques());
    }

    public function test_validar_afegirTasca_gestorDeTasques() {
        $gestorDeTasques = new GestorDeTasques();
        $gestorDeTasques->afegirTasca("Tasca1","Descripció",new Date("2021-01-01"));
        $this->assertEquals(1, count($gestorDeTasques->llistarTasques()));
        
        $array = [];
        $array[] = new Tasca("Tasca1","Descripció",new Date("2021-01-01"));
        $this->assertEquals($array,$gestorDeTasques->llistarTasques());
    }

    public function test_eliminarTasca_gestorDeTasques(){
        $gestorDeTasques = new GestorDeTasques();
        $gestorDeTasques->afegirTasca("Tasca1","Descripció",new Date("2021-01-01"));
        $gestorDeTasques->afegirTasca("Tasca2","Descripció",new Date("2021-01-01"));

        $this->assertEquals(2, count($gestorDeTasques->llistarTasques()));
        $gestorDeTasques->eliminarTasca("Tasca2");
        $this->assertEquals(1, count($gestorDeTasques->llistarTasques()));

    }
    
    public function test_eliminarTasca_notexist_gestorDeTasques(){
        $gestorDeTasques = new GestorDeTasques();
        $gestorDeTasques->afegirTasca("Tasca1","Descripció",new Date("2021-01-01"));
        $gestorDeTasques->afegirTasca("Tasca2","Descripció",new Date("2021-01-01"));

        $this->assertEquals(2, count($gestorDeTasques->llistarTasques()));
        
        try{
            $gestorDeTasques->eliminarTasca("Tasca3");
            $this->fail("No ha saltat l'excepció");
        }catch(TascaNotExistException $e) {
            $this->assertEquals("No existeix camp tasca amb aquest títol",$e->getMessage());
        }

    }

    public function test_gestorTasques_actualitzarEstatTasca(): void
    {
        $gestorTasques = new GestorDeTasques();
        $gestorTasques->afegirTasca("Tasca 1", "Descripció de la tasca 1", new Date("2021-10-10"));
        $gestorTasques->afegirTasca("Tasca 2", "Descripció de la tasca 2", new Date("2021-06-02"));
        $gestorTasques->afegirTasca("Tasca 3", "Descripció de la tasca 3", new Date("2021-03-09"));
        $gestorTasques->actualitzarEstatTasca("Tasca 2", "Acabat");
        $this->assertEquals("Acabat", $gestorTasques->llistarTasques()[1]->getEstat());
        $this->assertEquals("Pendent", $gestorTasques->llistarTasques()[0]->getEstat());
    }

}