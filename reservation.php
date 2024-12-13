<?php
$host = 'localhost';           
$db   = 'gym';   
$user = 'root';        
$pass = '';        

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $first_name = $_POST['first_name'];
    $phone_number = $_POST['phone_number'];
    $email = $_POST['email'];
    $activity_id = $_POST['activity_id'];

    $stmt = $conn->prepare("INSERT INTO members (name, first_name, phone_number, email) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $first_name, $phone_number, $email);
    
    if ($stmt->execute()) {
        $member_id = $conn->insert_id;
     
        $stmt = $conn->prepare("INSERT INTO reservations (member_id, activity_id, reservation_date, status) VALUES (?, ?, NOW(), 'Confirmed')");
        $stmt->bind_param("ii", $member_id, $activity_id);
        
        if ($stmt->execute()) {
            $message = "Reservation successful!";
        } else {
            $message = "Error: " . $stmt->error;
        }
    } else {
        $message = "Error: " . $stmt->error;
    }
    $stmt->close();
}

$query = "SELECT activity_id, name FROM activities WHERE disponibility = 1";
$result = $conn->query($query);

$activities = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $activities[] = $row;
    }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .message {
            margin: 20px 0;
            padding: 10px;
            border-radius: 5px;
            text-align: center;
        }
        .success {
            background-color: #d4edda;
            color: #155724;
        }
        .error {
            background-color: #f8d7da;
            color: #721c24;
        }
    </style>
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
    <h1>Activity Reservation</h1>
    <?php
    if (!empty($message)) {
        $messageClass = strpos($message, 'Error') !== false ? 'error' : 'success';
        echo "<div class='message $messageClass'>$message</div>";
    }
    ?>
    <div class="form-container">
        <form class="reservation-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <div class="form-group">
                <label for="name">Last Name:</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="first_name">First Name:</label>
                <input type="text" id="first_name" name="first_name" required>
            </div>
            <div class="form-group">
                <label for="phone_number">Phone Number:</label>
                <input type="tel" id="phone_number" name="phone_number" pattern="[0-9]{10}" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="activity">Select Activity:</label>
                <select id="activity" name="activity_id" required>
                    <option value="" hidden>Choose an activity</option>
                    <?php foreach ($activities as $activity): ?>
                        <option value="<?php echo htmlspecialchars($activity['activity_id']); ?>">
                            <?php echo htmlspecialchars($activity['name']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="submit-btn">Reserve Now</button>
        </form>
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