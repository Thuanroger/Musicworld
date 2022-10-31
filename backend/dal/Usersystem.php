<?php
require_once("dbInfo.php");

class Usersystem {
	public $description;
	public $flag;
	public $gmail;
	public $password;
	public $phone;
	public $picture;
	public $role;
	public $status;
	public $userSystemId;
	public $userSystemName;


   
	public function addUsersystem() {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
		$conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

		// Insert query.
		$sql = "INSERT INTO `usersystem`
				(
					`Description`,
					`Flag`,
					`Gmail`,
					`Password`,
					`Phone`,
					`Picture`,
					`Role`,
					`Status`,
					`UserSystemId`,
					`UserSystemName`
				)
				VALUES
				(
					:description,
					:flag,
					:gmail,
					:password,
					:phone,
					:picture,
					:role,
					:status,
					:userSystemId,
					:userSystemName
				);";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute(array(
			":description" => $this->description,
			":flag" => $this->flag,
			":gmail" => $this->gmail,
			":password" => $this->password,
			":phone" => $this->phone,
			":picture" => $this->picture,
			":role" => $this->role,
			":status" => $this->status,
			":userSystemId" => $this->userSystemId,
			":userSystemName" => $this->userSystemName));

		// Close the database connection.
		$conn = NULL;
	}

	public function updateUsersystem() {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
		$conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

		// Update query.
		$sql = "UPDATE	`usersystem`
				SET		`Description` = :description,
						`Flag` = :flag,
						`Gmail` = :gmail,
						`Password` = :password,
						`Phone` = :phone,
						`Picture` = :picture,
						`Role` = :role,
						`Status` = :status,
						`UserSystemName` = :userSystemName
				WHERE	`UserSystemId` = :userSystemId;";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute(array(
			":description" => $this->description,
			":flag" => $this->flag,
			":gmail" => $this->gmail,
			":password" => $this->password,
			":phone" => $this->phone,
			":picture" => $this->picture,
			":role" => $this->role,
			":status" => $this->status,
			":userSystemId" => $this->userSystemId,
			":userSystemName" => $this->userSystemName));

		// Close the database connection.
		$conn = NULL;
	}

	public static function deleteUsersystem($userSystemId) {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
		$conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

		// Delete query.
		$sql = "DELETE	FROM `usersystem`
				WHERE	`UserSystemId` = :userSystemId;";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute(array(":userSystemId" => $userSystemId));

		// Close the database connection.
		$conn = NULL;
	}

	public static function getUsersystem($userSystemId) {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
		$conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

		// Select query.
		$sql = "SELECT	`Description`,
						`Flag`,
						`Gmail`,
						`Password`,
						`Phone`,
						`Picture`,
						`Role`,
						`Status`,
						`UserSystemId`,
						`UserSystemName`
				FROM	`usersystem`
				WHERE	`UserSystemId` = :userSystemId;";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute(array(":userSystemId" => $userSystemId));

		// Fetch record.
		$usersystem = NULL;
		if($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$usersystem = new Usersystem();
			$usersystem->description = $row["Description"];
			$usersystem->flag = $row["Flag"];
			$usersystem->gmail = $row["Gmail"];
			$usersystem->password = $row["Password"];
			$usersystem->phone = $row["Phone"];
			$usersystem->picture = $row["Picture"];
			$usersystem->role = $row["Role"];
			$usersystem->status = $row["Status"];
			$usersystem->userSystemId = $row["UserSystemId"];
			$usersystem->userSystemName = $row["UserSystemName"];
		}

		// Close the database connection.
		$conn = NULL;

		return $usersystem;
	}
        public function getUserSystemwithpassword($userSystemName,$password) {
          
            
//		 Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
		$conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

		// Select query.
		$sql = "SELECT	`Description`,
						`Flag`,
						`Gmail`,
						`Password`,
						`Phone`,
						`Picture`,
						`Role`,
						`Status`,
						`UserSystemId`,
						`UserSystemName`
				FROM	`usersystem`
				WHERE	`UserSystemName` =:userSystemName AND `Password`=:password ;";

		// Prepare statement.
		$stmt = $conn->prepare($sql);
                
		// Execute the statement.
		
               $stmt->execute(array(
                        ":userSystemName" => $userSystemName,
			":password" => $password
			));


		// Fetch record.
		$usersystem = NULL;
		if($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$usersystem = new Usersystem();
			$usersystem->description = $row["Description"];
			$usersystem->flag = $row["Flag"];
			$usersystem->gmail = $row["Gmail"];
			$usersystem->password = $row["Password"];
			$usersystem->phone = $row["Phone"];
			$usersystem->picture = $row["Picture"];
			$usersystem->role = $row["Role"];
			$usersystem->status = $row["Status"];
			$usersystem->userSystemId = $row["UserSystemId"];
			$usersystem->userSystemName = $row["UserSystemName"];
		}

		// Close the database connection.
		$conn = NULL;

		return $usersystem;
	}

	public static function getAllRecords($pageNo, $pageSize, &$totalRecords, $sortColumn, $sortOrder) {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
		$conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

		// Validate sort column and order.
		$defaultSortColumn = "`UserSystemId`";
		$sortColumns = Array("DESCRIPTION", "FLAG", "GMAIL", "PASSWORD", "PHONE", "PICTURE", "ROLE", "STATUS", "USERSYSTEMID", "USERSYSTEMNAME");
		$sortColumn = in_array(strtoupper($sortColumn), $sortColumns) ? "`$sortColumn`" : $defaultSortColumn;
		$sortOrder = strcasecmp($sortOrder, "DESC") == 0 ? "DESC" : "ASC";

		$pageNo = (int)$pageNo;
		$pageSize = (int)$pageSize;

		$sql = "SELECT	COUNT(*) AS Count
				FROM	`usersystem`;";

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
						`Gmail`,
						`Password`,
						`Phone`,
						`Picture`,
						`Role`,
						`Status`,
						`UserSystemId`,
						`UserSystemName`
				FROM	`usersystem`
				ORDER BY $sortColumn $sortOrder
				LIMIT $start, $pageSize;";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute();

		// Fetch all records.
		$list = Array();
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$usersystem = new Usersystem();
			$usersystem->description = $row["Description"];
			$usersystem->flag = $row["Flag"];
			$usersystem->gmail = $row["Gmail"];
			$usersystem->password = $row["Password"];
			$usersystem->phone = $row["Phone"];
			$usersystem->picture = $row["Picture"];
			$usersystem->role = $row["Role"];
			$usersystem->status = $row["Status"];
			$usersystem->userSystemId = $row["UserSystemId"];
			$usersystem->userSystemName = $row["UserSystemName"];

			array_push($list, $usersystem);
		}

		// Close the database connection.
		$conn = NULL;

		return $list;
	}
}
?>