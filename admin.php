<?php

session_start();

// Define the admin password
$admin_password = "1234";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $password = $_POST['password'];

    if ($password == $admin_password) {
        $_SESSION['loggedin'] = true;
    } else {
        $message = "Mot de passe incorrect.";
        $message_type = "error";
    }
}
// Check if the user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: admin_login.php');
    exit;
}

// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "appointments_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch appointments
$sql = "SELECT * FROM appointments ORDER BY appointment_date";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Dr. Manel Ben Khedija</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="files/woman-doctor-icon-doctor-woman-with-stereoscopic-glyph-isolated-blue-background-vector.jpg" type="image/x-icon">

</head>
<body>

<header>
    <h1>Admin - Rendez-vous</h1>
</header>
<nav>
    <ul>
        <li><a href="index.html">Accueil</a></li>
        <li><a href="about.html">À propos</a></li>
        <li><a href="services.html">Services</a></li>
        <li><a href="videos.html">Vidéos</a></li>
        <li><a href="contact.html">Contact</a></li>
        <li><a href="admin_logout.php">Déconnexion</a></li>
    </ul>
</nav>
<div class="content">
    <div class="appointments">
        <h2>Liste des Rendez-vous</h2>
        <?php if ($result->num_rows > 0) { ?>
            <table>
                <tr>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Téléphone</th>
                    <th>Date</th>
                    <th>Message</th>
                </tr>
                <?php while($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['name']); ?></td>
                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                        <td><?php echo htmlspecialchars($row['phone']); ?></td>
                        <td><?php echo htmlspecialchars($row['appointment_date']); ?></td>
                        <td><?php echo htmlspecialchars($row['message']); ?></td>
                    </tr>
                <?php } ?>
            </table>
        <?php } else { ?>
            <p>Aucun rendez-vous trouvé.</p>
        <?php } ?>
    </div>
</div>

<footer>
    <p>&copy; 2024 Dr. Manel Ben Khedija. Tous droits réservés.</p>
</footer>

</body>
</html>

<?php
// Close database connection
$conn->close();
?>