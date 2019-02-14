<?php

	class DataBase {

		var $link;

		function __construct() {

			$this->link = mysqli_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE) or die('MySQL Connection fail.');

			mysqli_set_charset($this->link, DB_CHARSET);
		}

		function dbDie($string = null) {

			mysqli_close($this->link);

			die($string);
		}

		function dbEscape($string) {

			return 	mysqli_real_escape_string($this->link, $string);
		}

		function dbExecute($query) {

			$result = mysqli_query($this->link, $query . ';') or $this->dbDie('dbExecute error: ' . mysqli_error($this->link));

			return $result;
		}

		function dbExecuteMultiQuery($query) {

			$result = mysqli_multi_query($this->link, $query);

			while (mysqli_more_results($this->link) && mysqli_next_result($this->link));
		}

		function dbRead($query) {

			$result = $this->dbExecute($query);

			if (!mysqli_num_rows($result)) {

				return false;
			}
			else {

				while ($res = mysqli_fetch_assoc($result)) {

					$data[] = $res;
				}

				return $data;
			}
		}

		function dbInsert($table, array &$data) {

			$fields = implode(', ', array_keys($data));
			$values = "'". implode("', '", $data) . "'";

			$query = "INSERT INTO {$table} ( {$fields} ) VALUES ( {$values} )";

			return $this->dbExecute($query);
		}
	}

?>
