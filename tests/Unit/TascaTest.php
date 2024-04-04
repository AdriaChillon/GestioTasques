<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Models\Tasca;
use Illuminate\Support\Facades\Date;

class TascaTest extends TestCase
{
    public function test_contractor_de_tasca(): void
    {
    $tasca = new Tasca("Tasca1","Descripció",new Date("2021-01-01"));
    $this->assertEquals("Tasca1",$tasca->getTitol());
    $this->assertEquals("Descripció",$tasca->getDescripcio());
    $this->assertEquals($tasca->getEstat(), "Pendent");
    $this->assertTrue($tasca->getEstat() == "Pendent");

    }

    public function test_setEstat() {
        $tasca = new Tasca("Tasca1","Descripció",new Date("2021-01-01"));
        $tasca->setEstat("Acabada");
        $this->assertEquals("Acabada",$tasca->getEstat());
    }

    public function test_toString() {
        $tasca = new Tasca("Tasca1","Descripció",new Date("2021-01-01"));
        $this-> assertEquals("Tasca1 Descripció 2021-01-01", $tasca->__toString());
    }

}