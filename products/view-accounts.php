<?php
require_once 'database.php';
require_once 'Account.php';

class ViewAccounts {
    protected $db;

    function __construct() {
        $this->db = new Database();
    }

    function getAllAccounts() {
        $sql = "SELECT * FROM account";
        $query = $this->db->connect()->prepare($sql);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
}

// Create an instance of ViewAccounts
$view = new ViewAccounts();
$accounts = $view->getAllAccounts();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Accounts Table</title>
    <style>
        table {
            width: 80%;
            border-collapse: collapse;
            margin: 20px auto;
        }
        table, th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2 style="text-align: center;">Account List</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Username</th>
                <th>Role</th>
                <th>Staff</th>
                <th>Admin</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($accounts as $account): ?>
                <tr>
                    <td><?php echo htmlspecialchars($account['id']); ?></td>
                    <td><?php echo htmlspecialchars($account['first_name']); ?></td>
                    <td><?php echo htmlspecialchars($account['last_name']); ?></td>
                    <td><?php echo htmlspecialchars($account['username']); ?></td>
                    <td><?php echo htmlspecialchars($account['role']); ?></td>
                    <td><?php echo $account['is_staff'] ? 'Yes' : 'No'; ?></td>
                    <td><?php echo $account['is_admin'] ? 'Yes' : 'No'; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
