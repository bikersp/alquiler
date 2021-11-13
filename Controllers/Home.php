<?php
    require_once("Models/TCategoria.php");
    require_once("Models/TProducto.php");

    class Home extends Controllers{

        use TCategoria, TProducto;

        public function __construct(){
            parent::__construct();
            session_start();
            header('Location: '.base_url().'/dashboard');
        }

        public function home(){
            $data['page_tag'] = NOMBRE_EMPRESA;
            $data['page_title'] = NOMBRE_EMPRESA;
            $data['page_name'] = "Tienda_Virtual";
            $data['menu'] = "home";
            $data['slider'] = $this->getCategoriasT(CATEGORIA_SLIDER);
            $data['banner'] = $this->getCategoriasT(CATEGORIA_BANNER);
            $data['productos'] = $this->getProductosT();
            $this->views->getView($this,"home",$data);
        }

    }
?>