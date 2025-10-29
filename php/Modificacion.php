<?php
    class Modificacion{
        //Atributos
        private int $ModificacionId;
        private string $TipoMovimiento ;
        private DateTime $Fecha;
        private int $TrabajadorId;
        private int $CopiaVideojuegoId;

        //Constructor
        public function __construct(int $pModificacionId = null, string $pTipoMovimiento = "", DateTime $pFecha, int $pTrabajadorId = null, int $pCopiaVideojuegoId   ) {
            $this->ModificacionId = $pModificacionId;
            $this->TipoMovimiento  = $pTipoMovimiento;
            $this->Fecha = $pFecha;
            $this->TrabajadorId = $pTrabajadorId;
            $this->CopiaVideojuegoId = $pCopiaVideojuegoId;
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
    }
    ?>