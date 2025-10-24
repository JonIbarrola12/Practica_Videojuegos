<?php
    class CopiaVideojuego{
        //Atributos
        private int $CopiaVideojuegoId;
        private float $PrecioNuevo;
        private float $PrecioSeminuevo;
        private float $PrecioCompraGame;
        private int $Unidades;
        private int $TiendaId;
        private int $VideojuegoId;

        //Constructor
        public function __construct(int $pCopiaVideojuegoId = null, float $PprecioNuevo = 0.0,float $pPrecioSeminuevo = 0.0, float $pPrecioCompraGame = 0.0, int $pUnidades = 0, int $pTiendaId = null, int $pVideojuegoId = null ) {
            $this->CopiaVideojuegoId = $pCopiaVideojuegoId;
            $this->PrecioNuevo = $PprecioNuevo;
            $this->PrecioSeminuevo = $pPrecioSeminuevo;
            $this->PrecioCompraGame = $pPrecioCompraGame;
            $this->Unidades = $pUnidades;
            $this->TiendaId = $pTiendaId;
            $this->VideojuegoId = $pVideojuegoId;
        }
        //Getters y Setters
        public function getCopiaVideojuegoId(){
            return $this->CopiaVideojuegoId;
        }
        public function setCopiaVideojuegoId(int $pCopiaVideojuegoId){
            $this->CopiaVideojuegoId = $pCopiaVideojuegoId;
        }

        public function getPrecioNuevo(){
            return $this->PrecioNuevo;
        }
        public function setPrecioNuevo(float $PprecioNuevo){
            return $this->PrecioNuevo = $PprecioNuevo;
        }

        public function getPrecioSeminuevo(){
            return $this->PrecioSeminuevo;
        }
        public function setPrecioSeminuevo(float $pPrecioSeminuevo){
            return $this->PrecioSeminuevo = $pPrecioSeminuevo;
        }

        public function getPrecioCompraGame(){
            return $this->PrecioCompraGame;
        }
        public function setPrecioCompraGame(float $pPrecioCompraGame){
            return $this->PrecioCompraGame = $pPrecioCompraGame;
        }

        public function getUnidades(){
            return $this->Unidades;
        }
        public function setUnidades(int $Unidades){
            $this->Unidades = $pUnidades;
        }

        public function getTiendaId(){
            return $this->TiendaId;
        }
        public function setTiendaId(int $pTiendaId){
            $this->TiendaId = $pTiendaId;
        }

        public function getVideojuegoId(){
            return $this->VideojuegoId;
        }
        public function setVideojuegoId(int $pVideojuegoId){
            $this->VideojuegoId = $pVideojuegoId;
        }
    }
    ?>