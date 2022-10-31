<?php
require_once("dbInfo.php");

class Albumandsong {
	public $albumId;
	public $aSId;
	public $description;
	public $flag;
	public $songId;

	public function addAlbumandsong() {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
		$conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

		// Insert query.
		$sql = "INSERT INTO `albumandsong`
				(
					`AlbumId`,
					`Description`,
					`Flag`,
					`SongId`
				)
				VALUES
				(
					:albumId,
					:description,
					:flag,
					:songId
				);";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute(array(
			":albumId" => $this->albumId,
			":description" => $this->description,
			":flag" => $this->flag,
			":songId" => $this->songId));

		// Get value of the auto increment column.
		$newId = $conn->lastInsertId();
		$this->aSId = $newId;

		// Close the database connection.
		$conn = NULL;

		// Return the id.
		return $newId;
	}

	public function updateAlbumandsong() {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
		$conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

		// Update query.
		$sql = "UPDATE	`albumandsong`
				SET		`AlbumId` = :albumId,
						`Description` = :description,
						`Flag` = :flag,
						`SongId` = :songId
				WHERE	`ASId` = :aSId;";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute(array(
			":albumId" => $this->albumId,
			":aSId" => $this->aSId,
			":description" => $this->description,
			":flag" => $this->flag,
			":songId" => $this->songId));

		// Close the database connection.
		$conn = NULL;
	}

	public static function deleteAlbumandsong($aSId) {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
		$conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

		// Delete query.
		$sql = "DELETE	FROM `albumandsong`
				WHERE	`ASId` = :aSId;";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute(array(":aSId" => $aSId));

		// Close the database connection.
		$conn = NULL;
	}

	public static function getAlbumandsong($aSId) {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
		$conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

		// Select query.
		$sql = "SELECT	`AlbumId`,
						`ASId`,
						`Description`,
						`Flag`,
						`SongId`
				FROM	`albumandsong`
				WHERE	`ASId` = :aSId;";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute(array(":aSId" => $aSId));

		// Fetch record.
		$albumandsong = NULL;
		if($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$albumandsong = new Albumandsong();
			$albumandsong->albumId = $row["AlbumId"];
			$albumandsong->aSId = $row["ASId"];
			$albumandsong->description = $row["Description"];
			$albumandsong->flag = $row["Flag"];
			$albumandsong->songId = $row["SongId"];
		}

		// Close the database connection.
		$conn = NULL;

		return $albumandsong;
	}

	public static function getAllRecords($pageNo, $pageSize, &$totalRecords, $sortColumn, $sortOrder) {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
		$conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

		// Validate sort column and order.
		$defaultSortColumn = "`ASId`";
		$sortColumns = Array("ALBUMID", "ASID", "DESCRIPTION", "FLAG", "SONGID");
		$sortColumn = in_array(strtoupper($sortColumn), $sortColumns) ? "`$sortColumn`" : $defaultSortColumn;
		$sortOrder = strcasecmp($sortOrder, "DESC") == 0 ? "DESC" : "ASC";

		$pageNo = (int)$pageNo;
		$pageSize = (int)$pageSize;

		$sql = "SELECT	COUNT(*) AS Count
				FROM	`albumandsong`;";

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

		$sql = "SELECT	`AlbumId`,
						`ASId`,
						`Description`,
						`Flag`,
						`SongId`
				FROM	`albumandsong`
				ORDER BY $sortColumn $sortOrder
				LIMIT $start, $pageSize;";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute();

		// Fetch all records.
		$list = Array();
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$albumandsong = new Albumandsong();
			$albumandsong->albumId = $row["AlbumId"];
			$albumandsong->aSId = $row["ASId"];
			$albumandsong->description = $row["Description"];
			$albumandsong->flag = $row["Flag"];
			$albumandsong->songId = $row["SongId"];

			array_push($list, $albumandsong);
		}

		// Close the database connection.
		$conn = NULL;

		return $list;
	}
}
?>