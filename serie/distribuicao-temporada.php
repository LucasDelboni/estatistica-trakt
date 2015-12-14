<?php
    include "../curl.php";
    
    $serie = $_GET["nome"];
    $temporada = $_GET["temporada"];
    $url = "https://api-v2launch.trakt.tv/shows/".$serie."/seasons/".$temporada."/ratings";
    $resposta = curl_get($url);
    echo "distribuicao de notas do ".$serie." na ".$temporada." temporada";
    
    $media = 0;
    $total_votos = 0;
    
    
    //calcula a media
    for($i=1;$i<=10;$i++){
        $media = $i*$resposta[distribution][$i] + $media;
        $total_votos = $total_votos + $resposta[distribution][$i];
    }
    $media = $media/$total_votos;
    
    //calcula desvio padrao
    $somatorio = 0;
    for ($i=1;$i<10;$i++){
        $somatorio = $somatorio + (($i - $media) * ($i - $media));
    }
    $somatorio = $somatorio/ $total_votos;
    $desvio_padrao = sqrt($somatorio);
?>
<html>
  <head>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Nota', 'Quantidade de pessoas'],
          ['1', Number("<?php echo  $resposta[distribution][1]; ?>")],
          ['2', Number("<?php echo  $resposta[distribution][2]; ?>")],
          ['3', Number("<?php echo  $resposta[distribution][3]; ?>")],
          ['4', Number("<?php echo  $resposta[distribution][4]; ?>")],
          ['5', Number("<?php echo  $resposta[distribution][5]; ?>")],
          ['6', Number("<?php echo  $resposta[distribution][6]; ?>")],
          ['7', Number("<?php echo  $resposta[distribution][7]; ?>")],
          ['8', Number("<?php echo  $resposta[distribution][8]; ?>")],
          ['9', Number("<?php echo  $resposta[distribution][9]; ?>")],
          ['10',Number("<?php echo  $resposta[distribution][10]; ?>")],
        ]);

        var options = {
          title: 'Distribuicao de notas'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <div id="piechart" style="width: 900px; height: 500px;"></div>
    <h1>media: <?php echo $media ?> </h1>
    <h1>desvio padrao: <?php echo $desvio_padrao ?></h1>
  </body>
</html>
