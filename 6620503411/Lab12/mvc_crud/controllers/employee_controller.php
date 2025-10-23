<?php
require_once('models/officeModel.php');
class EmployeeController
{
    public function index(){

        $keyword = trim($_GET['x'] ?? '');

        if ($keyword === '') {
        $list = Employee::getAll();
        } else {
        $list = Employee::search($keyword);
        }

        require('views/pages/employee.php');
    }

    public function add(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $employeeName = trim($_POST['name'] ?? '');
            $officeName  = trim($_POST['place'] ?? '');

            if ($employeeName !== '' && $officeName !== '') {
                Employee::add($employeeName, $officeName);

                header("Location: index.php?controller=employee&action=index");
                exit;
            }
        }
        $officeList = Office::getAll();
        require('views/pages/employee_add.php');
    }

    public function edit(){

         $error = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $employeeId = ($_POST['E_id']  );
            $employeeName = ($_POST['employeeName'] );
            $Officeplace = ($_POST['place'] );

            if ($employeeId !== '' && $employeeName !== '' && $companyName !== '') {
                if (Employee::update($employeeId, $employeeName, $companyName)) {
                    header("Location: index.php?controller=employee&action=index");
                    exit;
                }
                $error = "อัปเดตไม่สำเร็จ (ตรวจสอบชื่อบริษัทหรือข้อมูลอีกครั้ง)";
            } else {
                $error = "กรุณากรอกข้อมูลให้ครบ";
            }

            $item = Employee::getById($employeeId);
        } else {
            $id = $_GET['id'] ?? null;
            if (!$id) {
                header("Location: index.php?controller=employee&action=index");
                exit;
            }
            $item = Employee::getById($id);
        }

        $OfficeList = Office::getAll();
        require('views/pages/employee_edit.php');
    }

    public function delete(){
        if (isset($_GET['delete_id'])) {
            $delete_id = $_GET['delete_id'];
            Employee::delete($delete_id);
            header("Location: index.php?controller=employee&action=index");
            exit;
        }
    }
}
?>