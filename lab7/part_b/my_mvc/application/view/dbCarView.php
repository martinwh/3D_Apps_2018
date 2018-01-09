<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Cars View</title>  
</head>
<body>
	<h1>This is Test View 2 </h1>
    <table style="border: 0px" width="1000" height="263" border="1">
    	<?php for ($i=0; $i <count ($data); $i++){ ?>
    	<tr>
    		<td width="300" align="center">
            	<h2>
					<?php echo $data[$i]['brandName'] ?>
                </h2>
            </td>
        	<td width="300" align="center">
            	<h2>
            		<?php echo $data[$i]['model'] ?>
                </h2>
            </td>
        	<td width="300" align="center">
                <h2>
					<?php echo $data[$i]['colour'] ?>
                </h2>
             </td>
        	<td><img width="300px" height="250px" src='../assets/<?php echo $data[$i]['brandName'] ?>.jpg'/></td>
    	</tr>
    	<?php } ?>
    </table>
</body>
</html>