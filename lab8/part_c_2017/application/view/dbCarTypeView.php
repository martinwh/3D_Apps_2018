<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="utf-8">
   <title>Cars View</title>
</head>
<body>
   <h1>Choose a car model to see more details </h1>
   <b>Select a Brand Name: </b>
   
   <form>
      <select id="select1">
        <?php 
           for ($i=0; $i <count ($data); $i++)
           echo '<option value="'. $i .'">'. $data[$i]['brandName']. '</option>';
        ?>
      </select>
   </form>

   <table style="border: 0px" width="1000" height="263" border="1">
   <?php 
    for ($i=0; $i <count ($data); $i++){ ?>
     <tr>
       <td width="300" align="center" ><h2><?php echo $data[$i]['brandName'] ?></h2></td>
       <td width="300" align="center" ><h2><?php echo $data[$i]['model'] ?></h2></td>
       <td width="300" align="center" ><h2><?php echo $data[$i]['colour'] ?></h2></td>
       <td><img width='300px' height="250px" src='../assets/<?php echo $data[$i]['brandName'] ?>.jpg'/></td>
     </tr>
    <?php } ?>
   </table>
</body>
</html>	