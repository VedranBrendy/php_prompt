<?php 
  //Get data from DB and show them in index.php
  include_once('db.php');

  ?>
<!-- 	 Design initial table header --> 
	<table class="table table-hover table-sm">
    <thead class="thead-light">
      <tr>
        <th scope="col">NO</th>
        <th scope="col">ID</th>
        <th scope="col">Text</th>
        <th scope="col">Date</th>
        <th scope="col">Update</th>
        <th scope="col">Delete</th>
      </tr>
    </thead>

    <?php
      //Get data from db
      $sql = 'SELECT * FROM post';
      $stmt = $pdo->prepare($sql);
      $stmt->execute(); 
  
      // if query results contains rows then featch those rows 
    if($stmt->rowCount()>0){
    	$number = 1;
    	while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        ?>
    		<tr>
          <td><?php echo $number; ?></td>
          <td><?php echo $row['id']; ?></td>
          <td><?php echo $row['text']; ?></td>
          <td><?php echo $row['created_at']; ?></td>
          <td>
					  <button onclick="updateData(<?php echo $row['id']; ?>)" class="btn btn-sm btn-warning">Update</button>
          </td>
          <td>
            <button onclick="deleteData(<?php echo $row['id']; ?>)" class="btn btn-sm btn-danger">Delete</button>
          </td>
    		</tr>
        <?php
    		$number++;
    	}
    }
    else
    {
      // records now found 
      ?>
    	
      <tr>
        <td colspan="6">Records not found!</td>
      </tr>
      </table>
      <?php
    }
 

?>