<?php
require_once("dbInfo.php");

class User {
	public $birthday;
	public $description;
	public $firstName;
	public $flag;
	public $gmail;
	public $lastName;
	public $level;
	public $middleName;
	public $password;
	public $phone;
	public $picture;
	public $status;
	public $userId;
	public $userName;

	public function addUser() {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
		$conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

		// Insert query.
		$sql = "INSERT INTO `user`
				(
					`Birthday`,
					`Description`,
					`FirstName`,
					`Flag`,
					`Gmail`,
					`LastName`,
					`Level`,
					`MiddleName`,
					`Password`,
					`Phone`,
					`Picture`,
					`Status`,
					`UserName`
				)
				VALUES
				(
					STR_TO_DATE(:birthday, '%m/%d/%Y %h:%i %p'),
					:description,
					:firstName,
					:flag,
					:gmail,
					:lastName,
					:level,
					:middleName,
					:password,
					:phone,
					:picture,
					:status,
					:userName
				);";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute(array(
			":birthday" => $this->birthday,
			":description" => $this->description,
			":firstName" => $this->firstName,
			":flag" => $this->flag,
			":gmail" => $this->gmail,
			":lastName" => $this->lastName,
			":level" => $this->level,
			":middleName" => $this->middleName,
			":password" => $this->password,
			":phone" => $this->phone,
			":picture" => $this->picture,
			":status" => $this->status,
			":userName" => $this->userName));

		// Get value of the auto increment column.
		$newId = $conn->lastInsertId();
		$this->userId = $newId;

		// Close the database connection.
		$conn = NULL;

		// Return the id.
		return $newId;
	}

	public function updateUser() {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
		$conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

		// Update query.
		$sql = "UPDATE	`user`
				SET		`Birthday` = STR_TO_DATE(:birthday, '%m/%d/%Y %h:%i %p'),
						`Description` = :description,
						`FirstName` = :firstName,
						`Flag` = :flag,
						`Gmail` = :gmail,
						`LastName` = :lastName,
						`Level` = :level,
						`MiddleName` = :middleName,
						`Password` = :password,
						`Phone` = :phone,
						`Picture` = :picture,
						`Status` = :status,
						`UserName` = :userName
				WHERE	`UserId` = :userId;";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute(array(
			":birthday" => $this->birthday,
			":description" => $this->description,
			":firstName" => $this->firstName,
			":flag" => $this->flag,
			":gmail" => $this->gmail,
			":lastName" => $this->lastName,
			":level" => $this->level,
			":middleName" => $this->middleName,
			":password" => $this->password,
			":phone" => $this->phone,
			":picture" => $this->picture,
			":status" => $this->status,
			":userId" => $this->userId,
			":userName" => $this->userName));

		// Close the database connection.
		$conn = NULL;
	}
	public function updateUser1() {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
		$conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

		// Update query.
		$sql = "UPDATE	`user`
				SET		
						`Flag` = :flag
						
				WHERE	`UserId` = :userId;";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute(array(
		
			":flag" => $this->flag,
			
			":userId" => $this->userId
		));

		// Close the database connection.
		$conn = NULL;
		return true;
	}

	public static function deleteUser($userId) {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
		$conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

		// Delete query.
		$sql = "DELETE	FROM `user`
				WHERE	`UserId` = :userId;";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute(array(":userId" => $userId));

		// Close the database connection.
		$conn = NULL;
	}

	public static function getUser($userId) {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
		$conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

		// Select query.
		$sql = "SELECT	DATE_FORMAT(`Birthday`, '%m/%d/%Y %h:%i %p') AS Birthday,
						`Description`,
						`FirstName`,
						`Flag`,
						`Gmail`,
						`LastName`,
						`Level`,
						`MiddleName`,
						`Password`,
						`Phone`,
						`Picture`,
						`Status`,
						`UserId`,
						`UserName`
				FROM	`user`
				WHERE	`UserId` = :userId;";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute(array(":userId" => $userId));

		// Fetch record.
		$user = NULL;
		if($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$user = new User();
			$user->birthday = $row["Birthday"];
			$user->description = $row["Description"];
			$user->firstName = $row["FirstName"];
			$user->flag = $row["Flag"];
			$user->gmail = $row["Gmail"];
			$user->lastName = $row["LastName"];
			$user->level = $row["Level"];
			$user->middleName = $row["MiddleName"];
			$user->password = $row["Password"];
			$user->phone = $row["Phone"];
			$user->picture = $row["Picture"];
			$user->status = $row["Status"];
			$user->userId = $row["UserId"];
			$user->userName = $row["UserName"];
		}

		// Close the database connection.
		$conn = NULL;

		return $user;
	}
	public static function getUserpassword($username,$pass) {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
		$conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

		// Select query.
		$sql = "SELECT	DATE_FORMAT(`Birthday`, '%m/%d/%Y %h:%i %p') AS Birthday,
						`Description`,
						`FirstName`,
						`Flag`,
						`Gmail`,
						`LastName`,
						`Level`,
						`MiddleName`,
						`Password`,
						`Phone`,
						`Picture`,
						`Status`,
						`UserId`,
						`UserName`
				FROM	`user`
				WHERE	`UserName` = :username AND
						`Password`= :password ;";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute(array(":username" => $username,
							":password" => $pass));

		// Fetch record.
		$user = NULL;
		if($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$user = new User();
			$user->birthday = $row["Birthday"];
			$user->description = $row["Description"];
			$user->firstName = $row["FirstName"];
			$user->flag = $row["Flag"];
			$user->gmail = $row["Gmail"];
			$user->lastName = $row["LastName"];
			$user->level = $row["Level"];
			$user->middleName = $row["MiddleName"];
			$user->password = $row["Password"];
			$user->phone = $row["Phone"];
			$user->picture = $row["Picture"];
			$user->status = $row["Status"];
			$user->userId = $row["UserId"];
			$user->userName = $row["UserName"];
		}

		// Close the database connection.
		$conn = NULL;

		return $user;
	}
	Public static function getcount(){
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
		$conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

		$sql = "SELECT	COUNT(*) AS Count
				FROM	`user`;";

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
		
		$pageSize = (int)$pageSize;

		$sql = "SELECT	COUNT(*) AS Count
				FROM	`user`;";

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

		$sql = "SELECT	DATE_FORMAT(`Birthday`, '%m/%d/%Y %h:%i %p') AS Birthday,
						`Description`,
						`FirstName`,
						`Flag`,
						`Gmail`,
						`LastName`,
						`Level`,
						`MiddleName`,
						`Password`,
						`Phone`,
						`Picture`,
						`Status`,
						`UserId`,
						`UserName`
				FROM	`user`
				ORDER BY `UserId` DESC
				LIMIT $start, $pageSize;";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute();

		// Fetch all records.
		$list = Array();
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$user = new User();
			$user->birthday = $row["Birthday"];
			$user->description = $row["Description"];
			$user->firstName = $row["FirstName"];
			$user->flag = $row["Flag"];
			$user->gmail = $row["Gmail"];
			$user->lastName = $row["LastName"];
			$user->level = $row["Level"];
			$user->middleName = $row["MiddleName"];
			$user->password = $row["Password"];
			$user->phone = $row["Phone"];
			$user->picture = $row["Picture"];
			$user->status = $row["Status"];
			$user->userId = $row["UserId"];
			$user->userName = $row["UserName"];

			array_push($list, $user);
		}

		// Close the database connection.
		$conn = NULL;

		return $list;
	}
}
?>