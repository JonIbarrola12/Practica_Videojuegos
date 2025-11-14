<?php
    class Modificacion{
        //Atributos
        private ?int $ModificacionId;
        private string $TipoMovimiento ;
        private DateTime $Fecha;
        private int $TrabajadorId;
        private ?int $CopiaVideojuegoId;
        private ?int $VideojuegoId;

        //Constructor
        public function __construct(?int $pModificacionId = null, string $pTipoMovimiento = "", ?int $pTrabajadorId = null, ?int $pCopiaVideojuegoId, ?int $pVideojuegoId   ) {
            $this->ModificacionId = $pModificacionId;
            $this->TipoMovimiento  = $pTipoMovimiento;
            $this->Fecha = new DateTime();
            $this->TrabajadorId = $pTrabajadorId;
            $this->CopiaVideojuegoId = $pCopiaVideojuegoId;
            $this->VideojuegoId = $pVideojuegoId;
        }
        //Getters y Setters

        public function getModificacionId(){
            return $this->ModificacionId;
        }
        public function setModificacionId(int $pModificacionId){
            return $this->ModificacionId = $pModificacionId;
        }

        public function getTipoMovimiento(){
            return $this->TipoMovimiento;
        }
        public function setTipoMovimiento(float $pTipoMovimiento){
            return $this->TipoMovimiento = $pTipoMovimiento;
        }

        public function getFecha(){
            return $this->Fecha;
        }
        public function setPrecioCompraGame(DateTime $pFecha){
            return $this->Fecha = $pFecha;
        }

        public function getTrabajadorId(){
            return $this->TrabajadorId;
        }
        public function setTrabajadorId(int $pTrabajadorId){
            $this->TrabajadorId = $pTrabajadorId;
        }

        public function getCopiaVideojuegoId(){
            return $this->CopiaVideojuegoId;
        }
        public function setCopiaVideojuegoId(int $pCopiaVideojuegoId){
            $this->CopiaVideojuegoId = $pCopiaVideojuegoId;
        }

        public function getVideojuegoId(){
            return $this->VideojuegoId;
        }
        public function setVideojuegoId(int $pVideojuegoId){
            $this->VideojuegoId = $pVideojuegoId;
        }
    }
    ?>