<?php

namespace Models;

use \Core\Model;

class Home extends Model {

	public function getAll() {
		$array = array();

		return $array;
	}

	// Metodo para pegar o valor de ENTRADA de acordo com periodos
	public function getInputList($period1, $period2) {
		$array = array();
		// period1: 01/01/2019
		// period2: 05/01/2019
		$currentDay = $period1;
		while($period2 != $currentDay) {
			$array[$currentDay] = 0;
			$currentDay = date('Y-m-d', strtotime('+1 day', strtotime($currentDay)));

		}

		$sql = "SELECT DATE_FORMAT(data, '%Y-%m-%d') as data, SUM(valor) as total FROM cashier WHERE data BETWEEN :period1 AND :period2 AND tipo = 1 GROUP BY DATE_FORMAT(data, '%Y-%m-%d')";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(":period1", $period1);
		$sql->bindValue(":period2", $period2);
		$sql->execute();

		if($sql->rowCount() > 0) {
			$rows = $sql->fetchAll();

			foreach($rows as $item) {
				$array[$item['data']] = $item['total'];
			}
		}

		return $array;
	}

	// Metodo para pegar o valor de SAIDA de acordo com periodos
	public function getExitList($period1, $period2) {
		$array = array();
		// period1: 01/01/2019
		// period2: 05/01/2019
		$currentDay = $period1;
		while($period2 != $currentDay) {
			$array[$currentDay] = 0;
			$currentDay = date('Y-m-d', strtotime('+1 day', strtotime($currentDay)));

		}

		$sql = "SELECT DATE_FORMAT(data, '%Y-%m-%d') as data, SUM(valor) as total FROM cashier WHERE data BETWEEN :period1 AND :period2 AND tipo = 0 GROUP BY DATE_FORMAT(data, '%Y-%m-%d')";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(":period1", $period1);
		$sql->bindValue(":period2", $period2);
		$sql->execute();

		if($sql->rowCount() > 0) {
			$rows = $sql->fetchAll();

			foreach($rows as $item) {
				$array[$item['data']] = $item['total'];
			}
		}

		return $array;
	}

}