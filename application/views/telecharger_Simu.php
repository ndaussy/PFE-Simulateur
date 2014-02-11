<div class="span10">

	<fieldset>
    <legend>Upload Simulation</legend>
</div>

<div class="span10">

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

		<label> Simulation's name </label>
		<input type="text" name="name_simulation" value="Nom_Simulation" required/>

		<label> Select file .csv to upload</label>

		 <?php echo form_open_multipart('telecharger/do_upload');?>

		<input class ="btn-info" type="file" name="CSV"  required/>

		 <label>Select file .txt to upload</label>

		<?php echo form_open_multipart('telecharger/do_upload');?>

		<input class ="btn-info" type="file" name="TXT"  required/>

          <label> Recorded Simulation </label>

		  <input class="btn-success" type="submit" value="Send" class="ui-corner-all" />
		</form> 

	</fieldset>

</div>