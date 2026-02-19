<?php

# Shows list of accounts

require 'functions/storage.php';
require 'templates/header.php';

$accounts = getAccounts();

// echo '<pre>';
// print_r($accounts);
// echo '</pre>';

usort($accounts, function($a, $b) {
    return strcmp($a['last_name'], $b['last_name']);
});

?>

<h1>Accounts</h1>


<a href="create.php">Create New Account</a>

<table border="1" cellpadding="10">
    <tr>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Personal Code</th>
        <th>IBAN</th>
        <th>Balance</th>
        <th>Add</th>
        <th>Delete</th>
    </tr>

    <?php foreach($accounts as $account): ?>
        <tr>
            <td><?= $account['first_name'] ?></td>
            <td><?= $account['last_name'] ?></td>
            <td><?= $account['personal_code'] ?></td>
            <td><?= $account['iban'] ?></td>
            <td><?= $account['balance'] ?></td>
            <td><a href="add.php?id=<?= $account['id'] ?>">Add Money</a></td>
            <td>
                <form method="POST" action="delete.php">
                    <input type="hidden" name="id" value="<?= $account['id'] ?>">
                    <button type="submit">Delete</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>

</table>


<?php require 'templates/footer.php';