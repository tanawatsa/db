<h2>Add Employee</h2>

<form method="post" action="index.php?controller=employee&action=add">
    <label>Name:</label>
    <input type="text" name = "name" required><br>

    <label>Office:</label>
    <select name = "place" required>
        <option value="">-- Select Office --</option>
        <?php foreach ($officeList as $o): ?>
            <option value="<?= $o->place ?>">
            <?= $o->place ?>
            </option>
        <?php endforeach; ?>
    </select>

    <button type="submit">confirm</button>
</form>
