<h2>Edit Employee</h2>

<form method="post" action="index.php?controller=employee&action=edit">
  <input type="hidden" name="if" value="<?= $item->employeeId ?? '' ?>">

  <label>Employee Name:</label>
  <input type="text" name="employeeName"
       value="<?= $item->employeeName ?>"><br>

  <label>Office:</label>
  <select name="officeplace" required>
      <option value="">-- เลือกสำนักงาน --</option>
      <?php foreach ($officeList as $o): ?>
          <option value="<?= $o->officeplace ?>"
              <?= ($item->officeName === $o->officeplace ? 'selected' : '') ?>>
            <?= $o->officeplace ?>
          </option>
      <?php endforeach; ?>
  </select><br>

  <button type="submit">Update</button>
</form>
