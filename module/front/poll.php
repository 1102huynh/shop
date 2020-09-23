<?php
	//print_r($_POST);
	$id=$_POST['answer'];
	//Tang so luot vote
	$sql="update `nn_answer` set `vote`=`vote`+1 where `id`=$id";
	mysqli_query($link,$sql);
	
	//Hien ket qua khao sat
	$sql='SELECT `id` , `content` FROM `nn_question` WHERE `active` =1';
	$rs=mysqli_query($link,$sql);
	$r=mysqli_fetch_assoc($rs);
	$question=$r['content'];
	
?>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
		  
		   <?php
			//Lay cac lua chon cua cau hoi
			$sql='SELECT `id` , `content`,`vote`
			FROM `nn_answer`
			WHERE `question_id` ='.$r['id'].'
			ORDER BY `order` ';
			$rs=mysqli_query($link,$sql);
			while($r=mysqli_fetch_assoc($rs))
			{
		?>
          		['<?php echo $r['content'] ?>',     <?php echo $r['vote'] ?>],
        <?php
			}
		?>  
        ]);

        var options = {
          title: '<?php echo $question ?>',
          is3D: true,
		  legend:{position:'bottom',textStyle:{color:'blue',fontSize:18}},
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
        chart.draw(data, options);
      }
    </script>
    <div id="piechart_3d" style="width: 700px; height: 500px;"></div>
