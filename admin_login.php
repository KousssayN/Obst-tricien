<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Dr. Manel Ben Khedija</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="files/woman-doctor-icon-doctor-woman-with-stereoscopic-glyph-isolated-blue-background-vector.jpg" type="image/x-icon">

</head>
<body>

<header>
    <h1>Admin Login</h1>
</header>
<nav>
        <ul>
            <li><a href="index.html">Accueil</a></li>
            <li><a href="about.html">À propos</a></li>
            <li><a href="services.html">Services</a></li>
            <li><a href="videos.html">Vidéos</a></li>
            <li><a href="submit_appointment.php">Contact</a></li>
        </ul>
    </nav>

<div class="content">
    <div class="contact-form">
        <h2>Connectez-vous à l'admin</h2>
        <form action="admin.php" method="post">
            <label for="password">Mot de passe</label>
            <input type="password" id="password" name="password" required>
            <button type="submit">Se connecter</button>
        </form>
    </div>
</div>

<footer>
    <p>&copy; 2024 Dr. Manel Ben Khedija. Tous droits réservés.</p>
</footer>

</body>
</html>