<?php

case "registerplayersclub":

      echo '<script type="text/javascript" src="js/clubplayers.js"></script>';

      getPreItem();
      
      $user = mysqli_fetch_assoc(getCurrentUser());
      
      echo fetchText("Logged on as:")." ".$user['name']."<br><br>";

      echo fetchText("Location:")."<br>";
      
      
      
      echo '<input type="hidden" id="userid" value="'.$user['id'].'">';
      
      $locations = mysqli_query($GLOBALS['link'],"SELECT * FROM `locations` ORDER BY `name`");
      
      echo '<select id="locations">
	      <option value="-1">'.fetchText("Select locations").'</option>
	    ';
	    
      while($location = mysqli_fetch_assoc($locations)){
      
	      echo '<option value="'.$location['id'].'">'.$location['name'].'</option>';
	  
      }
      
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
      
      echo fetchText("Hours:")."<br>";
      
      echo '<select id="length">
      	      <option value="-1">'.fetchText("Practice length").'</option>';
      
      for ($x = 1; $x <= 4; $x = $x + 0.25){
      
            echo '<option value="'.$x.'">'.$x.'</option>';
      
      }
      
      echo '</select><br><br>';
      
      
      getPostItem();
      
      createMenuItem(fetchText("Save"),"saveclubregisterplayers",5,"saveclubregisterplayers");
      
      createMenuItem(fetchText("Back"),"mainmenu",5);

break;



?>
