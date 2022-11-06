<?php
require_once("dbInfo.php");

class Artist {
	public $address;
	public $artistId;
	public $birthday;
	public $description;
	public $firstName;
	public $flag;
	public $lastName;
	public $level;
	public $middleName;
	public $picture;
	public $status;
	public $type;

	public function addArtist() {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
		$conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

		// Insert query.
		$sql = "INSERT INTO `artist`
				(
					`Address`,
					`Birthday`,
					`Description`,
					`FirstName`,
					`Flag`,
					`LastName`,
					`Level`,
					`MiddleName`,
					`Picture`,
					`Status`,
					`Type`
				)
				VALUES
				(
					:address,
					STR_TO_DATE(:birthday, '%m/%d/%Y %h:%i %p'),
					:description,
					:firstName,
					:flag,
					:lastName,
					:level,
					:middleName,
					:picture,
					:status,
					:type
				);";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute(array(
			":address" => $this->address,
			":birthday" => $this->birthday,
			":description" => $this->description,
			":firstName" => $this->firstName,
			":flag" => $this->flag,
			":lastName" => $this->lastName,
			":level" => $this->level,
			":middleName" => $this->middleName,
			":picture" => $this->picture,
			":status" => $this->status,
			":type" => $this->type));

		// Get value of the auto increment column.
		$newId = $conn->lastInsertId();
		$this->artistId = $newId;

		// Close the database connection.
		$conn = NULL;

		// Return the id.
		return $newId;
	}

	public function updateArtist() {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
		$conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

		// Update query.
		$sql = "UPDATE	`artist`
				SET		`Address` = :address,
						`Birthday` = STR_TO_DATE(:birthday, '%m/%d/%Y %h:%i %p'),
						`Description` = :description,
						`FirstName` = :firstName,
						`Flag` = :flag,
						`LastName` = :lastName,
						`Level` = :level,
						`MiddleName` = :middleName,
						`Picture` = :picture,
						`Status` = :status,
						`Type` = :type
				WHERE	`ArtistId` = :artistId;";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute(array(
			":address" => $this->address,
			":artistId" => $this->artistId,
			":birthday" => $this->birthday,
			":description" => $this->description,
			":firstName" => $this->firstName,
			":flag" => $this->flag,
			":lastName" => $this->lastName,
			":level" => $this->level,
			":middleName" => $this->middleName,
			":picture" => $this->picture,
			":status" => $this->status,
			":type" => $this->type));

		// Close the database connection.
		$conn = NULL;
	}
	public function updateArtist1() {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
		$conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

		// Update query.
		$sql = "UPDATE	`artist`
				SET		
						`Flag` = :flag,
				WHERE	`ArtistId` = :artistId;";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute(array(
			":artistId" => $this->artistId,
			":flag" => $this->flag,
		));

		// Close the database connection.
		$conn = NULL;
		return true;
	}

	public static function deleteArtist($artistId) {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
		$conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

		// Delete query.
		$sql = "DELETE	FROM `artist`
				WHERE	`ArtistId` = :artistId;";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute(array(":artistId" => $artistId));

		// Close the database connection.
		$conn = NULL;
	}

	public static function getArtist($artistId) {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
		$conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

		// Select query.
		$sql = "SELECT	`Address`,
						`ArtistId`,
						DATE_FORMAT(`Birthday`, '%m/%d/%Y %h:%i %p') AS Birthday,
						`Description`,
						`FirstName`,
						`Flag`,
						`LastName`,
						`Level`,
						`MiddleName`,
						`Picture`,
						`Status`,
						`Type`
				FROM	`artist`
				WHERE	`ArtistId` = :artistId;";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute(array(":artistId" => $artistId));

		// Fetch record.
		$artist = NULL;
		if($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$artist = new Artist();
			$artist->address = $row["Address"];
			$artist->artistId = $row["ArtistId"];
			$artist->birthday = $row["Birthday"];
			$artist->description = $row["Description"];
			$artist->firstName = $row["FirstName"];
			$artist->flag = $row["Flag"];
			$artist->lastName = $row["LastName"];
			$artist->level = $row["Level"];
			$artist->middleName = $row["MiddleName"];
			$artist->picture = $row["Picture"];
			$artist->status = $row["Status"];
			$artist->type = $row["Type"];
		}

		// Close the database connection.
		$conn = NULL;

		return $artist;
	}
	Public static function getcount(){
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
		$conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

		$sql = "SELECT	COUNT(*) AS Count
				FROM	`artist`;";

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
	//, $sortColumn, $sortOrder{
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
		$conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

		// Validate sort column and order.
		// $defaultSortColumn = "`ArtistId`";
		// $sortColumns = Array("ADDRESS", "ARTISTID", "BIRTHDAY", "DESCRIPTION", "FIRSTNAME", "FLAG", "LASTNAME", "LEVEL", "MIDDLENAME", "PICTURE", "STATUS", "TYPE");
		// $sortColumn = in_array(strtoupper($sortColumn), $sortColumns) ? "`$sortColumn`" : $defaultSortColumn;
		// $sortOrder = strcasecmp($sortOrder, "DESC") == 0 ? "DESC" : "ASC";

		$pageNo = (int)$pageNo;
		$pageSize = (int)$pageSize;

		$sql = "SELECT	COUNT(*) AS Count
				FROM	`artist`;";

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

		$sql = "SELECT	`Address`,
						`ArtistId`,
						DATE_FORMAT(`Birthday`, '%m/%d/%Y %h:%i %p') AS Birthday,
						`Description`,
						`FirstName`,
						`Flag`,
						`LastName`,
						`Level`,
						`MiddleName`,
						`Picture`,
						`Status`,
						`Type`
				FROM	`artist`
				ORDER BY `ArtistId` DESC
				LIMIT $start, $pageSize;";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute();

		// Fetch all records.
		$list = Array();
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$artist = new Artist();
			$artist->address = $row["Address"];
			$artist->artistId = $row["ArtistId"];
			$artist->birthday = $row["Birthday"];
			$artist->description = $row["Description"];
			$artist->firstName = $row["FirstName"];
			$artist->flag = $row["Flag"];
			$artist->lastName = $row["LastName"];
			$artist->level = $row["Level"];
			$artist->middleName = $row["MiddleName"];
			$artist->picture = $row["Picture"];
			$artist->status = $row["Status"];
			$artist->type = $row["Type"];

			array_push($list, $artist);
		}

		// Close the database connection.
		$conn = NULL;

		return $list;
	}
}
?>