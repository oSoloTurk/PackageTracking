<?php

	include("settings/connection_settings.php");

	$conn = mysqli_connect($GLOBALS['connection_settings']['HOST'], $GLOBALS['connection_settings']['USERNAME'], $GLOBALS['connection_settings']['PASSWORD'], $GLOBALS['connection_settings']['DB_NAME']);
	$GLOBALS['connection'] = $conn;
	if(!$conn){
		die("Connection failed because ".mysqli_connect_error());
	}

	function isLength(mysqli_result $result, int $length) {
		return mysqli_num_rows($result) == $length;
	}

	function executeQuery($query, $parameterTypes, ... $params) {
		$preQuery = mysqli_prepare($GLOBALS['connection'], $query);
		if(!empty($params)) $preQuery->bind_param($parameterTypes, ...$params);
		$preQuery->execute();
		if($preQuery->affected_rows == 0) throw new Exception("An effectless query");
		return $preQuery->get_result();
	}

	$GLOBALS['SQL_COMMANDS'] = array(
        "INSERT_NEW_VEHICLE" => "insert into vehicles (name, active_operation) values (?, ?)",
        "INSERT_NEW_ITEM" => "insert into items (name, price, description) VALUES (?, ?, ?)",
        "INSERT_NEW_USER" => "insert into users (username, email, email_confirmed, password, permissions, phone) values (?, ?, ?, ?, ?, ?)",
        "INSERT_NEW_REPORT" => "insert into reports (items, vehicle, time, date, total) values (?, ?, ?, ?, ?)",
        "INSERT_QUERY_TOKEN" => "insert into query_tokens (query_hash, target_id, caller_id) values (?, ?, ?)",
        "INSERT_ACCESS_TOKEN" => "insert into access_tokens values (?, ?) on duplicate key update access_key=?",
		"INSERT_ACTION" => "insert into actions (user, effected_user, action, time) values (?, ?, ?, ?)",

		"UPDATE_VEHICLE_NAME" => "update vehicles set name=? where id=?",
		"UPDATE_VEHICLE_OVERS" => "update vehicles set over_items=?, total_price=?, active_operation=?, target=? where id=?",
		"UPDATE_ITEM" => "update items set name=?, price=?, description=? where id=?",
		"UPDATE_USER_EMAIL_WITH_ID" => "update users set email=? where id=?",
		"UPDATE_USER_EMAIL_CODE" => "update users set email_code=? where id=?",
		"UPDATE_USER_EMAIL_CODE_PASSWORD" => "update users set password=?, email_code=? where email_code=?",
		"UPDATE_USER_PASSWORD" => "update users set password=? where id=?",
		"UPDATE_USER_PHONE" => "update users set phone=? where id=?",
		"UPDATE_USER_DETAILS_WITHOUT_PASSWORD" => "update users set username=?, email=?, phone=?, email_confirmed=?, permissions=? where id=?",
		"UPDATE_USER_DETAILS_WITH_PASSWORD" => "update users set username=?, email=?, password=?, phone=?, email_confirmed=?, permissions=? where id=?",

		"DELETE_VEHICLE" => "delete from vehicles where id=?",
		"DELETE_REPORT" => "delete from reports where id=?",
		"DELETE_ITEM" => "delete from items where id=?",
		"DELETE_ACCESS_TOKEN" => "delete from access_tokens where user_id=?",
		"DELETE_USER" => "delete from users where id=?",

		"SELECT_ALL_VEHICLES" => "select * from vehicles",
		"SELECT_ALL_ITEMS" => "select * from items",
		"SELECT_ALL_USERS" => "select * from users",
		"SELECT_ALL_REPORTS" => "select * from reports",
		"SELECT_EFFECTED_ACTIONS_WITH_ID" => "select * from actions where effected_user=?",
		"SELECT_EFFECTER_ACTIONS_WITH_ID" => "select * from actions where user=?",
		"SELECT_ITEM_WITH_ID" => "select * from items where id=?",
		"SELECT_VEHICLE_WITH_ID" => "select * from vehicles where id=?",
		"SELECT_ACCESS_TOKEN_WITH_ID_AND_TOKEN" => "select * from access_tokens where access_key=? and user_id=?",
		"SELECT_USER_WITH_ID" => "select * from users where id=?",
		"SELECT_USER_WITH_EMAIL" => "select * from users where email=?",
		"SELECT_USER_WITH_EMAIL_CODE" => "select * from users where email_code=?",
		"SELECT_USER_WITH_EMAIL_AND_PASSWORD" => "select * from users where email=? and password=?",
		"SELECT_USER_WITH_ID_AND_PASSWORD" => "select * from users where id=? and password=?",
		"SELECT_QUERY_TOKENS_FROM_HASH" => "select * from query_tokens where query_hash=?",
	);

?>