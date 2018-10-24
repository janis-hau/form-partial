<?php require_once 'functions.php' ?>
<!DOCTYPE html>
<html lang="de">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Form Partial</title>

        <link rel="stylesheet" href="assets/css/style.css">
        <link rel="stylesheet" href="assets/css/theme.css">
    </head>
    <body>
        <?php echo buildForm( $form_config ); ?>

        <script src="assets/js/output.min.js"> async</script>
    </body>
</html>