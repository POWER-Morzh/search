<?php
header("Content-Type: text/html; charset=ISO-8859-1");
  // Make sure that a values were sent.
  if (isset($_GET['search']) && $_GET['search'] != '') {
//     $phpbb_root_path = (defined('PHPBB_ROOT_PATH')) ? PHPBB_ROOT_PATH : './';
//     $phpEx = substr(strrchr(__FILE__, '.'), 1);
//     include($phpbb_root_path . 'config.' . $phpEx);
  	$dbhost = 'localhost';
  	$dbuser = 'suche';
  	$dbpasswd = '1234567890';
  	$dbname = 'musiksuche';
    $db = mysql_connect($dbhost, $dbuser, $dbpasswd) 
      or die('Error connecting to MySQL server.');
    unset($dbpasswd);
    mysql_select_db($dbname,$db); // selecting MySQL db

    //Add slashes to any quotes to avoid SQL problems.
	  $search = addslashes($_GET['search']);

    //Get every page title for the site.
	  $suggest_query = mysql_query("SELECT city_id, city_name
      FROM gpw1j_profilecity WHERE city_name  COLLATE UTF8_GENERAL_CI like('" . 
		  $search . "%')"); 
?>
<ul style="list-style: none outside none;">
<?php
    $i = 0;  
    while($suggest = mysql_fetch_array($suggest_query)) {
      ++$i;
		  //Return each page title seperated by a newline.
      ?>
      <li>
      <input name="city_checkbox" value="<?php echo $suggest['city_id'];  ?>"
        onclick="PutInCity(this.value, '<?php echo $suggest['city_name']; ?>')" id="<?php echo $i; ?>" class="checkboxes" type="checkbox">
      <?php
		    echo $suggest['city_name'] . "\n";
      ?></li><?php
	  }
?>
</ul>
<?php
    mysql_close($db);
  }
?>
