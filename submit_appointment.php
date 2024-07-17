<?php
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

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data and sanitize inputs
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $date = $conn->real_escape_string($_POST['date']);
    $message = $conn->real_escape_string($_POST['message']);

    // Check for duplicate appointment
    $duplicate_check_sql = "SELECT COUNT(*) as count FROM appointments WHERE phone='$phone' AND appointment_date='$date'";
    $duplicate_check_result = $conn->query($duplicate_check_sql);
    $duplicate_check_row = $duplicate_check_result->fetch_assoc();

    if ($duplicate_check_row['count'] > 0) {
        $message = "Vous avez déjà un rendez-vous programmé pour cette date avec le même numéro de téléphone.";
        $message_type = "error";
    } else {
        // Check if the chosen date already has 5 appointments
        $date_check_sql = "SELECT COUNT(*) as count FROM appointments WHERE appointment_date='$date'";
        $date_check_result = $conn->query($date_check_sql);
        $date_check_row = $date_check_result->fetch_assoc();

        if ($date_check_row['count'] >= 5) {
            $message = "La date choisie n'est pas disponible. Veuillez choisir une autre date.";
            $message_type = "error";
        } else {
            // SQL query to insert data into appointments table
            $sql = "INSERT INTO appointments (name, email, phone, appointment_date, message)
                    VALUES ('$name', '$email', '$phone', '$date', '$message')";

            if ($conn->query($sql) === TRUE) {
                // Redirect to thank you page after successful submission
                $message = "Votre rendez-vous a été pris avec succès. Nous vous contacterons bientôt pour confirmer.";
                $message_type = "success";
            } else {
                $message = "Erreur: " . $sql . "<br>" . $conn->error;
                $message_type = "error";
            }
        }
    }
}

// Close database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prendre Rendez-vous - Dr. Manel Ben Khedija</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="files/woman-doctor-icon-doctor-woman-with-stereoscopic-glyph-isolated-blue-background-vector.jpg" type="image/x-icon">

</head>
<body>

<header>
    <h1>Prendre Rendez-vous</h1>
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
        <h2>Formulaire de Rendez-vous</h2>

        <!-- Message display area -->
        <?php if(isset($message)) { ?>
            <div class="message <?php echo $message_type; ?>">
                <?php echo $message; ?>
            </div>
        <?php } ?>

        <form action="submit_appointment.php" method="post">
            <label for="name">Nom</label>
            <input type="text" id="name" name="name" required>
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>
            <label for="phone">Téléphone</label>
            <input type="tel" id="phone" name="phone" required>
            <label for="date">Date préférée</label>
            <input type="date" id="date" name="date" required>
            <label for="message">Message</label>
            <textarea id="message" name="message" rows="5" ></textarea>
            <button type="submit">Envoyer</button>
        </form>
    </div>

    <div class="map">
        <h2>Notre Emplacement</h2>
        <iframe
                src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d1129.513926877022!2d10.18574265281214!3d36.800596087140065!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1sbardo%20rue%20Habib%20bourguiba%2C%20Le%20Bardo%2C%20Tunisia!5e0!3m2!1sen!2stn!4v1721218181112!5m2!1sen!2stn"
                width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"></iframe>    </div>

    <div class="schedule">
        <h2>Horaires de Travail</h2>
        <p>Lundi - Vendredi: 9:00 - 17:00</p>
        <p>Samedi: 10:00 - 12:00</p>
        <p>Dimanche: Fermé</p>
    </div>
    <div class="schedule">
        <h2>contactez-nous par</h2>
        <p><img src="files/telephone.png" alt="telephone">Téléphone : 96 223 907 - 96 225 365 - 55 940 617</p>
        <p><img src="files/facebook.png" alt="facebook">Facebook :<a href="https://www.facebook.com/profile.php?id=61558749145509">https://www.facebook.com</a></p>
        <p><img src="files/email.jpg" alt="email">Email : Manel_benkhedija@yahoo.fr</p>
        <p><img src="files/adresse.png" alt="adresse">Adresse : bardo rue Habib bourguiba, Le Bardo, Tunisia</p>
    </div>
</div>
 <!-- Admin login link -->
 <div class="admin-login">
        <p>Pour consulter les rendez-vous, <a href="admin_login.php">connectez-vous ici</a>.</p>
    </div>
</div>

<footer>
    <p>&copy; 2024 Dr. Manel Ben Khedija. Tous droits réservés.</p>
</footer>

</body>
</html>