<?php    
 
    //Establecerlo en una ubicación de escritura, un lugar para archivos PNG generados temporalmente
    $PNG_TEMP_DIR = dirname(__FILE__).DIRECTORY_SEPARATOR.'temp'.DIRECTORY_SEPARATOR;
    
    //Html PNG prefijo de ubicación
    $PNG_WEB_DIR = 'temp/';

    include "qrlib.php";    
    
    //Claro que necesitamos derechos para crear dir temporal
    if (!file_exists($PNG_TEMP_DIR))
        mkdir($PNG_TEMP_DIR);
    
    
    $filename = $PNG_TEMP_DIR.'test.png';
    
    
// proceso de entrada de formularios
    // ¡Recuerda desinfectar la entrada del usuario en la solución de la vida real!
    $errorCorrectionLevel = 'L';
    if (isset($_REQUEST['level']) && in_array($_REQUEST['level'], array('L','M','Q','H')))
        $errorCorrectionLevel = $_REQUEST['level'];    

    $matrixPointSize = 4;
    if (isset($_REQUEST['tamaño']))
        $matrixPointSize = min(max((int)$_REQUEST['tamaño'], 1), 10);


    if (isset($_REQUEST['url'])) { 
    
        
//¡Es muy importante!
        if (trim($_REQUEST['url']) == '')
            die('Url no puede estar vacío! 

<style type="text/css">
<!--
.Estilo9 {color: #00FF00}
-->
</style>
<p><a href="?">REGRASAR</a>');
            
       // datos del usuario
        $filename = $PNG_TEMP_DIR.'test'.md5($_REQUEST['url'].'|'.$errorCorrectionLevel.'|'.$matrixPointSize).'.png';
        QRcode::png($_REQUEST['url'], $filename, $errorCorrectionLevel, $matrixPointSize, 2);    
        
    } else {    
    
        
// datos predeterminados
           
        QRcode::png('Código PHP QR :)', $filename, $errorCorrectionLevel, $matrixPointSize, 2);    
        
    }    
        
   
// mostrar el archivo generado
 
    
    //config form
    echo '</p>
<p align="center">&nbsp;</p>
<form action="" method="post" name="form1" id="form1">
  <div align="center">
    <p><img src="IMAGEN/logo.png" width="55" height="82" /><img src="IMAGEN/IMAGEN.gif" width="626" height="85" /><img src="IMAGEN/bxOyUoUA.jpeg" width="67" height="75" /></p>
  </div>
</form>
<form action="index.php" method="post">
        <div align="center" class="Estilo9">
          <p><strong>URL</strong>:&nbsp;
            <input name="url" type="text" value="'.(isset($_REQUEST['url'])?htmlspecialchars($_REQUEST['url']):'').'" />
&nbsp;<strong> ECC</strong>:&nbsp;
        <select name="level">
          <option value="L"'.(($errorCorrectionLevel=='L')?' selected':'').'>L - smallest</option>
          <option value="M"'.(($errorCorrectionLevel=='M')?' selected':'').'>M</option>
          <option value="Q"'.(($errorCorrectionLevel=='Q')?' selected':'').'>Q</option>
          <option value="H"'.(($errorCorrectionLevel=='H')?' selected':'').'>H - best</option>
        </select>
&nbsp; TAMAÑO:&nbsp;
        <select name="tamaño">
          
          ';
        
    for($i=1;$i<=10;$i++)
        echo '
          
          <option value="'.$i.'"'.(($matrixPointSize==$i)?' selected':'').'>'.$i.'</option>
          
          ';
        
    echo '
        
        </select>
        &nbsp;
        <input name="Enviar" type="submit" value="GENERAR">
          </p>
  </div>
  </form>
<form id="form2" name="form2" method="post" action="">
        <label></label>

  
      <div align="right">
        <blockquote>
          <blockquote>
            <blockquote>
              <blockquote>
                <blockquote>
                  <p align="left">
                    <input type="submit" name="Submit" value="LIMPIAR URL" />
                        </p>
                </blockquote>
              </blockquote>
            </blockquote>
          </blockquote>
        </blockquote>
  </div>
</form>
        <div align="center"><img src="'.$PNG_WEB_DIR.basename($filename).'" />    </div>
    ';
        
    

    