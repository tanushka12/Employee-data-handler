<?php
include_once("common.php");

function login(){
	global $conn;
	if(isset($_POST['cpf']) && isset($_POST['password'])){
		$cpf = esc($_POST['cpf']);
		$password = esc($_POST['password']);
		$query = "select * from user_data where cpf = '$cpf' and password = '$password'";
		$result = mysqli_query($conn, $query);
		if(mysqli_num_rows($result) > 0){
			$row = mysqli_fetch_assoc($result);		
			$_SESSION['cpf'] = $row['cpf'];
			$_SESSION['name'] = $row['first_name'] . 
      " " . $row['last_name'];
            header("location:home.php");
		}else{
			$_SESSION['status'] = "error";
			$_SESSION['msg'] = "Invalid login credentials. Please try again.";
			header("location:index.php");
		}
	}
}

function logout(){
    global $conn;
    if(isset($_SESSION['cpf']) && isset($_SESSION['name'])){
        unset($_SESSION['cpf']);
        unset($_SESSION['name']);
        $_SESSION['status'] = "success";
        $_SESSION['msg'] = "Logged out successfully.";
        header("location:index.php");
    }else{
        header("location:index.php");
    }
    
}

function signup(){
	global $conn;
	if(isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['cpf'])){
		$first_name = esc($_POST['first_name']);
		$last_name = esc($_POST['last_name']);
		$cpf = esc($_POST['cpf']);
		$query = "select * from user_data where cpf = '$cpf'";
		$result = mysqli_query($conn, $query);
		if(mysqli_num_rows($result) > 0){
			$_SESSION['status'] = "error";
			$_SESSION['msg'] = "This ID No. is already registered.";
		}else{
			$query = "insert into user_data values('$first_name','$last_name','$cpf','password')";
			$result = mysqli_query($conn, $query);
			if($result){
				$_SESSION['status'] = "success";
				$_SESSION['msg'] = "ID No. registered with FROST.";
				$_SESSION['cpf'] = $cpf;
				$_SESSION['name'] = $first_name . " " . $last_name;
			}else{
				$_SESSION['status'] = "error";
				$_SESSION['msg'] = "Error connecting database. Please try again later. Contact system administrator if problem persists.";
			}
		}
		header("location:index.php");
	}	
}

if(isset($_POST['action'])){
	$action = $_POST['action'];
	if($action == 'signup'){
		signup();
	} else if($action == 'login'){
		login();
	} else if($action == 'logout'){
        logout();
    }
}
?>