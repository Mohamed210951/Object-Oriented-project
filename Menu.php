<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu.php</title>
</head>
<body>
    <h1>Meun.php</h1>

    <?php 
        include_once "Back End.php";
        $List = GetAllContent("UserNow.txt");
        $Type = $List[0];
    ?>
</body>
</html>