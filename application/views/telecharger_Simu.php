<div class="span12">

	<fieldset>
    <legend>Depot de simulation</legend>
</div>

<div class="span12">

    <fieldset>
		<?php echo validation_errors(); 
			  
		?>
		<form class="well" method="post" action="<?php echo site_url('Telecharger/do_upload');?>" enctype="multipart/form-data" id="myForm" 
		target="_self" onSubmit="return verif_formulaire()"> 
           
		<?php
		if($erreur!='')
		{
		?>
		<div class="alert alert-danger"> <?php echo $erreur; ?> </div> 
		<?php
		}
		?>

		<label> Nom de la simulation </label>
		<input type="text" name="name_simulation" value="Nom_Simulation" required/>

		<label> Selectionner votre fichier .csv à dl</label>

		 <?php echo form_open_multipart('telecharger/do_upload');?>

		<input class ="btn-info" type="file" name="CSV"  required/>

		 <label> Selectionner votre fichier .txt à dl</label>

		<?php echo form_open_multipart('telecharger/do_upload');?>

		<input class ="btn-info" type="file" name="TXT"  required/>

          <label> Soumettre la simulation </label>  

		  <input class="btn-success" type="submit" value="Envoyer" class="ui-corner-all" />     
		</form> 

	</fieldset>

</div>