<?php

require_once '_connec.php';


$pdo = new PDO(DSN, USER, PASS);

$query = "SELECT * FROM friend";
$statement = $pdo->query($query);
$friends = $statement->fetchAll();

foreach ($friends as $friend) {
    ?>
    <div >
    <ul class="list">
    <li><?= $friend['id'];?></li>
    <li><?= $friend['firstname'];?></li>
    <li><?= $friend['lastname'];?></li>
    </ul>
    </div>
    <?php
}

?>

<html>
<head>
    <meta charset="utf-8">
    <title>Friends Formulaire</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <form action="index.php" method="post">
            <div class="contained">
                <label for="firstname">Enter your firstname: </label>
                <input type="text" name="firstname" id="firstname" required>
            </div>
            <div class="contained">
                <label for="lastname">Enter your lastname: </label>
                <input type="text" name="lastname" id="lastname" required>
            </div>
            <div class="contained">
                <input type="submit" value="Send!">
            </div>
        </form>
</div>
</body>

</html>

<?php

$firstname = trim($_POST['firstname']);
$lastname = trim($_POST['lastname']);

$query = "INSERT INTO friend (firstname, lastname) VALUES (:firstname, :lastname)";
$statement = $pdo->prepare($query);

$statement->bindValue(':firstname', $firstname, \PDO::PARAM_STR);
$statement->bindValue(':lastname', $lastname, \PDO::PARAM_STR);

$statement->execute();

$friends = $statement->fetchAll(PDO::FETCH_ASSOC);

?>