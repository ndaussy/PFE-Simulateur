
    <div class="row-fluid">
	  	<div class="span2">

	         <legend>Authentification</legend>
			

	         <?php echo validation_errors(); ?>

			<?php echo form_open('user/login'); ?>
			
			<div class="alert alert-danger">
			<?php echo $error;?>
			</div>


			<label>email</label>
			<input type="text" name="username" value="" size="50" required/>

			<label>Password</label>
			<input type="text" name="password" value="" size="50" required/>

			<input type="submit" value="S'identifier" class="btn-success"/>

			
			    
			</form> 

			<label> 
			<a  href="<?php echo site_url('user');?>"> crée un compte </a>
			</label>
			
		</div>


 
 	