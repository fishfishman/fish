<!DOCTYPE HTML>
<!--
	Full Motion by TEMPLATED
	templated.co @templatedco
	Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
-->
<?php
										$servername = "35.224.86.109";
										$username = "fish";
										$password = "fish123";
										$dbname = "fish";
 
										// 创建连接
										$conn = new mysqli($servername, $username, $password, $dbname);
										// Check connection
										if ($conn->connect_error) {
										    die("连接失败: " . $conn->connect_error);
										} 
 
										$sql = "SELECT temp,temp0 FROM senser ORDER BY ID DESC LIMIT 1";
										$result = $conn->query($sql);
										
										$sql_PH = "SELECT PH, dirty FROM senser ORDER BY ID DESC LIMIT 1";
										$SHOW_PH = $conn->query($sql_PH);
										
										//$sql_insert = "INSERT INTO `relay` (`heat`) VALUES ('$a')";
										
										//$heat=$_REQUEST["heat"];
										
										?>
										<?php
											$con = mysqli_connect('35.224.86.109','fish','fish123');
											mysqli_select_db($con,'fish');
											$sql = "SELECT heat,ID FROM relay";
											$records =mysqli_query($con,$sql);
											
											$sql_ON = "SELECT LED,ID FROM relay";
											$records_ON =mysqli_query($con,$sql_ON);
											
											$sql_OFF = "SELECT LED,ID FROM relay";
											$records_OFF =mysqli_query($con,$sql_OFF);
											
											$sql_SET = "SELECT LED,ID FROM relay";
											$records_SET =mysqli_query($con,$sql_SET);
										?>
<html>
	<head>
		<title>Full Motion</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="assets/css/main.css" />
	</head>
	
	<body id="top">
	
			<!-- Banner -->
			<!--
				To use a video as your background, set data-video to the name of your video without
				its extension (eg. images/banner). Your video must be available in both .mp4 and .webm
				formats to work correctly.
			-->
				<section id="banner" data-video="images/banner">
					<div class="inner">
						<header>
							<h1>魚缸專題</h1>
							<p><a href="https://templated.co/">Templated</a> and released under the Creative Commons License.</p>
						</header>
						<a href="#main" class="more">Learn More</a>
					</div>
				</section>

			<!-- Main -->
				<div id="main">
					<div class="inner">

					<!-- Boxes -->
						<div class="thumbnails">

							<div class="box">
								<a href="http://localhost/222/index.php" class="image fit"><img src="images/pic01.jpg" alt="" /></a>
								<div class="inner">
									<h3>溫度</h3>
									<p>
										<?php										
										if ($result->num_rows > 0) {
										    // 输出数据
										    while($row = $result->fetch_assoc()) {
										        echo "水溫: " . $row["temp"]. "<br>";
												echo "室溫:" . $row["temp0"]. "<br>";
										    }
										} else {
										    echo "0 结果";
										}
										
										?>
									</p>
									<!-- <a href="http://35.224.86.109/sceach_new.php" class="button fit" data-poptrox="youtube,800x400">Watch</a>-->
									<Input Type="Button" Value="更新資料" onClick="window.location.reload();" class="button fit" >		</a>
								</div>
							</div>

							<div class="box">
								<a href="https://youtu.be/s6zR2T9vn2c" class="image fit"><img src="images/pic02.jpg" alt="" /></a>
								<div class="inner">
									<h3>監控</h3>
									<p>
										<?php										
										if ($SHOW_PH->num_rows > 0) {
										    while($row = $SHOW_PH->fetch_assoc()) {
										        echo " PH值: " . $row["PH"]. "<br>";
												echo " 濁度:" . $row["dirty"]. "<br>";
										    }
										} else {
										    echo "0 结果";
										}
										
										?>
									</p>
									<Input Type="Button" Value="更新資料" onClick="window.location.reload();" class="button style2 fit" >	
								</div>
							</div>

							<div class="box">
								<a href="https://youtu.be/s6zR2T9vn2c" class="image fit"><img src="images/pic03.jpg" alt="" /></a>
								<div class="inner">
									<h3>圖表</h3>
									<p>一周間溫度圖表</p>
									<Input Type="Button" Value="watch" onclick="location.href='temp.php'" class="button fit" >		</a>
								</div>
							</div>

							<div class="box">
								<a href="https://youtu.be/s6zR2T9vn2c" class="image fit"><img src="images/pic04.jpg" alt="" /></a>
								<div class="inner">
									<h3>設定溫度</h3>
									<p>設定</p>	
									<?php
									while($row =mysqli_fetch_array($records))
									{
										echo "<tr><form action=update.php method=post>";
										echo "<td><input type=text name=heat value='".$row['heat']."'></td>";
										echo "<input type=hidden name=id value='".$row['ID']."'>";
										echo "<td><input type=submit>";
										echo "</form></tr>";
									}
									?>
										
								</div>
							</div>
							
							

							<div class="box">
								<a href="https://youtu.be/s6zR2T9vn2c" class="image fit"><img src="images/pic05.jpg" alt="" /></a>
								<div class="inner">
									<h3>燈</h3>
									<p>現在燈光狀態:
									<?php										
										while($row =mysqli_fetch_array($records_SET))
									{
										if($row['LED']==0)
											echo"關";
										else
											echo"開";
									}
										?>
									</p>
									<?php
									while($row =mysqli_fetch_array($records_ON))
									{
										echo "<tr><form action=update_on.php method=post>";
										echo "<td><input type=hidden name=LED value=1></td>";
										echo "<input type=hidden name=id value='".$row['ID']."'>";
										echo "<td><input type=submit value=開>";
										echo "</form></tr>";
									}
									while($row =mysqli_fetch_array($records_OFF))
									{
										echo "<tr><form action=update_on.php method=post>";
										echo "<td><input type=hidden name=LED value=0></td>";
										echo "<input type=hidden name=id value='".$row['ID']."'>";
										echo "<td><input type=submit value=關>";
										echo "</form></tr>";
									}
									?>   
							<!--		<a href="https://youtu.be/s6zR2T9vn2c" class="button style3 fit" data-poptrox="youtube,800x400">Watch</a>-->
								</div>
							</div>

					<!--		<div class="box">
								<a href="https://youtu.be/s6zR2T9vn2c" class="image fit"><img src="images/pic06.jpg" alt="" /></a>
								<div class="inner">
									<h3>Nascetur nunc varius commodo</h3>
									<p>Interdum amet accumsan placerat commodo ut amet aliquam blandit nunc tempor lobortis nunc non. Mi accumsan.</p>
									<a href="https://youtu.be/s6zR2T9vn2c" class="button fit" data-poptrox="youtube,800x400">Watch</a>
								</div>
							</div>-->

						</div>

					</div>
				</div>

			<!-- Footer -->
				<footer id="footer">
					<div class="inner">
						<!--<h2>Etiam veroeros lorem</h2>
						<p>Pellentesque eleifend malesuada efficitur. Curabitur volutpat dui mi, ac imperdiet dolor tincidunt nec. Ut erat lectus, dictum sit amet lectus a, aliquet rutrum mauris. Etiam nec lectus hendrerit, consectetur risus viverra, iaculis orci. Phasellus eu nibh ut mi luctus auctor. Donec sit amet dolor in diam feugiat venenatis. </p>
						-->
						<a accesskey="B" href="#start-B" id="start-B" style="text-decoration:none" title="下方相關連結區">:::</a>&nbsp; 41349 台中市霧峰區吉峰東路168號 / TEL:886-4-23323000 / FAX:886-4-23329898<br />
　 						 校安中心及學生緊急事故通報專線：886-4-23320808<br />
						&copy; 2018 CYUT
						<ul class="icons">
							<li><a href="#" class="icon fa-twitter"><span class="label">Twitter</span></a></li>
							<li><a href="#" class="icon fa-facebook"><span class="label">Facebook</span></a></li>
							<li><a href="#" class="icon fa-instagram"><span class="label">Instagram</span></a></li>
							<li><a href="#" class="icon fa-envelope"><span class="label">Email</span></a></li>
						</ul>
						<p class="copyright">&copy; Untitled. Design: <a href="https://templated.co">TEMPLATED</a>. Images: <a href="https://unsplash.com/">Unsplash</a>. Videos: <a href="http://coverr.co/">Coverr</a>.</p>
					</div>
				</footer>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.scrolly.min.js"></script>
			<script src="assets/js/jquery.poptrox.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>

	</body>
</html>