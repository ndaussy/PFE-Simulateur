<div class="span10">

	<legend> Simulation en BDD </legend>

<?php echo form_open('simulation/gestion'); ?>
<div class="row-fluid">
	<div class="span2"> </div>
		<div class="span8">
           <?php if($islogin)
           {?>
			<div  class="btn-group btn-group-justified">

				  <input  class="btn btn-success" type="submit" value="Ajouter" name="ajouter" class="ui-corner-all" /> 

				  <input class="btn btn-primary" type="submit" value="Modifier"  name="modifier" class="ui-corner-all" />    

				  <input  class="btn btn-warning" type="submit" value="Supprimer" name="supprimer" class="ui-corner-all" />

			</div>
            <?php } ?>
		</div>
	<div class="span2"> </div>
	</br>
	</br>
</div>

<div class="row-fluid">
	<div class="span12">
	<table class="table table-bordered">

	<?php 
		  	echo' 
			  		<thead> 
			  		<tr> ';


            if($islogin)
            {
                echo '<th> Selectionner </th> ';
            }

			  	
			
			foreach($result[0] as $item2 => $value)
			{
				//if($item2=='name_simulation'||$item2=='date_add')
				{
				echo '<th>'.$item2.'</th> ';   
				}
			  	 
		  	}
		  	

		  	echo '   </tr>  
		       		</thead>';
		  	$cpt=0;
			foreach($result as $item => $value)
			{
				echo '<Tr>';

			  	foreach ($value as $key => $value2) 
			  	{
                        if($key=='name_simulation')
                        {

                        if($islogin)
                        {
                            echo '<Td> <INPUT type="checkbox" name="name_simulation_'.$cpt++.'"; value="'.$value2.'"> </td>';
                        }

                        echo '<Td>'.$value2.'</Td>';
                        }

                        if($key=='date_add')
                        {
                        echo '<Td>'.$value2.'</Td>';
                        }

                        if($key=='csv_state')
                        {
                            echo '<Td>'.$value2.'</Td>';
                        }

                        if($key=='txt_state')
                        {
                            echo '<Td>'.$value2.'</Td>';
                        }
			  		
			  	}

	   			

			  	echo '</Tr>';
			}
	?>
	</table>
	</div>

	
 

</form>

</div>