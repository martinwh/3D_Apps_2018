<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Cars View</title>  
</head>
<body>
<div id="container" style="width:70%; margin:0px auto";>    
	<div style="float:left;">
    	<div id="title" >
    		<h1>Car Configuration Data:</h1>
    	</div>
    <div id="dbContents">
    	<table style="border: black" width="1000" height="263" border="1">	
    	<tr>
    		<td width="300" align="center">
    			<h2>Id</h2>
    		</td>
    		<td width="300" align="center">
    			<h2>Brand</h2>
    		</td>
    		<td width="300" align="center">
    			<h2>Model</h2>
    		</td>
    		<td width="300" align="center">
    			<h2>Color</h2>
    		</td>
    	</tr>
    	
    	<?php for ($i=0; $i <count ($data); $i++){ ?>
    	<tr>
    		<td align="center">
            	<h2>
					<?php echo $data[$i]['brandName'] ?>
                </h2>
            </td>
        	<td align="center">
            	<h2>					
            		<?php echo $data[$i]['model'] ?>
                </h2>
            </td>
        	<td align="center">
                <h2>
					<?php echo $data[$i]['color'] ?>
                </h2>
             </td>
        	<td>
        		<img width="300px" height="250px" src='../assets/<?php echo $data[$i]['brandName'] ?>.jpg'/>
        	</td>
    	</tr>
    	<?php } ?>
    	</table>
    </div>
    <div id="footer">
    	<div id="footerContents" >
    		<h3>Site Map: About | Cars | Refs | Statement of Originality | 3D Model Download </h3>
    	</div>
    </div>
</div>



</body>
</html>