<?php
    class Videojuego{
        //Atributos
        private int $VideojuegoId;
        private string $Tilulo;
        private int $AnioPublicacion;
        private string $EstudioDesarrollo;
        private string $Plataforma;

        //Constructor
        public function __construct(int $pVideojuegoId = null, string $pTilulo = "", int $pAnioPublicacionstring = 0, string $pEstudioDesarrollo = "", string $pPlataforma = "" ) {
            $this->VideojuegoId = $pVideojuegoId;
            $this->Tilulo = $pTitulo;
            $this->AnioPublicacion = $pAnioPublicacion;
            $this->EstudioDesarrollo = $pEstudioDesarrollo;
            $this->Plataforma = $pPlataforma;
        }
        //Getters y Setters
        public function getVideojuegoId(){
            return $this->VideojuegoId;
        }
        public function setVideojuegoId(int $pVideojuegoId){
            $this->VideojuegoId = $pVideojuegoId;
        }

        public function getTitulo(){
            return $this->Tilulo;
        }
        public function setTitulo(string $pTitulo){
            $this->Titulo = $pTitulo;
        }

        public function getAnioPublicacion(){
            return $this->AnioPublicacion;
        }
        public function setAnioPublicacion(int $pAnioPublicacion){
            $this->AnioPublicacion = $pAnioPublicacion;
        }

        public function getEstudioDesarrollo(){
            return $this->EstudioDesarrollo;
        }
        public function setEstudioDesarrollo(string $pEstudioDesarrollo){
            $this->EstudioDesarrollo = $pEstudioDesarrollo;
        }

        public function getPlataforma(){
            return $this->Plataforma;
        }
        public function setPlataforma(string $pPlataforma){
            $this->Plataforma = $pPlataforma;
        }
    }