<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php
        echo $title = isset($pageName) ? $pageName : 'Document';
        ?>
    </title>
    <!-- Base href -->
    <base href="/figure_store/Admin/">
    <!-- font text -->
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@300;400;500;600;700&family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet" />
    <!-- font icon -->
    <link rel="stylesheet" href="./public/font/font-icon/css/all.css">
    <!-- Jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <!-- Data table -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
    <!-- Ck editor -->
    <script type="text/javascript" src="./public/library/ckeditor5/ckeditor.js"></script>
    <!-- main css -->
    <link rel="stylesheet" href="./public/css/main.css">
</head>

<body>
    <div class="wrapper">
        <div class="container">
            <!-- sideBar -->
            <?php require_once './App/views/partials/sidebar.php' ?>

            <!-- Header -->
            <?php require_once './App/views/partials/header.php' ?>


            <!-- main -->
            <main class="main">
                <!-- main__content -->
                <div class="content" style="<?php echo $func->handlePaddingContent(); ?>">
                    <!-- breadcrumbs -->
                    <?php require_once './App/views/partials/pageLink.php' ?>
                    <!-- notification -->
                    <?php require_once './App/views/partials/notificationAction.php' ?>
                    <!-- Page -->
                    <?php require_once "./App/views/page/${page}.php" ?>
                </div>
            </main>
        </div>
    </div>

    <!--link JS  -->
    <script src="./public/js/main.js"></script>
    <script src="./public/js/notification.js"></script>
</body>

</html>