<div class="span8">
	


	<fieldset>
         <legend>Crée un compte</legend>
		


       <?php echo validation_errors(); ?>

		<?php echo form_open('user/createAccount'); ?>
			

		<label>email </label>
		<input type="text" name="username" value="" size="50" required/>

		<label>Password </label>
		<input type="password" name="password" value="" size="50" required/>
		<label></label>
		<input type="submit" value="S'enregistrer" class="btn-success"/>

		
		    
		</form> 
	</fieldset>
	
</div>
