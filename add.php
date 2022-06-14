<?php include('connect.php'); ?>

<?php
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $postID = $_POST['ID'];

    $sqlCol = "SHOW COLUMNS FROM `students`";
    $resultCol = mysqli_query($conn, $sqlCol);

    while($result = mysqli_fetch_array($resultCol)) {
        $fields[] = $result['0'];
    }

    $sql = "INSERT INTO `students` (";
    $column = "";
    foreach($fields as $key => $value) {
        $column = $column . "`$value`" . ", ";
    }
    
    $sql = $sql . substr($column, 0, -2) . ") VALUES (";
    
    $row = "";
    foreach($fields as $key => $value) {

        $data[$key] = $_POST[$value];
        $row = $row . "'$data[$key]'" . ", ";
    }
        
    $sql = $sql . substr($row, 0, -2) . ")";

    $result = mysqli_query($conn, $sql);

    if (!$result) {
        echo "<script>alert('May be ID already exist!');
                history.go(-1);</script> ";
    }
    else {
        echo "<script> alert('Your data is Successfully Added!!')</script>";
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login/Signup</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@40,700,1,0" />

    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <?php include("_partials/navbar.php"); ?>
    <?php include("_partials/sidebar.php"); ?>

    <div class="container" align="center">
        <h3>Add Student</h3>


        <form class="needs-validation w-75" novalidate method="post">

            <div class="my-3">
                <input type="number" name="ID" placeholder="Enter ID" class="form-control" required>
            </div>
            
            <div class="my-3">
                <input type="text" name="Name" placeholder="Full Name" class="form-control" required>
            </div>

            <div class="my-3">
                <input type="date" name="DoB" class="form-control" required>
            </div>

            <div class="">
                <input type="text" name="School" class="form-control" placeholder="School Name" required>
            </div>

            <div class="my-3">
                <select class="form-select" name="Class" required>
                    <option>Select Class</option>
                    <?php
                    for ($i = 1; $i <= 10; $i++) {
                        echo '<option value="' . $i . '">' . $i . '</option>';
                    }
                    ?>
                </select>
            </div>

            <div class="my-3">
                <select class="form-select" name="Division" required>
                    <option unselected>Select Division</option>
                    <?php
                    for ($i = 'A'; $i <= 'D'; $i++) {
                        echo '<option value="' . $i . '">' . $i . '</option>';
                    }
                    ?>
                </select>
            </div>

            <div class="my-3">
                <span>Status:</span>
                <br>
                <input class="form-check-input" type="radio" name="Status" value="Active" required> Active
                <br>
                <input class="form-check-input" type="radio" name="Status" value="Inactive" required> Inactive
            </div>
            
            <div class="my-3 row">
                <button class="btn btn-success col mx-2 p-2" type="submit">Save</button>
                <button class="btn btn-secondary col mx-2 p-2" type="reset">Reset</button>
            </div>
            
        </form>
        
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>

    <script src="js/index.js"></script>
</body>

</html>