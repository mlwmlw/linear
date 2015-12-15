<?php

function array_select($array, $keys) {
	return array_intersect_key($array, array_fill_keys($keys, FALSE));
}

function array_sort_columns($array, $orders) {
	usort($array, function($a, $b) use($orders) {
			$r = '';
			foreach($orders as $key => $type) {
				if($type == SORT_ASC)
					$r .= strnatcmp($a[$key], $b[$key]);
				else if($type == SORT_DESC)
					$r .= strnatcmp($a[$key], $b[$key]);
			}
			return $r;
	});
	return $array;
}

function array_map_key($cb, $array) {
	$res = array();
	foreach($array as $key => $row) {
		list($k, $v) = $cb($key, $row);
		$res[$k] = $v;
	}
	return $res;
}

function array_update_key($array, $arg) {
	if(!is_array($array))
		return $array;

	if(is_callable($arg))
		$cb = $arg;
	else 
		$column = $arg;
	
	foreach ($array as $row) {
		if (isset($colmumn) && is_array($row) && !isset($row[$column]))
			continue;
		if (isset($column) && is_object($row) && !isset($row->$column))
			continue;

		if(isset($cb)) 
			$key = $cb($row);
		else if(isset($row[$key]))
			$key = $row[$column];
		else if(isset($row->$key))
			$key = $row->$column;
			
		$result[$key] = $row;
	}
	return $result;
}

