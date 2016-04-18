<?php
    include "../curl.php";
    $filme = $_GET["nome"];
    $nome = str_replace(" ", "-", $filme);
    $url = "https://api-v2launch.trakt.tv/movies/".$nome."/ratings/";
    $resposta = curl_get($url);
    $someJSON = json_encode($resposta);
    $resultado = json_decode($someJSON, true);
    
    $media = 0;
    $total_votos = 0;
    //calcula a media
    for($i=1;$i<=10;$i++){
        $media = $i*$resultado[distribution][$i] + $media;
        $total_votos = $total_votos + $resultado[distribution][$i];
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

<!DOCTYPE html>
<html>
    <head>
        <script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js'></script>
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript">
            google.charts.load("current", {packages:["corechart"]});
            google.charts.setOnLoadCallback(draweChart);
            
            var notas = JSON.parse("<?php echo json_encode($valores);?>");
            var nome = String ("<?php echo $nome; ?>");
            var tamanho = Number ("<?php echo $tamanho; ?>");
      
            function draweChart() {
                var data = google.visualization.arrayToDataTable([
                    ['Nota', nome+(' (traktv)')],
                    ['1',  Number("<?php echo  $resultado[distribution][1]; ?>")],
                    ['2',  Number("<?php echo  $resultado[distribution][2]; ?>")],
                    ['3',  Number("<?php echo  $resultado[distribution][3]; ?>")],
                    ['4',  Number("<?php echo  $resultado[distribution][4]; ?>")],
                    ['5',  Number("<?php echo  $resultado[distribution][5]; ?>")],
                    ['6',  Number("<?php echo  $resultado[distribution][6]; ?>")],
                    ['7',  Number("<?php echo  $resultado[distribution][7]; ?>")],
                    ['8',  Number("<?php echo  $resultado[distribution][8]; ?>")],
                    ['9',  Number("<?php echo  $resultado[distribution][9]; ?>")],
                    ['10', Number("<?php echo  $resultado[distribution][10]; ?>")]
                ]);
                var options = {
                  title: 'Distribuicao  de notas',
                  hAxis: {title: 'Nota',  titleTextStyle: {color: '#333'}},
                  vAxis: {minValue: 0}
                };
                
                var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
                chart.draw(data, options);
            }
            
            
        </script>
    </head>
    <body>
        <h1><?php echo $filme?></h1>
        <div id="chart_div"></div>
        <h1>media: <?php echo $media ?> </h1>
        <h1>desvio padrao: <?php echo $desvio_padrao ?></h1>
    </body>
</html>