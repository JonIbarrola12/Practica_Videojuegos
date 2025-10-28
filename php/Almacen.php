<?php
    class Almacen{
        //Atributos
        private int $AlmacenId;
        private int $TiendaId;

        //Constructor
        public function __construct(int $pAlmacenId = null,int $pTiendaId = null) {
            $this->AlmacenId = $pAlmacenId;
            $this->TiendaId = $pTiendaId;
        }

        //Getters y Setters
        public function getAlmacenId(){
            return $this->AlmacenId;
        }
        public function setAlmacenId(int $pAlmacenId){
            $this->AlmacenId = $pAlmacenId;  
        }

        public function getTiendaId(){
            return $this->TiendaId;
        }
        public function setTiendaId(int $pTiendaId){
            $this->TiendaId = $pTiendaId;  
        }
    
    }