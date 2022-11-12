<?php
	
	require_once(__DIR__.'/connections.php');
	require_once(__DIR__.'/../models/sale.php');
	require_once(__DIR__.'/../models/product.php');
	
	class ProductsService {

		public static function list() {
			$sql = 'SELECT * FROM sale s JOIN product p ON s.id_product = p.id ORDER BY p.description ASC';
			$sales = array();
			$svc = new ConnectionService(TRUE);
			$stmt = $svc->con->prepare($sql);
			$stmt->execute();
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				$sales[] = new Sale($row['s.id'], $row['s.name'], $row['s.email'], $row['s.date'], new Product($row['p.id'], $row['p.description'], $row['p.omage'], floatval($row['p.price']), $row['p.enabled']));
			}
			return $sales;
		}

	}
	
?>