<?php

namespace Controlador\Personas;

use Modelo\Personas\PersonaDAO;
use Modelo\Personas\PersonaDAOMySQL;
use Vistas\Personas\PersonaVista;

class PersonaControlador
{
    private PersonaDAO $modelo;
    private PersonaVista $vista;

    /**
     * @param PersonaDAO $modelo
     * @param PersonaVista $vista
     */
    public function __construct()
    {
        $this->modelo = new PersonaDAOMySQL();
        //$this->vista = new PersonaVista();
    }

    public function comprobarUsuarioWeb($email, $pass)
    {
        $persona = $this->modelo->leerPersonaPorEmail($email);
        password_verify($pass, $persona->getContrasenya());
    }

    /**
     * @return PersonaVista
     */
    public function getVista(): PersonaVista
    {
        return $this->vista;
    }

    /**
     * @param PersonaVista $vista
     */
    public function setVista(PersonaVista $vista): PersonaControlador
    {
        $this->vista = $vista;
        return $this;
    }


}