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
            <input type="submit" value="temporadas" onclick="document.form1.action='temporadas.php';" />
            <input type="submit" value="episodios" onclick="document.form1.action='episodios.php';" />
        </form> 
        <h1>consultar distribuicao de notas em uma temporada</h1>
        <form action="distribuicao-temporada.php" method="get" id="form2" name="form2">
            Nome da serie: <input type="text" name="nome"><br>
            Temporada: <input type="text" name="temporada"><br>
            <input type="submit" value="consultar"/>
        </form> 
        
    </body>
</html>