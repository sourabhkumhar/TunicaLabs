<?php include('connect.php');

if ($_SERVER['REQUEST_URI'] == "/tunicalabs/students.php") {
    header("location: students.php?ID=&Name=&DoB=&School=&Class=&Division=");
}

?>

<?php
if (isset($_GET['del'])) {
    $sqlDel = "DELETE FROM `students` WHERE `ID` = '" . $_GET['del'] . "'";
    $resultDel = mysqli_query($conn, $sqlDel);

    if (!$resultDel) {
        echo "<script>alert('ID doesn't exist!');
                history.go(-1);</script> ";
    } else {
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

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@40,700,1,0" />

    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <?php include("_partials/navbar.php"); ?>
    <?php include("_partials/sidebar.php"); ?>

    <?php
    if ($_GET['alert']) {
        $alert = $_GET['alert'];
        echo '<div class="alert alert-' . $alert . ' alert-dismissible fade show container" role="alert">
            <strong>Holy guacamole!</strong> You should check in on some of those fields below.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }
    ?>

    <div class="container-fluid my-3">
        <hr>
        <form action="" method="get">

            <div class="d-flex justify-content-around">

                <div class="col px-2">
                    <input type="text" class="form-control" placeholder="ID" name="ID" aria-label="ID">
                </div>
                <div class="col px-2">
                    <input type="text" class="form-control" placeholder="Name" name="Name" aria-label="Name">
                </div>
                <div class="col px-2">
                    <input type="date" class="form-control" placeholder="Age" name="DoB" aria-label="Age">
                </div>
                <div class="col px-2">
                    <input type="text" class="form-control" placeholder="School" name="School" aria-label="School">
                </div>
                <div class="col px-2">
                    <select class="form-select" name="Class">
                        <option value="">Class</option>
                        <?php
                        for ($i = 1; $i <= 10; $i++) {
                            echo '<option value="' . $i . '">' . $i . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="col px-2">
                    <select class="form-select" name="Division">
                        <option value="">Division</option>
                        <?php
                        for ($i = 'A'; $i <= 'D'; $i++) {
                            echo '<option value="' . $i . '">' . $i . '</option>';
                        }
                        ?>
                    </select>
                </div>

                <button type="submit" class="btn btn-success col">Search</button>

            </div>

        </form>

        <hr>

        <table class="table dataTable table-responsive my-4">
            <thead class="table-dark" align="center">
                <?php
                echo '<tr>';
                $sqlHead = "SHOW COLUMNS FROM `students`";
                $resultHead = mysqli_query($conn, $sqlHead);

                while ($record = mysqli_fetch_array($resultHead)) {
                    $fields[] = $record['0'];
                }
                foreach ($fields as $value) {

                    echo "<th>" . $value . "</th>";
                }
                echo '<th scope="col">Edit</th>
                            <th scope="col">Delete</th>
                        </tr>';
                ?>
            </thead>
            <tbody align="center">
                <tr>

                    <?php
                    $filter = "";
                    $where = "";
                    if ($_SERVER['REQUEST_METHOD'] == "GET") {
                        $where = "";

                        foreach ($fields as $key => $value) {
                            if ($key == 6) {
                                continue;
                            }

                            $data[$key] = $_GET[$value];

                            if ($data[$key] == "") {
                                continue;
                            }

                            if ($data[0] || $data[1] || $data[2] || $data[3] || $data[4] || $data[5]) {
                                $where = "WHERE ";
                            }

                            $filter .= " " . $value . " = '" . $data[$key] . "' OR ";
                        }
                    } else {
                        $filter = "";
                        $where = "";
                    }

                    $sqlData = "SELECT * FROM `students` " . $where . substr($filter, 0, -4);

                    $resultData = mysqli_query($conn, $sqlData);

                    $numCol = mysqli_num_fields($resultData);
                    $numRow = mysqli_num_rows($resultData);

                    if ($numRow == 0) {
                        echo "<td colspan='9'>Data Not Found</td></tr>";
                    } else {
                        while ($row = mysqli_fetch_array($resultData)) {

                            for ($i = 0; $i < $numCol; $i++) {
                                echo "<td>" . $row[$i] . "</td>";
                            }

                            echo "  
                            <td align='center'><a href='edit.php?id=" . $row[0] . "'><span class='material-symbols-outlined text-black'>edit</span></i></a></td>
                            
                            <td align='center'><a onclick='confirm(`Are You Sure to Delete Student: " . $row[1] . "!`)' href='students.php?del=" . $row[0] . "'><span class='material-symbols-outlined text-black'>delete</span></i></td>
                            </tr>";
                        }
                    }
                    ?>

            </tbody>
        </table>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2"
        crossorigin="anonymous"></script>
</body>

</html>