<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
<!-- form start -->
    <form action="" method="post" enctype="multipart/form-data">
    <label for="files">Chose Your File </label>
<!-- firstSelect -->
    <select name="files" id="files">
        <option value=""></option>
        <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $_SESSION["fileLiTe3zele"]=$_POST["files"];
// upload file
                $path = __DIR__ . "/";
                $path = str_replace('\\', '/', $path);
                $pathOfileName = $path . basename($_FILES["gg"]["name"]);
                $fileNamee=basename($_FILES["gg"]["name"]);
                for ($j=0; $j < strlen($fileNamee) ; $j++){ 
                    if ($fileNamee[$j]=='.' && $fileNamee[$j+1]=='c' && $fileNamee[$j+2]=='s' && $fileNamee[$j+3]=='v') {
                        move_uploaded_file($_FILES["gg"]["tmp_name"], $pathOfileName);
                    }
                    elseif ($fileNamee[$j]=='.' && $fileNamee[$j+1]=='j' && $fileNamee[$j+2]=='s' && $fileNamee[$j+3]=='o' && $fileNamee[$j+4]=='n') {
                        move_uploaded_file($_FILES["gg"]["tmp_name"], $pathOfileName);
                    }
                }
            }
            else{
                $_SESSION["fileLiTe3zele"]="";
            }
            $allFilesNames=[];
            $blassa = __DIR__;
            $filesNames=scandir($blassa);
            foreach($filesNames as $fileName){
                $fileNameList=str_split($fileName);
                for ($i=0; $i <strlen($fileName) ; $i++) { 

                    if ($fileNameList[$i]=='.' && $fileNameList[$i+1]=='c' && $fileNameList[$i+2]=='s'&& $fileNameList[$i+3]=='v'){
                        array_push($allFilesNames,$fileName);
                        echo "<option value=\"$fileName\"";
                        if ($_SESSION['fileLiTe3zele']==$fileName){
                            echo" selected";
                        }
                        
                        echo">$fileName</option>"; 
                        

                    }
                    if ($fileNameList[$i]=='.' && $fileNameList[$i+1]=='j' && $fileNameList[$i+2]=='s'&& $fileNameList[$i+3]=='o'&& $fileNameList[$i+4]=='n'){
                        array_push($allFilesNames,$fileName);
                        echo "<option value=\"$fileName\"";
                        if ($_SESSION['fileLiTe3zele']==$fileName){
                            echo" selected";
                        }
                        
                        echo">$fileName</option>"; }}}  
        ?>
    </select>
<!-- Select 2 -->
    <select name="khate" id="khate">
        <option value="" default></option>
        <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $listaGG=str_split($_POST["files"]);
        for($i=0;$i<count($listaGG);$i++){
            if ($listaGG[$i]=='.' && $listaGG[$i+1]=='c' && $listaGG[$i+2]=='s' && $listaGG[$i+3]=='v') {
                $fileType='csv';
            }
            if ($listaGG[$i]=='.' && $listaGG[$i+1]=='j' && $listaGG[$i+2]=='s' && $listaGG[$i+3]=='o' && $listaGG[$i+4]=='n') {
                $fileType='json';
            }

        }
        if ($_POST["files"] != '' && $fileType=='csv') {
            $filee = fopen($_POST["files"], 'r');
            $ga3eStora = file($_POST["files"]);
            $nowStarStr = $ga3eStora[0];
            $l3amer2 = '';
            for ($x = 0; $x < strlen($nowStarStr); $x++) {
                if ($nowStarStr[$x] != ',' && $x != strlen($nowStarStr)) {
                    $l3amer2 .= $nowStarStr[$x];
                } else {   
                    echo "<option value=\"$l3amer2\">$l3amer2</option>";
                    $l3amer2 = '';
                }
            }
            fclose($filee);
        }
        if ($_POST["files"] != '' && $fileType=='json'){
            $jsonFile = file_get_contents($_POST["files"]);
            $arrayDyalJson = json_decode($jsonFile, true);
            $arrayDyalKeys=array_keys($arrayDyalJson[0]);
            foreach ($arrayDyalKeys as $key ) {
                echo"<option value=\"$key\">$key</option>";}}}?>
</select>
<!-- input files + submite -->
    <input type="file" name="gg" accept=".json,.csv">
    <input type="submit" value="see" id="submit">  
</form>
<!-- main php code -->
<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
// detect file type
        $listaGG=str_split($_POST["files"]);
        for($i=0;$i<count($listaGG);$i++){
            if ($listaGG[$i]=='.' && $listaGG[$i+1]=='c' && $listaGG[$i+2]=='s' && $listaGG[$i+3]=='v') {
                $fileType='csv';
            }
            if ($listaGG[$i]=='.' && $listaGG[$i+1]=='j' && $listaGG[$i+2]=='s' && $listaGG[$i+3]=='o' && $listaGG[$i+4]=='n') {
                $fileType='json';}}
// if file type .csv
        if($_POST["files"]!='' && $fileType=='csv' ){
// if the collum not selectes shows the full table
            if($_POST["khate"]==""){     
            $filee=fopen($_POST["files"],'r');
            $ga3eStora=file($_POST["files"]);
            echo'<table>';
            for ($z=0; $z < count($ga3eStora) ; $z++) { 
                $nowStarStr=$ga3eStora[$z];
                $l3amer='';
                echo'<tr>';
                for ($x=0; $x <strlen($nowStarStr);$x++){
                    if($nowStarStr[$x]!=',' && $x!=strlen($nowStarStr)){
                        $l3amer=$l3amer.''.$nowStarStr[$x];
                    }
                    else{
                        if ($z==0) {
                            echo'<th>'.$l3amer.'</th>';
                            $l3amer='';
                        }
                        else{
                        echo'<td>'.$l3amer.'</td>';
                        $l3amer='';}
                    }   
                }
                echo'</tr>';    
            }
            echo'</table>';        
            fclose($filee);}
// if the collum selected           
            else{
            $filee=fopen($_POST["files"],'r');
            $ga3eStora=file($_POST["files"]);
            echo'<table>';
            $lkhtota=[];
            for ($z=0; $z < count($ga3eStora) ; $z++) { 
                $nowStarStr=$ga3eStora[$z];
                $l3amer='';
                echo'<tr>';
                if($z==0){
                    for ($x=0; $x <strlen($nowStarStr);$x++){
                        if($nowStarStr[$x]!=',' && $x!=strlen($nowStarStr)){
                            $l3amer=$l3amer.''.$nowStarStr[$x];
                        }
                        else{
                            
                            array_push($lkhtota,$l3amer);
                            $l3amer='';
                        } 
                    }
                    $l3amer='';
                    $indexDyalKhate=array_search($_POST["khate"],$lkhtota); 
                }
                $zide=0;
                for ($x=0; $x <strlen($nowStarStr);$x++){
                    if($nowStarStr[$x]!=',' && $x!=strlen($nowStarStr)){
                        $l3amer=$l3amer.''.$nowStarStr[$x];
                    }
                    else{
                        if ($zide==$indexDyalKhate) {
                            if ($z==0) {
                                echo'<th>'.$l3amer.'</th>';
                                $l3amer='';
                            }
                            else{
                                
                                echo'<td>'.$l3amer.'</td>';
                            
                                $l3amer='';
                            }
                        }
                        $zide++;
                        $l3amer='';
                    }   
                }
                echo'</tr>';    
            }
            echo'</table>';  
            $lkhtota=[];      
            fclose($filee);
            }}
// if the file type .json
            if($_POST["files"]!='' && $fileType=='json'){
// if the collum not selectes shows the full table                
                if($_POST["khate"]==""){     
                    $jsonFile = file_get_contents($_POST["files"]);
                    $arrayDyalJson = json_decode($jsonFile, true);
                    $arrayDyalKeys=array_keys($arrayDyalJson[0]);
                    echo'<table> <tr>';
                    foreach ($arrayDyalKeys as $key ) {
                        echo'<th>'.$key.'</th>';}
                    echo'</tr>';
                    for ($i=0; $i < count($arrayDyalJson) ; $i++) { 
                        $arrayDyalStar=$arrayDyalJson[$i];
                        foreach ($arrayDyalKeys as $key ) {
                            echo'<td>'.$arrayDyalStar[$key].'</td>';}
                        echo'</tr>';}}
// if the collum selected 
                if($_POST["khate"]!=""){     
                    $jsonFile = file_get_contents($_POST["files"]);
                    $arrayDyalJson = json_decode($jsonFile, true);
                    $arrayDyalKeys=array_keys($arrayDyalJson[0]);
                    echo'<table> <tr>';
                    foreach ($arrayDyalKeys as $key ) {
                        if ($key==$_POST["khate"]){
                            echo'<th>'.$key.'</th>';
                        }}
                    echo'</tr>';
                    for ($i=0; $i < count($arrayDyalJson) ; $i++) { 
                        $arrayDyalStar=$arrayDyalJson[$i];
                        foreach ($arrayDyalKeys as $key ){
                            if ($key==$_POST["khate"]){
                                echo'<td>'.$arrayDyalStar[$key].'</td>';
                               }}
                        echo'</tr>';
                    }}};}?>
</body>
</html>
