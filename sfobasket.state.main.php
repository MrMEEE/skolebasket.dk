<?php

case "mainmenu":

      $currentUser = mysqli_fetch_assoc(getCurrentUser());
      
      if(5 == intval($currentUser['access'])){
      
          createMenuItem(fetchText("School Practice"),"registerplayers",5);

          createMenuItem(fetchText("Club Practice"),"registerplayersclub",5);
          
          createMenuItem(fetchText("Grand Prix"),"registerplayersgrandprix",5);
          
          createMenuItem(fetchText("Edit logs"),"logsshow",5);

      }
      
      createMenuItem(fetchText("Users"),"usersmenu",3);
      
      createMenuItem(fetchText("Gyms"),"gymsmenu",3);
      
      createMenuItem(fetchText("Lists"),"listsmenu",3);
      
      createMenuItem(fetchText("Logout"),"logout",5,"logout");


break;

?>
