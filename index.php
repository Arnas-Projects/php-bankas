<?php

$pageTitle = 'PHP Bankas - Sąskaitų sąrašas';

require 'functions/storage.php';
require 'templates/header.php';
require 'functions/auth.php';
require_once 'functions/helpers.php';

requireLogin();

$accounts = getAccounts();

usort($accounts, function ($a, $b) {
    return strcmp($a['last_name'], $b['last_name']);
});

?>

<div class="home-container">
    <h1>Sąskaitų sąrašas</h1>
    <?php if (isset($_SESSION['user'])): ?>
        <div class="login-user-container">
            <div style="margin-top: 15px; font-size: 18px;">
                Prisijungęs vartotojas: <strong><?= $_SESSION['user'] ?></strong>
            </div>
            <div style="margin-top: 10px; font-size: 18px;">
                Vartotojo tipas: <strong><?= getRoleLabel($_SESSION['role']) ?></strong>
            </div>
        </div>
    <?php endif; ?>
</div>



<table border="1" cellpadding="10">
    <tr>
        <th>Vardas</th>
        <th>Pavardė</th>
        <th>Asmens kodas</th>
        <th>IBAN</th>
        <th>Likutis, EUR</th>
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
                    <form method="POST" action="delete.php" class="delete-form">
                        <input type="hidden" name="id" value="<?= $account['id'] ?>">
                        <input type="hidden" name="balance" value="<?= $account['balance'] ?>">
                        <input type="hidden" name="name" value="<?= $account['first_name'] ?> <?= $account['last_name'] ?>">
                        <button class="destroy-btn" type="submit">Delete</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php endif; ?>

</table>


<!-- MODAL -->

<div id="deleteModal" class="modal">
    <div class="modal-content">
        <p id="modalText"></p>

        <form method="POST" action="delete.php">
            <input type="hidden" name="id" id="deleteId">
            <button class="destroy-btn" type="submit">Ištrinti</button>
            <button class="cancel-btn" type="button" onclick="document.getElementById('deleteModal').classList.remove('active')">
                Atšaukti
            </button>
        </form>
    </div>
</div>


<?php require 'templates/footer.php';
