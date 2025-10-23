<h2>Employee List</h2>
<p>
    <a href="index.php?controller=employee&action=add">
        <button type="button"> Add Employee</button>
    </a>
</p>
<form method="get" action="index.php">
  <input type="hidden" name="controller" value="employee">
  <input type="hidden" name="action" value="index">
  <input type="text" name="x" placeholder="ค้นหาพนักงาน/บริษัท">
  <button type="submit">ค้นหา</button>
</form>
<br>
<table border="1" cellpadding="6" cellspacing="0">
    <thead>
        <tr>
            <th>ID</th>
            <th>Employee Name</th>
            <th>Office ID</th>
            <th>Office Name</th> 
            <th>Edit</th> 
            <th>Delete</th> 
        </tr>
    </thead>
    <tbody>
        <?php if (empty($list)): ?>
            <tr>
                <td colspan="4">No employees found.</td>
            </tr>
        <?php else: ?>
            <?php foreach ($list as $row): ?>
                <tr>
                    <td><?= $row->E_id ?></td>
                    <td><?= $row->name ?></td>
                    <td><?= $row->O_id ?></td>
                    <td><?= $row->officeplace ?? '-' ?></td>
                    <td> 
                        <a href="index.php?controller=employee&action=edit&id=<?= $row->E_id ?>">
                            <button type="button">Edit</button>
                        </a>
                    </td>
                    <td>
                            <a href="index.php?controller=employee&action=delete&delete_id=<?= $row->E_id ?>">
                                <button type="button">Delete</button>
                            </a>    
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
</table>
