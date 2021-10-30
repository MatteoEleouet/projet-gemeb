<?php

    // Prepare variables for database connection

    $username = "root";  // enter database username
    $password = "willy9105";  // enter database password
    $servername = "localhost";
    $dbname = "test";


    // Connect to your database

    $conn = mysqli_connect($servername, $username, $password, $dbname);
    if (!$conn){
      die("connection failed: " . mysqli_connect_error());
    }

    $result=mysql_query("SELECT * FROM `test` ORDER BY `timeStamp` DESC",$link);
?>

<html>
   <head>
      <title>Sensor Data</title>
   </head>
<body>
   <h1>NbFlash / Prix</h1>

   <table border="1" cellspacing="1" cellpadding="1">
    <tr>
      <td>&nbsp;Timestamp&nbsp;</td>
      <td>&nbsp;Temperature 1&nbsp;</td>
      <td>&nbsp;Prix&nbsp;</td>
    </tr>

      <?php 
      if($result!==FALSE){
         while($row = mysql_fetch_array($result)) {
            printf("<tr><td> &nbsp;%s </td><td> &nbsp;%s&nbsp; </td><td> &nbsp;%s&nbsp; </td></tr>", 
               $row["timeStamp"], $row["NbFlash"], $row["Prix"]);
         }
         mysql_free_result($result);
         mysql_close();
      }
      ?>

     </table>
</body>
</html>
  
