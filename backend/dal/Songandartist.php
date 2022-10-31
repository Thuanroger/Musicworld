<?php
require_once("dbInfo.php");

class Songandartist {
	public $artistId;
	public $description;
	public $flag;
	public $saId;
	public $songId;

	public function addSongandartist() {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
		$conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

		// Insert query.
		$sql = "INSERT INTO `songandartist`
				(
					`ArtistId`,
					`Description`,
					`Flag`,
					`SongId`
				)
				VALUES
				(
					:artistId,
					:description,
					:flag,
					:songId
				);";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute(array(
			":artistId" => $this->artistId,
			":description" => $this->description,
			":flag" => $this->flag,
			":songId" => $this->songId));

		// Get value of the auto increment column.
		$newId = $conn->lastInsertId();
		$this->saId = $newId;

		// Close the database connection.
		$conn = NULL;

		// Return the id.
		return $newId;
	}

	public function updateSongandartist() {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
		$conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

		// Update query.
		$sql = "UPDATE	`songandartist`
				SET		`ArtistId` = :artistId,
						`Description` = :description,
						`Flag` = :flag,
						`SongId` = :songId
				WHERE	`SaId` = :saId;";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute(array(
			":artistId" => $this->artistId,
			":description" => $this->description,
			":flag" => $this->flag,
			":saId" => $this->saId,
			":songId" => $this->songId));

		// Close the database connection.
		$conn = NULL;
	}

	public static function deleteSongandartist($saId) {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
		$conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

		// Delete query.
		$sql = "DELETE	FROM `songandartist`
				WHERE	`SaId` = :saId;";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute(array(":saId" => $saId));

		// Close the database connection.
		$conn = NULL;
	}

	public static function getSongandartist($saId) {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
		$conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

		// Select query.
		$sql = "SELECT	`ArtistId`,
						`Description`,
						`Flag`,
						`SaId`,
						`SongId`
				FROM	`songandartist`
				WHERE	`SaId` = :saId;";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute(array(":saId" => $saId));

		// Fetch record.
		$songandartist = NULL;
		if($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$songandartist = new Songandartist();
			$songandartist->artistId = $row["ArtistId"];
			$songandartist->description = $row["Description"];
			$songandartist->flag = $row["Flag"];
			$songandartist->saId = $row["SaId"];
			$songandartist->songId = $row["SongId"];
		}

		// Close the database connection.
		$conn = NULL;

		return $songandartist;
	}

	public static function getAllRecords($pageNo, $pageSize, &$totalRecords, $sortColumn, $sortOrder) {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
		$conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

		// Validate sort column and order.
		$defaultSortColumn = "`SaId`";
		$sortColumns = Array("ARTISTID", "DESCRIPTION", "FLAG", "SAID", "SONGID");
		$sortColumn = in_array(strtoupper($sortColumn), $sortColumns) ? "`$sortColumn`" : $defaultSortColumn;
		$sortOrder = strcasecmp($sortOrder, "DESC") == 0 ? "DESC" : "ASC";

		$pageNo = (int)$pageNo;
		$pageSize = (int)$pageSize;

		$sql = "SELECT	COUNT(*) AS Count
				FROM	`songandartist`;";

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

		$sql = "SELECT	`ArtistId`,
						`Description`,
						`Flag`,
						`SaId`,
						`SongId`
				FROM	`songandartist`
				ORDER BY $sortColumn $sortOrder
				LIMIT $start, $pageSize;";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute();

		// Fetch all records.
		$list = Array();
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$songandartist = new Songandartist();
			$songandartist->artistId = $row["ArtistId"];
			$songandartist->description = $row["Description"];
			$songandartist->flag = $row["Flag"];
			$songandartist->saId = $row["SaId"];
			$songandartist->songId = $row["SongId"];

			array_push($list, $songandartist);
		}

		// Close the database connection.
		$conn = NULL;

		return $list;
	}
}
?>