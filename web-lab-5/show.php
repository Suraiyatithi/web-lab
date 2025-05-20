<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Show User Info</title>
    <style>
        body {
            padding: 40px;
            font-family: Arial, sans-serif;
            background: #f4f4f4;
        }
        h1 {
            text-align: center;
            margin-bottom: 30px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            box-shadow: 0 0 10px #ccc;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #3f87a6;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .no-data {
            text-align: center;
            font-style: italic;
            padding: 20px;
            background: #fff3cd;
            border: 1px solid #ffeeba;
            border-radius: 5px;
            margin: auto;
            max-width: 600px;
        }
    </style>
</head>
<body>

<h1>User Information Table</h1>

<?php
$connection = mysqli_connect("localhost", "root", "", "infoDb");

if (!$connection) {
    die("<p style='color: red;'>Connection failed: " . mysqli_connect_error() . "</p>");
}

$sql = "SELECT * FROM user_info";
$result = mysqli_query($connection, $sql);

if (mysqli_num_rows($result) > 0) {
    echo "<table>";
    echo "<tr>
            <th>ID</th>
            <th>Full Name</th>
            <th>Email</th>
            <th>Bio</th>
            <th>Gender</th>
            <th>Skills</th>
            <th>Country</th>
            <th>Preferences</th>
            <th>Password</th>
          </tr>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
                <td>" . htmlspecialchars($row['id']) . "</td>
                <td>" . htmlspecialchars($row['full_name']) . "</td>
                <td>" . htmlspecialchars($row['email']) . "</td>
                <td>" . htmlspecialchars($row['bio']) . "</td>
                <td>" . htmlspecialchars($row['gender']) . "</td>
                <td>" . htmlspecialchars($row['skills']) . "</td>
                <td>" . htmlspecialchars($row['country']) . "</td>
                <td>" . htmlspecialchars($row['preferences']) . "</td>
                <td>" . htmlspecialchars($row['password']) . "</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "<div class='no-data'>No user data found in the database.</div>";
}

mysqli_close($connection);
?>

</body>
</html>
