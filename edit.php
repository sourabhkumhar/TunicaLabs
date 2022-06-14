<?php include('connect.php'); ?>

<?php
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $getID = $_GET['id'];

    $sqlCol = "SHOW COLUMNS FROM `students`";
    $resultCol = mysqli_query($conn, $sqlCol);

    while($result = mysqli_fetch_array($resultCol)) {
        $fields[] = $result['0'];
    }

    $sql = "UPDATE `students` SET ";

    foreach($fields as $key => $value) {
        if($key == 0) {
            continue;
        }

        $data[$key] = $_POST[$value];
        $sql = $sql . "`$value` = '" . $data[$key] . "', ";  
    }

    $sql = substr($sql, 0, -2) . " WHERE `ID` = '$getID'";

    $result = mysqli_query($conn, $sql);

    if (!$result) {
        echo "<script>alert('May be ID already exist!');
                /*history.go(-1);*/</script>";
    }
    else {
        header("location: students.php?ID=&Name=&DoB=&School=&Class=&Division=&alert=success");
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
            
        <?php
        if(isset($_GET['id'])) {
            $fetchSql = "SELECT * FROM `students` WHERE `ID` = '" . $_GET['id'] . "'";
            $fetchResult = mysqli_query($conn, $fetchSql);

            $row = mysqli_fetch_array($fetchResult);
        }
        ?>


            <div class="my-3">
                <input type="number" name="ID" placeholder="Enter ID" class="form-control" <?php echo 'value=' . $_GET['id'] ?> disabled required>
            </div>
            
            <div class="my-3">
                <input type="text" name="Name" placeholder="Full Name" class="form-control" <?php echo 'value="' . $row[1] . '"' ?>  required>
            </div>

            <div class="my-3">
                <input type="date" name="DoB" class="form-control" <?php echo 'value="' . $row[2] . '"' ?> required>
            </div>

            <div class="">
                <input type="text" name="School" class="form-control" placeholder="School Name" <?php echo 'value="' . $row[3] . '"' ?> required>
            </div>

            <div class="my-3">
                <select class="form-select" name="Class" required>
                    <option <?php echo 'value=' . $row[4] ?>>Select Class (<?php echo $row[4] ?>)</option>
                    <?php
                    for ($i = 1; $i <= 10; $i++) {
                        echo '<option value="' . $i . '">' . $i . '</option>';
                    }
                    ?>
                </select>
            </div>

            <div class="my-3">
                <select class="form-select" name="Division" required>
                    <option <?php echo 'value=' . $row[5] ?>>Select Division (<?php echo $row[5] ?>)</option>
                    <?php
                    for ($i = 'A'; $i <= 'D'; $i++) {
                        echo '<option value="' . $i . '">' . $i . '</option>';
                    }
                    ?>
                </select>
            </div>

            <div class="my-3">
                <span>Status: (Current: <?php echo $row[6] ?>)</span>
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