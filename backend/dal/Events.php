<?php
require_once("dbInfo.php");

class Events {
	public $description;
	public $eventId;
	public $eventName;
	public $flag;
	public $musicId;

	public function addEvents() {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
		$conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

		// Insert query.
		$sql = "INSERT INTO `events`
				(
					`Description`,
					`EventName`,
					`Flag`,
					`MusicId`
				)
				VALUES
				(
					:description,
					:eventName,
					:flag,
					:musicId
				);";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute(array(
			":description" => $this->description,
			":eventName" => $this->eventName,
			":flag" => $this->flag,
			":musicId" => $this->musicId));

		// Get value of the auto increment column.
		$newId = $conn->lastInsertId();
		$this->eventId = $newId;

		// Close the database connection.
		$conn = NULL;

		// Return the id.
		return $newId;
	}

	public function updateEvents() {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
		$conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

		// Update query.
		$sql = "UPDATE	`events`
				SET		`Description` = :description,
						`EventName` = :eventName,
						`Flag` = :flag,
						`MusicId` = :musicId
				WHERE	`EventId` = :eventId;";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute(array(
			":description" => $this->description,
			":eventId" => $this->eventId,
			":eventName" => $this->eventName,
			":flag" => $this->flag,
			":musicId" => $this->musicId));

		// Close the database connection.
		$conn = NULL;
	}

	public static function deleteEvents($eventId) {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
		$conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

		// Delete query.
		$sql = "DELETE	FROM `events`
				WHERE	`EventId` = :eventId;";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute(array(":eventId" => $eventId));

		// Close the database connection.
		$conn = NULL;
	}

	public static function getEvents($eventId) {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
		$conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

		// Select query.
		$sql = "SELECT	`Description`,
						`EventId`,
						`EventName`,
						`Flag`,
						`MusicId`
				FROM	`events`
				WHERE	`EventId` = :eventId;";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute(array(":eventId" => $eventId));

		// Fetch record.
		$events = NULL;
		if($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$events = new Events();
			$events->description = $row["Description"];
			$events->eventId = $row["EventId"];
			$events->eventName = $row["EventName"];
			$events->flag = $row["Flag"];
			$events->musicId = $row["MusicId"];
		}

		// Close the database connection.
		$conn = NULL;

		return $events;
	}

	public static function getAllRecords($pageNo, $pageSize, &$totalRecords, $sortColumn, $sortOrder) {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
		$conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

		// Validate sort column and order.
		$defaultSortColumn = "`EventId`";
		$sortColumns = Array("DESCRIPTION", "EVENTID", "EVENTNAME", "FLAG", "MUSICID");
		$sortColumn = in_array(strtoupper($sortColumn), $sortColumns) ? "`$sortColumn`" : $defaultSortColumn;
		$sortOrder = strcasecmp($sortOrder, "DESC") == 0 ? "DESC" : "ASC";

		$pageNo = (int)$pageNo;
		$pageSize = (int)$pageSize;

		$sql = "SELECT	COUNT(*) AS Count
				FROM	`events`;";

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
						`EventId`,
						`EventName`,
						`Flag`,
						`MusicId`
				FROM	`events`
				ORDER BY $sortColumn $sortOrder
				LIMIT $start, $pageSize;";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute();

		// Fetch all records.
		$list = Array();
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$events = new Events();
			$events->description = $row["Description"];
			$events->eventId = $row["EventId"];
			$events->eventName = $row["EventName"];
			$events->flag = $row["Flag"];
			$events->musicId = $row["MusicId"];

			array_push($list, $events);
		}

		// Close the database connection.
		$conn = NULL;

		return $list;
	}
}
?>