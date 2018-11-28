<?php

function getHeader(){

  echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
	      <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	      <head>
	      <script src="http://code.jquery.com/jquery-1.8.3.js"></script>
	      <script type="text/javascript" src="js/sha256.js"></script>
	      <script type="text/javascript" src="js/jquery-1.10.2.js"></script>
	      <script type="text/javascript" src="js/jquery-ui-1.10.3.js"></script>
	      <script type="text/javascript" src="js/general.js"></script>
	      <link rel="stylesheet" type="text/css" href="css/styles.css" />
	      <link rel="stylesheet" href="css/jquery-ui-1.10.3-ui-lightness.css">
	      <meta charset="utf-8">
	      <table width="100%">';

  global $currentState;
  $currentState = $_POST['nextState'];
  if ($currentState == ""){
      $currentUser = mysqli_fetch_assoc(getCurrentUser());
      if(intval(5) == intval($currentUser['access'])){
	    $currentState = "mainmenu";
      }else{
	    $currentState = "mainmenu";
      }
  }
  
  echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>BørneBasketFonden</title>';
  
  echo '<form id="mainForm" name="mainForm" method="post">
          <input type="hidden" id="nextState" name="nextState" value="'.$currentState.'">';

}

function createMenuItem($name,$id,$access,$type="navigation"){
    
    $currentUser = mysqli_fetch_assoc(getCurrentUser());

    if(intval($access) >= intval($currentUser['access'])){
    
    echo '<tr>
    <td width="2%">
    </td>
    <td>
    <input type="submit" value="'.$name.'" style="font-size:60px;height: 200px; width:96%;" id="'.$id.'" ';
    
    if($type == "navigation"){
    
	echo 'class="navigation"';
    
    }
    
    echo '>
    </td>
    </tr>
    <tr>
    <td height="20px"></td>
    </tr>';

    }
}

function getPreItem(){

    echo '<tr><td width="2%"></td>';
    echo '<td>';
}

function getPostItem(){

    echo '</td>
    </tr>
    <tr>
    <td height="20px"></td>
    </tr>';

}
function getFooter(){

  echo '</table>
  </div>
  </body>
  </html>';

}

function getTitle($pagename){

echo '</script>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>BørneBasketFonden</title>

</head>

<body>

<div width="100%"><img class="logo" src="img/logo_sfobasket_small_new.jpg"></div>


<div id="main">';

}

function fetchText($text,$type="text"){

  if(!isset($GLOBALS['language'])){
    $GLOBALS['language'] = getLanguage();
  }

  switch($type){
  
    case "header1":
    
      return "<h1>".translateText($text)."</h1>";
    
    break;

    case "header2":
        
      return "<h2>".translateText($text)."</h2>";
                  
    break;

    case "header3":
    
      return "<h3>".translateText($text)."</h3>";
      
    break;
    
    case "javascript":
    
      return stringToJava(translateText($text));
    
    break;
    
    default:

      return translateText($text);
        
    break;

  }

}

function getLanguage(){

  $config = getConfiguration();
  
  $language = array();
  if (file_exists("sfobasket.lang.".$config['language'].".php")){
      $handle = fopen("sfobasket.lang.".$config['language'].".php", "r");
  }else{
      $handle = fopen("../sfobasket.lang.".$config['language'].".php", "r");
  }
  if ($handle) {
      while (($line = fgets($handle)) !== false) {
	  $thisline = explode("¤",$line);
	  $language[$thisline[0]] = $thisline[1];
      }
  }
  
  return $language;

}

function getCurrentUser($scope="SESSION"){

  if($scope == "POST"){
      $username = stripslashes($_POST['username']);
      $password = stripslashes($_POST['password']);
  }else{
      session_start();
      $username = stripslashes($_SESSION['rpusername']);
      $password = stripslashes($_SESSION['rppasswd']);
  }
  $username = mysqli_real_escape_string($GLOBALS['link'],$username);
  $password = mysqli_real_escape_string($GLOBALS['link'],$password);
  
  $currentuser = mysqli_query($GLOBALS['link'],"SELECT * FROM `users` WHERE `username`='".$username."' AND `passwd`='".$password."'");
  
  return $currentuser;

}

function showContent($state){

  $currentState = $state;
  
  if ($currentState == ""){
      $currentUser = mysqli_fetch_assoc(getCurrentUser());
      if(intval(5) == intval($currentUser['access'])){
	    $currentState = "registerplayers";
      }else{
	    $currentState = "mainmenu";
      }
  }
  
  echo '<table width=100%>
          <tr>
            <td>';
  
  if(mysqli_num_rows(getCurrentUser()) == 0){
	  session_start();
	  echo '<center>'.fetchText("Username").'<br><input name="username" class="username" type="text" id="username"><br><br>
		'.fetchText("Password").'<br><input name="password" class="password" type="password" id="password"><br><br>';
		
	  echo '</select><br><br><input type="submit" class="loginButton" name="loginButton" value="Login">';
	  echo '<br><br><input type="submit" class="evalStudentButton" name="evalStudentButton" value="Elev Evaluering">';
	  echo '<br><br><input type="submit" class="evalTeacherButton" name="evalTeacherButton" value="Lærer Evaluering"></center>';
	  
  }else{
	  $showstate = "switch(".$currentState."){";
	    
	    foreach (glob("sfobasket.state.*.php") as $filename){
	    
	      $showstate .= str_replace('?>','',str_replace('<?php','',file_get_contents($filename)));
	    
	    }

	  $showstate .= 'default:
	      echo "Content not found...";
	      break;
	  
	  }';
	  
	  eval($showstate);
  
  }
  
  echo '<br><br>';
  
  echo '   </td>
         </tr>
       </table>';

  echo '<script>'.$javascript.'</script>';
}

function getConfiguration(){
  
  $currentUser = mysqli_fetch_assoc(getCurrentUser());
  
  $configarray["language"] = $currentUser["lang"];
  
  $configs = mysqli_query($GLOBALS['link'],"SELECT `name`,`value` FROM `commonconfig`");
  
  while($config = mysqli_fetch_assoc($configs)){
  
    $configarray[$config["name"]] = $config["value"] ;
  
  }

  return $configarray;
  
}

function translateText($text){

  if(array_key_exists($text,$GLOBALS['language'])){
        return str_replace("\n","",$GLOBALS['language'][$text]);
  }else{
  	return $text;
  }

}

function stringToJava($text){

  $array = array(
    "&aring;" => "å",
    "&oslash;" => "ø",
    "&aelig" => "æ",
    "&Aring;" => "Å",
    "&Oslash;" => "Ø",
    "&AElig" => "Æ"
  );
  
  foreach ($array as $key => $value) {
      $text = str_replace($key,$value,$text);
  }
  
  return $text;

}

?>
