<?php
require_once("dbInfo.php");

class Yearsong {
	public $description;
	public $flag;
	public $songId;
	public $views;
	public $yearName;
	public $yearSongId;

	public function addYearsong() {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
		$conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

		// Insert query.
		$sql = "INSERT INTO `yearsong`
				(
					`Description`,
					`Flag`,
					`SongId`,
					`Views`,
					`YearName`
				)
				VALUES
				(
					:description,
					:flag,
					:songId,
					:views,
					:yearName
				);";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute(array(
			":description" => $this->description,
			":flag" => $this->flag,
			":songId" => $this->songId,
			":views" => $this->views,
			":yearName" => $this->yearName));

		// Get value of the auto increment column.
		$newId = $conn->lastInsertId();
		$this->yearSongId = $newId;

		// Close the database connection.
		$conn = NULL;

		// Return the id.
		return $newId;
	}

	public function updateYearsong() {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
		$conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

		// Update query.
		$sql = "UPDATE	`yearsong`
				SET		`Description` = :description,
						`Flag` = :flag,
						`SongId` = :songId,
						`Views` = :views,
						`YearName` = :yearName
				WHERE	`YearSongId` = :yearSongId;";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute(array(
			":description" => $this->description,
			":flag" => $this->flag,
			":songId" => $this->songId,
			":views" => $this->views,
			":yearName" => $this->yearName,
			":yearSongId" => $this->yearSongId));

		// Close the database connection.
		$conn = NULL;
	}
	public function updateYearsong1() {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
		$conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);
		// Update query.
		$sql = "UPDATE	`yearsong`
				SET		
						`Flag` = :flag
		
				WHERE	`YearSongId` = :yearSongId;";
		// Prepare statement.
		$stmt = $conn->prepare($sql);
		// Execute the statement.
		$stmt->execute(array(
			":flag" => $this->flag,
			":yearSongId" => $this->yearSongId));

		// Close the database connection.
		$conn = NULL;
	}

	public static function deleteYearsong($yearSongId) {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
		$conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

		// Delete query.
		$sql = "DELETE	FROM `yearsong`
				WHERE	`YearSongId` = :yearSongId;";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute(array(":yearSongId" => $yearSongId));

		// Close the database connection.
		$conn = NULL;
	}

	public static function getYearsong($yearSongId) {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
		$conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

		// Select query.
		$sql = "SELECT	`Description`,
						`Flag`,
						`SongId`,
						`Views`,
						`YearName`,
						`YearSongId`
				FROM	`yearsong`
				WHERE	`YearSongId` = :yearSongId;";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute(array(":yearSongId" => $yearSongId));

		// Fetch record.
		$yearsong = NULL;
		if($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$yearsong = new Yearsong();
			$yearsong->description = $row["Description"];
			$yearsong->flag = $row["Flag"];
			$yearsong->songId = $row["SongId"];
			$yearsong->views = $row["Views"];
			$yearsong->yearName = $row["YearName"];
			$yearsong->yearSongId = $row["YearSongId"];
		}

		// Close the database connection.
		$conn = NULL;

		return $yearsong;
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
				FROM	`yearsong`;";

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
						`SongId`,
						`Views`,
						`YearName`,
						`YearSongId`
				FROM	`yearsong`
				
				LIMIT $start, $pageSize;";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute();

		// Fetch all records.
		$list = Array();
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$yearsong = new Yearsong();
			$yearsong->description = $row["Description"];
			$yearsong->flag = $row["Flag"];
			$yearsong->songId = $row["SongId"];
			$yearsong->views = $row["Views"];
			$yearsong->yearName = $row["YearName"];
			$yearsong->yearSongId = $row["YearSongId"];

			array_push($list, $yearsong);
		}

		// Close the database connection.
		$conn = NULL;

		return $list;
	}
}
?>