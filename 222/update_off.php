<?php
		    $con =mysqli_connect('35.224.86.109','fish','fish123');
			mysqli_select_db($con,'fish');
			$sql = "UPDATE relay SET LED='$_POST[LED]' WHERE ID='$_POST[id]'";
			if(mysqli_query($con,$sql))
			   header("refresh:1; url=index.php");
			else
			   echo "Not Update";
?>