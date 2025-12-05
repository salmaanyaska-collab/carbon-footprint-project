<?php
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    // Redirect to the login page
    header("Location: login.php");
    exit;
}

// Define variables for handling data (if needed for future backend processing)

// Include frontend content below:
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculate Your Carbon Footprint</title>
    <link rel="icon" href="/public/images/favicon.png">
    <style>
        /* Add your styles here, copied from calculate.html */
        body {
            font-family: 'Poppins', sans-serif;
            line-height: 1.5;
            color: #333;
            background-color: #f9f9f9;
            padding-top: 70px;
            overflow-x: hidden;
        }

        /* Add all your other styles here... */
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav>
        <div class="logo">
            <a href="index.html"> <img src="/public/images/logo.png" height="70" width="70" alt=""></a>
        </div>
        <div class="nav-links">
            <a href="index.html">Home</a>
            <a href="calculate.php">Calculate</a>
            <a href="about.html">About</a>
            <a href="contact.html">Contact</a>
            <a href="logout.php" class="profile-icon-link">Logout</a>
        </div>
    </nav>

    <!-- Main content -->
    <header>
        <h1>Welcome, <?php echo htmlspecialchars($_SESSION["username"]); ?>!</h1>
        <h2>Calculate Your Carbon Footprint</h2>
        <form class="cleanForm" id="carbonForm">
            <div class="input-field">
                <p>
                    <label for="car">
                        <img src="/public/images/car.png" height="70" width="70" alt="Car Icon"> Car travel 
                    </label>
                    <input type="number" id="car" name="car">
                </p>
                <p>
                    <label for="electricity">
                        <img src="/public/images/electricity.png" height="70" width="70" alt="Electricity Icon"> Electricity usage
                    </label>
                    <input type="number" id="electricity" name="electricity">
                </p>
            </div>
            <div class="input-field">
                <p>
                    <label for="diet">
                        <img src="/public/images/diet.png" height="70" width="70" alt="Diet Icon"> Diet
                    </label>
                    <input type="number" id="diet" name="diet">
                </p>
                <p>
                    <label for="flight">
                        <img src="/public/images/flight.png" height="70" width="70" alt="Flight Icon"> Flights 
                    </label>
                    <input type="number" id="flight" name="flight">
                </p>
            </div>
            <div class="input-field">
                <p>
                    <label for="house">
                        <img src="/public/images/house.png" height="70" width="70" alt="House Icon"> House energy usage 
                    </label>
                    <input type="number" id="house" name="house">
                </p>
                <p>
                    <label for="motorbike">
                        <img src="/public/images/motorbike.png" height="70" width="70" alt="Motorbike Icon"> Motorbike travel 
                    </label>
                    <input type="number" id="motorbike" name="motorbike">
                </p>
            </div>
            <div class="button-container">
                <button type="button" onclick="calculateCarbon()">Calculate</button>
                <button type="reset" onclick="resetForm()">Reset</button>
            </div>
        </form>
        <section class="result">
            <h2>Your Estimated Carbon Footprint:</h2>
            <p>CO2 Emissions: <span id="result">0 kg</span> per year</p>
        </section>
    </header>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Carbon Footprint Calculator. All Rights Reserved.</p>
    </footer>

    <script>
        // Add your JavaScript code here
        function calculateCarbon() {
            const car = parseFloat(document.getElementById('car').value) || 0;
            const electricity = parseFloat(document.getElementById('electricity').value) || 0;
            const diet = parseFloat(document.getElementById('diet').value) || 0;
            const flight = parseFloat(document.getElementById('flight').value) || 0;
            const house = parseFloat(document.getElementById('house').value) || 0;
            const motorbike = parseFloat(document.getElementById('motorbike').value) || 0;

            const totalCarbon = (
                car * 2.392 +
                electricity * 0.233 +
                diet * 0.999 +
                flight * 250 +
                house * 204 +
                motorbike * 1.847
            ).toFixed(2);

            document.getElementById('result').textContent = `${totalCarbon} kg`;
        }

        function resetForm() {
            document.getElementById('carbonForm').reset();
            document.getElementById('result').textContent = "0 kg";
        }
    </script>
</body>
</html>
