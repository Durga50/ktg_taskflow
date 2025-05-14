<?php
session_start();

if (!isset($_SESSION['username']) && !isset($_SESSION['empUserName'])) {
    header("Location: login.php");
    exit();
}
?>

<?php

$companyName = isset($_GET['company']) ? htmlspecialchars($_GET['company']) : '';
$projectTitle = isset($_GET['title']) ? htmlspecialchars($_GET['title']) : '';
$projectType = isset($_GET['type']) ? htmlspecialchars($_GET['type']) : '';
$totalDays = isset($_GET['totalDays']) ? htmlspecialchars($_GET['totalDays']) : '';
$workingDays = isset($_GET['workingDays']) ? htmlspecialchars($_GET['workingDays']) : '';
$teammates = isset($_GET['teammates']) ? htmlspecialchars($_GET['teammates']) : '';
?>
<?php

include("dbconn.php");

$companyName = isset($_GET['company']) ? htmlspecialchars($_GET['company']) : '';
$projectTitle = isset($_GET['title']) ? htmlspecialchars($_GET['title']) : '';

$descriptions = [];

// Fetch the first description from projectcreation table
$sql1 = "SELECT ID, 'From: Managing Director' AS desctitle, date, description FROM projectcreation WHERE companyName = ? AND projectTitle = ? LIMIT 1";
$stmt1 = $conn->prepare($sql1);
$stmt1->bind_param("ss", $companyName, $projectTitle);
$stmt1->execute();
$result1 = $stmt1->get_result();

if ($row = $result1->fetch_assoc()) {
    $row['highlight'] = true; // Mark the first description to apply styling
    $descriptions[] = $row;
}
$stmt1->close();

// Fetch remaining descriptions from descriptiontable
$sql2 = "SELECT ID, desctitle, date, description FROM descriptiontable WHERE companyName = ? AND projectTitle = ?";
$stmt2 = $conn->prepare($sql2);
$stmt2->bind_param("ss", $companyName, $projectTitle);
$stmt2->execute();
$result2 = $stmt2->get_result();

while ($row = $result2->fetch_assoc()) {
    $row['highlight'] = false; // No special styling for others
    $descriptions[] = $row;
}

$stmt2->close();
$conn->close();
?>



<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Task Manager</title>

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
        <link rel="icon" type="image/png" href="img/ktglogo.jpg">
    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.0/css/bootstrap.min.css"> -->
    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <style>
         .custom-container {
        background:rgb(81, 172, 246);
        color: white;
        border-radius: 25px;
        padding: 20px;
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
    }
    .custom-card {
        flex: 1;
        padding: 20px;
        min-width: 100px;
        text-align: center;
        border-right: 2px solid white;
    }
    .custom-card:last-child {
        border-right: none;
    }
    .custom-card b {
        font-size: medium;
    }
    .custom-card div {
        font-size: 14px;
    }
 /* Responsive Design */
 @media (max-width: 1024px) { /* Tablet View */
        .custom-container {
            justify-content: center;
        }
        .custom-card {
            width: 30%;
            border-right: none;
            border-bottom: none;
        }
        .custom-card:nth-child(3n) {
            border-right: none;
        }
        .custom-card:nth-child(4), .custom-card:nth-child(5), .custom-card:nth-child(6) {
            border-bottom: none;
        }
    }
    
    @media (max-width: 768px) { /* Mobile View */
        .custom-card {
            width: 45%;
            border-right: 2px solid none;
            border-bottom: 2px solid none;
        }
        .custom-card:nth-child(2n) {
            border-right: none;
        }
        
        .custom-card b, .custom-card div {
            font-size: medium;
        }
    }

thead{
    color:black;
}
    #dataTable th:nth-child(1), #dataTable td:nth-child(1) { width: 3%; }  /* S.no */
    #dataTable th:nth-child(2), #dataTable td:nth-child(2) { width: 10%; } /* Date */
    #dataTable th:nth-child(3), #dataTable td:nth-child(3) { width: 10%; } /* Company */
    #dataTable th:nth-child(4), #dataTable td:nth-child(4) { width: 18%; } /* Project Title */
    #dataTable th:nth-child(5), #dataTable td:nth-child(5) { width: 10%; }  /* Project Type */
    #dataTable th:nth-child(6), #dataTable td:nth-child(6) { width: 10%; } /* Description */
    #dataTable th:nth-child(7), #dataTable td:nth-child(7) { width: 11%; } /* Total days */
    #dataTable th:nth-child(7), #dataTable td:nth-child(7) { width: 11%; } /* Working days */
    #dataTable th:nth-child(8), #dataTable td:nth-child(8) { width: 15%; } /* Teammates */

        /* Center align action buttons */
        .action-buttons {
            display: flex;
            justify-content: center;
            gap: 10px;
        }

        /* Styling for buttons */
        .btn-action {
            border: none;
            background: transparent;
            font-size: 18px;
            transition: transform 0.2s ease-in-out;
        }

        .btn-action:hover {
            transform: scale(1.2);
        }

        .btn-edit {
            color: #28a745;
        }

        .btn-delete {
            color: #dc3545;
        }

        /* Add Customer Button */
        .add-employee-btn {
            float: right;
            background: #007bff;
            color: white;
            font-size: 16px;
            padding: 8px 16px;
            border: none;
            border-radius: 10px;
            transition: all 0.3s ease-in-out;
        }

        .add-employee-btn i {
            margin-right: 5px;
        }

        .add-employee-btn:hover {
            background: #0056b3;
            transform: scale(1.1);
        }


    .upload-icon {
    transition: transform 0.3s ease-in-out, color 0.3s ease-in-out;
}

.upload-label:hover .upload-icon {
    transform: scale(1.2);
    color: #007bff;
}

.upload-icon.bounce {
    animation: bounce 0.5s ease-in-out;
}

@keyframes bounce {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-5px); }
}

/* Icon Styling */
.photo-icon{
    color: #5796d8;
}
.aadhar-icon{
    color: rgb(212, 212, 69);
}
.pan-icon{
    color:rgb(250, 148, 65);
}
.photo-icon, .aadhar-icon, .pan-icon {
    font-size: 24px;
    transition: transform 0.3s ease-in-out, color 0.3s ease-in-out;
}

/* Hover Animation */
.photo-icon:hover, .aadhar-icon:hover, .pan-icon:hover {
    transform: scale(1.3);
    color: #007bff;
}

/* Bounce Effect on File Icon */
@keyframes bounce {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-5px); }
}

.photo-icon:hover, .aadhar-icon:hover, .pan-icon:hover {
    animation: bounce 0.5s ease-in-out;
}

 /* Reduce table font size */
 #dataTable {
        font-size: 14px; /* Adjust size as needed */
    }
tbody{
    border-color: #f8f9fa;
}
    /* Reduce padding for table cells */
    

    .status-icon {
            font-size: 1.2rem;
            transition: transform 0.3s ease-in-out, opacity 0.3s ease-in-out;
        }
        .ongoing { color: orange; animation: spin 1s linear infinite; }
        .pending { color: red; animation: pulse 1s infinite alternate; }
        .completed { color: green; }
        @keyframes spin { 0% { transform: rotate(0deg); } 100% { transform: rotate(360deg); } }
        @keyframes pulse { 0% { opacity: 0.6; } 100% { opacity: 1; } }
        
        /* Styled Dropdown */
        .status-dropdown {
            font-weight: bold;
            border: none;
            padding: 6px;
            border-radius: 8px;
            cursor: pointer;
            transition: background 0.3s, color 0.3s;
        }
        .status-ongoing { background: orange; color: white; }
        .status-completed { background: green; color: white; }
/* Fix missing left and bottom borders */
.table thead tr:first-child th:first-child {
    border-top-left-radius: 15px;
}
.table thead tr:first-child th:last-child {
    border-top-right-radius: 15px;
}
.table tbody tr:last-child td:first-child {
    border-bottom-left-radius: 15px;
}
.table tbody tr:last-child td:last-child {
    border-bottom-right-radius: 15px;
}
.table-container {
    border-radius: 15px;
    overflow: hidden;
    border: 1px solid #dee2e6; /* Ensures full border visibility */
}


/* Apply border to all cells */
.table th, .table td {
    border: 1px solid #dee2e6;
}
    </style>

<style>
     .sidebar-brand-icon, .sidebar-brand-text {
        font-size: large;
        background: white;
        -webkit-background-clip: text; /* Clip background to text */
        -webkit-text-fill-color: transparent; /* Make text color transparent to show gradient */
        font-weight: bold; /* Optional: Makes text more prominent */
    }
    /* Sidebar background */
    .sidebar {
        background-color: rgb(15,29,64) !important;
        width: 250px; /* Adjust according to sidebar width */
    }

    /* Sidebar link styles */
    .l a.k{
        color: white !important; /* Dark text */
        border-radius: 8px; /* Rounded corners */
        transition: all 0.3s ease-in-out;
        padding: 12px 15px;
        font-size: 16px; /* Increased font size */
        display: flex;
        align-items: center;
        gap: 10px; /* Space between icon and text */
        width: 85%; /* Ensure links don’t take full width */
        margin: 0 auto; /* Center align */
    }

    /* Ensure icons are black */
    .l a.k i {
        color: white !important;
        font-size: 18px; /* Slightly larger icons */
        transition: color 0.3s ease-in-out;
    }


    /* Hover effect (only for non-active items) */
    .l:not(.active)  a.k:hover {
        background-color: rgb(45, 64, 113) !important; /* Light grey */
        color: white !important; /* Dark text */
        border-radius: 8px;
        width: 90%; /* Keep it smaller than the sidebar */
        margin: 0 auto; /* Center align */
    }

    /* Keep icons black on hover for non-active items */
    .l:not(.active) a.k:hover i {
        color: white !important;
    }

    /* Active item style */
    .l.active {
        background-color: rgb(45, 64, 113) !important; /* Light grey */
        color: white !important; /* Dark text */
        border-radius: 8px;
        width: 90%; /* Keep it smaller than the sidebar */
        margin: 0 auto; /* Center align */
        padding:1px;
    }
    .collapse-item.active{
        width: 90%;
        background:white;
        color:white;
        border-radius: 8px;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1); /* Subtle shadow */
        transform: scale(1.02); /* Slight lift effect */
        margin: 0 auto; /* Center align */
    }
    /* Active item text & icon color */
    .l.active a.k{
        color: white !important;
    }

    /* Ensure icons turn white inside active links */
    .l.active a.k i {
        color:white !important;
    }
    footer {
    background: white;
    color: rgb(15,29,64);
    padding: 15px;
    box-shadow: 0px -4px 6px rgba(0, 0, 0, 0.1); /* Negative Y value for top shadow */
}

    .master.active{
        width: 90%;
        background: linear-gradient(to right, #4568dc, #b06ab3);
        color:white;
        border-radius: 8px;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1); /* Subtle shadow */
        transform: scale(1.02); /* Slight lift effect */
        margin: 0 auto; /* Center align */
    }
    .master.active.collapse{
        background:white;
        border-radius: 8px;

    }
    .collapse{
        background:#F8F8F8;
        border-radius: 10px;
        color:white;
    }
    .collapse-item.active{
        width: 90%;
        background: rgb(45, 64, 113);
        color:white;
        border-radius: 8px;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1); /* Subtle shadow */
        transform: scale(1.02); /* Slight lift effect */
        margin: 0 auto; /* Center align */
    }
    .action-buttons button {
      margin: 0 5px;
    }
    /* Optional: Change cursor for clickable rows */
    #dataTable tbody tr {
      cursor: pointer;
    }
    .sidebar-dark .nav-item .nav-link[data-toggle="collapse"]:hover::after {
    color: white;
}
 /* Styling for the modal */
 @media (max-width:600px) {
    h4{
        font-size: small;
    }
}
@media (min-width:600px) {
    h4{
        font-size: medium;
    }
}

.header-counter {
    margin-left: 2px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    background: rgb(0, 148, 255);
    padding: 2px 5px;
    font-size: 13px;
    min-width: 20px;
    min-height: 20px;
    font-weight: 500;
    color: white;
    border-radius: 100px;
}

/* Styling for the card header */
.card-header {
    display: flex;
    align-items: center;
    justify-content: space-between; /* Adjust spacing */
    padding: 12px 16px;
    background-color: #f8f9fc;
}
.page-item.active .page-link {
    background: rgb(0, 148, 255);
}


html, body {
    height: 100%;
    margin: 0;
}

#wrapper {
    display: flex;
    flex-direction: column;
    min-height: 100vh; /* Full viewport height */
}

#content-wrapper {
    flex: 1; /* Pushes the footer down */
    display: flex;
    flex-direction: column;
}

#content {
    flex: 1; /* Ensures content takes up remaining space */
}

.sticky-footer {
    margin-top: auto; /* Pushes footer to the bottom */
}


/* First container (Button Holder) */
.button-container {
    height: 10vh; /* 10% of viewport height */
    overflow-x: auto; /* Horizontal scrolling */
    overflow-y: hidden; /* Hides vertical scroll */
    white-space: nowrap; /* Keeps items in a single row */
    padding: 10px;
    background: #f8f9fa; /* Light background */
    scrollbar-width: thin; /* Makes scrollbar thin for Firefox */
    scrollbar-color: rgba(144, 144, 144, 0.64) transparent; /* Dark blue color */
}

/* Custom Scrollbar for Chrome, Edge, Safari */
.button-container::-webkit-scrollbar {
    height: 4px; /* Thin scrollbar */
}

.button-container::-webkit-scrollbar-track {
    background: transparent; /* No background */
}

.button-container::-webkit-scrollbar-thumb {
    background: rgba(144, 144, 144, 0.64) transparent;
    border-radius: 5px;
}



</style>
<style>
        /* Container for requirement boxes */
        .file-container {
            overflow-x: auto; /* Horizontal scrolling */
            overflow-y: hidden; /* No vertical scroll */
            white-space: nowrap;
            padding-left: 5px;
            padding-right: 5px;
            background: #f8f9fa;
            scrollbar-width: thin;
            scrollbar-color: rgba(144, 144, 144, 0.64) transparent;
        }

        /* Custom scrollbar for Chrome, Edge, Safari */
        .file-container::-webkit-scrollbar {
            height: 2px; /* Thicker scrollbar */
        }
        .file-container::-webkit-scrollbar-track {
            background: #ddd;
            border-radius: 5px;
        }
        .file-container::-webkit-scrollbar-thumb {
            background: rgb(15, 29, 64);
            border-radius: 5px;
        }

        /* Flexbox for boxes */
        .file-wrapper {
    display: flex;
    gap: 10px;
    flex-wrap: wrap; /* Allows wrapping into new rows */
    justify-content: flex-start;
}


        /* Styling for each requirement file box */
        .file-box {
    height: 50px;
    display: flex;
    align-items: center; 
    padding: 15px;
    color: white;
    font-size: 16px;
    border-radius: 10px;
    cursor: pointer;
    box-shadow: 3px 3px 8px rgba(0, 0, 0, 0.2);
    transition: transform 0.2s;
    flex-direction: row; /* Row layout */
    justify-content: space-between; /* Space between text & image */
    text-align: left;
}

.text-container {
    display: flex;
    flex-direction: column; /* Stack text elements */
    align-items: flex-start; /* Align text to the left */
    gap: 5px;
    width: 70%; /* Ensure text takes most of the space */
    margin:40px;
}

.file-img {
    width: 60px; /* Adjust image width */
    height: 60px; /* Adjust image height */
    background-color: rgba(255, 255, 255, 0.2); /* Placeholder for image */
    border-radius: 5px;
}



        .file-box:hover {
            transform: scale(1.05);
        }

        /* Colors for the first four unique boxes */
        .file-box:nth-child(4n+1) { background:rgb(81, 172, 246); } /* Red */
        .file-box:nth-child(4n+2) { background:rgb(28, 64, 155); } /* Green */
        .file-box:nth-child(4n+3) { background:rgb(81, 172, 246); } /* Blue */
        .file-box:nth-child(4n+4) { background:rgb(28, 64, 155); } /* Yellow */

        /* Graphic design image */
        .file-box:nth-child(4n+1) .file-img  {
            width: 180px;
            height: 180px;
            background-size: contain;
            border-radius: 5px;
        }
        .file-box:nth-child(4n+2) .file-img {
            width: 190px;
            height: 190px;
            background-size: contain;
            border-radius: 5px;
        }
        .file-box:nth-child(4n+3) .file-img  {
            width: 180px;
            height: 190px;
            background-size: contain;
            border-radius: 5px;
        }
        .file-box:nth-child(4n+4) .file-img {
            width: 150px;
            height: 150px;
            background-size: contain;
            border-radius: 5px;
        }
/* Delete Button Always Visible */
.delete-btn {
    position: absolute;
    top: 5px;
    left: 5px;
    background: white;
    color: red;
    font-size: 14px;
    padding: 5px;
    border-radius: 50%;
    cursor: pointer;
    display: block; /* Always visible */
}




.delete-btn {
    position: absolute;
    top: 5px;
    left: 5px;
    background: white;
    color: red;
    font-size: 14px;
    padding: 5px;
    border-radius: 50%;
    cursor: pointer;
    display: block; /* Ensures visibility */
}

/* Ensure .file-box has relative positioning */
.file-box {
    position: relative;
}


    .file-link {
        color: white;
        text-decoration: none;
    }
    .file-row {
    display: flex;
    gap: 15px;
    flex-wrap: nowrap;
    width: 100%;
}

    .no-file-message {
    display: flex;
    justify-content: center;  /* Centers horizontally */
    align-items: center;      /* Centers vertically */
    height: 100%;             /* Adjust based on parent container */
    width: 100%;              /* Ensures it takes full width */
    color: white;             
    font-size: 14px;          
    font-weight: bold;
}

/* Modal Responsiveness */
.modal-dialog {
    max-width: 35%;
  }
  @media (max-width: 570px) {

    
    .container-fluid{
    padding-left: 5px;padding-right:5px;
}
.file-row {
    display: flex;
    gap: 5px;
    flex-wrap: nowrap;
    width: 100%;
}
  }
  @media (max-width: 992px) { /* Tablets */
    .modal-dialog {
      max-width: 60%;
    }
  }

  @media (max-width: 768px) { /* Mobile */
    .modal-dialog {
        max-width: 70%;
        display: flex;
        justify-content: center;
        align-items: center;
        margin: auto; /* Ensures it's centered */
    }
    .custom-radio {
        font-size: 12px;
        width:100%;
    }
    .submit-btn {
        font-size: 10px;
        padding: 4px 8px;
        margin-top: 5px;
    }
}
  .modal-content {
    border-radius: 15px;
  }

  .custom-radio {
    font-size: 14px;
    margin-right: 10px;
  }

  .submit-btn {
    background-color: rgb(15,29,64);
    color: white;
    border-radius: 10px;
    font-size: 14px;
    padding: 4px 8px;
  }

  .d-flex.flex-wrap {
    gap: 10px;
  }
 /* Entry Box Styling */
 .entry-box {
    background-color: rgb(81, 172, 246);
    color: white;
    padding: 10px 15px;
    margin: 8px 0;
    border-radius: 10px;
    font-weight: bold;
    box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);
    transition: all 0.3s ease-in-out;
  }

  /* Description Box Styling */
  .desc-content {
    background-color: rgb(255, 255, 255);
    padding: 8px;
    margin-top: 5px;
    border-radius: 5px;
    color: black;
    display: none;
  }

  /* Toggle Button Styling */
  .toggle-btn {
    background: white;
    color: rgb(81, 172, 246);
    border: none;
    padding: 4px 8px;
    font-weight: bold;
    cursor: pointer;
    border-radius: 5px;
  }

  .toggle-btn:hover {
    background: lightgray;
  }
  .toggle-btn1 {
    background: white;
    color: rgb(81, 172, 246);
    border: none;
    padding: 4px 8px;
    font-weight: bold;
    cursor: pointer;
    border-radius: 5px;
  }
  .toggle-btn1:hover {
    background: lightgray;
  }
</style>
</head>
<body id="page-top">
    <div id="wrapper">
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-2 static-top shadow" style=" background:white">


<div class="mr-auto d-flex align-items-center pl-3 py-2">
    <h4 class="text-dark font-weight-bold mr-4" style="color: rgb(15,29,64); margin-top: 5px;">
        Project Specification
    </h4>
</div>


<!-- Topbar Navbar -->
<ul class="navbar-nav ml-auto">
<div class="d-flex justify-content-between align-items-center mb-2">
<input type="file" id="fileInput" accept=".pdf, .jpg, .jpeg, .png, .doc, .docx, .ppt, .pptx, .xlsx, .xls" style="display: none;">

<style>
  .btn-custom {
    background: rgb(81, 172, 246);
    font-size: 13px;
    color: white;
    padding: 8px 10px;
    display: inline-block;
    text-decoration: none;
    border-radius: 5px;
    cursor: pointer;
  }

  /* Hide text and adjust padding for mobile screens */
  @media (max-width: 576px) {
    .btn-custom {
      font-size: 12px; /* Reduce icon size slightly */
      padding: 6px 6px; /* Reduce padding */
      width: 40px; /* Ensure square button */
      text-align: center;
    }

    .btn-custom span {
      display: none; /* Hide the text */
    }
  }
.container-fluid{
    padding-left: 15px;padding-right:15px;
}
  .white-container {
    background-color: white;
    border-radius: 15px;
    padding: 15px;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    overflow: hidden; /* Ensures content stays within rounded corners */
}
.container-heading {
    font-size: 16px;
    font-weight: bold;
    margin-bottom: 10px;
    color: #5a5c69; /* Dark gray for better readability */
}
</style>
<a href="#" id="addFileBtn" class="btn btn-custom" style="color: white;"> 
    <i class="fas fa-folder-plus"></i> <span>&nbsp; Add File</span>
</a>
&nbsp;&nbsp;
<a href="#" class="btn btn-custom" data-toggle="modal" data-target="#descModal" style="color: white;">
    <i class="fas fa-pen"></i> <span>&nbsp; Add Desc</span>
</a>

    </div>
    <div class="topbar-divider d-none d-sm-block"></div>

    <!-- Nav Item - User Information -->
    <li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <img class="img-profile rounded-circle"
                src="img/p.png" style="width: 2rem;height: 2rem;">
        </a>
        <!-- Dropdown - User Information -->
        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
            aria-labelledby="userDropdown">
            
            
            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                Logout
            </a>
        </div>
    </li>

</ul>

</nav>
    <div class="container-fluid" ><br>
    <div class="custom-container">
    <?php if (!empty($companyName) && !empty($projectTitle)) { ?>
        <div class="custom-card"><b>Company Name</b>
            <div style="margin-top: 10px;"><?php echo $companyName; ?></div>
        </div>
        <div class="custom-card"><b>Project Title</b>
            <div style="margin-top: 10px;"><?php echo $projectTitle; ?></div>
        </div>
        <div class="custom-card"><b>Project Type</b>
            <div style="margin-top: 10px;"><?php echo $projectType; ?></div>
        </div>
        <div class="custom-card"><b>Total Days</b>
            <div style="margin-top: 10px;"><?php echo $totalDays; ?></div>
        </div>
        <div class="custom-card"><b>Working Days</b>
            <div style="margin-top: 10px;" id="workingDays"><?php echo $workingDays; ?></div> <!-- Dynamic Value -->
        </div>

        <div class="custom-card"><b>Members Allocated</b>
            <div style="margin-top: 10px;"><?php echo $teammates; ?></div>
        </div>
    <?php } else { ?>
        <p>No project details selected. Click a row in the previous page to view details.</p>
    <?php } ?>
</div><br><br>
    <div class="white-container">
    <h2 class="container-heading">Requirement</h2>
    <div class="file-container" style="padding-bottom: 10px;">
        <div class="file-wrapper" id="fileWrapper">
            <!-- Files will be dynamically added here -->
        </div>
    </div>
</div>
<br>
<!-- Display Descriptions -->
<div class="white-container">
    <h2 class="container-heading">Description</h2>
    <div class="row" id="entriesContainer">
        <?php if (!empty($descriptions)) : ?>
            <?php foreach ($descriptions as $index => $entry) : ?>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="entry-box p-2" data-id="<?php echo $entry['ID']; ?>" 
                         style="<?php echo $entry['highlight'] ? 'background-color: red; color: white;' : ''; ?>">
                        <div class="row align-items-center">
                            <div class="col-6">
                                <span class="entry-title">
                                    <?php echo htmlspecialchars($entry['desctitle']); ?>
                                </span>
                            </div>
                            <div class="col-3 text-end">
                                <span class="entry-date"><?php echo htmlspecialchars($entry['date']); ?></span>
                            </div>
                            <div class="col-3 text-end">
                                <button class="toggle-btn" 
                                        onclick="openEditModal(this)" 
                                        style="<?php echo $entry['highlight'] ? 'display: none;' : ''; ?>">
                                    <i class="fas fa-pen"></i>
                                </button>
                                <button class="toggle-btn1" 
                                        onclick="toggleDesc(this)" 
                                        style="<?php echo $entry['highlight'] ? 'color: red; background-color: white; border: none;' : ''; ?>">+
                                </button>
                            </div>
                        </div>
                        <div class="desc-content mt-2" style="display: none;">
                            <?php echo nl2br(htmlspecialchars($entry['description'])); ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else : ?>
            <p id="noDescription" class="text-center" style="font-size: 14px; font-weight: bold; color: #5a5c69;">
                -- No description found --
            </p>
        <?php endif; ?>
    </div>
</div>


    </div></div>
    <div class="modal fade" id="descModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-body p-4">
      <form id="descForm">
    <input type="hidden" id="companyName" value="<?php echo htmlspecialchars($companyName); ?>">
    <input type="hidden" id="projectTitle" value="<?php echo htmlspecialchars($projectTitle); ?>">

    <div class="form-group d-flex">
        <div class="w-50 pr-2">
            <label for="dateInput"><b>Date:</b></label>
            <input type="date" class="form-control" id="dateInput" required>
        </div>
        <div class="w-50 pl-2">
            <label for="titleInput"><b>Title:</b></label>
            <input type="text" class="form-control" id="titleInput" placeholder="Enter title" required>
        </div>
    </div>

    <div class="form-group">
        <label for="descInput"><b>Description:</b></label>
        <textarea class="form-control" id="descInput" rows="3" placeholder="Enter description" required></textarea>
    </div>

    <div class="text-center">
        <button type="submit" class="btn submit-btn mx-2" style="color: white;">Submit</button>
    </div>
</form>


      </div>
    </div>
  </div>
</div>
<!-- Edit Description Modal -->
<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-hidden="true"> 
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-body p-4">
        <form id="editForm">
          <input type="hidden" id="editId"> <!-- Hidden field to store entry ID -->
          <div class="form-group d-flex">
            <div class="w-50 pr-2">
              <label for="editDateInput"><b>Date:</b></label>
              <input type="date" class="form-control" id="editDateInput" required>
            </div>
            <div class="w-50 pl-2">
              <label for="editTitleInput"><b>Title:</b></label>
              <input type="text" class="form-control" id="editTitleInput" placeholder="Enter title" required>
            </div>
          </div>
          <div class="form-group">
            <label for="editDescInput"><b>Description:</b></label>
            <textarea class="form-control" id="editDescInput" rows="3" placeholder="Enter description" required></textarea>
          </div>
          <div class="text-center">
            <button type="submit" class="btn submit-btn mx-2" style="color: white;">Update</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>  
            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                       <h6> <b>Copyright &copy; Knock the Globe Technologies 2025</b></h6>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.php">Logout</a>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
    <!-- Bootstrap JavaScript -->
    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>
<!-- Bootstrap 4.6.0 JavaScript -->
<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script> -->
<style>
  /* Responsive font size adjustments */
  .entry-title, .entry-date, .desc-content {
    font-size: 14px;
  }

  .toggle-btn {
    font-size: 12px;
  }

  /* Adjust font size for smaller screens */
  @media (max-width: 768px) { /* Tablets */
    .entry-title, .entry-date, .desc-content {
      font-size: 12px;
    }
    .toggle-btn {
      font-size: 10px;
    }
  }

  @media (max-width: 576px) { /* Mobile */
    .entry-title, .desc-content {
      font-size: 12px;
    }
    .entry-date{
        font-size:10px;
    }
    .toggle-btn {
      font-size: 9px;
    }
    .toggle-btn1 {
      font-size: 11px;
    }
  }
  .desc-content {
  color: #6c757d; /* Lighter text color */
  font-size: 14px; /* Optional: Adjust font size */
}
.delete-btn {
    font-size: 6px;  /* Adjust size as needed */
    color: white;  /* Optional: Set color */
    cursor: pointer;

}



</style>
<!-- // <button class="delete-btn" onclick="deleteEntry(${entryId})"><i class="fas fa-trash"></i></button> -->


<script>
    document.addEventListener("DOMContentLoaded", () => {
    const fileWrapper = document.getElementById("fileWrapper");
    const fileInput = document.getElementById("fileInput");
    const addFileBtn = document.getElementById("addFileBtn");

    addFileBtn.addEventListener("click", () => fileInput.click());

    fileInput.addEventListener("change", (event) => {
        const file = event.target.files[0];
        if (!file) return;

        const urlParams = new URLSearchParams(window.location.search);
        const companyName = urlParams.get("company");
        const projectTitle = urlParams.get("title");

        if (!companyName || !projectTitle) {
            Swal.fire({
                icon: "warning",
                title: "Missing Information",
                text: "Company Name and Project Title are required."
            });
            return;
        }

        let formData = new FormData();
        formData.append("file", file);
        formData.append("companyName", companyName);
        formData.append("projectTitle", projectTitle);

        fetch("upload.php", {
            method: "POST",
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                Swal.fire({
                    icon: "success",
                    title: "Success",
                    text: "File uploaded successfully!"
                }).then(() => location.reload());
            } else {
                Swal.fire({
                    icon: "error",
                    title: "Upload Failed",
                    text: data.error
                });
            }
        })
        .catch(error => console.error("Error:", error));
    });

    fetchRequirementFile();
});

function fetchRequirementFile() {
    const fileWrapper = document.getElementById("fileWrapper");
    const urlParams = new URLSearchParams(window.location.search);
    const companyName = urlParams.get("company");
    const projectTitle = urlParams.get("title");

    if (!companyName || !projectTitle) {
        fileWrapper.innerHTML = "<div class='no-file-message'>-- No Requirement File Uploaded --</div>";
        return;
    }

    fetch(`fetch_requirement.php?company=${encodeURIComponent(companyName)}&title=${encodeURIComponent(projectTitle)}`)
        .then(response => response.json())
        .then(data => {
            fileWrapper.innerHTML = ""; // Clear previous content
            
            if (data.files && data.files.length > 0) {
                data.files.forEach((fileName, index) => {
                    let fileBox = createFileBox(fileName, index === 0 ? false : true, index);
                    fileWrapper.appendChild(fileBox);
                });
            } else {
                fileWrapper.innerHTML = "<div class='no-file-message'>-- No Requirement File Uploaded --</div>";
            }
        })
        .catch(error => console.error("Error fetching requirement files:", error));
}

function createFileBox(fileName, isDeletable = true, index = null) {
    let fileBox = document.createElement("div");
    fileBox.classList.add("file-box");

    let textContainer = document.createElement("div");
    textContainer.classList.add("text-container");

    let requirementText = document.createElement("b");

    if (index === 0) {
        fileBox.style.backgroundColor = "red";
        fileBox.style.color = "white"; 
        requirementText.textContent = "Main Project File"; // Label the first file differently
    } else {
        requirementText.textContent = `Requirement ${index}`; 
    }

    let fileNameText = document.createElement("div");
    fileNameText.classList.add("file-name");
    let displayFileName = fileName.replace(/^reqfiles\//, "");
    fileNameText.textContent = displayFileName;
    fileNameText.style.fontSize = "14px";
    fileNameText.style.marginTop = "5px";

    textContainer.appendChild(requirementText);
    textContainer.appendChild(fileNameText);
    fileBox.appendChild(textContainer);

    if (isDeletable && index !== 0) {
        let deleteBtn = document.createElement("div");
        deleteBtn.classList.add("delete-btn");
        deleteBtn.textContent = "✖";
        deleteBtn.onclick = (event) => {
            event.stopPropagation();
            deleteFile(index);
        };
        fileBox.appendChild(deleteBtn);
    }

    fileBox.onclick = () => window.open(fileName, "_blank");

    return fileBox;
}


function deleteFile(fileIndex) {
    const urlParams = new URLSearchParams(window.location.search);
    const companyName = urlParams.get("company");
    const projectTitle = urlParams.get("title");

    fetch(`fetch_requirement.php?company=${encodeURIComponent(companyName)}&title=${encodeURIComponent(projectTitle)}`)
    .then(response => response.json())
    .then(data => {
        if (!data.files || data.files.length <= fileIndex) {
            console.error("Error: Invalid file index");
            return;
        }

        const fileName = data.files[fileIndex]; // Correct file name from DB

        Swal.fire({
            icon: "warning",
            title: "Are you sure?",
            text: `You are about to delete ${fileName}. This action cannot be undone.`,
            showCancelButton: true,
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "Cancel"
        }).then((result) => {
            if (result.isConfirmed) {
                fetch(`delete.php?file=${encodeURIComponent(fileName)}&company=${encodeURIComponent(companyName)}&title=${encodeURIComponent(projectTitle)}`, {
                    method: "GET"
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            icon: "success",
                            title: "Deleted!",
                            text: "File deleted successfully."
                        }).then(() => fetchRequirementFile());
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "Deletion Failed",
                            text: data.error
                        });
                    }
                })
                .catch(error => console.error("Error:", error));
            }
        });
    });
}

</script>

<script>
$(document).ready(function () {
    $("#descForm").submit(function (event) {
        event.preventDefault();

        let companyName = $("#companyName").val();
        let projectTitle = $("#projectTitle").val();
        let date = $("#dateInput").val();
        let title = $("#titleInput").val();
        let description = $("#descInput").val();

        console.log("Sending Data:", { companyName, projectTitle, date, title, description });

        $.ajax({
            url: "add_description.php",
            type: "POST",
            data: {
                companyName: companyName,
                projectTitle: projectTitle,
                date: date,
                title: title,
                description: description
            },
            dataType: "json",
            success: function (response) {
                console.log("Response:", response);
                if (response.success) {
                    Swal.fire({
                        icon: "success",
                        title: "Success",
                        text: response.message
                    }).then(() => {
                        $("#descModal").modal("hide");
                        location.reload();
                    });
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Error",
                        text: response.message
                    });
                }
            },
            error: function (xhr, status, error) {
                console.error("AJAX Error:", status, error);
                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: "Error submitting the form."
                });
            }
        });
    });
});
</script>

<script>
// Toggle Description Visibility
function toggleDesc(btn) {
  let descBox = btn.closest(".entry-box").querySelector(".desc-content");
  descBox.style.display = (descBox.style.display === "none") ? "block" : "none";
}

function openEditModal(btn) {
    let entryBox = btn.closest(".entry-box");
    let id = entryBox.dataset.id;
    let title = entryBox.querySelector(".entry-title").innerText.trim();
    let date = entryBox.querySelector(".entry-date").innerText.trim();
    let desc = entryBox.querySelector(".desc-content").innerText.trim();

    $("#editModal").data("id", id);
    $("#editTitleInput").val(title);
    $("#editDateInput").val(date);
    $("#editDescInput").val(desc);
    
    $('#editModal').modal('show');
}

$(document).ready(function () {
    $("#editForm").submit(function (event) {
        event.preventDefault();

        let id = $("#editModal").data("id");  
        let date = $("#editDateInput").val().trim();
        let title = $("#editTitleInput").val().trim();
        let description = $("#editDescInput").val().trim(); 

        console.log("Updating Data:", { id, date, title, description });

        $.ajax({
            url: "update_description.php",
            type: "POST",
            data: { id: id, date: date, title: title, description: description },
            dataType: "json",
            success: function (response) {
                console.log("Response:", response);
                if (response.success) {
                    Swal.fire({
                        icon: "success",
                        title: "Success",
                        text: response.message
                    }).then(() => {
                        $("#editModal").modal("hide");
                        location.reload();
                    });
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Error",
                        text: "Update failed: " + response.message
                    });
                }
            },
            error: function (xhr, status, error) {
                console.error("AJAX Error:", status, error);
                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: "Error updating the data."
                });
            }
        });
    });
});
</script>
</body>

</html>