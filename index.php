<!DOCTYPE html>
<html>
<head>
    <title>Registered Users</title>
    <style>
        /* CSS for styling the table */
        table {
            border-collapse: collapse;
            width: 100%;
        }
        
        th, td {
            text-align: center;
            padding: 8px;
        }
        
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

    <?php
    // Establishing the database connection
    $servername = "localhost";
    $username = "id20906905_data";
    $password = "Sil@1234";
    $database = "id20906905_datab";

    $conn = mysqli_connect($servername, $username, $password, $database);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Pagination configuration
    $limit = 3; // Number of records per page
    $page = isset($_GET['page']) ? $_GET['page'] : 1; // Current page number

    $start = ($page - 1) * $limit; // Starting point for the query

    // Retrieve the users from the database with pagination
    $query = "SELECT * FROM users LIMIT $start, $limit";
    $result = mysqli_query($conn, $query);

    $users = array(); // Array to store the users

    if (mysqli_num_rows($result) > 0) {
        // Fetching the user records and storing them in the array
        while ($row = mysqli_fetch_assoc($result)) {
            $users[] = $row;
        }
    } else {
        echo "No users found";
    }

    // Get the total number of users for pagination
    $totalQuery = "SELECT COUNT(*) as total FROM users";
    $totalResult = mysqli_query($conn, $totalQuery);
    $totalRow = mysqli_fetch_assoc($totalResult);
    $totalUsers = $totalRow['total'];
    $totalPages = ceil($totalUsers / $limit);

    // Closing the database connection
    mysqli_close($conn);
    ?>

    <table border="2"solid black align="center">
        <tr><td colspan="5"><h2>REGISTERED USERS</h2></td></tr>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Mobile</th>
            <th>Password</th>
        </tr>
        <?php
        // Loop through the users and display them in the table
        foreach ($users as $user) {
            echo "<tr>";
            echo "<td>" . $user['ID'] . "</td>";
            echo "<td>" . $user['name'] . "</td>";
            echo "<td>" . $user['email'] . "</td>";
            echo "<td>" . $user['mobile'] . "</td>";
            echo "<td>" . $user['password'] . "</td>";
            echo "</tr>";
        }
        ?>
    </table>

    <?php
    // Display pagination links
    echo "<br>";
    echo "Page: ";
    for ($i = 1; $i <= $totalPages; $i++) {
        echo "<a href='index.php?page=" . $i . "'>" . $i . "</a> ";
    }
    ?>
</body>
</html>
