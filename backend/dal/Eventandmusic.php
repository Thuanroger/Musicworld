<?php
require_once("dbInfo.php");

class Eventandmusic {
	public $description;
	public $emId;
	public $eventId;
	public $flag;
	public $musicId;

	public function addEventandmusic() {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
		$conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

		// Insert query.
		$sql = "INSERT INTO `eventandmusic`
				(
					`Description`,
					`EventId`,
					`Flag`,
					`MusicId`
				)
				VALUES
				(
					:description,
					:eventId,
					:flag,
					:musicId
				);";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute(array(
			":description" => $this->description,
			":eventId" => $this->eventId,
			":flag" => $this->flag,
			":musicId" => $this->musicId));

		// Get value of the auto increment column.
		$newId = $conn->lastInsertId();
		$this->emId = $newId;

		// Close the database connection.
		$conn = NULL;

		// Return the id.
		return $newId;
	}

	public function updateEventandmusic() {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
		$conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

		// Update query.
		$sql = "UPDATE	`eventandmusic`
				SET		`Description` = :description,
						`EventId` = :eventId,
						`Flag` = :flag,
						`MusicId` = :musicId
				WHERE	`EmId` = :emId;";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute(array(
			":description" => $this->description,
			":emId" => $this->emId,
			":eventId" => $this->eventId,
			":flag" => $this->flag,
			":musicId" => $this->musicId));

		// Close the database connection.
		$conn = NULL;
	}
	public function updateEventandmusic1() {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
		$conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

		// Update query.
		$sql = "UPDATE	`eventandmusic`
				SET		
						`Flag` = :flag
						
				WHERE	`EmId` = :emId;";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute(array(
			
			":emId" => $this->emId,
			
			":flag" => $this->flag
			));

		// Close the database connection.
		$conn = NULL;
		return true;
	}
	public static function deleteEventandmusic($emId) {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
		$conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

		// Delete query.
		$sql = "DELETE	FROM `eventandmusic`
				WHERE	`EmId` = :emId;";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute(array(":emId" => $emId));

		// Close the database connection.
		$conn = NULL;
	}

	public static function getEventandmusic($emId) {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
		$conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

		// Select query.
		$sql = "SELECT	`Description`,
						`EmId`,
						`EventId`,
						`Flag`,
						`MusicId`
				FROM	`eventandmusic`
				WHERE	`EmId` = :emId;";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute(array(":emId" => $emId));

		// Fetch record.
		$eventandmusic = NULL;
		if($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$eventandmusic = new Eventandmusic();
			$eventandmusic->description = $row["Description"];
			$eventandmusic->emId = $row["EmId"];
			$eventandmusic->eventId = $row["EventId"];
			$eventandmusic->flag = $row["Flag"];
			$eventandmusic->musicId = $row["MusicId"];
		}

		// Close the database connection.
		$conn = NULL;

		return $eventandmusic;
	}

	public static function getAllRecords($pageNo, $pageSize, &$totalRecords) {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
		$conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

		// Validate sort column and order.
		

		$pageNo = (int)$pageNo;
		$pageSize = (int)$pageSize;

		$sql = "SELECT	COUNT(*) AS Count
				FROM	`eventandmusic`;";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute();

		// Get total records count.
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$totalRecords = $row['Count'];
		$stmt = NULL;

		$totalPages = ceil($totalRecords / $pageSize);
		if ($pageNo > $totalPages) {
			$pageNo = $totalPages;
		}

		$start = $pageSize * $pageNo - $pageSize;
		if($start < 0) {
			$start = 0;
		}

		$sql = "SELECT	`Description`,
						`EmId`,
						`EventId`,
						`Flag`,
						`MusicId`
				FROM	`eventandmusic`
				ORDER BY `EmId` DESC
				LIMIT $start, $pageSize;";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute();

		// Fetch all records.
		$list = Array();
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$eventandmusic = new Eventandmusic();
			$eventandmusic->description = $row["Description"];
			$eventandmusic->emId = $row["EmId"];
			$eventandmusic->eventId = $row["EventId"];
			$eventandmusic->flag = $row["Flag"];
			$eventandmusic->musicId = $row["MusicId"];

			array_push($list, $eventandmusic);
		}

		// Close the database connection.
		$conn = NULL;

		return $list;
	}
}
?>