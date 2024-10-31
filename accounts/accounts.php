<?php
    session_start();

    if(isset($_SESSION['account'])){
        if(!$_SESSION['account']['is_staff']){
            header('location: login.php');
        }
    }else{
        header('location: login.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accounts</title>
    <style>
        /* Styling for the search results */
        p.search {
            text-align: center;
            margin: 20px 0;
        }
    </style>
</head>
<body>

    <?php
        require_once 'account.class.php'; 

        $accountObj = new Account();

        $accounts = $accountObj->getAllAccounts(); 
    ?>

    <table border="1">
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Email</th>
            <th>Role</th>
            <th>Action</th>
        </tr>
        
        <?php
        if (empty($accounts)) {
        ?>
            <tr>
                <td colspan="5"><p class="search">No accounts found.</p></td>
            </tr>
        <?php
        }
        foreach ($accounts as $account) {
        ?>
        <tr>
            <td><?= $account['id'] ?></td>
            <td><?= $account['username'] ?></td>
            <td><?= $account['email'] ?></td>
            <td><?= $account['role'] ?></td>
            <td>
                <a href="editaccount.php?id=<?= $account['id'] ?>">Edit</a>
                <?php
                    if ($_SESSION['account']['is_admin']){
                ?>
                <a href="#" class="deleteBtn" data-id="<?= $account['id'] ?>" data-name="<?= $account['username'] ?>">Delete</a>
                <?php
                    }
                ?>
            </td>
        </tr>
        <?php
        }
        ?>
    </table>
    
    <script src="./account.js"></script>
</body>
</html>