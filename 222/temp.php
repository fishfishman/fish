<!DOCTYPE HTML>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php // content="text/plain; charset=utf-8"

$mysql_conf = array(
    'host'    => '35.224.86.109', 
    'db'      => 'fish', 
    'db_user' => 'fish', 
    'db_pwd'  => 'fish123', 
    );
$mysql_conn = @mysqli_connect($mysql_conf['host'], $mysql_conf['db_user'], $mysql_conf['db_pwd']);
if (!$mysql_conn) {
    die("could not connect to the database:\n" );//診斷連線錯誤
}
$select_db = mysqli_select_db($mysql_conn, $mysql_conf['db']);
if (!$select_db) {
    die("could not connect to the db:\n");
}
$sql = "select temp from senser";
$res = mysqli_query($mysql_conn, $sql);
if (!$res) {
    die("could get the res:\n");
}
$datatemp = array();

while ($row = mysqli_fetch_assoc($res)) {
		array_push($datatemp, $row['temp']);
	}
$datatimelenght = count($datatemp);
?>
<html>
<head>
	<meta charset="utf-8" />
<script>
window.onload = function () {

var jsdatatime = ["<?php echo join("\", \"", $datatemp); ?>"];
var jsdatatimelenght = '<?php echo $datatimelenght; ?>';
var limit = jsdatatimelenght;
var data = [];
var dataSeries = { type: "line" };
var dataPoints = [];
for (var i = 0; i < limit; i += 1) {
	dataPoints.push({
		x: i,
		y: jsdatatime[i]*1
	});
}
dataSeries.dataPoints = dataPoints;
data.push(dataSeries);

var options = {
	title: {
		text: "一周間溫度曲線圖"
	},
	axisY: {
		includeZero: false,
		lineThickness: 1
	},
	data: data
};
var chart = new CanvasJS.Chart("chartContainer", options);
var startTime = new Date();
chart.render();
var endTime = new Date();
}
</script>
<style>
	#timeToRender {
		position:absolute; 
		top: 10px; 
		font-size: 20px; 
		font-weight: bold; 
		background-color: #d85757;
		padding: 0px 4px;
		color: #ffffff;
	}
</style>
</head>
<body>
<div id="chartContainer" style="height: 370px; width: 100%;"></div>
<span id="timeToRender"></span>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<Input Type="Button" Value="上一頁" onClick="javascript:history.back(1)" class="button fit" >		</a>
</body>
</html>