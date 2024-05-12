    <?php

    function connection(){
        $host = "localhost";
        $username ="root";
        $password = "new_password";
        $dbname = "infiniteeth";

        $con = new mysqli($host,$username,$password,$dbname);

        if ($con->connect_error){
            echo $con-> connect_error;
        }else{
            return $con;

            }
        
    }



    ?>