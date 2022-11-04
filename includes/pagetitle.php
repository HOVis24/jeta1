<?php
$GET['url'] = basename($_SERVER['PHP_SELF']);
$title = "";

if($GET['url'] == "dashboard.php"){
$title = "Dashboard";
}
if($GET['url'] == "stores.php"){
$title = "Stores";
}
if($GET['url'] == "stores_registrations.php"){
$title = "Stores Registrations";
}
if($GET['url'] == "customers.php"){
$title = "Customers";
}
if($GET['url'] == "ordersmanagement.php"){
$title = "Orders Management";
}
if($GET['url'] == "products.php"){
$title = "Products";
}
if($GET['url'] == "payments.php"){
$title = "Payments";
}
if($GET['url'] == "users.php"){
$title = "Users";
}
if($GET['url'] == "chats.php"){
$title = "Chats";
}
if($GET['url'] == "schedules.php"){
$title = "Schedules";
}
if($GET['url'] == "financial.php"){
    $title = "Financial Report";
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
if($GET['url'] == "myassignments.php"){
    $title = "My Assignments";
}
if($GET['url'] == "completedquizzes.php"){
    $title = "Completed Quizzes";
}
if($GET['url'] == "completedassignments.php"){
    $title = "Completed Assignments";
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
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="page-title mb-0 font-size-18"><?php echo $title; ?></h4>
        </div>
    </div>
</div>
                    <!-- end page title -->