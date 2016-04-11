<?
	/**
	 * Manages category tree
	 * Longterm TODO: split into two classes, one will manage hierarchy and referental integrity while other one will manage
	 * storing category data
	 */
	class CategoryTreeModel {
		protected $m_db;
		protected $m_closure_tbl_name;
		protected $m_category_info_tbl_name;
		// this is for future use, cahcning not implemented yet
		protected $m_tree_cache = null;

		/**
		 * Constructs object
		 * @param PDO $db_object - PDO object with opened connected
		 * @param string $closure_table_name - a name of the table that stores hiearchy data of the category tree
		 * @param string $category_info_table_name - name of table which stores category data itself (name, symbolic code etc)
		 * @return CategoryTreeModel object
		 */
		public function __construct($db_object, $closure_table_name = "category_closure", $category_info_table_name = "category_info") 
		{
			$this->m_db = $db_object;
			$this->m_closure_tbl_name = $closure_table_name;
			$this->m_category_info_tbl_name = $category_info_table_name;
		}

		/**
		 * Constructs query for getting desired tree (or sub-tree), may return both certain level or certain sub-tree
		 * @param int $level - level of tree, 0 is starting one (top), if -1 func will constuct querty to retrieve whole (sub) tree
		 * @param int $ancestor - ancestor node of subtree, in case of -1 func will construct query for retrieving all trees
		 * @param int $distance - not implemented yet, don't ever try to use, will throws exception
		 * @throws Exception - NOT IMPLEMENETED YET
		 * @return string - valid SQL query
		 */
		protected function GetTreeRetrieveQueryString($level = -1, $ancestor = -1, $distance = 1) 
		{
			if($distance != 1) {
				throw new Exception("NOT IMPLEMENTED YET");
			}

			$query_string = "SELECT c.ancestor, c.descendant, a.name AS aname, d.name AS dname, a.code AS acode, d.code AS dcode FROM $this->m_closure_tbl_name AS c";
			if($ancestor != -1) {
				$query_string .= " INNER JOIN (SELECT descendant as dsc FROM $this->m_closure_tbl_name " .
								 " WHERE ancestor=$ancestor) AS dyntable " .
								 " ON c.ancestor = dyntable.dsc";
			}
			$query_string .= " JOIN $this->m_category_info_tbl_name AS a ON c.ancestor = a.id";
			$query_string .= " JOIN $this->m_category_info_tbl_name AS d ON c.descendant = d.id";

			if($level != -1 && $distance != -1) {
				$query_string .= " WHERE ";

				if($level != -1) {
					$query_string .= " c.level = $level";
				}

			if($distance != -1) {
					$query_string .= " AND c.distance = $distance";
				}
			}

			$query_string .= ";";
			
			return $query_string;
		}

		/**
		 * Constructs query for retrieving (sub) tree depth
		 * @param int $ancestor - id of tree root, in case of -1 func will construct query for retrieving max depth of all trees
		 * @return string - valid SQL query
		 */
		protected function GetMaxDepthQueryString($ancestor = -1) 
		{
			$query_string = "SELECT MAX(level) AS depth FROM $this->m_closure_tbl_name";
			if($ancestor != -1) {
				$query_string .= " WHERE ancestor=$ancestor";
			}
			$query_string .= ";";
			return $query_string;
		}

		/**
		 * Retrieves subtree root depth
		 * @param int $ancestor - id of root
		 * @return int - depth of tree root
		 */
		protected function GetRootDepth($ancestor) {
			$query_string = "SELECT level FROM $this->m_closure_tbl_name WHERE ancestor = descendant AND ancestor = $ancestor;";
			$result = $this->m_db->query($query_string)->Fetch();
			return intval($result["level"]);
		}

		/**
		 * Retrieves (sub) tree depth
		 * @param int $ancestor - id of (sub) tree root in case of -1 func will retrieve max depth
		 * @return int - root depth  
		 */
		protected function GetMaxDepth($ancestor = -1)
		{
			$query_string = $this->GetMaxDepthQueryString($ancestor);
			$result = $this->m_db->query($query_string)->Fetch();
			return intval($result['depth']);
		}

		/**
		 * Gets tree root of certain node 
		 * @param int $descendant - id of node
		 * @return int id of tree root
		 */
		public function GetTreeRoot($descendant) 
		{
			$query_string = "SELECT b.ancestor AS ancestor FROM $this->m_closure_tbl_name as b JOIN 
							(SELECT c.* 
							 FROM $this->m_closure_tbl_name AS c 
							 WHERE descendant = $descendant) AS c ON b.ancestor = c.ancestor 
			 				 WHERE b.level = 0;";
			$result = $this->m_db->query($query_string)->Fetch();
			return intval($result["ancestor"]);
		}

		/**
		 * Gets array of tree levels (this one apologizes for confusing naming)
		 * @param int $ancestor - id of root, in case of -1 retrieves all trees
		 * @return nested array with the following format:
		 *	 array(
		 *		NODE_LEVEL => array(
		 *			ANCESTOR_ID => array(
		 *				"ID" => ANCESTOR_ID,
		 *				"NAME" => ANCESTOR_NAME,
		 *				"CHILD" => array(
		 *					DESCENDANT_NUMBER => array(
		 *						"ID" => DESCENDANT_ID,
		 *						"NAME" => DESCENDANT_NAME,
		 *						"CHILD" => null
		 *					)
		 *				)
		 *			)
		 *		)
		 *	);
		 */
		public function GetBranchTable($ancestor = -1) 
		{
			$result_array = array();
			$query_string_array = array();
			$max_depth = $this->GetMaxDepth($ancestor);
			for($i = $max_depth; $i >= 0; $i--) {
				$query_string_array[$i] = $this->GetTreeRetrieveQueryString($i, $ancestor);
			}

			foreach($query_string_array as $depth => $cur_query) {
				foreach($this->m_db->query($cur_query) as $value) {
					$result_array[$depth][$value["ancestor"]]["ID"] = $value["ancestor"];
					$result_array[$depth][$value["ancestor"]]["NAME"] = $value["aname"];
					$result_array[$depth][$value["ancestor"]]["CODE"] = $value["acode"];
					$result_array[$depth][$value["ancestor"]]["CHILD"][$value["descendant"]] = array(
						"ID" => $value["descendant"],
						"NAME" => $value["dname"],
						"CODE" => $value["dcode"],
						"CHILD" => null
					);
				}
			}

			return $result_array;
		}

		/**
		 * Retrieves tree itself, very time-expensive, 
		 * strangely enough it takes more time to retrieve sub-tree than to retrieve certain tree.
		 * @param int $ancestor - id of (sub) tree root
		 * @return recursive nested array with the following format:
		 *	array(
		 *		ROOT_NODE_ID => array(
		 *			"ID" => ROOT_NODE_ID
		 *			"NAME" => ROOT_NODE_NAME
		 *			"CHILD" => array(
		 *				CHILD_NODE_ID => array(	
		 *					"ID" => CHILD_NODE_ID
		 *					"NAME" => CHILD_NODE_ID
		 *					"CHILD" => array(
		 *						CHILD_NODE_ID => array(
		 *							"ID" => CHILD_NODE_ID
		 *							"NAME" => CHILD_NODE_ID
		 *							"CHILD" => array(),
		 *						...
		 *						)
		 *					),
		 *				...
		 *				)
		 *			)
		 *		)
		 *		...
		 *	)
		 */
		public function GetTree($ancestor = -1) {
			$result_array = $this->GetBranchTable($ancestor);

			if(empty($result_array)) {
				return $result_array;
			}

			if($ancestor != -1) {
				$start_depth = $this->GetRootDepth($ancestor) + 1;
			} else {
				$start_depth = 1;
			}
			$depth = $this->GetMaxDepth($ancestor);
			
			// Processes two levels at the time, thus needs at least two levels to work with. 
			if(($depth - $start_depth) < 2) {
				return $result_array[$start_depth];
			}

			while($depth > $start_depth) {
				foreach($result_array[$depth - 1] as &$value) {
					foreach(array_keys($result_array[$depth]) as $key) {
						if(array_key_exists($key, $value["CHILD"])) {
							$value["CHILD"][$key] = $result_array[$depth][$key];
							unset($result_array[$depth][$key]);
						}
					}
				}
				$depth--;
			}

			$result_array = $result_array[$start_depth];
			return $result_array;
		}

		/**
		 * Retrieves node level
		 * @param int $node_id - id of node
		 * @return int - level of node (0 is tree roots levels)
		 */
		public function GetNodeLevel($node_id) {
			$level = $this->m_db->query("SELECT max(level) as level FROM $this->m_closure_tbl_name WHERE descendant = $node_id;")->Fetch();
			$level = intval($level[0]);
			return intval($level);
		}

		/**
		 * Get list of all direct descendant of node (usable for showing menu level by level)
		 * @param - node id
		 * @return - nested array with the following format:
		 * array(
		 *		NUMBER => array(
		 *			"ID" => NODE_ID
		 *			"NAME" => NODE_NAME
		 *		),
		 *		...
		 * )
		 */
		public function GetChilds($node_id) {
			$query_string = "SELECT a.descendant AS id, b.name as name, b.code as code, b.image as image FROM $this->m_closure_tbl_name AS a 
							 JOIN $this->m_category_info_tbl_name AS b ON a.descendant = b.id  
							 WHERE a.ancestor = $node_id AND a.distance = 1;";
			$result_array = array();
			foreach ($this->m_db->query($query_string) as $value) {
				$result_array[] = array(
					"ID" => $value["id"],
					"CODE" => $value["code"],
					"IMAGE" => $value["image"],
					"NAME" => $value["name"]
				);
			}
			return $result_array;
		}

		/**
		 * Gets ordered (root is first) list of ancestor nodes of certain node, usable for creating breadcrumbs
		 * @param int $node_id - id of node
		 * @return - nested array with the following format:
		 * array(
		 *		NUMBER => array(
		 *			"ID" => NODE_ID
		 *			"NAME" => NODE_NAME
		 *		),
		 *		...
		 * )
		 */
		public function GetNodePath($node_id) {
			$query_string = "SELECT a.ancestor AS id, b.name AS name, b.code as code FROM $this->m_closure_tbl_name AS a 
							 JOIN $this->m_category_info_tbl_name AS b ON a.ancestor = b.id 
							 WHERE a.descendant = $node_id ORDER BY a.distance DESC;";
			$result_array = array();
			foreach($this->m_db->query($query_string) as $value) {
				$result_array[] = array(
					"ID" => $value["id"],
					"NAME" => $value["name"],
					"CODE" => $value["code"]
				);
			}
			return $result_array;
		}

		/**
		 * Gets (sub) tree id by its path
		 * @param string $path - url path of category splitted by slashes, for example: "guitars/electro/bla-bla";
		 * @return int - id of found category or just 0
		 */
		public function GetCategoryIDByPath($path) {
			// $query_string = "SELECT tbl.id, tbl.URL FROM (
			// 	SELECT c.id, GROUP_CONCAT(b.code SEPARATOR '/') as URL 
			// 	FROM $this->m_category_info_tbl_name AS c 
			// 	JOIN $this->m_closure_tbl_name AS d ON c.id = d.descendant 
			// 	JOIN $this->m_category_info_tbl_name AS b ON b.id = d.ancestor 
			// 	GROUP BY d.descendant) AS tbl WHERE tbl.URL LIKE '$path';";

			$query_string = "SELECT tbl.id, tbl.path FROM
				(SELECT comboA.descendant AS id, GROUP_CONCAT(comboB.code SEPARATOR '/') AS path FROM $this->m_category_info_tbl_name AS infoX
				JOIN (SELECT * FROM $this->m_closure_tbl_name) AS comboA
				ON comboA.descendant = infoX.id
				JOIN $this->m_category_info_tbl_name AS comboB ON comboB.id = comboA.ancestor
				GROUP BY comboA.descendant) AS tbl WHERE tbl.path LIKE '$path';";

			$result = $this->m_db->query($query_string)->Fetch();
			if(!is_null($result)) {
				return $result["id"];
			} else {
				return false;
			}
			
		}

		/**
		 * Gets category info (from category info table) by category id
		 * @param int $id - id of category
		 * @return array of category properties
		 */
		public function GetByID($id) {
			$query_string = "SELECT * FROM $this->m_category_info_tbl_name WHERE id = $id;";
			$result = $this->m_db->query($query_string)->Fetch();
			$result_array = array();
			foreach($result as $field_key => $field_value) {
				if(!is_numeric($field_key)) {
					$result_array[strtoupper($field_key)] = $field_value;
				}
			}
			return $result_array;
		}

		/******************************************************************************************************\
		 * Mutators / Setters 																				  *
		\******************************************************************************************************/

		/**
		 * Adds new root node (a node without any ancestors)
		 * @param string $name - name of added root
		 * @param string $code - symbolic code of added root
		 * @return mixed: int ID of newly created node in case of success, boolean false in case of failure
		 */
		public function AddRoot($name, $code, $image = "") {
			$new_id = $this->m_db->query("SELECT MAX(id) FROM $this->m_category_info_tbl_name;")->Fetch();
			$new_id = intval($new_id[0]) + 1;

			$query_string = "INSERT INTO $this->m_category_info_tbl_name (id, name, code, image) VALUES ($new_id, '$name', '$code', '$image');";
			$rowcount = $this->m_db->exec($query_string);
			if($rowcount > 0) {
				$query_string = "INSERT INTO $this->m_closure_tbl_name (ancestor, descendant, level, distance) VALUES ($new_id, $new_id, 0, 0);";
				$rowcount = $this->m_db->exec($query_string);
				if($rowcount > 0) {
					return $new_id;
				}
			}
			return false;
		}

		/**
		 * Creates and adds child node to other node (root or regular node)
		 * @param int $parent - id of ancestor node to attach to
		 * @param string $name - name of newly created node
		 * @param string $code - symbolic code of newly created node
		 * @return mixed: int ID of newly created node in case of success, boolean false in case of failure
		 */
		public function AddNode($parent, $name, $code, $image = "") {
			$new_id = $this->m_db->query("SELECT MAX(id) FROM $this->m_category_info_tbl_name;")->Fetch();
			$new_id = intval($new_id[0]) + 1;

			$new_level = $this->GetNodeLevel($parent) + 1;

			$query_string = "INSERT INTO $this->m_category_info_tbl_name (id, name, code, image) VALUES ($new_id, '$name', '$code', '$image');";
				
			$rowcount = $this->m_db->exec($query_string);
			if($rowcount > 0) {
				$query_string = "INSERT INTO $this->m_closure_tbl_name (ancestor, descendant, level, distance) SELECT ancestor, $new_id as descendant, level + 1, distance + 1 
								 FROM $this->m_closure_tbl_name WHERE descendant = $parent UNION ALL SELECT $new_id, $new_id, $new_level, 0;";
				if($this->m_db->exec($query_string) > 0) {
					return $new_id;
				}
			}
			return false;
		}

		/**
		 * Deletes node by id, with all references to ancestor, but doesn't deletes child nodes, thus referental integrity will
		 * likely be losed if node had children (because they will become parentless)
		 * @param int @node_id - id of node to delete
		 * @return boolean - true in case of success
		 */
		public function DeleteNode($node_id) {
			$query_string = "DELETE FROM $this->m_category_info_tbl_name WHERE id = $node_id;";
			$rowcount = $this->m_db->exec($query_string);
			if($rowcount > 0) {
				$query_string = "DELETE FROM $this->m_closure_tbl_name WHERE descendant = $node_id;";
				$rowcount = $this->m_db->exec($query_string);
				return true;
			}
			return false;
		}
	}
?>
