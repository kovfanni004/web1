<?php
// Adatbázis hitelesítő adatok

$db_pass = 'wI-rUaaZbdUF].kZ'; // Adatbázis jelszó
$db_name = 'webshop'; // Adatbázis név

// Új felhasználó beszúrása
if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password'])) {
    // Adatbázis kapcsolat létrehozása
    $dbh = new PDO(
        "mysql:host=localhost;dbname=$db_name", $dbname, $db_pass
    );

    // SQL beillesztés (prepared statement használata ajánlott a biztonság érdekében)
    $sql = "INSERT INTO users (name, email, password) VALUES (:name, :email, SHA1(:password))";

    // Készített állítás használata
    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(':name', $_POST['name']);
    $stmt->bindParam(':email', $_POST['email']);
    $stmt->bindParam(':password', $_POST['password']);
    $stmt->execute();
}

// Navigációs menü beillesztése
include_once('navigation.php');
?>

<div class="container">
    <h2>Add new user</h2>

    <form action="" method="POST">
        <div class="form-group">
            <label for="name">Name</label>
            <input name="name" type="text" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input name="email" type="email" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input name="password" type="password" class="form-control" required>
        </div>

        <button class="btn btn-primary mt-3">Add User</button>
    </form>

    <?php
    // Adatbázis kapcsolat létrehozása
    $dbh = new PDO(
        "mysql:host=localhost;dbname=$db_name", $db_name, $db_pass
    );

    // Adatok lekérdezése a felhasználók listájának megjelenítéséhez
    $results = $dbh->query("SELECT * FROM users");
    $users = $results->fetchAll(PDO::FETCH_ASSOC);
    ?>

    <h2 class="mt-5">User List</h2>

    <div class="col-12">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Password (Hashed)</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user) { ?>
                    <tr>
                        <td><?= $user['ID'] ?></td>
                        <td><?= $user['Name'] ?></td>
                        <td><?= $user['Email'] ?></td>
                        <td><?= $user['Password'] ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

</div> <!-- Záró div tag -->

</div> <!-- Záró div tag -->

</body>
</html>
