<?php
session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"]!== true) {
    header("location: login.php");
    exit;
}

require_once "conn.php";
require_once 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$search = isset($_GET['search'])? $_GET['search'] : '';

$sql = "SELECT * FROM students WHERE name LIKE '$search%'";
$result = $db->query($sql);

if (isset($_GET['export'])) {
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    $sheet->setCellValue('A1', 'ID');
    $sheet->setCellValue('B1', 'Name');
    $sheet->setCellValue('C1', 'Email');
    $sheet->setCellValue('D1', 'Phone');
    $sheet->setCellValue('E1', 'Address');

    $rowNumber = 2;
    while ($row = $result->fetch_assoc()) {
        $sheet->setCellValue('A'. $rowNumber, $row['id']);
        $sheet->setCellValue('B'. $rowNumber, $row['name']);
        $sheet->setCellValue('C'. $rowNumber, $row['email']);
        $sheet->setCellValue('D'. $rowNumber, $row['phone']);
        $sheet->setCellValue('E'. $rowNumber, $row['address']);
        $rowNumber++;
    }

    $writer = new Xlsx($spreadsheet);
    $writer->save('student_list.xlsx');

    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename="student_list.xlsx"');
    header('Content-Length: '. filesize('student_list.xlsx'));
    readfile('student_list.xlsx');
    exit;
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Student List</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1>Student List</h1>
        <a href="create.php" class="btn btn-primary">Add New Student</a>
        <a href="logout.php" class="btn btn-danger float-right md-3">Logout</a>

        <form method="GET" action="index.php">
            <div class="input-group mb-3">
                <input type="text" class="form-control" name="search" placeholder="Search by name" value="<?php echo isset($_GET['search'])? $_GET['search'] : '';?>">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="submit">Search</button>
                    <a href="index.php?export=1" class="btn btn-success ml-2">Export to Excel</a>
                </div>
            </div>
        </form>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) {?>
                    <tr>
                        <td><?php echo $row['id'];?></td>
                        <td><?php echo $row['name'];?></td>
                        <td><?php echo $row['email'];?></td>
                        <td><?php echo $row['phone'];?></td>
                        <td><?php echo $row['address'];?></td>
                        <td>
                            <a href="edit.php?id=<?php echo $row['id'];?>" class="btn btn-warning">Edit</a>
                            <a href="delete.php?id=<?php echo $row['id'];?>" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                        </td>
                    </tr>
                <?php }?>
            </tbody>
        </table>
    </div>
</body>
</html>
