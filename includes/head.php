<?php
$GET['url'] = basename($_SERVER['PHP_SELF']);
$title = "";

if($GET['url'] == "dashboard.php"){
    $title = "Dashboard";
}
if($GET['url'] == "stores.php"){
    $title = "Stores";
}
if($GET['url'] == "grades.php"){
    $title = "Students Grades";
}
if($GET['url'] == "subjects.php"){
    $title = "Subjects";
}
if($GET['url'] == "rooms.php"){
    $title = "Rooms";
}
if($GET['url'] == "sections.php"){
    $title = "Sections";
}
if($GET['url'] == "users.php"){
    $title = "Users";
}
if($GET['url'] == "courses.php"){
    $title = "Courses";
}
if($GET['url'] == "schedules.php"){
    $title = "Schedules";
}
if($GET['url'] == "classes.php"){
    $title = "Classes";
}
if($GET['url'] == "myclasses.php"){
    $title = "My Classes";
}
if($GET['url'] == "mystudentsgrades.php"){
    $title = "My Student's Grades";
}
if($GET['url'] == "mygrades.php"){
    $title = "My Grades";
}
if($GET['url'] == "quizzes.php"){
    $title = "Quizzes";
}
if($GET['url'] == "assignments.php"){
    $title = "Assignments";
}
if($GET['url'] == "myquizzes.php"){
    $title = "My Quizzes";
}
if($GET['url'] == "quiz.php"){
    $title = "Quiz";
}
if($GET['url'] == "completedquizzes.php"){
    $title = "Completed Quizzes";
}
if($GET['url'] == "completedassignments.php"){
    $title = "Completed Assignments";
}
if($GET['url'] == "myassignments.php"){
    $title = "My Assignments";
}
if($GET['url'] == "files.php"){
    $title = "Files";
}
if($GET['url'] == "withoutbalance.php"){
    $title = "Without Balance";
}
if($GET['url'] == "withbalance.php"){
    $title = "With Balance";
}
if($GET['url'] == "withoutviolations.php"){
    $title = "Without Violations";
}
if($GET['url'] == "withviolations.php"){
    $title = "With Violations";
}
if($GET['url'] == "withoutguidance.php"){
    $title = "Without Guidance Records";
}
if($GET['url'] == "withguidance.php"){
    $title = "With Guidance Records";
}
if($GET['url'] == "completerequirements.php"){
    $title = "Complete Requirements";
}
if($GET['url'] == "incompleterequirements.php"){
    $title = "Incomplete Requirements";
}
if($GET['url'] == "completeclearance.php"){
    $title = "Complete Clearance";
}
if($GET['url'] == "incompleteclearance.php"){
    $title = "Incomplete Clearance";
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>JETA PH

    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">


    <!-- jquery.vectormap css -->
    <link href="assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />

    <!-- Sweet Alert-->
    <link href="assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />

    <!-- DataTables -->
    <link href="assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />


    <link href="assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">
    <link href="assets/libs/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css" rel="stylesheet">
    <link href="assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet" />

    <!-- Responsive datatable examples -->
    <link href="assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />

    <!-- Bootstrap Css -->
    <link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />





</head>

<body data-layout="detached" data-topbar="colored" data-sidebar-size="small">

    <div class="container-fluid">
        <!-- Begin page -->
        <div id="layout-wrapper">