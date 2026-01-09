<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title = isset($pageName) ? $pageName : 'Document' ?></title>
    <base href="/figure_store/customer/">
    <link rel="stylesheet" href="./public/css/main.css">
    <link rel="stylesheet" href="./public/font/font-icon/css/all.css">
</head>

<body>
    <div class="wrapper">
        <!-- main -->
        <main class="main">
            <?php require_once "./App/views/page/${page}.php" ?>
        </main>

    </div>
</body>

</html>