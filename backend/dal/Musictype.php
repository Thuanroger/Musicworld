<?php
require_once("dbInfo.php");

class Musictype {
	public $description;
	public $flag;
	public $musicTypeId;
	public $musicTypeName;
	public $parentId;
	public $picture;

	public function addMusictype() {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
		$conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

		// Insert query.
		$sql = "INSERT INTO `musictype`
				(
					`Description`,
					`Flag`,
					`MusicTypeName`,
					`ParentId`,
					`Picture`
				)
				VALUES
				(
					:description,
					:flag,
					:musicTypeName,
					:parentId,
					:picture
				);";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute(array(
			":description" => $this->description,
			":flag" => $this->flag,
			":musicTypeName" => $this->musicTypeName,
			":parentId" => $this->parentId,
			":picture" => $this->picture));

		// Get value of the auto increment column.
		$newId = $conn->lastInsertId();
		$this->musicTypeId = $newId;

		// Close the database connection.
		$conn = NULL;

		// Return the id.
		return $newId;
	}

	public function updateMusictype() {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
		$conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

		// Update query.
		$sql = "UPDATE	`musictype`
				SET		`Description` = :description,
						`Flag` = :flag,
						`MusicTypeName` = :musicTypeName,
						`ParentId` = :parentId,
						`Picture` = :picture
				WHERE	`MusicTypeId` = :musicTypeId;";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute(array(
			":description" => $this->description,
			":flag" => $this->flag,
			":musicTypeId" => $this->musicTypeId,
			":musicTypeName" => $this->musicTypeName,
			":parentId" => $this->parentId,
			":picture" => $this->picture));

		// Close the database connection.
		$conn = NULL;
	}
	public function updateMusictyp2e() {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
		$conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

		// Update query.
		$sql = "UPDATE	`musictype`
				SET	
						`Flag` = :flag,
				WHERE	`MusicTypeId` = :musicTypeId;";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute(array(	
			":flag" => $this->flag,
			":musicTypeId" => $this->musicTypeId
			));

		// Close the database connection.
		$conn = NULL;
		return true;
	}

	public static function deleteMusictype($musicTypeId) {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
		$conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

		// Delete query.
		$sql = "DELETE	FROM `musictype`
				WHERE	`MusicTypeId` = :musicTypeId;";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute(array(":musicTypeId" => $musicTypeId));

		// Close the database connection.
		$conn = NULL;
	}

	public static function getMusictype($musicTypeId) {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
		$conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

		// Select query.
		$sql = "SELECT	`Description`,
						`Flag`,
						`MusicTypeId`,
						`MusicTypeName`,
						`ParentId`,
						`Picture`
				FROM	`musictype`
				WHERE	`MusicTypeId` = :musicTypeId;";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute(array(":musicTypeId" => $musicTypeId));

		// Fetch record.
		$musictype = NULL;
		if($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$musictype = new Musictype();
			$musictype->description = $row["Description"];
			$musictype->flag = $row["Flag"];
			$musictype->musicTypeId = $row["MusicTypeId"];
			$musictype->musicTypeName = $row["MusicTypeName"];
			$musictype->parentId = $row["ParentId"];
			$musictype->picture = $row["Picture"];
		}

		// Close the database connection.
		$conn = NULL;

		return $musictype;
	}
	
Public static function getcount(){
	$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
	$dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
	$conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

	$sql = "SELECT	COUNT(*) AS Count
			FROM	`musictype`;";

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

		// Validate sort column and order.
		
		$pageNo = (int)$pageNo;
		$pageSize = (int)$pageSize;

		$sql = "SELECT	COUNT(*) AS Count
				FROM	`musictype`;";

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
						`MusicTypeId`,
						`MusicTypeName`,
						`ParentId`,
						`Picture`
				FROM	`musictype`
				ORDER BY `MusicTypeId` DESC
				LIMIT $start, $pageSize;";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute();

		// Fetch all records.
		$list = Array();
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$musictype = new Musictype();
			$musictype->description = $row["Description"];
			$musictype->flag = $row["Flag"];
			$musictype->musicTypeId = $row["MusicTypeId"];
			$musictype->musicTypeName = $row["MusicTypeName"];
			$musictype->parentId = $row["ParentId"];
			$musictype->picture = $row["Picture"];

			array_push($list, $musictype);
		}

		// Close the database connection.
		$conn = NULL;

		return $list;
	}
}
?>