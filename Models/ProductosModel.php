<?php
	class ProductosModel extends Mysql{

		private $intIdProducto;
		private $strNombre;
		private $strDescripcion;
		private $intTelefono;
		private $intCodigo;
		private $intCategoriaId;
		private $intPrecio;
		private $intStock;
		private $txtFechaI;
		private $txtFechaF;
		private $strRuta;
		private $intStatus;
		private $strImagen;

		public function __construct(){
			parent::__construct();
		}

		public function selectProductos(){
			$sql = "SELECT p.idproducto,
							p.codigo,
							p.nombre,
							p.descripcion,
							c.descripcion as piso,
							p.telefono,
							p.categoriaid,
							c.nombre as categoria,
							p.precio,
							p.stock,
							p.fechainicio,
							p.fechafin,
							p.status
			 		FROM producto p
			 		INNER JOIN categoria c
			 		ON p.categoriaid = c.idcategoria
					WHERE p.status != 0
					ORDER BY p.idproducto DESC";
				$request = $this->select_all($sql);
				return $request;
		}

		public function updateProductoCategoria(int $idproducto){
			$this->intIdProducto = $idproducto;
			$this->intCategoriaId = 1;
			$sql = "UPDATE producto 
					SET categoriaid=?
					WHERE idproducto = $this->intIdProducto ";
			$arrData = array($this->intCategoriaId);

			$request = $this->update($sql,$arrData);
			return $request;
		}

		public function insertProducto(string $nombre, string $descripcion, int $telefono, int $codigo, int $categoriaid, string $precio, int $stock, string $fechai, string $fechaf, string $ruta, int $status){
			$this->strNombre = $nombre;
			$this->strDescripcion = $descripcion;
			$this->intTelefono = $telefono;
			$this->intCodigo = $codigo;
			$this->intCategoriaId = $categoriaid;
			$this->strPrecio = $precio;
			$this->intStock = $stock;
			$this->txtFechaI = $fechai;
			$this->txtFechaF = $fechaf;
			$this->strRuta = $ruta;
			$this->intStatus = $status;
			$return = 0;
			$sql = "SELECT * FROM producto WHERE categoriaid = '{$this->intCategoriaId}' AND status != 0";
			$request = $this->select_all($sql);
			if(empty($request))	{
				$query_insert  = "INSERT INTO producto(categoriaid,
														codigo,
														nombre,
														descripcion,
														telefono,
														precio,
														stock,
														fechainicio,
														fechafin,
														ruta,
														status) 
								  VALUES(?,?,?,?,?,?,?,?,?,?,?)";
	        	$arrData = array($this->intCategoriaId,
        						$this->intCodigo,
        						$this->strNombre,
        						$this->strDescripcion,
        						$this->intTelefono,
        						$this->strPrecio,
        						$this->intStock,
        						$this->txtFechaI,
        						$this->txtFechaF,
        						$this->strRuta,
        						$this->intStatus);
	        	$request_insert = $this->insert($query_insert,$arrData);
	        	$return = $request_insert;
			}else{
				$return = "exist";
			}
	        return $return;
		}

		public function updateProducto(int $idproducto, string $nombre, string $descripcion, int $telefono, int $codigo, int $categoriaid, string $precio, int $stock, string $fechai, string $fechaf, string $ruta, int $status){
			$this->intIdProducto = $idproducto;
			$this->strNombre = $nombre;
			$this->strDescripcion = $descripcion;
			$this->intTelefono = $telefono;
			$this->intCodigo = $codigo;
			$this->intCategoriaId = $categoriaid;
			$this->strPrecio = $precio;
			$this->intStock = $stock;
			$this->txtFechaI = $fechai;
			$this->txtFechaF = $fechaf;
			$this->strRuta = $ruta;
			$this->intStatus = $status;
			$return = 0;
			$sql = "SELECT * FROM producto WHERE categoriaid = '{$this->intCategoriaId}' AND idproducto != $this->intIdProducto  AND status != 0";
			$request = $this->select_all($sql);
			if(empty($request)){
				$sql = "UPDATE producto 
						SET categoriaid=?,
							codigo=?,
							nombre=?,
							descripcion=?,
							telefono=?,
							precio=?,
							stock=?,
							fechainicio=?,
							fechafin=?,
							ruta=?,
							status=? 
						WHERE idproducto = $this->intIdProducto ";
				$arrData = array($this->intCategoriaId,
        						$this->intCodigo,
        						$this->strNombre,
        						$this->strDescripcion,
        						$this->intTelefono,
        						$this->strPrecio,
        						$this->intStock,
        						$this->txtFechaI,
        						$this->txtFechaF,
        						$this->strRuta,
        						$this->intStatus);

	        	$request = $this->update($sql,$arrData);
	        	$return = $request;
			}else{
				$return = "exist";
			}
	        return $return;
		}

		public function selectProducto(int $idproducto){
			$this->intIdProducto = $idproducto;
			$sql = "SELECT p.idproducto,
							p.codigo,
							p.nombre,
							p.descripcion,
							p.telefono,
							c.descripcion as piso,
							p.precio,
							p.stock,
							p.fechainicio,
							p.fechafin,
							p.categoriaid,
							c.nombre as categoria,
							p.status
					FROM producto p
					INNER JOIN categoria c
					ON p.categoriaid = c.idcategoria
					WHERE idproducto = $this->intIdProducto";
			$request = $this->select($sql);
			return $request;
		}

		public function insertImage(int $idproducto, string $imagen){
			$this->intIdProducto = $idproducto;
			$this->strImagen = $imagen;
			$query_insert  = "INSERT INTO imagen(productoid,img) VALUES(?,?)";
	        $arrData = array($this->intIdProducto,
        					$this->strImagen);
	        $request_insert = $this->insert($query_insert,$arrData);
	        return $request_insert;
		}

		public function selectImages(int $idproducto){
			$this->intIdProducto = $idproducto;
			$sql = "SELECT productoid,img
					FROM imagen
					WHERE productoid = $this->intIdProducto";
			$request = $this->select_all($sql);
			return $request;
		}

		public function deleteImage(int $idproducto, string $imagen){
			$this->intIdProducto = $idproducto;
			$this->strImagen = $imagen;
			$query  = "DELETE FROM imagen 
						WHERE productoid = $this->intIdProducto 
						AND img = '{$this->strImagen}'";
	        $request_delete = $this->delete($query);
	        return $request_delete;
		}

		public function deleteProducto(int $idproducto){
			$this->intIdProducto = $idproducto;
			$sql = "UPDATE producto SET status = ? WHERE idproducto = $this->intIdProducto ";
			$arrData = array(0);
			$request = $this->update($sql,$arrData);
			return $request;
		}

	}
?>