<?php 
    class Tienda {
        //Atributos
        private int $TiendaId;
        private string $Direccion;
        private string $Pais;

        //Constructor
        public function __construct(int $pTiendaId = null, string $pDireccion = "", string $pPais = "") {
            $this->TiendaId = $pTiendaId;
            $this->Direccion = $pDireccion;
            if ($Pais!= "España" || $Pais != "Portugal"){
                $this->Pais = null;
            }else{
                $this->Pais = $pPais;
            }
        }
        
        //Getters y Setters
        public function getTiendaId(){
            return $this->TiendaId;
        }
        public function setTiendaId(int $pTiendaId){
            $this->TiendaId = $pTiendaId;
        }

        public function getDireccion(){
            return $this->Direccion;
        }
        public function setDireccion(int $pDireccion){
            $this->Direccion = $pDireccion;
        }

        public function getPais(){
            return $this->Pais;
        }
        public function setPais(int $pPais){
            if ($Pais!= "España" || $Pais != "Portugal"){
                $this->Pais = null;
            }else{
                $this->Pais = $pPais;
            }
        }

    }