<head>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

  <!-- TODO: GET JQUERY WORKING!!!!!!!!!!!!!!!!!!!!!!! -->
  <script>
    $('#')
  </script>
</head>
  <input type="submit" name="delete" value="Delete" />
  <?

	$status_arr[1] = 'Good' ;
	$status_arr[2] = 'Needs Sent';
	$status_arr[3] = 'Changes Sent';
	$status_arr[4] = 'Needs Changed';


    $servername = 'localhost';
    $username = 'user_admin';
    $password = 'adminpass';
    $dbname = 'tbdatabox';

    // data connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error)
    {
      die("Connection failed: " . $conn->connect_error);
    }
    else
    {
      echo "Connected Successfully";
    }

    $sql = "SELECT * FROM tblBigURLMapping";
    $result = mysqli_query($conn, $sql);

    echo "<table>";
    echo "<tr><th>URL ID</th><th>URL</th><th>Title</th><th>Description</th><th>Status</th></tr>";

    while ($row = mysqli_fetch_array($result))
    {
      $urlID = $row['urlID'];
      $url = $row['siteURL'];
      $title = $row['metaTITLE'];
      $description = $row['metaDESCR'];
      $status = $row['Status'];


?>
<form action="urlMapSave.php" method="post">
	<input type="hidden" name="urlID" value="<?=$urlID?>" />
	<tr id="row_<?=$urlID?>">
		<td><?=$urlID?></td>
		<td><a href='<?=$url?>'><?=$url?></a></td>
		<td><input type="text" name="Title" value="<?=$title?>" /></td>
		<td><input type="text" name="Description" value="<?=$description?>" /></td>
		<td>
			<select name="Status">
<?

foreach($status_arr as $status_value) {
	$selected = '' ;
	if($status == $status_value) {
		$selected = 'selected="selected"' ;
	}
	echo '<option value="'.$status_value.'" '.$selected.'>'.$status_value.'</option>' ;
}


?>
			</select>
		</td>
		<td><input type="submit" value="Save" name="Save" onclick="urlMapSave.php"></td>
	</tr>
</form>

<?

    }
    echo "</table>";



  ?>
