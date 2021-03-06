<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    
    <title>WebTruong</title>
    <!-- Meta tag Keywords -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>

<body>
    <?php
    session_start();
	include'models/dbconfig.php';
    // if(isset($_SESSION['expire']))
    // {
    //     $now = time(); 
    //     if ($now > $_SESSION['expire']) {
    //         unset($_SESSION['id']);
    //         unset($_SESSION['name']);
           
    //     }
    // }
    $db = new database;
    $db->connect();
    if(isset($_GET['controller'])){
        $controller= $_GET['controller'];
    }
	if(empty($controller)) $controller= "login";
	$controller_name= $controller."_controller";
	require_once("./controllers/{$controller_name}.php");
	$controllerObj = new $controller_name();
	$controllerObj->run();
    ?>

     <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>

</body>
</html>