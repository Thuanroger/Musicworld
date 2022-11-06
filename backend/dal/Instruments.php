<?php
require_once("dbInfo.php");

class Instruments {
	public $description;
	public $flag;
	public $instrumentId;
	public $instrumentName;

	public function addInstruments() {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
		$conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

		// Insert query.
		$sql = "INSERT INTO `instruments`
				(
					`Description`,
					`Flag`,
					`InstrumentName`
				)
				VALUES
				(
					:description,
					:flag,
					:instrumentName
				);";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute(array(
			":description" => $this->description,
			":flag" => $this->flag,
			":instrumentName" => $this->instrumentName));

		// Get value of the auto increment column.
		$newId = $conn->lastInsertId();
		$this->instrumentId = $newId;

		// Close the database connection.
		$conn = NULL;

		// Return the id.
		return $newId;
	}

	public function updateInstruments() {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
		$conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

		// Update query.
		$sql = "UPDATE	`instruments`
				SET		`Description` = :description,
						`Flag` = :flag,
						`InstrumentName` = :instrumentName
				WHERE	`InstrumentId` = :instrumentId;";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute(array(
			":description" => $this->description,
			":flag" => $this->flag,
			":instrumentId" => $this->instrumentId,
			":instrumentName" => $this->instrumentName));

		// Close the database connection.
		$conn = NULL;
	}
	public function updateInstruments1() {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
		$conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

		// Update query.
		$sql = "UPDATE	`instruments`
				SET		
						`Flag` = :flag,
						
				WHERE	`InstrumentId` = :instrumentId;";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute(array(
			
			":flag" => $this->flag,
			":instrumentId" => $this->instrumentId
			));

		// Close the database connection.
		$conn = NULL;
	}

	public static function deleteInstruments($instrumentId) {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
		$conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

		// Delete query.
		$sql = "DELETE	FROM `instruments`
				WHERE	`InstrumentId` = :instrumentId;";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute(array(":instrumentId" => $instrumentId));

		// Close the database connection.
		$conn = NULL;
	}

	public static function getInstruments($instrumentId) {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
		$conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

		// Select query.
		$sql = "SELECT	`Description`,
						`Flag`,
						`InstrumentId`,
						`InstrumentName`
				FROM	`instruments`
				WHERE	`InstrumentId` = :instrumentId;";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute(array(":instrumentId" => $instrumentId));

		// Fetch record.
		$instruments = NULL;
		if($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$instruments = new Instruments();
			$instruments->description = $row["Description"];
			$instruments->flag = $row["Flag"];
			$instruments->instrumentId = $row["InstrumentId"];
			$instruments->instrumentName = $row["InstrumentName"];
		}

		// Close the database connection.
		$conn = NULL;

		return $instruments;
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
				FROM	`instruments`;";

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
						`Flag`,
						`InstrumentId`,
						`InstrumentName`
				FROM	`instruments`
				ORDER BY `InstrumentId` DESC
				LIMIT $start, $pageSize;";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute();

		// Fetch all records.
		$list = Array();
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$instruments = new Instruments();
			$instruments->description = $row["Description"];
			$instruments->flag = $row["Flag"];
			$instruments->instrumentId = $row["InstrumentId"];
			$instruments->instrumentName = $row["InstrumentName"];

			array_push($list, $instruments);
		}

		// Close the database connection.
		$conn = NULL;

		return $list;
	}
}
?>