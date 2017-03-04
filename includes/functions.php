<?php

function confirm_query($result_set){
	if(!result_set){
		die("database query failed");
	}
}

function find_all_subjects(){
	global $connection;
	//Perform the database query
	$query="SELECT * FROM subjects";
	$subject_result = mysqli_query($connection, $query);
	confirm_query($subject_result);

	return $subject_result;
}

function find_pages_for_subject($subject_id){
	global $connection;

	$safe_subject_id= mysqli_real_escape_string($connection, $subject_id);
	//Perform the database query
	$page_query="SELECT * FROM pages WHERE visible=1 AND subject_id={$safe_subject_id}";
	$page_result = mysqli_query($connection, $page_query);
	confirm_query($page_result);

	return $page_result;
}

function navigation (){
	//performed with include method
}

function find_subject_by_id ($subject_id){
	global $connection;
	$safe_subject_id= mysqli_real_escape_string($connection, $subject_id);

	$query = "SELECT * FROM subjects WHERE id={$safe_subject_id} LIMIT 1";
	$subject_result= mysqli_query($connection, $query);
	confirm_query($subject_result);
	//fetch row
	if($subject = mysqli_fetch_assoc($subject_result)){
		return $subject;
	}else{
		return null;
	}

}

function find_page_by_id ($page_id){
	global $connection;
	$safe_page_id= mysqli_real_escape_string($connection, $page_id);

	$query = "SELECT * FROM pages WHERE id={$safe_page_id} LIMIT 1";
	$page_result= mysqli_query($connection, $query);
	confirm_query($page_result);
	//fetch row
	if($page = mysqli_fetch_assoc($page_result)){
		return $page;
	}else{
		return null;
	}

}

function find_selected_page(){

	global $current_subject;
	global $current_page;
	
	if(isset($_GET['subject'])){

	    $current_subject = find_subject_by_id ($_GET['subject']);
	    $current_page=null;
	} elseif(isset($_GET["page"])){

	    $current_page = find_page_by_id ($_GET['page']); 
	    $current_subject=null;
	}else{

	    $current_subject=null;
	    $current_page=null;
	}
}










?>