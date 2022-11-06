<?php
require_once("dbInfo.php");

class Publishers {
	public $description;
	public $flag;
	public $publisherid;
	public $publisherName;
	public $yearPub;

	public function addPublishers() {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
		$conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

		// Insert query.
		$sql = "INSERT INTO `publishers`
				(
					`Description`,
					`Flag`,
					`PublisherName`,
					`YearPub`
				)
				VALUES
				(
					:description,
					:flag,
					:publisherName,
					:yearPub
				);";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute(array(
			":description" => $this->description,
			":flag" => $this->flag,
			":publisherName" => $this->publisherName,
			":yearPub" => $this->yearPub));

		// Get value of the auto increment column.
		$newId = $conn->lastInsertId();
		$this->publisherid = $newId;

		// Close the database connection.
		$conn = NULL;

		// Return the id.
		return $newId;
	}

	public function updatePublishers() {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
		$conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

		// Update query.
		$sql = "UPDATE	`publishers`
				SET		`Description` = :description,
						`Flag` = :flag,
						`PublisherName` = :publisherName,
						`YearPub` = :yearPub
				WHERE	`Publisherid` = :publisherid;";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute(array(
			":description" => $this->description,
			":flag" => $this->flag,
			":publisherid" => $this->publisherid,
			":publisherName" => $this->publisherName,
			":yearPub" => $this->yearPub));

		// Close the database connection.
		$conn = NULL;
	}
	public function updatePublishers2() {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
		$conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

		// Update query.
		$sql = "UPDATE	`publishers`
				SET		
						`Flag` = :flag
					
						
				WHERE	`Publisherid` = :publisherid;";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute(array(
		
			":flag" => $this->flag,
			":publisherid" => $this->publisherid

			));

		// Close the database connection.
		$conn = NULL;
		return true;
	}

	public static function deletePublishers($publisherid) {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
		$conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

		// Delete query.
		$sql = "DELETE	FROM `publishers`
				WHERE	`Publisherid` = :publisherid;";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute(array(":publisherid" => $publisherid));

		// Close the database connection.
		$conn = NULL;
	}

	public static function getPublishers($publisherid) {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
		$conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

		// Select query.
		$sql = "SELECT	`Description`,
						`Flag`,
						`Publisherid`,
						`PublisherName`,
						`YearPub`
				FROM	`publishers`
				WHERE	`Publisherid` = :publisherid;";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute(array(":publisherid" => $publisherid));

		// Fetch record.
		$publishers = NULL;
		if($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$publishers = new Publishers();
			$publishers->description = $row["Description"];
			$publishers->flag = $row["Flag"];
			$publishers->publisherid = $row["Publisherid"];
			$publishers->publisherName = $row["PublisherName"];
			$publishers->yearPub = $row["YearPub"];
		}

		// Close the database connection.
		$conn = NULL;

		return $publishers;
	}

	public static function getAllRecords($pageNo, $pageSize, &$totalRecords) {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
		$conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

		// Validate sort column and order.
		// $defaultSortColumn = "`Publisherid`";
		// $sortColumns = Array("DESCRIPTION", "FLAG", "PUBLISHERID", "PUBLISHERNAME", "YEARPUB");
		// $sortColumn = in_array(strtoupper($sortColumn), $sortColumns) ? "`$sortColumn`" : $defaultSortColumn;
		// $sortOrder = strcasecmp($sortOrder, "DESC") == 0 ? "DESC" : "ASC";

		$pageNo = (int)$pageNo;
		$pageSize = (int)$pageSize;

		$sql = "SELECT	COUNT(*) AS Count
				FROM	`publishers`;";

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
						`Publisherid`,
						`PublisherName`,
						`YearPub`
				FROM	`publishers`
				ORDER BY `Publisherid` DESC
				LIMIT $start, $pageSize;";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute();

		// Fetch all records.
		$list = Array();
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$publishers = new Publishers();
			$publishers->description = $row["Description"];
			$publishers->flag = $row["Flag"];
			$publishers->publisherid = $row["Publisherid"];
			$publishers->publisherName = $row["PublisherName"];
			$publishers->yearPub = $row["YearPub"];

			array_push($list, $publishers);
		}

		// Close the database connection.
		$conn = NULL;

		return $list;
	}
}
?>