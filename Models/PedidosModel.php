<?php
	// require_once("CategoriasModel.php");

	class PedidosModel extends Mysql{
		private $objCategoria;
		private $intIdProducto;
		private $intIdTipopago;
		private $strFecha;
		private $strAnio;
		private $strMes;
		private $intPersona;
		private $intPrecio;
		private $intPagoId;

		public function __construct(){
			parent::__construct();
			// $this->objCategoria = new CategoriasModel();
		}

		public function insertPago(int $idproducto, int $idtipopago, string $fecha, string $precio){
			$this->intPersona = $_SESSION['idUser'];
			$this->intIdProducto = $idproducto;
			$this->intIdTipopago = $idtipopago;
			$this->strFecha = $fecha;
			$this->strAnio = intval(substr($fecha,0,4));
			$this->strMes = intval(substr($fecha,5,2));
			$this->intPrecio = $precio;
			$return = 0;

			$sql = "SELECT * FROM pagos WHERE productoid = $this->intIdProducto AND MONTH(fechapago) = $this->strMes AND YEAR(fechapago) = $this->strAnio";
			$request = $this->select_all($sql);
			if(empty($request))	{
				$query_insert  = "INSERT INTO pagos(personaid,
														productoid,
														tipopagoid,
														fechapago,
														monto) 
								  VALUES(?,?,?,?,?)";
	        	$arrData = array($this->intPersona,
        						$this->intIdProducto,
        						$this->intIdTipopago,
        						$this->strFecha,
										$this->intPrecio);
	        	$request_insert = $this->insert($query_insert,$arrData);
	        	$return = $request_insert;
			}else{
				$return = "exist";
			}
			return $return;
		}

		public function deletePago(int $idpago){
			$this->intPagoId = $idpago;
			$sql = "DELETE FROM pagos WHERE idpago = $this->intPagoId";
			$request = $this->delete($sql);
			return $request;
		}

		public function selectPago(int $idpago){
			$this->intPagoId = $idpago;
			$sql = "SELECT DAY(fecharegistro) as fecha
					FROM pagos
					WHERE idpago = $this->intPagoId";
			$request = $this->select($sql);
			return $request;
		}

		public function selectProductoPago(int $idproducto){
			$this->intIdProducto = $idproducto;
			$sql = "SELECT p.idproducto,
							p.precio
					FROM producto p
					WHERE idproducto = $this->intIdProducto";
			$request = $this->select($sql);
			return $request;
		}

		public function selectPagos(){
			$sql = "SELECT p.idpago,
							pe.nombres as usuario,
							pro.nombre,
							ca.nombre as categoria,
							ca.descripcion as piso,
							p.monto,
							tp.tipopago,
              DATE_FORMAT(p.fecharegistro, '%d/%m/%Y') as fecha,
              MONTH(p.fechapago) as fechapago
			 		FROM pagos p
					INNER JOIN producto pro
					ON p.productoid = pro.idproducto
					INNER JOIN persona pe
					ON pe.idpersona = p.personaid
			 		INNER JOIN tipopago tp
			 		ON p.tipopagoid = tp.idtipopago
					INNER JOIN categoria ca
					ON ca.idcategoria = pro.categoriaid
					ORDER BY p.idpago";
      $request = $this->select_all($sql);
      return $request;
		}

		public function selectDeudoresold(){
			$fechaActual = "'".strval(date('d/m/Y'))."'";
			$sql = "SELECT p.idproducto,
							p.nombre,
							c.nombre as categoria,
							c.descripcion as piso,
							p.precio,
							p.fechainicio,
							p.fechafin,
							p.status,
							pa.fechapago
			 		FROM producto p
			 		INNER JOIN categoria c
			 		ON p.categoriaid = c.idcategoria
			 		LEFT JOIN pagos pa
			 		ON pa.productoid = p.idproducto
					WHERE p.status != 0 
					AND STR_TO_DATE($fechaActual, '%d/%m/%y') >= STR_TO_DATE(p.fechainicio, '%d/%m/%y') ";
					// AND STR_TO_DATE($fechaActual, '%d/%m/%y') < STR_TO_DATE(p.fechafin, '%d/%m/%y')";
				$request = $this->select_all($sql);
				return $request;
		}

		public function selectInquilinos(){
			$sql = "SELECT p.idproducto,
									p.nombre,
									c.nombre as categoria,
									c.descripcion as piso,
									p.fechainicio,
									p.precio,
									p.status
							FROM producto p
							INNER JOIN categoria c
							ON p.categoriaid = c.idcategoria
							WHERE p.status != 0
							ORDER BY p.fechainicio";
				$request = $this->select_all($sql);
				return $request;
		}

		public function selectDeudores($mesActual, $anioctual){
			$sql = "SELECT p.idproducto,
									p.nombre,
									c.nombre as categoria,
									c.descripcion as piso,
									p.precio,
									p.fechainicio,
									p.status,
									pa.fechapago,
									pa.fecharegistro
							FROM pagos pa
							LEFT JOIN producto p
							ON pa.productoid = p.idproducto
							INNER JOIN categoria c
							ON p.categoriaid = c.idcategoria
							WHERE p.status != 0 AND MONTH(pa.fechapago) = $mesActual AND YEAR(pa.fechapago) = $anioctual
							ORDER BY p.fechainicio";
				$request = $this->select_all($sql);
				return $request;
		}

		public function selectContratos(){
			$fechaActual = "'".strval(date('d/m/Y'))."'";
			$sql = "SELECT p.idproducto,
							p.nombre,
							c.nombre as categoria,
							c.descripcion as piso,
							p.precio,
							p.fechainicio,
							p.fechafin,
							p.status
			 		FROM producto p
			 		INNER JOIN categoria c
			 		ON p.categoriaid = c.idcategoria
					WHERE p.status != 0 ";
					// AND STR_TO_DATE($fechaActual, '%d/%m/%y') > STR_TO_DATE(p.fechafin, '%d/%m/%y')";
				$request = $this->select_all($sql);
				return $request;
		}

	}
?>