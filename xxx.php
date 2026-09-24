<?php
    $host = "localhost";
    $dbname = "phples";
    $username = "root";
    $password = "";

    try{
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $query = "SELECT * FROM gebruikers";
        $statement = $pdo->query($query);
        $statement->execute();
        $users = $statement->fetchAll();

        if (count($users) > 0) {
            foreach ($users as $user) {
            echo "User ID: " . $user->id . ", Username: " . $user->username . ", password: " . $user->password . "<br>";
    }} else {
        echo "No users found in the database.";
        }   
    }catch (PDOException $e) {
        error_log(
            $e->getMessage() . PHP_EOL,
            3,
            __DIR__ . '/errors.log'
        );

        echo "Er is iets misgegaan.";
    }
?>
    <form method="POST" id="login">
        <h2 id="textlogin">New here? Try signing up instead!</h2>
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
        <button type="submit" id="submitpassword">Log in</button>
    </form>
    <?php include 'includes/footer.php'; ?>