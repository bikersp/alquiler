<?php
    class Contacto extends Controllers{

        public function __construct(){
            parent::__construct();
            session_start();
        }

        public function contacto(){
            $data['page_tag'] = NOMBRE_EMPRESA;
            $data['page_title'] = NOMBRE_EMPRESA;
            $data['page_name'] = "Tienda_Virtual";
            $data['menu'] = "contacto";
            $this->views->getView($this,"contacto",$data);
        }

    }
?>