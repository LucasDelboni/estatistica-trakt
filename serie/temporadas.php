<?php
    include "../curl.php";
    $serie = $_GET["nome"];
    $serie = str_replace(" ", "-", $serie);
    $url = "https://api-v2launch.trakt.tv/shows/".$serie."/ratings/";
    $resposta = curl_get($url);
    
    $temporadas = temporadas($serie);
    $notas = Array();
    $valores = Array();
    $tamanho = quantidade_temporadas($serie);
    for ($i=0;$i<$tamanho;$i++){
        $notas[$i] = curl_get("https://api-v2launch.trakt.tv/shows/".$serie."/seasons/".$i."/ratings");
        $valores[$i] = $notas[$i][rating];
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js'></script>
        <script type="text/javascript" src="https://www.google.com/jsapi"></script>
        <script type="text/javascript">
            google.load('visualization', '1', {packages: ['corechart', 'line']});
            google.setOnLoadCallback(drawCurveTypes);
            
            function drawCurveTypes() {
                var notas = JSON.parse("<?php echo json_encode($valores);?>");
                var nome = String ("<?php echo $serie; ?>");
                var tamanho = Number ("<?php echo $tamanho; ?>");
                

                var data = new google.visualization.DataTable();
                data.addColumn('number', 'Temporada');
                data.addColumn('number', "Nota");
                
                for(i=0;i<tamanho;i++){
                    data.addRows([[i,notas[i]]])
                }
                
                var options = {
                    chart: {
                    title: 'Nota das temporadas',
                    subtitle: ' '
                    },
                    width: 900,
                    height: 500
                };

            
                var chart = new google.charts.Line(document.getElementById('grafico-temporadas'));
            
                chart.draw(data, options);
            }
        </script>
        
    </head>
    <body>
        <div>
            <h1><?php echo $serie?></h1>
            <h5><?php echo "nota: ". $resposta[rating];?></h1>
            <h5><?php echo "votos: ". $resposta[votes];?></h1>
        </div>
        <div id="grafico-temporadas"></div>
        <div id="grafico-episodios"></div>
    </body>
</html>