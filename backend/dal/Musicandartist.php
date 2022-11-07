<?php
require_once("dbInfo.php");

class Musicandartist {
	public $artistId;
	public $description;
	public $flag;
	public $msA;
	public $musicTypeId;

	public function addMusicandartist() {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
		$conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

		// Insert query.
		$sql = "INSERT INTO `musicandartist`
				(
					`ArtistId`,
					`Description`,
					`Flag`,
					`MusicTypeId`
				)
				VALUES
				(
					:artistId,
					:description,
					:flag,
					:musicTypeId
				);";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute(array(
			":artistId" => $this->artistId,
			":description" => $this->description,
			":flag" => $this->flag,
			":musicTypeId" => $this->musicTypeId));

		// Get value of the auto increment column.
		$newId = $conn->lastInsertId();
		$this->msA = $newId;

		// Close the database connection.
		$conn = NULL;

		// Return the id.
		return $newId;
	}

	public function updateMusicandartist() {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
		$conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

		// Update query.
		$sql = "UPDATE	`musicandartist`
				SET		`ArtistId` = :artistId,
						`Description` = :description,
						`Flag` = :flag,
						`MusicTypeId` = :musicTypeId
				WHERE	`MsA` = :msA;";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute(array(
			":artistId" => $this->artistId,
			":description" => $this->description,
			":flag" => $this->flag,
			":msA" => $this->msA,
			":musicTypeId" => $this->musicTypeId));

		// Close the database connection.
		$conn = NULL;
	}
	public function updateMusicandartist2() {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
		$conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

		// Update query.
		$sql = "UPDATE	`musicandartist`
				SET		
						`Flag` = :flag,		
				WHERE	`MsA` = :msA;";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute(array(
			":flag" => $this->flag,
			":msA" => $this->msA,
			));

		// Close the database connection.
		$conn = NULL;
		return true;
	}

	public static function deleteMusicandartist($msA) {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
		$conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

		// Delete query.
		$sql = "DELETE	FROM `musicandartist`
				WHERE	`MsA` = :msA;";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute(array(":msA" => $msA));

		// Close the database connection.
		$conn = NULL;
	}

	public static function getMusicandartist($msA) {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
		$conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

		// Select query.
		$sql = "SELECT	`ArtistId`,
						`Description`,
						`Flag`,
						`MsA`,
						`MusicTypeId`
				FROM	`musicandartist`
				WHERE	`MsA` = :msA;";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute(array(":msA" => $msA));

		// Fetch record.
		$musicandartist = NULL;
		if($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$musicandartist = new Musicandartist();
			$musicandartist->artistId = $row["ArtistId"];
			$musicandartist->description = $row["Description"];
			$musicandartist->flag = $row["Flag"];
			$musicandartist->msA = $row["MsA"];
			$musicandartist->musicTypeId = $row["MusicTypeId"];
		}

		// Close the database connection.
		$conn = NULL;

		return $musicandartist;
	}
	
Public static function getcount(){
	$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
	$dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
	$conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

	$sql = "SELECT	COUNT(*) AS Count
			FROM	`musicandartist`;";

	// Prepare statement.
	$stmt = $conn->prepare($sql);

	// Execute the statement.
	$stmt->execute();
;
	// Get total records count.
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	return $row['Count'];
	$stmt = NULL;
}
	public static function getAllRecords($pageNo, $pageSize, &$totalRecords) {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
		$conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

		// // Validate sort column and order.
		// $defaultSortColumn = "`MsA`";
		// $sortColumns = Array("ARTISTID", "DESCRIPTION", "FLAG", "MSA", "MUSICTYPEID");
		// $sortColumn = in_array(strtoupper($sortColumn), $sortColumns) ? "`$sortColumn`" : $defaultSortColumn;
		// $sortOrder = strcasecmp($sortOrder, "DESC") == 0 ? "DESC" : "ASC";

		$pageNo = (int)$pageNo;
		$pageSize = (int)$pageSize;

		$sql = "SELECT	COUNT(*) AS Count
				FROM	`musicandartist`;";

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
						`MsA`,
						`MusicTypeId`
				FROM	`musicandartist`
				ORDER BY `MsA` DESC
				LIMIT $start, $pageSize;";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute();

		// Fetch all records.
		$list = Array();
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$musicandartist = new Musicandartist();
			$musicandartist->artistId = $row["ArtistId"];
			$musicandartist->description = $row["Description"];
			$musicandartist->flag = $row["Flag"];
			$musicandartist->msA = $row["MsA"];
			$musicandartist->musicTypeId = $row["MusicTypeId"];

			array_push($list, $musicandartist);
		}

		// Close the database connection.
		$conn = NULL;

		return $list;
	}
}
?>