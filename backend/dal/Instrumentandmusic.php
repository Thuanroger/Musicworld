<?php
require_once("dbInfo.php");

class Instrumentandmusic {
	public $description;
	public $flag;
	public $iamId;
	public $instrumentId;
	public $musicId;

	public function addInstrumentandmusic() {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
		$conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

		// Insert query.
		$sql = "INSERT INTO `instrumentandmusic`
				(
					`Description`,
					`Flag`,
					`InstrumentId`,
					`MusicId`
				)
				VALUES
				(
					:description,
					:flag,
					:instrumentId,
					:musicId
				);";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute(array(
			":description" => $this->description,
			":flag" => $this->flag,
			":instrumentId" => $this->instrumentId,
			":musicId" => $this->musicId));

		// Get value of the auto increment column.
		$newId = $conn->lastInsertId();
		$this->iamId = $newId;

		// Close the database connection.
		$conn = NULL;

		// Return the id.
		return $newId;
	}

	public function updateInstrumentandmusic() {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
		$conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

		// Update query.
		$sql = "UPDATE	`instrumentandmusic`
				SET		`Description` = :description,
						`Flag` = :flag,
						`InstrumentId` = :instrumentId,
						`MusicId` = :musicId
				WHERE	`IamId` = :iamId;";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute(array(
			":description" => $this->description,
			":flag" => $this->flag,
			":iamId" => $this->iamId,
			":instrumentId" => $this->instrumentId,
			":musicId" => $this->musicId));

		// Close the database connection.
		$conn = NULL;
	}

	public static function deleteInstrumentandmusic($iamId) {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
		$conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

		// Delete query.
		$sql = "DELETE	FROM `instrumentandmusic`
				WHERE	`IamId` = :iamId;";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute(array(":iamId" => $iamId));

		// Close the database connection.
		$conn = NULL;
	}

	public static function getInstrumentandmusic($iamId) {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
		$conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

		// Select query.
		$sql = "SELECT	`Description`,
						`Flag`,
						`IamId`,
						`InstrumentId`,
						`MusicId`
				FROM	`instrumentandmusic`
				WHERE	`IamId` = :iamId;";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute(array(":iamId" => $iamId));

		// Fetch record.
		$instrumentandmusic = NULL;
		if($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$instrumentandmusic = new Instrumentandmusic();
			$instrumentandmusic->description = $row["Description"];
			$instrumentandmusic->flag = $row["Flag"];
			$instrumentandmusic->iamId = $row["IamId"];
			$instrumentandmusic->instrumentId = $row["InstrumentId"];
			$instrumentandmusic->musicId = $row["MusicId"];
		}

		// Close the database connection.
		$conn = NULL;

		return $instrumentandmusic;
	}

	public static function getAllRecords($pageNo, $pageSize, &$totalRecords, $sortColumn, $sortOrder) {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
		$conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

		// Validate sort column and order.
		$defaultSortColumn = "`IamId`";
		$sortColumns = Array("DESCRIPTION", "FLAG", "IAMID", "INSTRUMENTID", "MUSICID");
		$sortColumn = in_array(strtoupper($sortColumn), $sortColumns) ? "`$sortColumn`" : $defaultSortColumn;
		$sortOrder = strcasecmp($sortOrder, "DESC") == 0 ? "DESC" : "ASC";

		$pageNo = (int)$pageNo;
		$pageSize = (int)$pageSize;

		$sql = "SELECT	COUNT(*) AS Count
				FROM	`instrumentandmusic`;";

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
						`IamId`,
						`InstrumentId`,
						`MusicId`
				FROM	`instrumentandmusic`
				ORDER BY $sortColumn $sortOrder
				LIMIT $start, $pageSize;";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute();

		// Fetch all records.
		$list = Array();
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$instrumentandmusic = new Instrumentandmusic();
			$instrumentandmusic->description = $row["Description"];
			$instrumentandmusic->flag = $row["Flag"];
			$instrumentandmusic->iamId = $row["IamId"];
			$instrumentandmusic->instrumentId = $row["InstrumentId"];
			$instrumentandmusic->musicId = $row["MusicId"];

			array_push($list, $instrumentandmusic);
		}

		// Close the database connection.
		$conn = NULL;

		return $list;
	}
}
?>