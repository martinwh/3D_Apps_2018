<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>Test View of car Data</title>
    
</head>
<body>
	<h1>This is Test View 2</h1>
    
	 <table style="border: 0px" width="600" height="263" border="1">
     <tr>
       <td width="300" align="center" ><h2><?php echo $car1 ?></h2></td>
       <td><img width='300px' height="250px" src='assets/<?php echo $car1 ?>.jpg'/></td>
     </tr>
     <tr>
       <td width="300" align="center"><h2><?php echo $car2 ?></h2></td>
       <td><img width='300px' height="250px" src='assets/<?php echo $car2 ?>.jpg'/></td>
     </tr>
     <tr>
       <td width="300" align="center"><h2><?php echo $car3 ?></h2></td>
       <td><img width='300px' height="250px" src='assets/<?php echo $car3 ?>.jpg'/></td>
     </tr>
     <tr>
       <td width="300" align="center"><h2><?php echo $car4 ?></h2></td>
       <td><img width='300px' height="250px" src='assets/<?php echo $car4?>.jpg'/></td>
     </tr>
     <tr>
       <td width="300" align="center"><h2><?php echo $car5 ?></h2></td>
       <td><img width='300px' height="250px" src='assets/<?php echo $car5 ?>.jpg'/></td>
     </tr>
   </table>
</body>
</html>