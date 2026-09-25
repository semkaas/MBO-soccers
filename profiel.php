<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="webpagina van mbosoccers">
    <meta name="keywords" content="HTML, voetbal, club, schema, overzicht">
    <meta name="author" content="Sem en Sidney">
    <title>MBO soccers</title>
    <link rel="icon" href="" type="image/x-icon">
    <link rel="stylesheet" href="css/style.css">
    <script src="javascript/script.js" defer></script>
</head>
<body>
<?php include 'includes/header.php';?>
<?php
    $host = "localhost";
    $dbname = "mbosoccers3";
    $username = "root";
    $password = "";

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user = trim($_POST['username']);
            $pass = $_POST['password'];

            if (!empty($user) && !empty($pass)) {
                // $wachtwoord = password_hash($pass, PASSWORD_DEFAULT);

                $sql = "INSERT INTO gebruikers (username, password) VALUES (:username, :password)";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([
                    'username' => $user,
                    'password' => $pass
                ]);

                header("Location: aankondigingen.php");
            } else {
                echo "Vul alle velden in. <br> <br>";
            }
        }
    } catch (PDOException $e) {
        error_log(
            $e->getMessage() . PHP_EOL,
            3,
            __DIR__ . '/errors.log'
        );

        echo "Er is iets misgegaan.";
    }
?>

<form method="POST">
    <h2>New here? Try signing up instead!</h2>
    <article>
        <h1>USERNAME:</h1>
        <input type="text" id="username" name="username" required>
    </article>
    <br>
    <article>
        <h1>PASSWORD:</h1>
        <input type="password" id="password" name="password" required>
    </article>
    <br>
    <button type="submit" id="submitpassword">Sign up</button>
</form>

<?php include 'includes/footer.php'; ?>
</body>
</html>
