<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php $this->renderSection("title"); ?></title>
    <?php include(APPPATH . 'views/templates/scripts.php'); ?>

</head>

<body>
    <?php $this->renderSection("content"); ?>
    <?php include(APPPATH . 'views/components/footer/footer.php');
    ?>
</body>


</html>