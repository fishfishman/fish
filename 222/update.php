<?php
		    $con =mysqli_connect('35.224.86.109','fish','fish123');
			mysqli_select_db($con,'fish');
			$sql = "UPDATE relay SET heat='$_POST[heat]' WHERE ID='$_POST[id]'";
			if(mysqli_query($con,$sql))
			   header("refresh:1; url=index.php");
			else
			   echo "Not Update";
?>