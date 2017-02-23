<?php

namespace FSM;

class Misc
{

	/**
	 * Returns the ids of the records in a query
	 */
	public static function getList($table, $params = [])
	{
        $where = "$table.active = 1";
        if (is_array($params['where'])) {
        	$params['where'] = array_filter($params['where']);
            $where .= ' AND ' . implode(' AND ', $params['where']);
        } else if ($params['where']) {
            $where .= ' AND ' . $params['where'];
        }
		
		if ($params['count'] === true) {
			$sql = "
				SELECT count(id) as count
				FROM $table
				WHERE $where
			";
			$r = sql_array($sql);
			return $r[0]['count'];
		}

        $limit = $params['limit'];
        if ($params['limit']) {
            $limit = "LIMIT {$params['limit']}";
        }
		if ($params['offset']) {
			$offset = "OFFSET {$params['offset']}";
		}
		if ($params['sort']) {
			$order_by = "ORDER BY {$params['sort']} {$params['sort_dir']}";
		}
		
		$sql = "
			SELECT id
			FROM $table
			WHERE $where
			$order_by
			$limit
			$offset
		";
		$r = sql_array($sql);
		return $r;      

	}
	
	/**
	 * Returns a safe filename, for a given platform (OS), by replacing all
	 * dangerous characters with an underscore.
	 *
	 * @param string $dangerous_filename The source filename to be "sanitized"
	 * @param boolean $encrypt Whether or not to encrpyt the filename
	 * @param string $platform The target OS
	 *
	 * @return Boolean string A safe version of the input filename
	 */
	public static function sanitizeFileName($dangerous_filename, $encrypt = false, $platform = 'Unix')  	{
		if (in_array(strtolower($platform), array('unix', 'linux'))) {
			// our list of "dangerous characters", add/remove characters if necessary
  			$dangerous_characters = array(" ", '"', "'", "&", "/", "\\", "?", "#");
  		}
  	  	else {
			// no OS matched? return the original filename then...
  	  	  	return $dangerous_filename;
  	  	}
  	
		// every forbidden character is replace by an underscore and then encoded
		if (!$encrypt) return strtolower(str_replace($dangerous_characters, '_', $dangerous_filename));
		
		$ext = strrchr($dangerous_filename,'.');
		return md5($dangerous_filename.microtime()).$ext;
		
  	}

	public static function truncateString($string, $your_desired_width,$dots = '') {
		if (strlen($string) <= $your_desired_width) return $string;

		$parts = preg_split('/([\s\n\r]+)/', $string, null, PREG_SPLIT_DELIM_CAPTURE);
		$parts_count = count($parts);

		$length = 0;
		$last_part = 0;
		for (; $last_part < $parts_count; ++$last_part) {
			$length += strlen($parts[$last_part]);
			if ($length > $your_desired_width) { break; }
		}

		return implode(array_slice($parts, 0, $last_part)).$dots;
	}

}