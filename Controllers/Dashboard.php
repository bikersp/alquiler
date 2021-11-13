<?php
	class Dashboard extends Controllers{

		public function __construct(){
			parent::__construct();
			session_start();
			if (empty($_SESSION['login'])) {
				header('Location: '.base_url().'/login');
				die();
			}
			getPermisos(MDASHBOARD);
		}

		public function dashboard(){
			$data['page_id'] = 2;
			$data['page_tag'] = "Dashboard - ".NOMBRE_EMPRESA;
			$data['page_title'] = "DASHBOARD";
			$data['page_name'] = "dashboard";
			$data['menu'] = "dashboard";
			$data['page_functions_js'] = "functions_dashboard.js";
			$data['usuarios'] = $this->model->cantUsuarios();
			$data['clientes'] = $this->model->cantClientes();
			$data['categorias'] = $this->model->cantCategorias();
			$data['productos'] = $this->model->cantProductos();
			$data['pedidos'] = $this->model->cantPedidos();
			$data['lastOrders'] = $this->model->lastOrders();
			$data['productosTen'] = $this->model->productosTen();
			$data['caja'] = $this->model->selectCaja();
			$data['otro'] = $this->model->selectOtro();

			$anio = date('Y');
			$mes = date('m');
			$data['pagosMes'] = $this->model->selectPagosMes($anio, $mes);
			$data['ventasDia'] = $this->model->selectVentasMes($anio, $mes);
			$data['ventasAnio'] = $this->model->selectVentasAnio($anio);

			if ($_SESSION['userData']['idrol'] == RCLIENTES) {
				$this->views->getView($this,"dashboardCliente",$data);
			}else{
				$this->views->getView($this,"dashboard",$data);
			}
		}

		public function tipoPagoMes(){
			if ($_POST) {
				$grafica = "tipoPagoMes";
				$nFecha = str_replace(" ", "", $_POST['fecha']);
				$arrFecha = explode('-', $nFecha);
				$mes = $arrFecha[0];
				$anio = $arrFecha[1];
				$pagos = $this->model->selectPagosMes($anio, $mes);
				$script = getFile("Template/Modals/graficas", $pagos);
				echo $script;
				die;
			}
		}

		public function ventasMes(){
			if ($_POST) {
				$grafica = "ventasMes";
				$nFecha = str_replace(" ", "", $_POST['fecha']);
				$arrFecha = explode('-', $nFecha);
				$mes = $arrFecha[0];
				$anio = $arrFecha[1];
				$pagos = $this->model->selectVentasMes($anio, $mes);
				$script = getFile("Template/Modals/graficas", $pagos);
				echo $script;
				die;
			}
		}

		public function ventasAnio(){
			if ($_POST) {
				$grafica = "ventasAnio";
				$anio = intval($_POST['anio']);
				$pagos = $this->model->selectVentasAnio($anio);
				$script = getFile("Template/Modals/graficas", $pagos);
				echo $script;
				die;
			}
		}

	}
?>