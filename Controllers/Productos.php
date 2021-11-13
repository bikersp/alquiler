<?php 
    class Productos extends Controllers{

        public function __construct(){
            parent::__construct();
            session_start();
            if (empty($_SESSION['login'])) {
                header('Location: '.base_url().'/dashboard');
            }
            getPermisos(MPRODUCTOS);
        }

        public function productos(){
            if (empty($_SESSION['permisosMod']['r'])) {
                header("Location:".base_url()."/dashboard");
            }
            $data['page_tag'] = "Inquilinos - ".NOMBRE_EMPRESA;
            $data['page_title'] = "INQUILINOS";
            $data['page_name'] = "Inquilinos";
            $data['page_functions_js'] = "functions_productos.js";
			$data['menu'] = "productos";
            $this->views->getView($this,"productos",$data);
        }

        public function getProductos(){
            if($_SESSION['permisosMod']['r']){
                $arrData = $this->model->selectProductos();

                for ($i=0; $i < count($arrData); $i++) {
                    $btnView = '';
                    $btnEdit = '';
                    $btnDelete = '';

                    if ($arrData[$i]['status'] == 1) {
                      $arrData[$i]['status'] = '<span class="badge badge-success">Activo</span>';
                    }else{
                      $arrData[$i]['status'] = '<span class="badge badge-danger">Inactivo</span>';
                    }

                    $arrData[$i]['precio'] = SMONEY.' '.intval($arrData[$i]['precio']);

                    if ($_SESSION['permisosMod']['r']) {
                        $btnView = '<button class="btn btn-info btn-sm btnViewProducto" onClick="fntViewProducto('.$arrData[$i]['idproducto'].')" title="Ver Pedido"><i class="far fa-eye"></i></button>';
                    }
                    if ($_SESSION['permisosMod']['u']) {
                        $btnEdit = '<button class="btn btn-primary btn-sm btnEditProducto" onClick="fntEditProducto(this,'.$arrData[$i]['idproducto'].')" title="Editar Pedido"><i class="fas fa-pencil-alt"></i></button>';
                    }
                    if ($_SESSION['permisosMod']['d']) {
                        $btnDelete = '<button class="btn btn-danger btn-sm btnDeleteProducto" onClick="fntDeleteProducto('.$arrData[$i]['idproducto'].')" title="Eliminar Pedido"><i class="fas fa-trash-alt"></i></button>';
                    }

                    $arrData[$i]['options'] = '<div class="text-center">'.$btnView.' '.$btnEdit.' '.$btnDelete.'</div>';
                    $arrData[$i]['fechainicio'] = substr($arrData[$i]['fechainicio'],0,2);
                    $arrData[$i]['nombre'] = strtok($arrData[$i]['nombre'], " ");
                }

                echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
            }else{
                header('Location: '.base_url().'/dashboard');
            }
            die();
        }

        public function getProducto($idproducto){
            if($_SESSION['permisosMod']['r']){
                $idproducto = intval($idproducto);
                if($idproducto > 0){
                    $arrData = $this->model->selectProducto($idproducto);
                    if(empty($arrData)){
                        $arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
                    }else{
                        $arrImg = $this->model->selectImages($idproducto);
                        if(count($arrImg) > 0){
                            for ($i=0; $i < count($arrImg); $i++) { 
                                $arrImg[$i]['url_image'] = media().'/img/uploads/'.$arrImg[$i]['img'];
                            }
                        }
                        $arrData['images'] = $arrImg;
                        $arrResponse = array('status' => true, 'data' => $arrData);
                    }
                    echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
                }
            }
            die();
        }

        public function setProducto(){
            if($_SESSION['permisosMod']['w']){
                if($_POST){
                    if(empty($_POST['txtNombre']) || empty($_POST['txtCodigo']) || empty($_POST['listCategoria']) || empty($_POST['txtPrecio']) || empty($_POST['listStatus']) ) {
                        $arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
                    }else{
                        $idProducto = intval($_POST['idProducto']);
                        $strNombre = strClean($_POST['txtNombre']);
                        $strDescripcion = strClean($_POST['txtDescripcion']);
                        $intTelefono = intval(strClean($_POST['txtTelefono']));
                        $strCodigo = strClean($_POST['txtCodigo']);
                        $intCategoriaId = intval($_POST['listCategoria']);
                        $strPrecio = strClean($_POST['txtPrecio']);
                        $intStock = intval($_POST['txtStock']);
                        $txtFechaI = $_POST['txtFechaI'];
                        $txtFechaF = $_POST['txtFechaF'];
                        $intStatus = intval($_POST['listStatus']);
                        $request_producto = "";

                        $ruta = strtolower(clear_cadena($strNombre));
                        $ruta = str_replace(" ","-", $ruta);

                        if($idProducto == 0) {
                            $option = 1;
                            if($_SESSION['permisosMod']['w']){
                                $request_producto = $this->model->insertProducto($strNombre, 
                                                                            $strDescripcion, 
                                                                            $intTelefono,
                                                                            $strCodigo, 
                                                                            $intCategoriaId,
                                                                            $strPrecio, 
                                                                            $intStock,
                                                                            $txtFechaI,
                                                                            $txtFechaF,
                                                                            $ruta, 
                                                                            $intStatus );
                            }
                        }else{
                            $option = 2;
                            if($_SESSION['permisosMod']['u']){
                                $request_producto = $this->model->updateProducto($idProducto,
                                                                            $strNombre,
                                                                            $strDescripcion, 
                                                                            $intTelefono,
                                                                            $strCodigo, 
                                                                            $intCategoriaId,
                                                                            $strPrecio, 
                                                                            $intStock,
                                                                            $txtFechaI,
                                                                            $txtFechaF,
                                                                            $ruta, 
                                                                            $intStatus);
                            }
                        }
                        if($request_producto > 0 ) {
                            if($option == 1){
                                $arrResponse = array('status' => true, 'idproducto' => $request_producto, 'msg' => 'Datos guardados correctamente.');
                            }else{
                                $arrResponse = array('status' => true, 'idproducto' => $idProducto, 'msg' => 'Datos Actualizados correctamente.');
                            }
                        }else if($request_producto == 'exist'){
                            $arrResponse = array('status' => false, 'msg' => '¡Atención! El cuarto ya ha sido alquilado.');
                        }else{
                            $arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos.');
                        }
                    }
                    echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
                }
                die();
            }
        }

        public function deleteProducto(){
            if($_SESSION['permisosMod']['d']){
                if($_POST){
                    if($_SESSION['permisosMod']['d']){
                        $intIdproducto = intval($_POST['idProducto']);
                        $requestUpdate = $this->model-> updateProductoCategoria($intIdproducto);
                        $requestDelete = $this->model->deleteProducto($intIdproducto);
                        if($requestDelete) {
                            $arrResponse = array('status' => true, 'msg' => 'Se ha eliminado el producto');
                        }else{
                            $arrResponse = array('status' => false, 'msg' => 'Error al eliminar el producto.');
                        }
                        echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
                    }
                }
                die();
            }
        }

        public function setImage(){
            if($_POST){
                if(empty($_POST['idProducto'])){
                    $arrResponse = array('status' => false, 'msg' => 'Error de dato.');
                }else{
                    $idProducto = intval($_POST['idProducto']);
                    $foto      = $_FILES['foto'];
                    $type = $foto['type'];
                    $estraccion = explode("/", $type);
                    $extension = $estraccion[1];
                    $imgNombre = 'producto_'.md5(date('d-m-Y H:m:s')).'.'.$extension;
                    $request_image = $this->model->insertImage($idProducto,$imgNombre);
                    if($request_image){
                        $uploadImage = uploadImage($foto,$imgNombre);
                        $arrResponse = array('status' => true, 'imgname' => $imgNombre, 'msg' => 'Archivo cargado.');
                    }else{
                        $arrResponse = array('status' => false, 'msg' => 'Error de carga.');
                    }
                }
                echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
            }
            die();
        }

        public function deleteFile(){
            if($_POST){
                if(empty($_POST['idproducto']) || empty($_POST['file'])){
                    $arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
                }else{
                    //Eliminar de la DB
                    $idProducto = intval($_POST['idproducto']);
                    $imgNombre  = strClean($_POST['file']);
                    $request_image = $this->model->deleteImage($idProducto,$imgNombre);

                    if($request_image){
                        $deleteFile =  deleteFile($imgNombre);
                        $arrResponse = array('status' => true, 'msg' => 'Archivo eliminado');
                    }else{
                        $arrResponse = array('status' => false, 'msg' => 'Error al eliminar');
                    }
                }
                echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
            }
            die();
        }

        public function getSelectProductos(){
            $htmlOptions = "";
            $arrData = $this->model->selectProductos();
            if (count($arrData) > 0) {
                for ($i=0; $i < count($arrData); $i++) {
                    if ($arrData[$i]['status'] == 1) {
                        $htmlOptions .='<option value="'.$arrData[$i]['idproducto'].'">'.$arrData[$i]['categoria'].' - '.$arrData[$i]['nombre'].'</option>';
                    }

                }
            }
            echo $htmlOptions;
            die();
        }

    }
?>