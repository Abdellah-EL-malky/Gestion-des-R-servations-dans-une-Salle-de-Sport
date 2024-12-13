<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation</title>
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
        <h1>Activity Reservation</h1>
        <div class="form-container">
            <form class="reservation-form">
                <div class="form-group">
                    <label for="lastName">Last Name:</label>
                    <input type="text" id="lastName" name="lastName" required>
                </div>

                <div class="form-group">
                    <label for="firstName">First Name:</label>
                    <input type="text" id="firstName" name="firstName" required>
                </div>

                <div class="form-group">
                    <label for="phone">Phone Number:</label>
                    <input type="tel" id="phone" name="phone" required>
                </div>

                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>

                <div class="form-group">
                    <label for="activity">Select Activity:</label>
                    <select id="activity" name="activity" required>
                        <option value="">Choose an activity</option>
                        <option value="yoga">Yoga Class</option>
                        <option value="spinning">Spinning</option>
                        <option value="boxing">Boxing</option>
                        <option value="weightlifting">Weightlifting</option>
                        <option value="pilates">Pilates</option>
                        <option value="zumba">Zumba</option>
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