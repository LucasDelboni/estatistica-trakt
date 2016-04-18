<!DOCTYPE html>
<html>
    <head>
        <script language="JavaScript">
            function Enviar(opc){
                if(opc == 0){
                    document.form.action = "temporadas.php";
                }
                if(opc == 1){
                    document.form.action = "enviar.php";
                    document.form.target = "";
                    document.form.submit();
                }
            }
        </script>
    </head>
    <body>
        <h1>consultar uma serie</h1>
        <form action="" method="get" id="form1" name="form1">
            Nome da serie: <input type="text" name="nome"><br>
            <input type="submit" value="temporadas" onclick="document.form1.action='serie/temporadas.php';" />
            <input type="submit" value="episodios" onclick="document.form1.action='serie/episodios.php';" />
        </form> 
        <h1>consultar distribuicao de notas em uma temporada</h1>
        <form action="serie/distribuicao-temporada.php" method="get" id="form2" name="form2">
            Nome da serie: <input type="text" name="nome"><br>
            Temporada: <input type="number" name="temporada"><br>
            <input type="submit" value="consultar"/>
        </form> 
        
        <h1>consultar um filme</h1>
        <form action="filme" method="get" id="form3" name="form3">
            Nome do filme: <input type="text" name="nome"><br>
            <input type="submit" value="filme"/>
        </form> 
        
    </body>
</html>