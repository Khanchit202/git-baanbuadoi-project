<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <style>
        @font-face {
            font-family: kkfont;
            src: url('FC Iconic Regular.ttf');
        }
        body {
            margin: 0;
            padding: 0;
            font-family: kkfont;
        }
    </style>
</head>
<body>

    <div class="container shadow-sm rounded bg-white" style="padding: 50px 30px; border-color: #ccc; border-width: 1px; border-radius: 4px; width: 1080px; height: 3000px;">
        <nav style="position: sticky; top: 20px;">
            <?php include("tabbar_view/tab_bar.php"); ?>
        </nav>
    </div>

</body>
</html>
