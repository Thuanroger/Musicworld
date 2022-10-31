<?php
require_once("dbInfo.php");

class Song {
	public $description;
	public $flag;
	public $length;
	public $level;
	public $picture;
	public $songId;
	public $songName;
	public $status;
	public $urlSong;

	public function addSong() {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
		$conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

		// Insert query.
		$sql = "INSERT INTO `song`
				(
					`Description`,
					`Flag`,
					`Length`,
					`Level`,
					`Picture`,
					`SongName`,
					`Status`,
					`UrlSong`
				)
				VALUES
				(
					:description,
					:flag,
					:length,
					:level,
					:picture,
					:songName,
					:status,
					:urlSong
				);";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute(array(
			":description" => $this->description,
			":flag" => $this->flag,
			":length" => $this->length,
			":level" => $this->level,
			":picture" => $this->picture,
			":songName" => $this->songName,
			":status" => $this->status,
			":urlSong" => $this->urlSong));

		// Get value of the auto increment column.
		$newId = $conn->lastInsertId();
		$this->songId = $newId;

		// Close the database connection.
		$conn = NULL;

		// Return the id.
		return $newId;
	}

	public function updateSong() {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
		$conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

		// Update query.
		$sql = "UPDATE	`song`
				SET		`Description` = :description,
						`Flag` = :flag,
						`Length` = :length,
						`Level` = :level,
						`Picture` = :picture,
						`SongName` = :songName,
						`Status` = :status,
						`UrlSong` = :urlSong
				WHERE	`SongId` = :songId;";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute(array(
			":description" => $this->description,
			":flag" => $this->flag,
			":length" => $this->length,
			":level" => $this->level,
			":picture" => $this->picture,
			":songId" => $this->songId,
			":songName" => $this->songName,
			":status" => $this->status,
			":urlSong" => $this->urlSong));

		// Close the database connection.
		$conn = NULL;
	}

	public static function deleteSong($songId) {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
		$conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

		// Delete query.
		$sql = "DELETE	FROM `song`
				WHERE	`SongId` = :songId;";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute(array(":songId" => $songId));

		// Close the database connection.
		$conn = NULL;
	}

	public static function getSong($songId) {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
		$conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

		// Select query.
		$sql = "SELECT	`Description`,
						`Flag`,
						`Length`,
						`Level`,
						`Picture`,
						`SongId`,
						`SongName`,
						`Status`,
						`UrlSong`
				FROM	`song`
				WHERE	`SongId` = :songId;";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute(array(":songId" => $songId));

		// Fetch record.
		$song = NULL;
		if($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$song = new Song();
			$song->description = $row["Description"];
			$song->flag = $row["Flag"];
			$song->length = $row["Length"];
			$song->level = $row["Level"];
			$song->picture = $row["Picture"];
			$song->songId = $row["SongId"];
			$song->songName = $row["SongName"];
			$song->status = $row["Status"];
			$song->urlSong = $row["UrlSong"];
		}

		// Close the database connection.
		$conn = NULL;

		return $song;
	}

	public static function getAllRecords($pageNo, $pageSize, &$totalRecords) {
//             $sortColumn, $sortOrder
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
		$conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

		// Validate sort column and order.
//		$defaultSortColumn = "`SongId`";
//		$sortColumns = Array("DESCRIPTION", "FLAG", "LENGTH", "LEVEL", "PICTURE", "SONGID", "SONGNAME", "STATUS", "URLSONG");
//		$sortColumn = in_array(strtoupper($sortColumn), $sortColumns) ? "`$sortColumn`" : $defaultSortColumn;
//		$sortOrder = strcasecmp($sortOrder, "DESC") == 0 ? "DESC" : "ASC";

		$pageNo = (int)$pageNo;
		$pageSize = (int)$pageSize;

		$sql = "SELECT	COUNT(*) AS Count
				FROM	`song`;";

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
						`Length`,
						`Level`,
						`Picture`,
						`SongId`,
						`SongName`,
						`Status`,
						`UrlSong`
				FROM	`song`
				
				LIMIT $start, $pageSize;";
//                ORDER BY $sortColumn $sortOrder
		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute();

		// Fetch all records.
		$list = Array();
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$song = new Song();
			$song->description = $row["Description"];
			$song->flag = $row["Flag"];
			$song->length = $row["Length"];
			$song->level = $row["Level"];
			$song->picture = $row["Picture"];
			$song->songId = $row["SongId"];
			$song->songName = $row["SongName"];
			$song->status = $row["Status"];
			$song->urlSong = $row["UrlSong"];

			array_push($list, $song);
		}

		// Close the database connection.
		$conn = NULL;

		return $list;
	}
}
?>