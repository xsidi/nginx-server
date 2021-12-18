<?php
  function insert_one_record() {
    try {
      require 'connect.php';
      // insert a continent
      $continent_id = 10;
      $continent_code = 'continent_code';
      $continent_name = 'continent_name';
      
      $sql = "INSERT INTO continents (continent_id, continent_code, continent_name)
              VALUES (:continent_id, :continent_code, :continent_name)";
  
      $stmt = $conn->prepare($sql);

      try {
        $conn->beginTransaction();

        $stmt->execute([
          ':continent_id' => $continent_id,
          ':continent_code' => $continent_code,
          ':continent_name' => $continent_name
        ]);
  
        $conn->commit();
  
        $sql = "SELECT MAX(continent_id) AS max_continent_id
                FROM continents";
        $stmt = $conn->prepare($sql);
        $stmt->execute(); 
        $max_continent_id = $stmt->fetchColumn();
        echo 'The continent id ' . $max_continent_id . ' was inserted';
      } catch(PDOException $e) {
          $conn->rollback();
          print "Error!: " . $e->getMessage() . "</br>";
      }

      $conn = null;
    } catch( PDOException $e ) {
        print "Error!: " . $e->getMessage() . "</br>";
    }
  }
?>
