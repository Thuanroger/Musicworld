<?php
require_once("dbInfo.php");

class Album {
	public $albumId;
	public $albumName;
	public $description;
	public $flag;
	public $level;
	public $picture;
	public $publisherId;
	public $status;

	public function addAlbum() {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
		$conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

		// Insert query.
		$sql = "INSERT INTO `album`
				(
					`AlbumName`,
					`Description`,
					`Flag`,
					`Level`,
					`Picture`,
					`PublisherId`,
					`Status`
				)
				VALUES
				(
					:albumName,
					:description,
					:flag,
					:level,
					:picture,
					:publisherId,
					:status
				);";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute(array(
			":albumName" => $this->albumName,
			":description" => $this->description,
			":flag" => $this->flag,
			":level" => $this->level,
			":picture" => $this->picture,
			":publisherId" => $this->publisherId,
			":status" => $this->status));

		// Get value of the auto increment column.
		$newId = $conn->lastInsertId();
		$this->albumId = $newId;

		// Close the database connection.
		$conn = NULL;

		// Return the id.
		return $newId;
	}

	public function updateAlbum() {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
		$conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

		// Update query.
		$sql = "UPDATE	`album`
				SET		`AlbumName` = :albumName,
						`Description` = :description,
						`Flag` = :flag,
						`Level` = :level,
						`Picture` = :picture,
						`PublisherId` = :publisherId,
						`Status` = :status
				WHERE	`AlbumId` = :albumId;";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute(array(
			":albumId" => $this->albumId,
			":albumName" => $this->albumName,
			":description" => $this->description,
			":flag" => $this->flag,
			":level" => $this->level,
			":picture" => $this->picture,
			":publisherId" => $this->publisherId,
			":status" => $this->status));

		// Close the database connection.
		$conn = NULL;
	}
	public function updateAlbum1() {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
		$conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

		// Update query.
		$sql = "UPDATE	`album`
				SET		
						`Flag` = :flag
				WHERE	`AlbumId` = :albumId;";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute(array(
			":albumId" => $this->albumId,
			":flag" => $this->flag,
			));

		// Close the database connection.
		$conn = NULL;
                 return true;
	}

	public static function deleteAlbum($albumId) {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
		$conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

		// Delete query.
		$sql = "DELETE	FROM `album`
				WHERE	`AlbumId` = :albumId;";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute(array(":albumId" => $albumId));

		// Close the database connection.
		$conn = NULL;
	}

	public static function getAlbum($albumId) {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
		$conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

		// Select query.
		$sql = "SELECT	`AlbumId`,
						`AlbumName`,
						`Description`,
						`Flag`,
						`Level`,
						`Picture`,
						`PublisherId`,
						`Status`
				FROM	`album`
				WHERE	`AlbumId` = :albumId;";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute(array(":albumId" => $albumId));

		// Fetch record.
		$album = NULL;
		if($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$album = new Album();
			$album->albumId = $row["AlbumId"];
			$album->albumName = $row["AlbumName"];
			$album->description = $row["Description"];
			$album->flag = $row["Flag"];
			$album->level = $row["Level"];
			$album->picture = $row["Picture"];
			$album->publisherId = $row["PublisherId"];
			$album->status = $row["Status"];
		}

		// Close the database connection.
		$conn = NULL;

		return $album;
	}
	Public static function getcount(){
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
		$conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

		$sql = "SELECT	COUNT(*) AS Count
				FROM	`album`;";

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
		// $defaultSortColumn = "`AlbumId`";
		// $sortColumns = Array("ALBUMID", "ALBUMNAME", "DESCRIPTION", "FLAG", "LEVEL", "PICTURE", "PUBLISHERID", "STATUS");
		// $sortColumn = in_array(strtoupper($sortColumn), $sortColumns) ? "`$sortColumn`" : $defaultSortColumn;
		// $sortOrder = strcasecmp($sortOrder, "DESC") == 0 ? "DESC" : "ASC";

		$pageNo = (int)$pageNo;
		$pageSize = (int)$pageSize;

		$sql = "SELECT	COUNT(*) AS Count
				FROM	`album`;";

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
						`AlbumName`,
						`Description`,
						`Flag`,
						`Level`,
						`Picture`,
						`PublisherId`,
						`Status`
				FROM	`album`
				ORDER BY `AlbumId` DESC
				LIMIT $start, $pageSize;";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute();

		// Fetch all records.
		$list = Array();
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$album = new Album();
			$album->albumId = $row["AlbumId"];
			$album->albumName = $row["AlbumName"];
			$album->description = $row["Description"];
			$album->flag = $row["Flag"];
			$album->level = $row["Level"];
			$album->picture = $row["Picture"];
			$album->publisherId = $row["PublisherId"];
			$album->status = $row["Status"];

			array_push($list, $album);
		}

		// Close the database connection.
		$conn = NULL;

		return $list;
	}
}
?>