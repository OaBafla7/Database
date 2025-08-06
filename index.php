<?php
$conn = new mysqli('localhost', 'root', '', 'smart_methods');
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['name'])) {
    $name = $conn->real_escape_string($_POST['name']);
    $age = (int)$_POST['age'];
    $conn->query("INSERT INTO users (name, age) VALUES ('$name', $age)");
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>User Management System</title>
    <style>
        body { font-family: Arial; margin: 20px; }
        .form-line { display: flex; gap: 10px; margin-bottom: 15px; align-items: center; }
        table { border-collapse: collapse; width: 100%; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: center; }
        th { background-color: #f2f2f2; }
        .status-0 { color: red; }
        .status-1 { color: green; }
    </style>
</head>
<body>
    <h1>User Management System</h1>
    
    <form method="POST">
        <div class="form-line">
            <label>Name:</label>
            <input type="text" name="name" required>
            <label>Age:</label>
            <input type="number" name="age" required>
            <button type="submit">Submit</button>
        </div>
    </form>

    <h2>Records</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Age</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $result = $conn->query("SELECT * FROM users");
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['name']}</td>
                    <td>{$row['age']}</td>
                    <td class='status-{$row['status']}'>{$row['status']}</td>
                    <td>
                        <form method='POST' action='toggle.php'>
                            <input type='hidden' name='id' value='{$row['id']}'>
                            <button type='submit'>Toggle</button>
                        </form>
                    </td>
                </tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>