<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/index.css">
</head>

<body>
    <div class="form-login">
        <form action="loginfunc.php" method="post">
            <h2>Login</h2>
            <?php if (isset($_GET['error'])) { ?>
                <p class="error"><?php echo $_GET['error']; ?></p>
            <?php } ?>
            <input type="text" placeholder="Insert Name" name="username">
            <input type="password" placeholder="Insert Password" name="password">
            <button type="submit" class="submit">Login</button>
        </form>
    </div>
</body>

</html>