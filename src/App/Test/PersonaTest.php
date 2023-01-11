<?php

namespace App\Test;

use App\Personas\Persona;
use function PHPUnit\Framework\assertArrayNotHasKey;
use function PHPUnit\Framework\assertEquals;

class PersonaTest extends \PHPUnit\Framework\TestCase
{
    public function testMostrarDatosPersona()
    {
        $persona = new Persona('45931347A', "Adios", "Como Tamos", "comotamos3@gmail.com", "12354", "956789425");

        assertEquals("Adios Como Tamos 45931347A", $persona->__toString());

    }

    public function testCheckNotConvertPassToJSON()
    {
        $persona = new Persona('45931347A', "Adios", "Como Tamos", "comotamos3@gmail.com", "12354", "956789425");

        assertArrayNotHasKey("contrasenya", $persona->jsonSerialize());
    }
}