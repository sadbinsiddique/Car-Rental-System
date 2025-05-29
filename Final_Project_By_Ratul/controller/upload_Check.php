<?php

    if(isset($_POST['submit'])){

    
        $src = $_FILES['myfile']['tmp_name'];
        $des = "../asset/upload/".$_FILES['myfile']['name'];

       
        if(move_uploaded_file($src, $des)){
            echo "Success";
        }else{
            echo "Error";
        }

    }

?>