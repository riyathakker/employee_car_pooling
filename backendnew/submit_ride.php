<?php
$host = 'localhost'; 
$username = 'root'; 
$password = ''; 
$database = 'vehicle_sharing_app'; 
$conn = new mysqli($host, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$source = isset($_POST['source']) ? $_POST['source'] : '';
$destination = isset($_POST['destination']) ? $_POST['destination'] : '';
$time = isset($_POST['time']) ? $_POST['time'] : '';
$seats = isset($_POST['number']) ? $_POST['number'] : '';
$vehicle = isset($_POST['vehicle']) ? $_POST['vehicle'] : '';
$gender = isset($_POST['gender']) ? $_POST['gender'] : '';
$date = isset($_POST['date']) ? $_POST['date'] : '';
$dateParts = explode('-', $date);
if (count($dateParts) === 3) {
    $day = $dateParts[0];
    $month = $dateParts[1];
    $year = $dateParts[2];
}
    
    $mysqlDate = date('Y-m-d', strtotime("$year-$month-$day"));
    $stmt = $conn->prepare("INSERT INTO rides (source, destination, date, time, number_of_seats, vehicle, gender) 
                            VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssiss", $source, $destination, $mysqlDate, $time, $seats, $vehicle, $gender);
    if ($stmt->execute()) {
        echo '<!DOCTYPE html>
        <html>
        <head>
            <!-- Redirect to home page after 3 seconds -->
            <script>
                setTimeout(function () {
                    window.location.href = "http://localhost:3000/home";
                }, 3000); // Redirect after 3 seconds
            </script>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    background-color: #f0f0f0;
                }
                .container {
                    text-align: center;
                    padding: 50px;
                }
                .success-message {
                    font-size: 24px;
                    color: #4CAF50;
                }
            </style>
        </head>
        <body>
            <div class="container">
                <p class="success-message">Ride data inserted successfully! Redirecting to home page...</p>
            </div>
        </body>
        </html>';
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
    $conn->close();
    ?>