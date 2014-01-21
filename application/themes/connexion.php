  <div class="row-fluid">

	      <div class="span2">

	         <legend>Connexion</legend>
			

	         <?php echo validation_errors(); ?>

			<?php echo form_open('user/login'); ?>
			
			

			<label>email</label>
			<input style="width: 125px;" type="text" name="username" value="exemple@ece.fr"  required/>

			<label>Password</label>
			<input style="width: 125px;" type="password" name="password" value="password"  required/>

			<input type="submit" value="S'identifier" class="btn btn-success"/>

			
			    
		<!--	<legend>Compte</legend>
			
			<a class="btn btn-success"  href="<?php// echo site_url('user');?>"> crée un compte </a>
			 
			-->
              </form>

          </div>

        <div class="span10">

        </div>




 