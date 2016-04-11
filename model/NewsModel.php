<?
	class NewsModel {
		protected $m_db;
		public function __construct($db_object) {
			$this->m_db = $db_object;
		}

		public function AddNews($author_id, $code, $title, $date, $body) {
			$query_string = "INSERT INTO news_info (author, title, code, date, body) VALUES (:author, :title, :code, :date, :body);";
			$statement = $this->m_db->prepare($query_string);


			$date = new DateTime($date);
			$date = $date->format("y.m.d");
			$result = $statement->execute(array(
				":author" => $author_id,
				":title" => $title,
				":code" => $code,
				":date" => $date,
				":body" => $body
			));
			return $result;
		}

		public function GetList($page, $page_size) {
			$limit_min = $page * $page_size;
			$limit_max = $limit_min + $page_size;
			$query_string = "SELECT * FROM news_info LIMIT $limit_min, $limit_max;";

			$result = QueryEx($query_string, array(), $this->m_db);

			return $result;
		}

		public function GetComments($news_id) {
			$query_string = "SELECT id, user_id, text FROM news_comment WHERE news_id=$news_id;";
			$result_array = array();

			foreach ($this->m_db->query($query_string) as $key => $value) {
				$result_array[] = array(
					"ID" => $value["id"],
					"USER_ID" => $value["user_id"],
					"TEXT" => $value["text"]
				);
			}
			return $result_array;
		}

		public function GetRatings($news_id) {
			$query_string = "SELECT user_id, value FROM news_rating WHERE news_id=$news_id;";
			$result_array = array();
			$overall_rating = 0.0;
			foreach ($this->m_db->query($query_string) as $key => $value) {
				$result_array["RATING_LIST"][] = array(
					"USER_ID" => $value["user_id"],
					"VALUE" => $value["value"]
				);
				$overall_rating += floatval($value["value"]);
			}
			$overall_rating /= floatval(count($result_array["RATING_LIST"]));
		}

		public function AddComment($news_id, $user_id, $text) {
			$query_string = "INSERT INTO news_comments (news_id, user_id, text) VALUES (:news_id, :user_id, :text)";
			$statement = $this->m_db->prepare($query_string);
			$result = $statement->execute(array(
				"news_id" => $news_id,
				"user_id" => $user_id,
				"text" => $text
			));
			return $result;
		}

		public function AddRating($news_id, $user_id, $value) {
			$query_string = "INSERT INTO news_rating (news_id, user_id, value) VALUES ($news_id, $user_id, $value);";
			$rows = $this->m_db->exec($query_string);
			if($rows > 0) {
				return true;
			} else {
				return false;
			}
		}
	}
?>
