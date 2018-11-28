<?php

case "registermenu":

      createMenuItem(fetchText("Register players"),"registerplayers",5);
      
      //createMenuItem(fetchText("View Logs"),"viewlogs",5);

      createMenuItem(fetchText("Back"),"mainmenu",5);


break;

case "registerplayers":

      echo '<script type="text/javascript" src="js/players.js"></script>';

      getPreItem();
      
      $user = mysqli_fetch_assoc(getCurrentUser());
      
      echo fetchText("Logged on as:")." ".$user['name']."<br><br>";

      echo fetchText("Gym:")."<br>";
      
      
      
      echo '<input type="hidden" id="userid" value="'.$user['id'].'">';
      
      $accesses = mysqli_query($GLOBALS['link'],"SELECT * FROM `gymusers` WHERE `userid`='".$user['id']."'");
      
      while($access = mysqli_fetch_assoc($accesses)){
      
	  $availablegyms[] = $access['gymid'];
      
      }
      
      $gyms = mysqli_query($GLOBALS['link'],"SELECT * FROM `gyms` ORDER BY `name`");
      
      echo '<select id="gyms">
	      <option value="-1">'.fetchText("Select Gym").'</option>
	    ';
	    
      while($gym = mysqli_fetch_assoc($gyms)){
      
	  if(in_array($gym['id'],$availablegyms)){
      
	      echo '<option value="'.$gym['id'].'">'.$gym['name'].'</option>';
	      
	  }
	  
      }
      
      echo '</select><br><br>';
      
      echo fetchText("Number of players:")."<br>";
      
      for ($i = 0; $i <= 50; $i++) {
      
	    $numbers .= '<option value="'.$i.'">'.$i.'</option>
	    ';
      }
      
      echo '<select id="boys">
	      <option value="-1">'.fetchText("Number of boys").'</option>';
	      echo $numbers;
      
      
      echo '</select><br><br>';
      
      echo '<select id="girls">
	      <option value="-1">'.fetchText("Number of girls").'</option>';
	      echo $numbers;
      
      
      echo '</select><br><br>';
      
      echo fetchText("Class:")."<br>";
      
      echo '<select id="class">
            <option value="-1">'.fetchText("Class").'</option>';
      
      for ($x = 0; $x < 10; $x++){
      
            echo '<option value="'.$x.'">'.$x.fetchText(". Klasse").'</option>';
      
      }
      
      echo '</select><br><br>';
      
      /*echo fetchText("Extra Coach:")."<br>";
      
      echo '<select id="extracoach">
	      <option value="-1">'.fetchText("No extra Coach").'</option>
	    ';
	    
      $coaches = mysqli_query($GLOBALS['link'],"SELECT * FROM `users` ORDER BY `name`");
	
      while($coach = mysqli_fetch_assoc($coaches)){
      
	  if($coach['username'] != "admin"){
      
	      echo '<option value="'.$coach['id'].'">'.$coach['name'].'</option>';
	      
	  }
	  
      }*/
      
      echo '</select><br><br>';
      
      
      echo fetchText("Date:")."<br>";
      
      echo '<select id="day">';
	      for ($i = 1; $i <= 31; $i++) {
		    if ($i == date('d')){
			echo '<option value="'.$i.'" selected>'.$i.'</option>
		    ';
		    }else{
			echo '<option value="'.$i.'">'.$i.'</option>
		    ';
		    }
      }
      
      echo '</select>-';
      
      echo '<select id="month">';
	      for ($i = 1; $i <= 12; $i++) {
		    if ($i == date('n')){
			echo '<option value="'.$i.'" selected>'.$i.'</option>
		    ';
		    }else{
			echo '<option value="'.$i.'">'.$i.'</option>
		    ';
		    }
      }
      
      echo '</select>-<span id="year">'.date('Y').'</span>';
      
      echo '<br><br>';
      
      echo fetchText("Length of practice:")."<br>";
      
      echo '<select id="length">
      	      <option value="-1">'.fetchText("Practice length").'</option>';
      
      for ($x = 30; $x <= 180; $x = $x + 5){
      
            echo '<option value="'.$x.'">'.$x.' min</option>';
      
      }
      
      echo '</select><br><br>';
      
      
      getPostItem();
      
      createMenuItem(fetchText("Save"),"saveregisterplayers",5,"saveregisterplayers");
      
      createMenuItem(fetchText("Back"),"mainmenu",5);

break;


case "viewlogs":

      echo "";
      
      createMenuItem(fetchText("Back"),"registermenu",5);

break;


?>
