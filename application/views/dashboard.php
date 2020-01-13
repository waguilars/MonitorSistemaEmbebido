<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $title ?> </title>

    <?=$header?>

</head>
<body class="nav-md">
    <div class="container body">
    <div class="main_container">
        <?=$aside?>

        <!-- top navigation -->
        <?=$topnav?>
        <!-- /top navigation -->

        <!-- page content -->
        <?=$content?>
        <!-- /page content -->

        
        <!-- footer -->
        <?=$footer?>
        <!-- footer --> 

      </div>
    </div>

    <?=$scripts?>
</body>
</html>