<?php
	
	require_once(__DIR__.'/connections.php');
	require_once(__DIR__.'/../models/product.php');
	
	class ProductsService {

		public static function getById($id) {
			$sql = 'SELECT * FROM product WHERE id = :id AND enabled = 1';
			$svc = new ConnectionService(TRUE);
			$stmt = $svc->con->prepare($sql);
			$stmt->bindValue(':id', $id);
			$stmt->execute();
			if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				return new Product($row['id'], $row['description'], $row['image'], floatval($row['price']), $row['enabled']);
			} else {
				throw new InfoException('Produto não encontrado');
			}
		}

		public static function list() {
			$sql = 'SELECT * FROM product ORDER BY description ASC';
			$products = array();
			$svc = new ConnectionService(TRUE);
			$stmt = $svc->con->prepare($sql);
			$stmt->execute();
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				$products[] = new Product($row['id'], $row['description'], $row['image'], floatval($row['price']), $row['enabled']);
			}
			return $products;
		}

	}
	
?>