<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" > 
    <head>
        <title><?php echo $titre; ?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=<?php echo $charset; ?>" />
        <link rel="icon" type="image/png" href=<?php echo base_url()."/assets/img/logo_ebsf.png";?> />
        
        <?php foreach($css as $url): ?>
        <link rel="stylesheet" type="text/css" media="screen" href="<?php echo $url; ?>" />
        <?php endforeach; ?>


        <?php foreach($js as $url): ?>
            <script type="text/javascript" src="<?php echo $url; ?>"></script>
        <?php endforeach; ?>

    </head>
    <body>

        <div class="container-fluid">

             <div class="row-fluid">

                <div class="span2">
                </div>

                 <div class="span8">

                    <?php echo $output; ?>
                </div>

                <div class="span2">
                </div>

        </div>


        

    </body>
</html>