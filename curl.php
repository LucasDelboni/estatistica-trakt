<?php
    function curl_get($url){
        $ch = curl_init($url);
  
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "trakt-api-key: 314eaee96f1803883ed403b39dc84164b478c8cdffb070eeb1b17268b07d295e"
        ));
        
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,  2);
        
        
        $result = curl_exec($ch);
        curl_close($ch);
        
        $resposta = json_decode($result, TRUE);
        return $resposta;
    }
    
    function temporadas($serie){
        $url = "https://api-v2launch.trakt.tv/shows/".$serie."/seasons";
        $resultado = curl_get($url);
        return $resultado;
    }
    
    function quantidade_temporadas($serie){
        $someJSON = json_encode(temporadas($serie));
        $someArray = json_decode($someJSON, true);
        $i=0;
        foreach ($someArray as $e){
            $i++;
        }
        return $i;
    }
    

?>