<div class="span8">
<title>Upload Form</title>
</head>
<body>

<div class="alert alert-success">Vos fichiers ont été téléchargé sur le serveur.</div>



<table class='table'>

<?php 
	  	echo' 
		  		<thead> 
		  		<tr> ';
		  	
		
			echo '<th>Nom du fichier </th> ';   
			echo '<th>Extension </th> ';
			echo '<th>Taille </th> ';
		  	 
	  	

	  	echo '   </tr>  
	       		</thead>';
	  				   
		 foreach($upload_data as $item => $value)
		{
			echo '<Tr>';
		  	foreach ($value as $key => $value2) 
		  	{
		  		if($key=='orig_name'||$key=='file_ext'||$key=='file_size')
		  		{
		  		echo '<Td>'.$value2.'</Td>';
		  		}
		  		
		  	}
		  	echo '</Tr>';
		}
?>
</table>

</div>

