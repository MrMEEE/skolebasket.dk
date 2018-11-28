<?php

require("../connect.php");
require("../sfobasket.common.functions.php");

switch($_POST['action']){

    case "fetchText":
	  
	  $string = fetchText($_POST['string'],"javascript");
	  
	  $json = '[ { "text": "'.$string.'" } ]';
	  
	  echo $json;
    
    break;
    
    case "logon":
    
	  if(mysqli_num_rows(getCurrentUser("POST")) > 0){
		$status = "0";
		session_start();
		$_SESSION['rpusername']=$_POST['username'];
		$_SESSION['rppasswd']=$_POST['password'];
		session_write_close();
	  }else{
		$status = "1";
	  }
	  	  
	  $json = '[ { "status": "'.$status.'" } ]';
	  
	  echo $json;
    
    break;
    
    case "logout":
	  session_start();
	  session_unset();
	  session_destroy();
	  //header("Location: ../");exit;
    
    break;
    
    case "saveuser":
    
	  if(mysqli_num_rows(getCurrentUser()) > 0){
	  
		$query = mysqli_query($GLOBALS['link'],"SELECT * FROM `users` WHERE `username`='".$_POST['newuser']."'");
		
		if(mysqli_num_rows($query) == 0){
		      mysqli_query($GLOBALS['link'],"INSERT INTO `users` (`username`,`name`,`email`,`passwd`,`access`) VALUES ('".$_POST['newuser']."','".$_POST['name']."','".$_POST['email']."','".$_POST['newpassword']."','".$_POST['usertype']."')");
		      $json = '[ { "status": "created" } ]';
		}else{
		      $json = '[ { "status": "exists" } ]';
		}
	  
		echo $json;
	  }
    
    break;
    
    case "edituser":
    
	  if(mysqli_num_rows(getCurrentUser()) > 0){
	  
	      if($_POST['newpassword'] == ""){
	      
		    mysqli_query($GLOBALS['link'],"UPDATE `users` SET `name`='".$_POST['name']."',`email`='".$_POST['email']."',`access`='".$_POST['usertype']."' WHERE id='".$_POST['id']."'");
	      
	      }else{
	      
		    mysqli_query($GLOBALS['link'],"UPDATE `users` SET `name`='".$_POST['name']."',`email`='".$_POST['email']."',`access`='".$_POST['usertype']."',`passwd`='".$_POST['newpassword']."' WHERE id='".$_POST['id']."'");
	      
	      }
	      
	      $json = '[ { "status": "updated" } ]';
	      
	      echo $json;
	  }
    
    break;
    
    case "getuser":
    
	  $user = mysqli_fetch_assoc(mysqli_query($GLOBALS['link'],"SELECT * FROM `users` WHERE `id`='".$_POST['id']."'"));
	  
	  $json = '[ { "username": "'.$user['username'].'", "name": "'.$user['name'].'", "email": "'.$user['email'].'", "access": "'.$user['access'].'" } ]';
	  
	  echo $json;
    
    break;
    
    case "deleteuser":
	  
	  if(mysqli_num_rows(getCurrentUser()) > 0){
	  
		  mysqli_query($GLOBALS['link'],"DELETE FROM `gymusers` WHERE `userid`='".$_POST['id']."'");
	  
		  mysqli_query($GLOBALS['link'],"DELETE FROM `users` WHERE `id`='".$_POST['id']."'");
	  
	  }
	  
	  $json = '[ { "status": "deleted" } ]';
	  
	  echo $json;
    
    break;
    
    case "savegym":
    
	  if(mysqli_num_rows(getCurrentUser()) > 0){
	  
		$query = mysqli_query($GLOBALS['link'],"SELECT * FROM `gyms` WHERE `name`='".$_POST['name']."' AND `area`='".$_POST['area']."'");
		
		if(mysqli_num_rows($query) == 0){
		      mysqli_query($GLOBALS['link'],"INSERT INTO `gyms` (`name`,`address`,`area`) VALUES ('".$_POST['name']."','".$_POST['address']."','".$_POST['area']."')");
		      $json = '[ { "status": "created" } ]';
		}else{
		      $json = '[ { "status": "exists" } ]';
		}
	  
		echo $json;
	  }
    
    case "savelocation":
    
	  if(mysqli_num_rows(getCurrentUser()) > 0){
	  
		$query = mysqli_query($GLOBALS['link'],"SELECT * FROM `locations` WHERE `name`='".$_POST['name']."'");
		
		if(mysqli_num_rows($query) == 0){
		      mysqli_query($GLOBALS['link'],"INSERT INTO `locations` (`name`) VALUES ('".$_POST['name']."')");
		      $json = '[ { "status": "created" } ]';
		}else{
		      $json = '[ { "status": "exists" } ]';
		}
	  
		echo $json;
	  }	 
    
    break;
    
    case "savearea":
    
	  if(mysqli_num_rows(getCurrentUser()) > 0){
	  
		$query = mysqli_query($GLOBALS['link'],"SELECT * FROM `areas` WHERE `name`='".$_POST['name']."'");
		
		if(mysqli_num_rows($query) == 0){
		      mysqli_query($GLOBALS['link'],"INSERT INTO `areas` (`name`) VALUES ('".$_POST['name']."')");
		      $json = '[ { "status": "created" } ]';
		}else{
		      $json = '[ { "status": "exists" } ]';
		}
	  
		echo $json;
	  }	  
    
    break;
    
    case "getgym":
    
	  $user = mysqli_fetch_assoc(mysqli_query($GLOBALS['link'],"SELECT * FROM `gyms` WHERE `id`='".$_POST['id']."'"));
	  
	  $users = mysqli_query($GLOBALS['link'],"SELECT * FROM `gymusers` WHERE `gymid`='".$_POST['id']."'");
	  
	  while($usr = mysqli_fetch_assoc($users)){
	  
	      $username = mysqli_fetch_assoc(mysqli_query($GLOBALS['link'],"SELECT * FROM `users` WHERE `id`='".$usr['userid']."'"));
	      
	      $usernames[] = $username['name'];
	  
	  }
	  
	  sort($usernames);
	  
	  $usernames = implode("¤",$usernames);
	  
	  $json = '[ { "name": "'.$user['name'].'", "address": "'.$user['address'].'", "users": "'.$usernames.'" } ]';
	  
	  echo $json;
    
    break;
    
    case "getlocation":
    
	  $location = mysqli_fetch_assoc(mysqli_query($GLOBALS['link'],"SELECT * FROM `locations` WHERE `id`='".$_POST['id']."'"));
	  
	  $json = '[ { "name": "'.$location['name'].'" } ]';
	  
	  echo $json;
    
    break;
    
    case "getgyms":
    
	  $gyms = mysqli_query($GLOBALS['link'],"SELECT * FROM `gyms` WHERE `area`='".$_POST['id']."' ORDER BY `name`");
	  
	  $i = 0;
	  while($gym = mysqli_fetch_assoc($gyms)){
	      
	      $gymlist[$i]['name'] = $gym['name'];
	      $gymlist[$i]['id'] = $gym['id'];
	      $i++;
	      
	  }
	  
	  echo json_encode($gymlist);
    break;

    case "editgym":
    
	  if(mysqli_num_rows(getCurrentUser()) > 0){
	  
	      mysqli_query($GLOBALS['link'],"UPDATE `gyms` SET `address`='".$_POST['address']."' WHERE id='".$_POST['id']."'");
	      
	      $json = '[ { "status": "updated" } ]';
	      
	      echo $json;
	  }
    
    break;

    case "deletegym":
	  
	  if(mysqli_num_rows(getCurrentUser()) > 0){
	  
		  mysqli_query($GLOBALS['link'],"DELETE FROM `gyms` WHERE `id`='".$_POST['id']."'");
	  
	  }
	  
	  $json = '[ { "status": "deleted" } ]';
	  
	  echo $json;
    
    break;
    
    case "deletelocation":
	  
	  if(mysqli_num_rows(getCurrentUser()) > 0){
	  
		  mysqli_query($GLOBALS['link'],"DELETE FROM `locations` WHERE `id`='".$_POST['id']."'");
	  
	  }
	  
	  $json = '[ { "status": "deleted" } ]';
	  
	  echo $json;
    
    break;
    
    case "deletearea":
	  
	  if(mysqli_num_rows(getCurrentUser()) > 0){
	  
		  mysqli_query($GLOBALS['link'],"DELETE FROM `areas` WHERE `id`='".$_POST['id']."'");
	  
	  }
	  
	  $json = '[ { "status": "deleted" } ]';
	  
	  echo $json;
    
    break;
    
    case "addcoach":
    
	  if(mysqli_num_rows(getCurrentUser()) > 0){
	  
		  if(mysqli_num_rows(mysqli_query($GLOBALS['link'],"SELECT * FROM `gymusers` WHERE `userid`='".$_POST['userid']."' AND `gymid`='".$_POST['gymid']."'"))){
		  
			  $status="exists";
		  
		  }else{
		  
			  mysqli_query($GLOBALS['link'],"INSERT INTO `gymusers` (`userid`,`gymid`) VALUES ('".$_POST['userid']."','".$_POST['gymid']."')");
			  $status="added";
			  
		  }
	  }
	  
	  $json = '[ { "status": "'.$status.'" } ]';
	  
	  echo $json;
    
    break;
    
    case "remcoach":
    
	  if(mysqli_num_rows(getCurrentUser()) > 0){
	  
		  if(mysqli_num_rows(mysqli_query($GLOBALS['link'],"SELECT * FROM `gymusers` WHERE `userid`='".$_POST['userid']."' AND `gymid`='".$_POST['gymid']."'"))){
		  
			  mysqli_query($GLOBALS['link'],"DELETE FROM `gymusers` WHERE `userid`='".$_POST['userid']."' AND `gymid`='".$_POST['gymid']."'");
			  $status="removed";
		  
		  }else{
		  
			  $status="noexists";
			  
		  }
	  }
	  
	  $json = '[ { "status": "'.$status.'" } ]';
	  
	  echo $json;
    
    break;
    
    case "saveregisterplayers":
    
	  if(mysqli_num_rows(getCurrentUser()) > 0){
	  
		$sql = "INSERT INTO `players` (`userid`,`gymid`,`boys`,`girls`,`date`,`class`,`length`) VALUES ('".$_POST['userid']."','".$_POST['gymid']."','".$_POST['boys']."','".$_POST['girls']."','".$_POST['year']."-".$_POST['month']."-".$_POST['day']."','".$_POST['class']."','".$_POST['length']."')";
	  
		mysqli_query($GLOBALS['link'],$sql);
		
	  }
	  
	  $json = '[ { "status": "registered" , "sql": "'.$sql.'"} ]';
	  
	  echo $json;
    
    break;
	
	  case "saveclubregisterplayers":
    
	  if(mysqli_num_rows(getCurrentUser()) > 0){
	  
		$sql = "INSERT INTO `clubplayers` (`userid`,`locationid`,`date`,`length`) VALUES ('".$_POST['userid']."','".$_POST['locationid']."','".$_POST['year']."-".$_POST['month']."-".$_POST['day']."','".$_POST['length']."')";
	  
		mysqli_query($GLOBALS['link'],$sql);
		
	  }
	  
	  $json = '[ { "status": "registered" , "sql": "'.$sql.'"} ]';
	  
	  echo $json;
    
    break;
    
    case "savegrandprixregisterplayers":
    
	  if(mysqli_num_rows(getCurrentUser()) > 0){
	  
		$sql = "INSERT INTO `grandprixplayers` (`userid`,`date`) VALUES ('".$_POST['userid']."','".$_POST['year']."-".$_POST['month']."-".$_POST['day']."')";
	  
		mysqli_query($GLOBALS['link'],$sql);
		
	  }
	  
	  $json = '[ { "status": "registered" , "sql": "'.$sql.'"} ]';
	  
	  echo $json;
    
    break;
    
    case "getlogsforuser":
    
	  $logs = mysqli_query($GLOBALS['link'],"SELECT * FROM `players` WHERE `userid`='".$_POST['userid']."' ORDER BY `date`");
    $clublogs = mysqli_query($GLOBALS['link'],"SELECT * FROM `clubplayers` WHERE `userid`='".$_POST['userid']."' ORDER BY `date`");
    $grandprixlogs = mysqli_query($GLOBALS['link'],"SELECT * FROM `grandprixplayers` WHERE `userid`='".$_POST['userid']."' ORDER BY `date`");
	  
	  $logsrows = array();
    $clublogsrows = array();
    while($r = mysqli_fetch_assoc($logs)) {
       $logsrows[] = $r;
    }
    while($r = mysqli_fetch_assoc($clublogs)) {
       $clublogsrows[] = $r;
    }
    while($r = mysqli_fetch_assoc($grandprixlogs)) {
       $grandprixlogsrows[] = $r;
    }
    
    $rows[] = array();
    $rows["logs"] = $logsrows;
    $rows["clublogs"] = $clublogsrows;
    $rows["grandprixlogs"] = $grandprixlogsrows;
    print json_encode($rows);
    
    break;
    
    case "editlog":
    
	  if(mysqli_num_rows(getCurrentUser()) > 0){

        switch($_POST['logtype']){
        
        case "school":
                  mysqli_query($GLOBALS['link'],"UPDATE `players` SET `girls`='".$_POST['girls']."',`boys`='".$_POST['boys']."',`length`='".$_POST['length']."',`date`='".$_POST['year']."-".$_POST['month']."-".$_POST['day']."' WHERE id='".$_POST['id']."'");
              break;
        case "club":
              $clublength = $_POST['length'] / 60;
                  mysqli_query($GLOBALS['link'],"UPDATE `clubplayers` SET `length`='".$clublength."',`date`='".$_POST['year']."-".$_POST['month']."-".$_POST['day']."' WHERE id='".$_POST['id']."'");
              break;
        case "grandprix":
                  mysqli_query($GLOBALS['link'],"UPDATE `grandprixplayers` SET `date`='".$_POST['year']."-".$_POST['month']."-".$_POST['day']."' WHERE id='".$_POST['id']."'");
              break;
          
        }
	      
	      
	      $json = '[ { "status": "updated" } ]';
	      
	      echo $json;
	  }
    
    break;
    
    case "deletelog":
    
	  if(mysqli_num_rows(getCurrentUser()) > 0){

        switch($_POST['logtype']){
        
            case "school":
                mysqli_query($GLOBALS['link'],"DELETE from `players` WHERE id='".$_POST['id']."'");
            break;
            case "club":
                mysqli_query($GLOBALS['link'],"DELETE from `clubplayers` WHERE id='".$_POST['id']."'");
            break;
            case "grandprix":
                mysqli_query($GLOBALS['link'],"DELETE from `grandprixplayers` WHERE id='".$_POST['id']."'");   
            break;
        }
	  
	      $json = '[ { "status": "deleted" } ]';
	      
	      echo $json;
	  }
    
    break;
    
}

?>
