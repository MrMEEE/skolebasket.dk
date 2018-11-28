<?php

case "registerplayersgrandprix":

      echo '<script type="text/javascript" src="js/grandprix.js"></script>';

      getPreItem();
      
      $user = mysqli_fetch_assoc(getCurrentUser());
      
      echo fetchText("Logged on as:")." ".$user['name']."<br><br>";

      echo '<input type="hidden" id="userid" value="'.$user['id'].'">';
      
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
      
      
      getPostItem();
      
      createMenuItem(fetchText("Save"),"savegrandprixregisterplayers",5,"savegrandprixregisterplayers");
      
      createMenuItem(fetchText("Back"),"mainmenu",5);

break;



?>
