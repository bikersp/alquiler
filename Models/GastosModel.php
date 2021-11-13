<?php
	class GastosModel extends Mysql{

		public $strPrecio;
		public $strDescripcion;
		public $intIdGasto;
		public $intIdServicio;
		public $strFecha;
		private $strAnio;
		private $strMes;

		public function __construct(){
			parent::__construct();
		}

		public function selectGastos(){
			$sql = "SELECT g.idgasto,
										s.nombre,
										g.descripcion,
										DATE_FORMAT(g.fecharegistro, '%d/%m/%Y') as fecha,
										MONTH(g.fechapago) as fechapago,
										g.monto 
			FROM gastos g
			INNER JOIN servicio s
			ON s.idservicio = g.servicioid
			ORDER BY idgasto DESC";
			$request = $this->select_all($sql);
			return $request;
		}

		public function insertGasto(int $idservicio, String $mensaje, String $fecha, String $monto){
			$this->intIdServicio = $idservicio;
			$this->strDescripcion = $mensaje;
			$this->strPrecio = $monto;
			$this->strFecha = $fecha;
			$this->strAnio = intval(substr($fecha,0,4));
			$this->strMes = intval(substr($fecha,5,2));

			$sql = "SELECT * FROM gastos WHERE servicioid = $this->intIdServicio AND servicioid < 4 AND MONTH(fechapago) = $this->strMes AND YEAR(fechapago) = $this->strAnio";
			$request = $this->select_all($sql);
			if(empty($request))	{
				$query_insert = "INSERT INTO gastos(servicioid, descripcion, fechapago, monto) VALUES(?,?,?,?)";
				$arrData = array($this->intIdServicio, 
								$this->strDescripcion, 
								$this->strFecha, 
								$this->strPrecio);
				$request_insert = $this->insert($query_insert,$arrData);
				$return = $request_insert;
			}else{
				$return = "exist";
			}
			return $return;
		}

		public function deleteGasto(int $idgasto){
			$this->intIdGasto = $idgasto;
			$sql = "DELETE FROM gastos WHERE idgasto = $this->intIdGasto";
			$request = $this->delete($sql);
			return $request;
		}

		public function selectGasto(int $idgasto){
			$this->intIdGasto = $idgasto;
			$sql = "SELECT DAY(fecharegistro) as fecha
					FROM gastos
					WHERE idgasto = $this->intIdGasto";
			$request = $this->select($sql);
			return $request;
		}

	}
?>