<?php
// ----------------------

	// File: db.php
	// Author: Kirk walker
	// Description: The database class.

	// ----------------------

	class Database {

		// The database connection
		private $db;

		// The last query we executed
		public $query;
		public $strQuery;

		// The resource returned from above query
		public $result;

		public $insert_id;

		// Number of rows returned from above query.
		public $count;

		// Number of affected rows from above query.
		public $affected_rows;

		public $strTableName;

		public $pages;
		public $pg;
		public $pageSize;
		public $records;

		// Nullary constructor
		public function __construct() {
			// Create a persistent connection to the database with our settings.
			// if this class is used as an extension, this constructor does not fire.
			$this->initDB();
		}


		public function __destruct() {
			//@mysql_close( $db );
		}


		public function initDB() {
			$this->mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
			$this->insert_id = 0;
			// Check connection
			if ($this->mysqli->connect_error) {
			    die(json_encode(array("error" => "Connection failed: " . $this->mysqli->connect_error)));
			}
		}


		public function mysqli() {
			return $this->mysqli;
		}


		public function getAll() {
			$this->query = "SELECT * FROM $this->strTableName";

			if( $this->result = $this->mysqli->query( $this->query) ) {
				return $this->getMysqliResults($this->query,true);
			} else {
				return null;
			}
		}


		public function getByID($ID, $table = '',$debug = false) {

			$table = $table == '' ? $this->strTableName : $table;

			$this->query = "SELECT * FROM $table WHERE id=$ID";

			if($debug) echo '<br />11db.getFieldByID='.$this->query;

			if( $this->result = $this->mysqli->query( $this->query) ) {
				return $this->result->fetch_array( MYSQL_ASSOC );
			} else {
				return null;
			}

		}


		public function getFieldByID($ID, $table = '', $field = '',$debug = false) {
			$table = $table == '' ? $this->strTableName : $table;
			$field = $field == '' ? '*' : $field;

			$this->query = "SELECT $field FROM $table WHERE id=$ID";

			if($debug) echo '<br />11db.getFieldByID='.$this->query;

			if( $this->result = $this->mysqli->query( $this->query) ) {
				return $this->result->fetch_array( MYSQL_ASSOC );
			} else {
				return null;
			}
		}


		public function delete( $id, $table = ''){

			$table = $table == '' ? $this->strTableName : $table;
			$this->query = "DELETE FROM $table WHERE id=$id";

			if( $this->result = $this->mysqli->query( $this->query) ) {
				$this->affected_rows = $this->mysqli->affected_rows;
				return true;
			} else {

				return false;
			}


		}



		// Query function - Execute a given query.
		public function query( $query ) {
			// Set the query string.
			$this->query = $query;

			if( $this->result = $this->mysqli->query( $this->query) ) {
				$this->count = $this->result->num_rows;
				$this->affected_rows = $this->mysqli->affected_rows;
				return true;
			} else {
				// Could not execute provided query.
				// Set results to null/0 where appropriate.
				$this->result = NULL;
				$this->count = 0;
				$this->affected_rows = 0;
				return false;
			}
		}


		// Query function - Execute a given query.
		public function short_query( $query ) {
			// Set the query string.
			$this->query = $query;
			if( $this->result = $this->mysqli->query( $this->query) ) {
				return true;
			} else {
				// Could not execute provided query.
				// Set results to null/0 where appropriate.
				$this->result = NULL;
				return false;
			}
		}


		// Get Results Function - Return array/assoc array
		// From given query.
		public function getMysqliResults( $query, $assoc = false ) {
			// Execute the query using our query method.
			$this->query = $query;
			$this->result = $this->mysqli->query( $this->query);

			// If a valid resource, return the proper result.
			$result = array();
			if($this->result) {
				if( $assoc ) {
					// Associative Array
					while( $r = $this->result->fetch_array( MYSQL_ASSOC ) )
						$result[] = $r;
				} else {
					// Numeric Indexed Array
					while( $r = $this->result->fetch_array( MYSQL_NUM ) )
						$result[] = $r;
				}
				$this->count = $this->result->num_rows;
				$this->affected_rows = $this->mysqli->affected_rows;

				return $result;
			} else {
				return NULL;
			}
		}


        public function getCleanArray($array) {
            $clean_array=array();
            foreach ($array AS $key=>$value) {
                $clean_array[$key]=$this->getCleanVar($value);
            }
            return $clean_array;
        }


        public function getCleanVar($var) {
            //$var=stripslashes($var);
            return $this->mysqli->real_escape_string($var);
        }


        public function mysqliinsert($keys,$vals, $table = '') {
        	$table = $table == '' ? $this->strTableName : $table;
        	$this->insert_id = 0;
        	$date = Date('Y-m-d');
			$types = '';
			$key = implode(",", $keys);

			$errorMessage = '';
			$q = array();

			foreach($vals As $v){
				$q[] = '?';
				$types .= 's';
			}

			$qa = implode(",", $q);

        	$sqlStr = "INSERT INTO $table ($key) VALUES ($qa)";
        	$data = array_merge((array) $types, $vals);

        	do {
	        	$stmt = mysqli_prepare($this->mysqli, $sqlStr);

				if ( false===$stmt ) {
					$errorMessage = 'execute() failed: ' . htmlspecialchars($this->mysqli->error);
					break;
				}

	        	call_user_func_array(array($stmt, "bind_param"),$this->refValues($data));

        		$rc = $stmt->execute();

				if ( false===$rc ) {
					$errorMessage = 'execute() failed: ' . htmlspecialchars($stmt->error);
					break;
				}

				$this->insert_id = $this->mysqli->insert_id;
				$stmt->close();
				break;

			} while ($errorMessage == ""); // error conditional

			return $errorMessage;
		}


		function refValues($arr){
		    $refs = array();
	        foreach ($arr as $key => $value) {
	            $refs[$key] = &$arr[$key];
	        }

	        return $refs;
		}


		public function mysqliupdate($table,$keys,$vals, $ident, $iname = 'id') {
        	$this->insert_id = 0;
        	$date = Date('Y-m-d');
			$types = '';
			
			$key = implode(",", $keys);

			$errorMessage = '';
			$q = array();

			foreach($keys As $k){
				$q[] = $k.'=?';
				$types .= 's';
			}

			$qa = implode(",", $q);

        	$sqlStr = "UPDATE $table SET $qa WHERE $iname=$ident";

        	$data = array_merge((array) $types, $vals);
        	do {

	        	$stmt = mysqli_prepare($this->mysqli, $sqlStr);

				if ( false===$stmt ) {
					$errorMessage = 'execute() failed 1: ' . htmlspecialchars($this->mysqli->error) . '<br />' . $sqlStr;
					break;
				}


	        	call_user_func_array(array($stmt, "bind_param"),$this->refValues($data));

        		$rc = $stmt->execute();

				if ( false===$rc ) {
					$errorMessage = 'execute() failed 2: ' . htmlspecialchars($stmt->error);
					break;
				}

				$stmt->close();
				break;

			} while ($errorMessage == ""); // error conditional

			return $errorMessage;
        }


	}