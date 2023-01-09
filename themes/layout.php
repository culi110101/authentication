<!DOCTYPE html>
<html lang="vi">

<head>
    <title>example</title>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="Content-Language" content="vi" />
    <?php include_once $style; ?>
    <?php include_once $script; ?>
</head>

<body>
        <?php
        if (file_exists($file_path)) {
            include_once $file_path;
        } else {
            include_once 'themes/pages/404.php';
        }
        ?>
</body>

</html>