<?php
require_once("dbInfo.php");

class News {
	public $content;
	public $description;
	public $flag;
	public $newsId;
	public $picture;
	public $reference;
	public $status;

	public function addNews() {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
		$conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

		// Insert query.
		$sql = "INSERT INTO `news`
				(
					`Content`,
					`Description`,
					`Flag`,
					`Picture`,
					`Reference`,
					`Status`
				)
				VALUES
				(
					:content,
					:description,
					:flag,
					:picture,
					:reference,
					:status
				);";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute(array(
			":content" => $this->content,
			":description" => $this->description,
			":flag" => $this->flag,
			":picture" => $this->picture,
			":reference" => $this->reference,
			":status" => $this->status));

		// Get value of the auto increment column.
		$newId = $conn->lastInsertId();
		$this->newsId = $newId;

		// Close the database connection.
		$conn = NULL;

		// Return the id.
		return $newId;
	}

	public function updateNews() {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
		$conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

		// Update query.
		$sql = "UPDATE	`news`
				SET		`Content` = :content,
						`Description` = :description,
						`Flag` = :flag,
						`Picture` = :picture,
						`Reference` = :reference,
						`Status` = :status
				WHERE	`NewsId` = :newsId;";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute(array(
			":content" => $this->content,
			":description" => $this->description,
			":flag" => $this->flag,
			":newsId" => $this->newsId,
			":picture" => $this->picture,
			":reference" => $this->reference,
			":status" => $this->status));

		// Close the database connection.
		$conn = NULL;
	}

	public static function deleteNews($newsId) {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
		$conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

		// Delete query.
		$sql = "DELETE	FROM `news`
				WHERE	`NewsId` = :newsId;";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute(array(":newsId" => $newsId));

		// Close the database connection.
		$conn = NULL;
	}

	public static function getNews($newsId) {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
		$conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

		// Select query.
		$sql = "SELECT	`Content`,
						`Description`,
						`Flag`,
						`NewsId`,
						`Picture`,
						`Reference`,
						`Status`
				FROM	`news`
				WHERE	`NewsId` = :newsId;";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute(array(":newsId" => $newsId));

		// Fetch record.
		$news = NULL;
		if($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$news = new News();
			$news->content = $row["Content"];
			$news->description = $row["Description"];
			$news->flag = $row["Flag"];
			$news->newsId = $row["NewsId"];
			$news->picture = $row["Picture"];
			$news->reference = $row["Reference"];
			$news->status = $row["Status"];
		}

		// Close the database connection.
		$conn = NULL;

		return $news;
	}

	public static function getAllRecords($pageNo, $pageSize, &$totalRecords, $sortColumn, $sortOrder) {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
		$conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

		// Validate sort column and order.
		$defaultSortColumn = "`NewsId`";
		$sortColumns = Array("CONTENT", "DESCRIPTION", "FLAG", "NEWSID", "PICTURE", "REFERENCE", "STATUS");
		$sortColumn = in_array(strtoupper($sortColumn), $sortColumns) ? "`$sortColumn`" : $defaultSortColumn;
		$sortOrder = strcasecmp($sortOrder, "DESC") == 0 ? "DESC" : "ASC";

		$pageNo = (int)$pageNo;
		$pageSize = (int)$pageSize;

		$sql = "SELECT	COUNT(*) AS Count
				FROM	`news`;";

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

		$sql = "SELECT	`Content`,
						`Description`,
						`Flag`,
						`NewsId`,
						`Picture`,
						`Reference`,
						`Status`
				FROM	`news`
				ORDER BY $sortColumn $sortOrder
				LIMIT $start, $pageSize;";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute();

		// Fetch all records.
		$list = Array();
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$news = new News();
			$news->content = $row["Content"];
			$news->description = $row["Description"];
			$news->flag = $row["Flag"];
			$news->newsId = $row["NewsId"];
			$news->picture = $row["Picture"];
			$news->reference = $row["Reference"];
			$news->status = $row["Status"];

			array_push($list, $news);
		}

		// Close the database connection.
		$conn = NULL;

		return $list;
	}
}
?>