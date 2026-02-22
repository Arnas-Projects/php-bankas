<?php

# Shows list of accounts

require 'functions/storage.php';
require 'templates/header.php';
require 'functions/auth.php';

requireLogin();

$accounts = getAccounts();

// echo '<pre>';
// print_r($accounts);
// echo '</pre>';

usort($accounts, function ($a, $b) {
    return strcmp($a['last_name'], $b['last_name']);
});

?>

<h1>Sąskaitų sąrašas</h1>


<!-- <a href="create.php">Create New Account</a> -->

<table border="1" cellpadding="10">
    <tr>
        <th>Vardas</th>
        <th>Pavardė</th>
        <th>Asmens kodas</th>
        <th>IBAN</th>
        <th>Likutis</th>
        <th>Įnešti pinigus</th>
        <th>Išimti pinigus</th>
        <th>Ištrinti sąskaitą</th>
    </tr>

    <?php if (empty($accounts)): ?>
        <tr>
            <td colspan="8" style="text-align: center; font-size: 22px; color: #c5c5c5; padding: 20px 0;">
                <i>Sąskaitų nerasta</i>
            </td>
        </tr>
    <?php else: ?>

        <?php foreach ($accounts as $account): ?>
            <tr>
                <td><?= $account['first_name'] ?></td>
                <td><?= $account['last_name'] ?></td>
                <td><?= $account['personal_code'] ?></td>
                <td><?= $account['iban'] ?></td>
                <td><?= number_format($account['balance'], 2, ' . ', ' ') ?></td>
                <td><a class="add-money" href="add.php?id=<?= $account['id'] ?>">Pridėti</a></td>
                <td>
                    <a class="withdraw-money" href="withdraw.php?id=<?= $account['id'] ?>">Nuskaičiuoti</a>
                </td>
                <td>
                    <form method="POST" action="delete.php">
                        <input type="hidden" name="id" value="<?= $account['id'] ?>">
                        <button class="destroy-btn" type="submit">Ištrinti</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php endif; ?>

</table>


<?php require 'templates/footer.php';
