<?php
$file = $_GET['file']; // pega o endereço do arquivo
                       // ou o nome dele se o arquivo 
                       // estiver na mesma pagina!! 


					   
					    
					   
					   
					   if (file_exists($file)) {
        header('Content-Description: File Transfer');
        header('Content-Type: text/plain');
        header('Content-Disposition: attachment; filename=' . basename($file));
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file));
        ob_clean();
        flush();
        readfile($file);
        exit;
    }else {
        echo "Arquivo não existe: ".$file;
    }

					   
					   
					   
					   
					   /*
					   
					   header("Content-Type: application/save") ;
header("Content-Length:".filesize($file)); 
header('Content-Disposition: attachment; filename="' . $file . '"'); 
header("Content-Transfer-Encoding: binary");
header('Expires: 0'); 
header('Pragma: no-cache'); 

// nesse momento ele le o arquivo e envia



$fp = fopen("$file", "r"); 
//$contents = file_get_contents($file); 
fpassthru($fp); 
fclose($fp); */
?>
