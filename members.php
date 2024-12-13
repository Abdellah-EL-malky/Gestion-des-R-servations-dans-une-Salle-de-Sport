<?php
$host = 'localhost';            
$db   = 'gym';   
$user = 'root';        
$pass = '';        

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT 
            r.reservation_id, 
            m.name AS member_name, 
            m.first_name, 
            m.email, 
            m.phone_number,
            a.name AS activity_name, 
            a.description, 
            a.capacity, 
            a.start_date, 
            a.end_date, 
            a.disponibility,
            r.reservation_date, 
            r.status
        FROM reservations r
        JOIN members m ON r.member_id = m.member_id
        JOIN activities a ON r.activity_id = a.activity_id
        ORDER BY r.reservation_date DESC";

$result = $conn->query($sql);

if (!$result) {
    die("Error executing query: " . $conn->error);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservations</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav class="navbar">
        <div class="nav-content">
            <div class="logo">IRONCORE</div>
            <ul class="nav-links">
                <li><a href="index.html">Home</a></li>
                <li><a href="reservation.php">Reservation</a></li>
                <li><a href="members.php">Members</a></li>
            </ul>
        </div>
    </nav>

    <div class="page-content">
        <h1>Reservation List</h1>
        <div class="table-container">
            <?php
            if ($result->num_rows > 0) {
                echo "<table>
                        <thead>
                            <tr>
                                <th>Reservation ID</th>
                                <th>Member Name</th>
                                <th>Member First Name</th>
                                <th>Email</th>
                                <th>Phone Number</th>
                                <th>Activity Name</th>
                                <th>Description</th>
                                <th>Capacity</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Disponibility</th>
                                <th>Reservation Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>";
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . htmlspecialchars($row['reservation_id']) . "</td>
                            <td>" . htmlspecialchars($row['member_name']) . "</td>
                            <td>" . htmlspecialchars($row['first_name']) . "</td>
                            <td>" . htmlspecialchars($row['email']) . "</td>
                            <td>" . htmlspecialchars($row['phone_number']) . "</td>
                            <td>" . htmlspecialchars($row['activity_name']) . "</td>
                            <td>" . htmlspecialchars($row['description']) . "</td>
                            <td>" . htmlspecialchars($row['capacity']) . "</td>
                            <td>" . htmlspecialchars($row['start_date']) . "</td>
                            <td>" . htmlspecialchars($row['end_date']) . "</td>
                            <td>" . htmlspecialchars($row['disponibility']) . "</td>
                            <td>" . htmlspecialchars($row['reservation_date']) . "</td>
                            <td>" . htmlspecialchars($row['status']) . "</td>
                        </tr>";
                }
                echo "</tbody></table>";
            } else {
                echo "<p>No reservations found.</p>";
            }

        
            $conn->close();
            ?>
        </div>
    </div>

    <footer class="footer">
        <div class="footer-content">
            <div class="footer-section">
                <h3>IronCore Fitness</h3>
                <p>Transform your body and mind with us.</p>
            </div>
            <div class="footer-section">
                <h3>Contact</h3>
                <p>123 Fitness Street</p>
                <p>contact@ironcore.com</p>
                <p>(555) 123-4567</p>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2024 IronCore Fitness. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>