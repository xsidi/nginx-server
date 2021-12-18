<?php 
  // connect to the database to get the PDO instance
  require 'connect.php';

  // build the sql statement
  $sql = 'SELECT continent_id, continent_code, continent_name 
          FROM continents
          WHERE continent_code = :continent_code
            AND continent_id IN (';
 
  $ids = array(2, 3);
  $comma = '';
  for($i=0; $i<count($ids); $i++){
    $sql .= $comma.':p'.$i;       // :p0, :p1, ...
    $comma = ',';
  }
  $sql .= ')';
  // prepare the sql statement
  $stmt = $conn->prepare($sql);
  // bind the parameters
  $stmt->bindValue(':continent_code', 'AFR');  // some value
  for($i=0; $i<count($ids); $i++){
    $stmt->bindValue(':p'.$i, $ids[$i]);
  }
  // execute the sql statement
  $stmt->execute();

  // fetch all rows
  $continents = $stmt->fetchAll(PDO::FETCH_ASSOC);

  // display the continents
  foreach ($continents as $continent) {
    echo  '<br />' . $continent['continent_id'] . '.' . $continent['continent_name'] . '<br />';
  }
  
  // close the connection to the DB
  $conn = null;

  echo '<br />';

  // insert one record
  include 'insert.php';
  echo '<form method="post"><input type="submit" name="insertRecord" id="insertRecord" value="Insert record" /><br/></form>';
  
  function insertREC() {
    echo "Your test function on button click is working";
  }

  if(array_key_exists('insertRecord', $_POST)) { 
    insert_one_record();
  }
?>
