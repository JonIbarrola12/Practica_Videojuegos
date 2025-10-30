<?php 
    class Trabajador {
        //Atributos
        private int $TrabajadorId;
        private string $Nombre;
        private string $Apellidos;
        private string $Dni;
        private DateTime $FechaNacimiento;
        private string $Email;
        private string $Usuario;
        private string $Contrasena;
        private int $TiendaId;

        //Constructor
        public function __construct(int $pTrabajadorId = null, string $pNombre = "", string $pApellidos = "",string $pDni = "", DateTime $pFechaNacimiento = new DateTime(), string $pEmail = "", string $pUsuario = "", string $pContrasena = "", int $pTiendaId = null) {
            $this->TrabajadorId = $pTrabajadorId;
            $this->Nombre = $pNombre;
            $this->Apellidos = $pApellidos;
            $this->Dni = $pDni;
            $this->FechaNacimiento = $pFechaNacimiento;
            $this->Email = $pEmail;
            $this->Usuario = $pUsuario;
            $this->Contrasena = $pContrasena;
            $this->TiendaId = $pTiendaId;
        }
        
        //Getters y Setters
        public function getTrabajadorId(){
            return $this->TrabajadorId;
        }
        public function setTrabajadorId(int $pTrabajadorId){
            $this->TrabajadorId = $pTrabajadorId;
        }

        public function getNombre(){
            return $this->Nombre;
        }
        public function setNombre(string $pNombre){
            $this->Nombre = $pNombre;
        }

        public function getApellidos(){
            return $this->Apellidos;
        }
        public function setApellidos(string $pApellidos){
            $this->Apellidos = $pApellidos;
        }

        public function getDni(){
            return $this->Dni;
        }
        public function setDni(string $pDni){
            $this->Dni = $pDni;
        }

        public function getFechaNacimiento(){
            return $this->FechaNacimiento;
        }
        public function setFechaNacimiento(DateTime $pFechaNacimiento){
            $this->FechaNacimiento = $pFechaNacimiento;
        }

        public function getEmail(){
            return $this->Email;
        }
        public function setEmail(string $pEmail){
            $this->Email = $pEmail;
        }

        public function getUsuario(){
            return $this->Usuario;
        }
        public function setUsuarios(string $pUsuario){
            $this->Usuario = $pUsuario;
        }

        public function getContrasena(){
            return $this->Contrasena;
        }
        public function setContrasena(string $pContrasena){
            $this->Contrasena = $pContrasena;
        }
        
        public function getTiendaId(){
            return $this->TiendaId;
        }
        public function setTiendaId(int $pTiendaId){
            $this->TiendaId = $pTiendaId;
        }
    }