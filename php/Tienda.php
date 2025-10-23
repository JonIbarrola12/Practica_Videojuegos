<?php 
    class Tienda {
        //Atributos
        private int $TiendaId;
        private string $Direccion;
        private string $Pais;
        private Almacen $Almacen;

        //Constructor
        public function __construct(int $pTiendaId = null, string $pDireccion = "", string $pPais = "") {
            $this->TiendaId = $pTiendaId;
            $this->Direccion = $pDireccion;
            if ($pPais!= "España" && $pPais != "Portugal"){
                $this->Pais = null;
            }else{
                $this->Pais = $pPais;
            }
            $this->cargarAlmacen();
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
        public function setDireccion(string $pDireccion){
            $this->Direccion = $pDireccion;
        }

        public function getPais(){
            return $this->Pais;
        }
        
        public function setPais(string $pPais){
            if ($pPais!= "España" && $pPais != "Portugal"){
                $this->Pais = null;
            }else{
                $this->Pais = $pPais;
            }
        }

        public function getAlmacen(): ?Almacen {
            return $this->Almacen;
        }

        //Metodo que carga el Almacen
        private function cargarAlmacen(){
            $this->Almacen = new Almacen(null,"Almacen",1);
        }


    }
    ?>