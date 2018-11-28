<?php

case "gymsmenu":

      createMenuItem(fetchText("Create Area"),"areascreate",3);
      
      createMenuItem(fetchText("Edit Area"),"areasedit",3);

      createMenuItem(fetchText("Create Gym"),"gymscreate",3);
      
      createMenuItem(fetchText("Edit Gym"),"gymsedit",3);
      
      createMenuItem(fetchText("Create Location"),"locationcreate",3);
      
      createMenuItem(fetchText("Edit Location"),"locationedit",3);

      createMenuItem(fetchText("Back"),"mainmenu",5);


break;

case "areascreate":

      echo '<script type="text/javascript" src="js/areas.js"></script>';
      
      getPreItem();
      
      echo fetchText("Name:").'<br><input id="name"><br>';
      
      

      getPostItem();
      
      createMenuItem(fetchText("Save"),"savearea",5,"savearea");

      createMenuItem(fetchText("Back"),"gymsmenu",3);

break;

case "gymscreate":

      echo '<script type="text/javascript" src="js/gyms.js"></script>';
      
      getPreItem();
      
      echo fetchText("Name:").'<br><input id="name"><br>
	   '.fetchText("Address:").'<br><input id="address"><br><br>';
      
      $areas = mysqli_query($GLOBALS['link'],"SELECT * FROM `areas` ORDER BY `name`");
      
      echo '<select id="areas">
	      <option value="-1">'.fetchText("Select Area").'</option>
	    ';
      while($area = mysqli_fetch_assoc($areas)){
      
	  echo '<option value="'.$area['id'].'">'.$area['name'].'</option>';
	  
      }
      
      echo '</select><br><br>';

      getPostItem();
      
      createMenuItem(fetchText("Save"),"savegym",5,"savegym");

      createMenuItem(fetchText("Back"),"gymsmenu",3);

break;

case "locationcreate":

      echo '<script type="text/javascript" src="js/location.js"></script>';
      
      getPreItem();
      
      echo fetchText("Name:").'<br><input id="name"><br><br>';

      getPostItem();
      
      createMenuItem(fetchText("Save"),"savelocation",5,"savelocation");

      createMenuItem(fetchText("Back"),"gymsmenu",3);

break;


case "areasedit":

      echo '<script type="text/javascript" src="js/areas.js"></script>';

      getPreItem();

      $areas = mysqli_query($GLOBALS['link'],"SELECT * FROM `areas` ORDER BY `name`");
      
      echo '<select id="areas">
	      <option value="-1">'.fetchText("Select Area").'</option>
	    ';
      while($area = mysqli_fetch_assoc($areas)){
      
	  echo '<option value="'.$area['id'].'">'.$area['name'].'</option>';
	  
      }
      
      echo '</select><br><br>';
      
      echo fetchText("Name:").'<br><div id="name"></div>';
	    
      getPostItem();
             
      createMenuItem(fetchText("Delete"),"deletearea",5,"deletearea");
      
      createMenuItem(fetchText("Back"),"gymsmenu",3);

break;

case "gymsedit":

      echo '<script type="text/javascript" src="js/gyms.js"></script>';

      getPreItem();
      
      $areas = mysqli_query($GLOBALS['link'],"SELECT * FROM `areas` ORDER BY `name`");
      
      echo '<select id="areas">
	      <option value="-1">'.fetchText("Select Area").'</option>
	    ';
      while($area = mysqli_fetch_assoc($areas)){
      
	  echo '<option value="'.$area['id'].'">'.$area['name'].'</option>';
	  
      }
      
      echo '</select><br><br>';
      
      echo '<select id="gyms">
	      <option value="-1">'.fetchText("Select Gym").'</option>
	    ';
      
      echo '</select><br><br>';
      
      echo fetchText("Name:").'<br><div id="name"></div>
	   '.fetchText("Address:").'<br><input id="address"><br><br>'
	   .fetchText("Coaches:").'<br><div id="coaches"></div>';
	    
      $users = mysqli_query($GLOBALS['link'],"SELECT * FROM `users` ORDER BY `name`");
      
      echo '<select id="users">
	      <option value="-1">'.fetchText("Select Coach").'</option>
	    ';
      
      while($user = mysqli_fetch_assoc($users)){
      
	  echo '<option value="'.$user['id'].'">'.$user['name'].'</option>';
	  
      }
      
      echo '</select><br><br>';

	    
      getPostItem();
      
      createMenuItem(fetchText("Add Coach"),"addcoach",5,"addcoach");
      
      createMenuItem(fetchText("Remove Coach"),"remcoach",5,"remcoach");
      
      createMenuItem(fetchText("Save"),"editgym",5,"editgym");
      
      createMenuItem(fetchText("Delete"),"deletegym",5,"deletegym");
      
      createMenuItem(fetchText("Back"),"gymsmenu",3);

break;

case "locationedit":

      echo '<script type="text/javascript" src="js/location.js"></script>';

      getPreItem();
      
      $locations = mysqli_query($GLOBALS['link'],"SELECT * FROM `locations` ORDER BY `name`");
      
      echo '<select id="locations">
	      <option value="-1">'.fetchText("Select Location").'</option>
	    ';
      while($location = mysqli_fetch_assoc($locations)){
      
	  echo '<option value="'.$location['id'].'">'.$location['name'].'</option>';
	  
      }
      echo '</select><br>';
      echo fetchText("Name:").'<br><div id="name"></div>';
	    
	    
      getPostItem();
      
      createMenuItem(fetchText("Delete"),"deletelocation",5,"deletelocation");
      
      createMenuItem(fetchText("Back"),"gymsmenu",3);

break;

?>
