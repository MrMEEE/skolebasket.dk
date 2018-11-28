<?php

case "listsmenu":

      createMenuItem(fetchText("Show list"),"listsshow",3);
      
      createMenuItem(fetchText("Show logs"),"logsshow",3);

      createMenuItem(fetchText("Back"),"mainmenu",5);


break;

case "listsshow":

      echo '<script type="text/javascript" language="javascript">
        window.open("sfobasket.lists.php");
        </script>'; 

      createMenuItem(fetchText("Back"),"listsmenu",3);

break;

case "logsshow":

      $currentUser = mysqli_fetch_assoc(getCurrentUser());

      echo '<script type="text/javascript" src="js/lists.js"></script>';

      getPreItem();
      
      
      if(5 == intval($currentUser['access'])){
      
      echo '<input type="hidden" id="selectuser" value="'.$currentUser['id'].'">';
      
      }else{

      $users = mysqli_query($GLOBALS['link'],"SELECT * FROM `users` ORDER BY `username`");
      
      echo '<select id="selectuser">
	      <option value="-1">'.fetchText("Select User").'</option>
	    ';
      while($user = mysqli_fetch_assoc($users)){
      
	  echo '<option value="'.$user['id'].'">'.$user['username'].'</option>';
	  
      }
      
      echo '</select><br><br>';
      
      }
      for ($i = 0; $i <= 50; $i++) {
      
	    $numbers .= '<option value="'.$i.'">'.$i.'</option>
	    ';
      }
      
      echo '<input type="hidden" id="logid">';
      echo '<input type="hidden" id="logtype">';
      
      echo '<div id="date">';
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
      
      echo '</select>-';
      
      echo '<select id="year">';
	      for ($i = 2015; $i <= 2036; $i++) {
		    if ($i == date('Y')){
			echo '<option value="'.$i.'" selected>'.$i.'</option>
		    ';
		    }else{
			echo '<option value="'.$i.'">'.$i.'</option>
		    ';
		    }
      }
      
      echo '</select>';
      
      echo '</div>';
      
      echo '<div id="lengthdiv">'.fetchText("Length").'<br><select id="length">
      	      <option value="-1">'.fetchText("Length of practice:").'</option>';
      
      for ($x = 30; $x <= 180; $x = $x + 5){
      
            echo '<option value="'.$x.'">'.$x.' min</option>';
      
      }
      
      echo '</select><br></div>';
      
      echo '<div id="boysdiv">'.fetchText("Number of boys").'<br><select id="boys">:
	      <option value="-1">'.fetchText("Number of boys").'</option>';
	      echo $numbers;
      
      
        echo '</select><br></div>';
      
      echo '<div id="girlsdiv">'.fetchText("Number of girls").'<br><select id="girls">:
	      <option value="-1">'.fetchText("Number of girls").'</option>';
	      echo $numbers;
      
      
      echo '</select><br><br></div>';
      
      echo '<div id="updatediv"><input id="update" type="submit" value="'.fetchText("Update").'"></div>';
      echo '<div id="deletediv"><input id="delete" type="submit" value="'.fetchText("Delete").'"></div>';
      
      echo fetchText("School Practice")."<br><br>";
      
      
      echo '<table id="logstable" style="width:100%">
              <tr align="left">
                <th>'.fetchText("Date").'</th>
                <th>'.fetchText("Boys").'</th>
                <th>'.fetchText("Girls").'</th>
                <th>'.fetchText("Length").'</th>
              </tr>
                </table><br><br> ';
      
      
      echo fetchText("Club Practice")."<br><br>";
      echo '<table id="clublogstable" style="width:100%">
              <tr align="left">
                <th>'.fetchText("Date").'</th>
                <th>'.fetchText("Length").'</th>
              </tr>
                </table><br><br>';
      
      echo fetchText("Grand Prix")."<br><br>";
      echo '<table id="grandprixlogstable" style="width:100%">
              <tr align="left">
                <th>'.fetchText("Date").'</th>
              </tr>
            </table> ';
                          
      
      getPostItem();

      if(5 == intval($currentUser['access'])){
      
         createMenuItem(fetchText("Back"),"mainmenu",5);

      }else{
      
         createMenuItem(fetchText("Back"),"listsmenu",3);
      
      }
      
break;

?>
