<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Information Form</title>
    <style>
        body {
            padding: 40px;
            font-family: Arial;
        }
        form {
            max-width: 600px;
            margin: auto;
            background: #f9f9f9;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 0 10px #ccc;
        }
        label {
            display: block;
            margin-top: 15px;
        }
        input, textarea, select {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
        }
        input[type="checkbox"], input[type="radio"] {
            width: auto;
        }
        input[type="submit"], input[type="reset"] {
            margin-top: 20px;
            width: 49%;
        }
    </style>
</head>
<body>

<h1 style="text-align: center;">User Info Form</h1>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = mysqli_connect("localhost", "root", "", "infodb");
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $bio = mysqli_real_escape_string($conn, $_POST['bio']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $country = mysqli_real_escape_string($conn, $_POST['country']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $skills = isset($_POST['skills']) ? implode(", ", $_POST['skills']) : '';
    $preferences = isset($_POST['preferences']) ? implode(", ", $_POST['preferences']) : '';

    $sql = "INSERT INTO user_info (full_name, email, bio, gender, skills, country, preferences, password)
            VALUES ('$full_name', '$email', '$bio', '$gender', '$skills', '$country', '$preferences', '$password')";

    if (mysqli_query($conn, $sql)) {
        echo "<p style='color: green;'>✔️ Data inserted successfully!</p>";
    } else {
        echo "<p style='color: red;'>❌ Error: " . mysqli_error($conn) . "</p>";
    }

    mysqli_close($conn);
}
?>

<form action="index.php" method="POST">
    <label>Full Name:</label>
    <input type="text" name="full_name" required>

    <label>Email:</label>
    <input type="text" name="email" required>

    <label>Bio:</label>
    <textarea name="bio" placeholder="Write something about yourself..."></textarea>

    <label>Gender:</label>
    <input type="radio" name="gender" value="Male" required> Male 
    <input type="radio" name="gender" value="Female"> Female
    <input type="radio" name="gender" value="Other"> Other

    <label>Skills (Multiple Checkboxes):</label>
    <input type="checkbox" name="skills[]" value="HTML"> HTML
    <input type="checkbox" name="skills[]" value="CSS"> CSS
    <input type="checkbox" name="skills[]" value="JavaScript"> JavaScript
    <input type="checkbox" name="skills[]" value="PHP"> PHP

    <label>Country (List Box):</label>
    <select name="country" required>
        <option value="">--Select Country--</option>
        <option value="Bangladesh">Bangladesh</option>
        <option value="India">India</option>
        <option value="USA">USA</option>
        <option value="UK">UK</option>
    </select>

    <label>Preferences (Select Multiple):</label>
    <select name="preferences[]" multiple size="4">
        <option value="Newsletter">Newsletter</option>
        <option value="SMS Alerts">SMS Alerts</option>
        <option value="Product Updates">Product Updates</option>
        <option value="Event Invites">Event Invites</option>
    </select>

    <label>Password:</label>
    <input type="password" name="password" required>

    <input type="submit" value="Submit">
    <input type="reset" value="Reset">
</form>
<div style="text-align:center;">
<button><a href='show.php'>view info </a></button>
</div>
</body>
</html>
