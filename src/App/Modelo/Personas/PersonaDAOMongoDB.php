<?php

namespace App\Modelo\Personas;

use App\Modelo\Excepciones\MongoDBConexionIncorrectaException;
use App\Modelo\Excepciones\PersonaNoEncontradaException;
use App\Personas\Persona;
use MongoDB\Client;
use MongoDB\Collection;
use MongoDB\Database;
use Ramsey\Uuid\Uuid;

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
        //$this->coleccion->createIndex(["dni"=>1], ["unique"=>true]);
        $this->coleccion->createIndex(["email" => 1], ["unique" => true]);
    }

    public function insertarPersona(Persona $persona): ?Persona
    {
        var_dump($persona->jsonSerialize());
        $this->coleccion->insertOne($persona->__serialize());
        $id = Uuid::uuid4();
        var_dump($id);

        $this->coleccion->insertOne($persona->$this->convertirArrayAPersona());
        //$insertOneResult
        return $persona;
    }

    public function modificarPersona(Persona $persona): ?Persona
    {
        $resultado = $this->coleccion->updateOne(["dni" => $persona->getDNI()],
            [
                '$set' => [
                    "nombre" => $persona->getNombre(),
                    "apellidos" => $persona->getApellidos(),
                    "email" => $persona->getEmail(),
                    "telefono" => $persona->getTelefono(),
                    "contrasenya" => $persona->getContrasenya()
                ]
            ]
        );
        var_dump($resultado);
        if ($resultado->getModifiedCount()) {
            return $persona;
        } else {
            return null;
        }
    }

    public function modificarTodasLasPersonas(array $elementosAModificar)
    {
        $resultado = $this->coleccion->updateMany([],
            ['$set' => $elementosAModificar]
        );
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

    /**
     * @throws PersonaNoEncontradaException
     */
    public function obtenerRangoPersonas(int $inicio, int $numeroResultados = NUMERODERESULTADOSPORPAGINA): array
    {
        $consulta = $this->coleccion->find([], [
            'skip' => $inicio,
            'limit' => $numeroResultados
        ]);
        if ($consulta->valid()) {
            return $consulta->toArray();
        } else {
            throw new PersonaNoEncontradaException("No se puede encontrar el rango");
        }
    }

    protected function convertirArrayAPersona(array $datosPersona): ?Persona
    {
        if (!isset($datosPersona[strtolower('TELEFONO')]) || $datosPersona[strtolower('TELEFONO')] == null) {
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