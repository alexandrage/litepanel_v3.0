<?php
/*
* @LitePanel
* @Version: 1.0.1
* @Date: 29.12.2012
* @Developed by QuickDevel
*/
class serversModel extends Model {
	public function createServer($data) {
		$sql = "INSERT INTO `servers` SET ";
		$sql .= "user_id = '" . (int)$data['user_id'] . "', ";
		$sql .= "game_id = '" . (int)$data['game_id'] . "', ";
		$sql .= "location_id = '" . (int)$data['location_id'] . "', ";
		$sql .= "server_slots = '" . (int)$data['server_slots'] . "', ";
		$sql .= "server_port = '" . (int)$data['server_port'] . "', ";
		$sql .= "server_password = '" . $this->db->escape($data['server_password']) . "', ";
		$sql .= "server_status = '" . (int)$data['server_status'] . "', ";
		$sql .= "server_date_reg = NOW(), ";
		$sql .= "server_date_end = NOW() + INTERVAL " . (int)$data['server_months'] . " MONTH";
		$this->db->query($sql);
		return $this->db->getLastId();
	}
	
	public function deleteServer($serverid) {
		$sql = "DELETE FROM `servers` WHERE server_id = '" . (int)$serverid . "'";
		$this->db->query($sql);
	}
	
	public function updateServer($serverid, $data = array()) {
		$sql = "UPDATE `servers`";
		if(!empty($data)) {
			$count = count($data);
			$sql .= " SET";
			foreach($data as $key => $value) {
				$sql .= " $key = '" . $this->db->escape($value) . "'";
				
				$count--;
				if($count > 0) $sql .= ",";
			}
		}
		$sql .= " WHERE `server_id` = '" . (int)$serverid . "'";
		$query = $this->db->query($sql);
	}
	
	public function getServers($data = array(), $joins = array(), $sort = array(), $options = array()) {
		$sql = "SELECT * FROM `servers`";
		foreach($joins as $join) {
			$sql .= " LEFT JOIN $join";
			switch($join) {
				case "users":
					$sql .= " ON servers.user_id=users.user_id";
					break;
				case "games":
					$sql .= " ON servers.game_id=games.game_id";
					break;
				case "locations":
					$sql .= " ON servers.location_id=locations.location_id";
					break;
			}
		}
		
		if(!empty($data)) {
			$count = count($data);
			$sql .= " WHERE";
			foreach($data as $key => $value) {
				$sql .= " $key = '" . $this->db->escape($value) . "'";
				
				$count--;
				if($count > 0) $sql .= " AND";
			}
		}
		
		if(!empty($sort)) {
			$count = count($sort);
			$sql .= " ORDER BY";
			foreach($sort as $key => $value) {
				$sql .= " $key " . $value;
				
				$count--;
				if($count > 0) $sql .= ",";
			}
		}
		
		if(!empty($options)) {
			if ($options['start'] < 0) {
				$options['start'] = 0;
			}
			if ($options['limit'] < 1) {
				$options['limit'] = 20;
			}
			$sql .= " LIMIT " . (int)$options['start'] . "," . (int)$options['limit'];
		}
		$query = $this->db->query($sql);
		return $query->rows;
	}
	
	public function getServerById($serverid, $joins = array()) {
		$sql = "SELECT * FROM `servers`";
		foreach($joins as $join) {
			$sql .= " LEFT JOIN $join";
			switch($join) {
				case "users":
					$sql .= " ON servers.user_id=users.user_id";
					break;
				case "games":
					$sql .= " ON servers.game_id=games.game_id";
					break;
				case "locations":
					$sql .= " ON servers.location_id=locations.location_id";
					break;
			}
		}
		$sql .=  " WHERE `server_id` = '" . (int)$serverid . "' LIMIT 1";
		$query = $this->db->query($sql);
		return $query->row;
	}
	
	public function getTotalServers($data = array()) {
		$sql = "SELECT COUNT(*) AS count FROM `servers`";
		if(!empty($data)) {
			$count = count($data);
			$sql .= " WHERE";
			foreach($data as $key => $value) {
				$sql .= " $key = '" . $this->db->escape($value) . "'";
				
				$count--;
				if($count > 0) $sql .= " AND";
			}
		}
		$query = $this->db->query($sql);
		return $query->row['count'];
	}
	
	public function getServerNewPort($locationid, $min, $max) {
		for($i = $min; $i < $max; $i += 2) {
			$sql = "SELECT COUNT(*) AS total FROM `servers` WHERE location_id = '" . (int)$locationid . "' AND server_port = '" . (int)$i . "' LIMIT 1";
			$query = $this->db->query($sql);
			if($query->row['total'] == 0) {
				return $i;
			}
		}
		return null;
	}
	
	public function extendServer($serverid, $month, $fromCurrent) {
		$sql = "UPDATE `servers` SET server_date_end = ";
		if($fromCurrent)
			$sql .= "NOW()";
		else
			$sql .= "server_date_end";
		$sql .= "+INTERVAL " . (int)$month . " MONTH WHERE server_id = '" . (int)$serverid . "'";
		
		$this->db->query($sql);
	}
	
	public function execServerAction($serverid, $action) {
		$this->load->library('ssh2');
		
		$ssh2Lib = new ssh2Library();
		
		$server = $this->getServerById($serverid, array('users', 'locations', 'games'));
		$link = $ssh2Lib->connect($server['location_ip'], $server['location_user'], $server['location_password']);
		$output = $ssh2Lib->execute($link, "/home/cp/gameservers.py $action $server[server_id] $server[game_code] $server[location_ip] $server[server_port] $server[server_slots] $server[server_password]");
		if(preg_match("/\[\[(.*)::(.*)?\]\]/", $output, $matches)) {
			$result['status'] = $matches[1];
			$result['description'] = $matches[2];
		} else {
			$result['status'] = "ERROR";
			$result['description'] = "UnknownResponse";
		}
		$ssh2Lib->disconnect($link);
		return $result;
		/*
		Для тестирования без сервероной части:
		return array('status' => 'OK', 'description' => '');
		*/
	}
	
	public function getServerSystemLoad($serverid) {
		$this->load->library('ssh2');
		
		$ssh2Lib = new ssh2Library();
		
		$server = $this->getServerById($serverid, array('users', 'locations', 'games'));
		$link = $ssh2Lib->connect($server['location_ip'], $server['location_user'], $server['location_password']);
		$output = $ssh2Lib->execute($link, "/home/cp/gameservers.py sysload $server[server_id] $server[game_code] $server[location_ip] $server[server_port] $server[server_slots] $server[server_password]");
		if(preg_match("/\[\[([0-9]+\.[0-9]+)::([0-9]+\.[0-9]+)?\]\]/", $output, $matches)) {
			$result['cpu'] = floatval($matches[1]);
			$result['ram'] = floatval($matches[2]);
		} else {
			$result['cpu'] = 0.0;
			$result['ram'] = 0.0;
		}
		$ssh2Lib->disconnect($link);
		return $result;
	}
}
?>
