<?php
$host = 'localhost';            
$db   = 'gym';   
$user = 'root';        
$pass = '';        

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM members";
$result = $conn->query($sql);

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Membres</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav class="navbar">
        <div class="nav-content">
            <div class="logo">IRONCORE</div>
            <ul class="nav-links">
                <li><a href="index.html">Accueil</a></li>
                <li><a href="reservation.php">Réservation</a></li>
                <li><a href="members.php">Membres</a></li>
            </ul>
        </div>
    </nav>

    <div class="page-content">
        <h1>Liste des Membres</h1>
        <div class="table-container">
            <?php
            if ($result && $result->num_rows > 0) {
                echo "<table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nom</th>
                                <th>Prénom</th>
                                <th>Email</th>
                                <th>Téléphone</th>
                            </tr>
                        </thead>
                        <tbody>";
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . htmlspecialchars($row['member_id']) . "</td>
                            <td>" . htmlspecialchars($row['name']) . "</td>
                            <td>" . htmlspecialchars($row['first_name']) . "</td>
                            <td>" . htmlspecialchars($row['email']) . "</td>
                            <td>" . htmlspecialchars($row['phone_number']) . "</td>
                          </tr>";
                }
                echo "</tbody></table>";
            } else {
                echo "<p class='error'>Aucun membre trouvé.</p>";
            }
            ?>
        </div>
    </div>

    <footer class="footer">
        <div class="footer-content">
            <div class="footer-section">
                <h3>IronCore Fitness</h3>
                <p>Transformez votre corps et votre esprit avec nous.</p>
            </div>
            <div class="footer-section">
                <h3>Contact</h3>
                <p>123 Rue du Fitness</p>
                <p>contact@ironcore.com</p>
                <p>(555) 123-4567</p>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2024 IronCore Fitness. Tous droits réservés.</p>
        </div>
    </footer>

   
</body>
</html>