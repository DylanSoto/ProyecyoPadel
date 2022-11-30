<?php

namespace App\Modelo\Personas;

use App\Modelo\Excepciones\MongoDBConexionIncorrectaException;
use App\Personas\Persona;
use MongoDB\Client;
use MongoDB\Collection;
use MongoDB\Database;

class PersonaDAOMongoDB extends PersonaDAO implements InterfazPersonas
{

    private Database $db;
    private Collection $coleccion;

    /**
     * @throws MongoDBConexionIncorrectaException
     */
    public function __construct()
    {
        if (!$this->setConexion(new Client("mongodb://root:example@mongo:27017"))) {
            throw new MongoDBConexionIncorrectaException();
        }
        $this->db = $this->getConexion()->padel;
        $this->coleccion = $this->db->persona;
    }

    public function insertarPersona(Persona $persona): ?Persona
    {
        //var_dump($persona->jsonSerialize());
        $this->coleccion->insertOne($persona->__serialize());
        return $persona;
    }

    public function modificarPersona(Persona $persona): ?Persona
    {
    }

    public function borrarPersona(Persona $persona): ?Persona
    {
    }

    public function borrarPersonaPorDNI(string $dni): ?Persona
    {
    }

    public function leerPersona(string $dni): ?Persona
    {
    }

    public function leerPersonaPorEmail(string $email): ?Persona
    {
    }

    public function leerTodasPersonas(): array
    {
        $arrayRetorno = [];
        $retorno = $this->coleccion->find();
        foreach ($retorno as $documento) {
            echo "<pre>";
            echo json_encode($documento->getArrayCopy(), JSON_PRETTY_PRINT);
            echo "</pre>";
            $arrayRetorno[] = $this->convertirArrayAPersona($documento->getArrayCopy());
        }
        return $arrayRetorno;
    }

    public function obtenerPersonasSinTelefono(): array
    {
    }

    public function obtenerPersonasPorNombre(string $nombre): array
    {
    }

    public function obtenerPersonasPorApellido(string $apellido): array
    {
    }

    public function obtenerRangoPersonas(int $inicio, int $numeroResultados = NUMERODERESULTADOSPORPAGINA): array
    {
    }

    protected function convertirArrayAPersona(array $datosPersona): ?Persona
    {
        if (!isset($datosPersona[strtolower('TELEFONO')]) || $datosPersona[strtolower('TELEFONO')] == NULL) {
            $datosPersona[strtolower('TELEFONO')] = '';
        }
        return new Persona(
            $datosPersona[strtolower('DNI')],
            $datosPersona[strtolower('NOMBRE')],
            $datosPersona[strtolower('APELLIDOS')],
            $datosPersona[strtolower('EMAIL')],
            $datosPersona[strtolower('CONTRASENYA')],
            $datosPersona[strtolower('TELEFONO')]
        );
    }
}