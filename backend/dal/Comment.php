<?php
require_once("dbInfo.php");

class Comment {
	public $albumId;
	public $artistId;
	public $commentId;
	public $content;
	public $description;
	public $flag;
	public $songId;

	public function addComment() {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
		$conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

		// Insert query.
		$sql = "INSERT INTO `comment`
				(
					`AlbumId`,
					`ArtistId`,
					`Content`,
					`Description`,
					`Flag`,
					`SongId`
				)
				VALUES
				(
					:albumId,
					:artistId,
					:content,
					:description,
					:flag,
					:songId
				);";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute(array(
			":albumId" => $this->albumId,
			":artistId" => $this->artistId,
			":content" => $this->content,
			":description" => $this->description,
			":flag" => $this->flag,
			":songId" => $this->songId));

		// Get value of the auto increment column.
		$newId = $conn->lastInsertId();
		$this->commentId = $newId;

		// Close the database connection.
		$conn = NULL;

		// Return the id.
		return $newId;
	}

	public function updateComment() {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
		$conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

		// Update query.
		$sql = "UPDATE	`comment`
				SET		`AlbumId` = :albumId,
						`ArtistId` = :artistId,
						`Content` = :content,
						`Description` = :description,
						`Flag` = :flag,
						`SongId` = :songId
				WHERE	`CommentId` = :commentId;";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute(array(
			":albumId" => $this->albumId,
			":artistId" => $this->artistId,
			":commentId" => $this->commentId,
			":content" => $this->content,
			":description" => $this->description,
			":flag" => $this->flag,
			":songId" => $this->songId));

		// Close the database connection.
		$conn = NULL;
	}
	public function updateComment1() {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
		$conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

		// Update query.
		$sql = "UPDATE	`comment`
				SET		
						`Flag` = :flag
						
				WHERE	`CommentId` = :commentId;";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute(array(		
			":commentId" => $this->commentId,
			":flag" => $this->flag
			));

		// Close the database connection.
		$conn = NULL;
	}


	public static function deleteComment($commentId) {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
		$conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

		// Delete query.
		$sql = "DELETE	FROM `comment`
				WHERE	`CommentId` = :commentId;";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute(array(":commentId" => $commentId));

		// Close the database connection.
		$conn = NULL;
	}

	public static function getComment($commentId) {
		// Connect to database.
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
		$conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

		// Select query.
		$sql = "SELECT	`AlbumId`,
						`ArtistId`,
						`CommentId`,
						`Content`,
						`Description`,
						`Flag`,
						`SongId`
				FROM	`comment`
				WHERE	`CommentId` = :commentId;";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute(array(":commentId" => $commentId));

		// Fetch record.
		$comment = NULL;
		if($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$comment = new Comment();
			$comment->albumId = $row["AlbumId"];
			$comment->artistId = $row["ArtistId"];
			$comment->commentId = $row["CommentId"];
			$comment->content = $row["Content"];
			$comment->description = $row["Description"];
			$comment->flag = $row["Flag"];
			$comment->songId = $row["SongId"];
		}

		// Close the database connection.
		$conn = NULL;

		return $comment;
	}
	Public static function getcount(){
		$options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		$dsn = "mysql:host=" . DatabaseInfo::getServer() . ";dbname=" . DatabaseInfo::getDatabaseName() . ";charset=utf8";
		$conn = new PDO($dsn, DatabaseInfo::getUserName(), DatabaseInfo::getPassword(), $options);

		$sql = "SELECT	COUNT(*) AS Count
				FROM	`comment`;";

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
		// $defaultSortColumn = "`CommentId`";
		// $sortColumns = Array("ALBUMID", "ARTISTID", "COMMENTID", "CONTENT", "DESCRIPTION", "FLAG", "SONGID");
		// $sortColumn = in_array(strtoupper($sortColumn), $sortColumns) ? "`$sortColumn`" : $defaultSortColumn;
		// $sortOrder = strcasecmp($sortOrder, "DESC") == 0 ? "DESC" : "ASC";

		$pageNo = (int)$pageNo;
		$pageSize = (int)$pageSize;

		$sql = "SELECT	COUNT(*) AS Count
				FROM	`comment`;";

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
						`ArtistId`,
						`CommentId`,
						`Content`,
						`Description`,
						`Flag`,
						`SongId`
				FROM	`comment`
				ORDER BY `CommentId` DESC
				LIMIT $start, $pageSize;";

		// Prepare statement.
		$stmt = $conn->prepare($sql);

		// Execute the statement.
		$stmt->execute();

		// Fetch all records.
		$list = Array();
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$comment = new Comment();
			$comment->albumId = $row["AlbumId"];
			$comment->artistId = $row["ArtistId"];
			$comment->commentId = $row["CommentId"];
			$comment->content = $row["Content"];
			$comment->description = $row["Description"];
			$comment->flag = $row["Flag"];
			$comment->songId = $row["SongId"];

			array_push($list, $comment);
		}

		// Close the database connection.
		$conn = NULL;

		return $list;
	}
}
?>