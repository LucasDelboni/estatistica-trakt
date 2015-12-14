<?php
    include "../curl.php";
    $serie = $_GET["nome"];
    $url = "https://api-v2launch.trakt.tv/shows/".$serie."/ratings/";
    $resposta = curl_get($url);
    
    $temporadas = temporadas($serie);
    $notas = Array();
    for ($i=0;$i<6;$i++){
        $notas[$i] = curl_get("https://api-v2launch.trakt.tv/shows/".$serie."/seasons/".$i."/ratings");
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <script type="text/javascript" src="https://www.google.com/jsapi"></script>
        <script type="text/javascript">
            google.load('visualization', '1', {packages: ['corechart', 'line']});
            google.setOnLoadCallback(drawCurveTypes);
            
            function drawCurveTypes() {
                var nome = String ("<?php echo $serie; ?>");
                var um = Number("<?php echo $notas[1][rating]; ?>");
                var dois = Number("<?php echo $notas[2][rating]; ?>");
                var tres= Number("<?php echo $notas[3][rating]; ?>");
                var q= Number("<?php echo $notas[4][rating]; ?>");

                
                var data = new google.visualization.DataTable();
                data.addColumn('number', 'Nota');
                data.addColumn('number', nome);
                
                "<?php for($i=0;$i<6;$i++){ echo $inicio.$i.$virgula.$notas[$i][rating].$final;}?>";

                data.addRows([[0,Number("<?php echo $notas[0][rating]; ?>")]])
                data.addRows([
                    [1,  um],
                    [2,  dois],
                    [3,  tres],
                    [4,  q],
                    [5,  Number("<?php echo $notas[5][rating]; ?>")]
                ])
                
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