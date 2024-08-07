<?php
// session_start();
if (empty($_SESSION['username_thecoffe'])) {
    header('location:login');
}

include "controller/connect.php";
$query = mysqli_query($con, "SELECT * FROM tb_user WHERE username='$_SESSION[username_thecoffe]'");
$hasil = mysqli_fetch_array($query);
?>

<!doctype html>
<html lang="en" data-bs-theme="light">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?php echo (ucfirst($_GET['page'])); ?> | TheCoffe
    </title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="src/css/style.css">

    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.css" />
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
</head>

<body>
    <!-- Header -->
    <?php include 'components/header.php'; ?>

    <div class="container-lg">
        <div class="row">
            <!-- Sidebar -->
            <?php include 'components/sidebar.php'; ?>

            <!-- Content -->
            <?php
            include $page;
            ?>
        </div>
        <!-- Footer -->
        <?php include 'components/footer.php'; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });
    </script>
</body>

</html>