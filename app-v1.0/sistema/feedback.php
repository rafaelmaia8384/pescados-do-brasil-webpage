<?php

    class Feedback {

        var $db;

        function __construct() {

			$this->db = new DataBase();
		}

        function escapeString($string) {

            return $this->db->dbEscape($string);
        }

        function success($msg, array &$extra = null) {

            header('Content-Type: text/plain; charset=utf-8');

            $response = array('error' => '0', 'msg' => $msg, 'extra' => $extra);

            $this->db->dbDie(json_encode($response, JSON_UNESCAPED_UNICODE));
        }

        function error($msg, array &$extra = null) {

            header('Content-Type: text/plain; charset=utf-8');

            $response = array('error' => '1', 'msg' => $msg, 'extra' => $extra);

            $this->db->dbDie(json_encode($response, JSON_UNESCAPED_UNICODE));
        }

        function dbInsert($table, array &$data) {

            return $this->db->dbInsert($table, $data);
        }

        function dbRead($query) {

            return $this->db->dbRead($query);
        }

        function dbExecute($query) {

            return $this->db->dbExecute($query);
        }

        function dbExecuteMultiQuery($query) {

            return $this->db->dbExecuteMultiQuery($query);
        }
    }

?>
