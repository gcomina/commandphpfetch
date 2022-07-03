<?php




   $servername = "localhost";
   $username = "wntneimy_wio";
   $password = "seed2studio2!";
   $dbname = "wntneimy_wiodb";

   // Create connection
   $conn = new mysqli($servername, $username, $password, $dbname);
   // Check connection
   if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
   }
    $sql = "SELECT * FROM tablaadd2 ORDER BY id DESC LIMIT 1";
  
    $result_set = mysqli_query($conn,$sql);
    
      if($result_set){
           while($row = mysqli_fetch_array($result_set)) {
            
            
                  $sources="/home3/wntneimy/igsensor/wiok2/".$row['thermal'];
                  // echo $sources;
           
                  $destination = "/home3/wntneimy/public_html/wio/".$row['thermal'];   // destination folder or file        
 
                shell_exec("cp -r  $sources $destination");
               // echo "<H2>Copy files completed!</H2>".$destination;
                
                
                $oldMessage = ';';

                $deletedFormat = '  ';
                 
                //read the entire string
                $str=file_get_contents($destination);

                //replace something in the file string - this is a VERY simple example
                 $str=str_replace($oldMessage, $deletedFormat,$str);
                 $temporalname="/home3/wntneimy/public_html/wio/temporalimage.csv";
                //write the entire string
                file_put_contents( $temporalname, $str);
                
                shell_exec("rm $destination");
                
                      
                           
           }
          //creating alert
          echo "<script type=\"text/javascript\">alert('Data was Retrieved 
             successfully');</script>";
}

     else{
         //creating alert
         echo "<script type=\"text/javascript\">alert('ERROR! Could Not Retrieve 
             Data');</script>";
     }
     
    


   $conn->close();
  


?>
