<?php
session_start();

if (!isset($_SESSION['username']) && !isset($_SESSION['empUserName'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" href="img/ktglogo.jpg">

    <title>Task Manager</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
        <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <style>
        /* Gradient background for thead */
        thead  {
            background: linear-gradient(to right, #4568dc, #b06ab3);
            color: white;
        }

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
        .add-customer-btn {
            float: right;
            background: #007bff;
            color: white;
            font-size: 16px;
          
            border: none;
            border-radius: 10px;
            transition: all 0.3s ease-in-out;
        }

        .add-customer-btn i {
            margin-right: 5px;
        }

        .add-customer-btn:hover {
            background: #0056b3;
            transform: scale(1.1);
        }
    .table {
    border-radius: 15px;
    overflow: hidden; /* Ensures inner elements don't break the radius */
    border-collapse: separate; /* Required for border-radius to work properly */
    border-spacing: 0; /* Removes unwanted gaps */
}

/* Rounds top corners */
.table thead tr:first-child th:first-child {
    border-top-left-radius: 15px;
}
.table thead tr:first-child th:last-child {
    border-top-right-radius: 15px;
}

/* Rounds bottom corners */
.table tbody tr:last-child td:first-child {
    border-bottom-left-radius: 15px;
}
.table tbody tr:last-child td:last-child {
    border-bottom-right-radius: 15px;
}


#taskInput {
    width: 60%;
}

#taskButton {
    width: 30%;
    margin-left: 130px;
}
.acontainer{
    margin-left: 25px;
    margin-right: 25px;
    margin-top: 10px;
    margin-bottom: 10px;
}
/* Tablets and Medium screens */
@media (max-width: 992px) {
    #taskInput {
        width: 80%;
    }

    #taskButton {
        width: 50%;
        font-size: 14px;
        
    }
}

/* Small screens (Phones) */
@media (max-width: 768px) {
    #taskForm {
        flex-direction: column;
        align-items: stretch;
    }

    #taskInput {
        width: 100%;
        margin-bottom: 10px;
    }

    #taskButton {
        width: 100%;
        margin-left: 0px;
    }
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
        width: 90%; /*
         Keep it smaller than the sidebar */
        margin: 0 auto; /* Center align */
        padding:0px;
        text-align:center;
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
.plus-icon {
    transition: transform 0.3s ease-in-out;
}

.plus-button {
    transition: all 0.3s ease-in-out;
}

.plus-button:hover {
    background-color: rgb(0, 120, 220); /* Darker shade of blue */
    transform: scale(1.1); /* Slightly enlarge the button */
}

.plus-button:hover .plus-icon {
    transform: rotate(135deg); /* Rotate the plus icon */
}
.status-container {
    display: flex;
    flex-wrap: wrap;
    gap: 15px; /* Increases space between cards */
    justify-content: center;
    margin-top: 10px;
}


  .draggable-card {
    min-height: 40px;
    width: 250px;
    color: black;
    background-color: var(--card-color);
    border-radius: 10px;
    position: relative;
    transition: transform 0.2s, background-color 0.3s;
    cursor: pointer;
    padding: 8px;
    text-align: center;
    float:center;
  }

  .draggable-card:hover {
    transform: scale(1.05);
  }

  .card-description {
    font-size: 12px;
    color: #555;
    display: none;
  }

  .draggable-card:hover .card-description {
    display: block;
  }
</style>
    
<style>
  /* Style for Count Box */
.count-box {
    display: inline-block;
    width: 24px;
    height: 24px;
    line-height: 24px;
    background-color: rgb(224, 230, 235);
    color: rgb(140, 147, 159);
    font-size: 12px;
    font-weight: bold;
    text-align: center;
    border-radius: 4px; /* Slightly rounded corners */
    margin-left: 5px;
}

/* Optional: Adjust title styling */
.title {
    font-size: 14px;
    color: black;
}

  /* Container Styling */
  .status-container {
    display: flex;
    flex-wrap: wrap;
    gap: 15px;
    justify-content: center;
    margin-top: 10px;
  }

  /* Card Styling */
  .draggable-card {
    min-height: 40px;
    width: 240px;
    color: black;
    background-color: var(--card-color);
    border-radius: 10px;
    text-align: center;
    padding: 8px;
    transition: transform 0.2s;
    cursor: pointer;
  }

  .draggable-card:hover {
    transform: scale(1.05);
  }

  /* Vertical Divider */
  .vertical-divider {
    position: absolute;
    top: 0;
    right: 0;
    width: 1px;
    height: 100%;
    background-color: #ccc;
  }

  /* Prevent Divider on Last Column */
  .col-md-3:last-child .vertical-divider {
    display: none;
  }

  /* Hide default radio button */
.radio-btn input {
  display: none;
}

/* Custom Radio Button Style */
.custom-radio {
  display: inline-block;
  padding: 8px 15px;
  border-radius: 20px;
  cursor: pointer;
  font-weight: 600;
  transition: all 0.3s ease-in-out;
  background-color: #f1f1f1;
  color: #333;
  border: 2px solid transparent;
}

/* Colors for Different Status */
.ongoing { background-color: #FFD700; }  /* Gold */
.payment { background-color: #28a745; color: white; } /* Green */
.newClient { background-color: #007bff; color: white; } /* Blue */

/* Hover Effect */
.custom-radio:hover {
  filter: brightness(1.1);
  box-shadow: 0px 0px 8px rgba(0, 0, 0, 0.2);
}

/* Active (Selected) State */
.radio-btn input:checked + .custom-radio {
  border: 2px solid #000;
  transform: scale(1.05);
}

</style>


</head>
<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
    <?php include ("sidebar.php"); ?>
    
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow" style=" background:white;">          
                   <!-- Header Section -->
                   <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                   <div class="mr-auto d-flex align-items-center pl-3 py-2">
    <h4 class="text-dark font-weight-bold mr-4" style="color: rgb(15,29,64); font-size: medium; margin-top: 5px;">
        FollowUps
    </h4>
    
    <!-- Button to Open Modal (Responsive) -->
    <!-- <button class="btn add d-flex align-items-center  plus-button mb-2 mb-md-0" 
        data-toggle="modal" data-target="#designationModal" style="color: white;">
        <i class="fa-solid fa-plus fa-1x plus-icon"></i>&nbsp;
        Add
    </button> -->
    &nbsp;&nbsp;&nbsp;
   


<style>
 
.add{
  background-color:rgb(0, 148, 255); 
  color: white; 
  border-radius: 25px; 
  font-size: 50px;
  padding:8px;
}
  #addAccessBtn{
        background: rgb(238, 153, 129); 
        color: white; 
        padding: 8px;
        font-size: 16px; 
        font-weight: 600; 
        border-radius: 25px; 
        transition: all 0.3s ease-in-out;
        border: none; 
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  }
    /* Ensure buttons are responsive */
    .btn-container {
        display: flex;
        flex-direction: column; /* Stack vertically on mobile */
        gap: 10px; /* Space between buttons */
    }

    /* Responsive Button Sizes */
    .plus-button, #addAccessBtn {
        font-size: 16px;
        width: 100%;  /* Full width on smaller screens */
    }

    @media (max-width: 868px) {
        .plus-button, #addAccessBtn {
            width: 100%;  /* Ensure full width on small screens */
            font-size: 10px;  /* Slightly smaller font size */
        }
        .fa-plus{
          font-size:10px
    
        }
    }

    @media (min-width: 768px) {
        .plus-button, #addAccessBtn {
            width: auto;  /* Auto width on larger screens */
            font-size: 14px;
        }
    }
</style>


<style>
    /* Access Button Hover Effect */
    #addAccessBtn:hover {
        background: rgb(255, 105, 0); /* Slightly darker shade */
        transform: translateY(-2px);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
    }

    /* Dropdown Container Hover Effect */
    #accessDropdownContainer:hover {
        box-shadow: 0 6px 14px rgba(0, 0, 0, 0.2);
    }

    /* Dropdown Items */
    .employee-checkbox {
        margin-right: 10px;
    }

    .employee-label {
        font-size: 14px;
        font-weight: 500;
        color: #333;
        transition: color 0.3s ease-in-out;
    }

    .employee-label:hover {
        color: rgb(255, 105, 0);
        cursor: pointer;
    }

    /* Dropdown Item Wrapper */
    .dropdown-item-wrapper {
        display: flex;
        align-items: center;
        padding: 10px 0;
        border-bottom: 1px solid #f0f0f0;
        transition: background 0.2s ease-in-out;
    }

    .dropdown-item-wrapper:last-child {
        border-bottom: none;
    }

    /* Highlight on Hover */
    .dropdown-item-wrapper:hover {
        background-color: rgba(255, 105, 0, 0.1);
    }
</style>


<!-- Remove Selected Employees Display -->
<!-- <div id="selectedAccessContainer" class="mt-2">
    <span id="selectedAccess">--Nil--</span>
</div> -->


</div>
<!-- Include Font Awesome for Icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">




<!-- Responsive CSS -->
<style>
  /* Modal Responsiveness */
  .modal-dialog {
    max-width: 35%;
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


  /* Styling */
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
</style>

            <!-- Sidebar Toggle (Topbar) -->
                    
                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img class="img-profile rounded-circle"
                                    src="img/p.png" style="width: 2rem;height: rem;">
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
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
              <!-- Include Bootstrap -->

<!-- Designation Cards Container -->
<!-- Include Font Awesome -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
<div class="container-fluid mt-4">
  <!-- Nav Tabs -->
  <ul class="nav nav-pills custom-nav">
  <li class="nav-item">
      <a class="nav-link active" id="all-tab" href="#" onclick="setActiveTab('all')">
          <i class="fas fa-list-ul"></i> All
      </a>
  </li>

  <?php
  // DB connection
  include("dbconn.php");
  $sql = "SELECT FollowuptypeName FROM followuptype";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
          $type = strtolower(str_replace(' ', '-', $row['FollowuptypeName'])); // e.g., "New Client" -> "new-client"
          $label = $row['FollowuptypeName'];
          echo '
          <li class="nav-item">
              <a class="nav-link" id="' . $type . '-tab" href="#" onclick="setActiveTab(\'' . $type . '\')">
                  ' . $label . '
              </a>
          </li>';
      }
  }

  $conn->close();
  ?>
</ul>
  

<style>
    /* Adjust font size for navigation tabs */
    .nav-link {
        font-size: 16px; /* Default font size for larger screens */
    }

    /* Media query for smaller screens */
    @media (max-width: 768px) {
        .nav-link {
            font-size: 14px; /* Smaller font size for mobile devices */
        }
    }
</style>

  <!-- Card Containers -->
  <div id="cards-container" class="row mt-4" >
  </div>

  <!-- Custom Styles -->
  <style>
 
    /* Navigation Styling */
    .custom-nav .nav-link {
      background-color: #0B3D91;
      color: white;
      border-radius: 50px;
      margin-right: 15px;
      font-size: 14px;
      transition: background-color 0.3s ease, transform 0.3s ease;
    }

    .custom-nav .nav-link.active {
      background-color: rgb(0, 148, 255);
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
      transform: scale(1.1);
    }

    .custom-nav .nav-link:hover {
      background-color: rgb(0, 148, 255);
      transform: scale(1.05);
    }

    /* Card Styling */
    .card {
      margin: 8px;
      padding: 2px; /* Reduce padding */
      width: 100%;
      min-height: 40px; /* Reduce card height */
      font-size: 14px; /* Reduce font size */
      cursor: pointer;
      transition: transform 0.2s ease;
      color: black;
      display: flex;
      align-items: center; /* Center content vertically */
      justify-content: center; /* Center content horizontally */
      text-align: center;
      border-radius: 5px;
    }

    /* Ensure 4 Cards per Row */
    .card-container {
      flex: 1 1 calc(25% - 16px); /* 4 cards per row */
      max-width: calc(25% - 16px);
    }

    /* Responsive: Adjust cards for smaller screens */
    @media (max-width: 992px) {
      .card-container {
        flex: 1 1 calc(50% - 16px); /* 2 cards per row */
        max-width: calc(50% - 16px);
      }
    }

    @media (max-width: 600px) {
      .card-container {
        flex: 1 1 100%; /* 1 card per row */
        max-width: 100%;
      }
    }

    .card:hover {
      transform: scale(1.05);
    }

    
    /* Hide Description & Status Initially */
    .card-text, .card-status {
      display: none;
    }
  </style>
<style>
/* Card Styles */
.card {
  position: relative; /* Makes absolute positioning work for children */
  border: 1px solid #ddd;
  box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.1);
  min-height: 40px; /* Ensures consistent height */
  display: flex;
  flex-direction: column;
  justify-content: space-between; /* Ensures spacing */
}
/* Flag Icon - Initially only outlined */
.flag-icon {
  position: absolute;
  top: 5px;
  right: 2px;
  cursor: pointer;
  font-size: 14px;
  padding: 5px;
  color: white; /* Initially transparent */
  background-color: transparent;
}

/* When a color is selected */
.flag-icon.selected {
  color: inherit; /* Fills the icon */
  border-color: inherit; /* Changes outline color */
}

/* Delete Icon - Fixing it to the bottom-right */
/* Delete Icon - Initially Hidden */
.delete-icon {
  position: absolute;
  bottom: 10px;
  right: 10px;
  cursor: pointer;
  font-size: 14px;
  color: red;
  opacity: 0; /* Initially hidden */
  transform: scale(0.5); /* Starts slightly smaller */
  transition: opacity 0.3s ease-in-out, transform 0.3s ease-in-out;
}

/* Show delete icon when hovering over the card */
.card:hover .delete-icon {
  opacity: 1; /* Make it visible */
  transform: scale(1); /* Scale up to normal size */
}

/* Color Picker */
.color-picker {
  display: none;
  position: absolute;
  top: 30px;
  right: 8px;
  background: white;
  padding: 5px;
  border: 1px solid #ccc;
  border-radius: 5px;
}

.color-picker span {
  display: inline-block;
  width: 20px;
  height: 20px;
  margin: 3px;
  cursor: pointer;
  border-radius: 5px;
  border: 1px solid #000; /* Ensures visibility */
}
.card-text {
    display: block !important;
}

.open-icon{
  position: absolute;
  bottom: 35px;
  right: 2px;
  cursor: pointer;
  font-size: 27px;
  color: #090b81;
  opacity: 0; /* Initially hidden */
  transform: scale(0.5); /* Starts slightly smaller */
  transition: opacity 0.3s ease-in-out, transform 0.3s ease-in-out;
}
.card:hover .open-icon {
    opacity: 1; /* Show on hover */
}

</style>

</div>

<!-- HTML + PHP Modal -->
<div class="modal fade" id="designationModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-body p-0">
        <div class="row no-gutters">
          <div class="col-12 p-3">
            <form id="designationForm" method="POST">
              <input type="hidden" id="followupId" value="123">

              <div class="form-group">
                <label for="titleInput"><b>Title:</b></label>
                <input type="text" class="form-control" id="titleInput" placeholder="Enter title" required>
              </div>
              <div class="form-group">
                <label for="descriptionInput"><b>Updates</b></label>
                <textarea class="form-control" id="descriptionInput" rows="2" placeholder="Enter short description" required></textarea>
              </div>
              <div class="form-group">
                <label for="statusSelect"><b>Status:</b></label>
                <?php
                  include('dbconn.php');
                  $sql = "SELECT FollowuptypeName FROM followuptype";
                  $result = $conn->query($sql);
                ?>
                <select class="form-control" id="statusSelect" required>
                  <option value="">Select</option>
                  <?php
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<option value='" . htmlspecialchars($row["FollowuptypeName"]) . "'>" . htmlspecialchars($row["FollowuptypeName"]) . "</option>";
                        }
                    } else {
                        echo "<option value=''>No statuses available</option>";
                    }
                    $conn->close();
                  ?>
                </select>
              </div>
              <div class="text-center">
                <button type="submit" class="btn submit-btn" style="color: white;">Submit</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- JavaScript -->
<script>
const statusColorMap = {};
let allCards = [];

// Predefined pastel color palette
const pastelColors = [
    "#FFB3BA", "#FFDFBA", "#FFFFBA", "#BAFFC9", "#BAE1FF",
    "#D5BAFF", "#FFC3E0", "#C4FAF8", "#E0BBE4", "#D0F4DE",
    "#FFCCF9", "#F3FFE3", "#E7FFDE", "#FFFACD", "#D1C4E9",
    "#B2EBF2", "#F8BBD0", "#F0F4C3", "#FAD6A5", "#B9FBC0"
];

let colorIndex = 0;

function getColorForStatus(status) {
    if (!statusColorMap[status]) {
        if (colorIndex >= pastelColors.length) {
            alert("Not enough unique colors! Add more to pastelColors array.");
            statusColorMap[status] = "#ffffff"; // fallback
        } else {
            statusColorMap[status] = pastelColors[colorIndex++];
        }
    }
    return statusColorMap[status];
}

document.getElementById("designationForm").addEventListener("submit", function(event) {
    event.preventDefault();

    const title = document.getElementById("titleInput").value;
    const description = document.getElementById("descriptionInput").value;
    const status = document.getElementById("statusSelect").value;

    fetch('insert_followup.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `title=${encodeURIComponent(title)}&updates=${encodeURIComponent(description)}&status=${encodeURIComponent(status)}`
    })
    .then(response => response.json())
    .then(result => {
      if (!result.success) {
          if (result.error === 'duplicate') {
              alert("A follow-up with the same title and status already exists.");
          } else {
              alert("Failed to add follow-up. Try again.");
          }
          return;
      }

      const followupId = result.followupId;
      const card = createCard(title, description, status, followupId);
      allCards.push(card);
      appendCardToTab(status, card);
      refreshCards();
      document.getElementById("designationForm").reset();
      $('#designationModal').modal('hide');
  })


    .catch(error => {
        console.error('Error:', error);
    });
});

function createCard(title, description, status, followupId) {
    const card = document.createElement("div");
    const creationDate = new Date().toISOString();
    card.setAttribute("data-id", followupId); // 🔥 ID from DB

    const bgColor = getColorForStatus(status);
    card.classList.add("card", "card-container", "col-12", "col-md-6", "col-lg-3");
    card.style.backgroundColor = bgColor;
    card.setAttribute('data-status', status);
    card.setAttribute('data-created-date', creationDate);

    card.innerHTML = `
    <div class="card-body">
        <span class="flag-icon fas fa-flag" style="float:right;" onclick="toggleColorPicker(this)"></span>
        <div class="color-picker">
            <span style="background: white;" onclick="changeFlagColor(this, 'white')"></span>
            <span style="background: red;" onclick="changeFlagColor(this, 'red')"></span>
            <span style="background: blue;" onclick="changeFlagColor(this, 'blue')"></span>
            <span style="background: green;" onclick="changeFlagColor(this, 'green')"></span>
            <span style="background: black;" onclick="changeFlagColor(this, 'black')"></span>
            <span style="background: orange;" onclick="changeFlagColor(this, 'orange')"></span>
        </div>
        <p class="card-title">${title}</p>
        <p class="card-text">${description}</p>
        <p class="card-status"><strong>Status:</strong> ${status}</p>
        <p><strong>Card ID:</strong> ${followupId}</p> <!-- ✅ Show actual DB ID -->
        <span class="open-icon fas fa-eye" onclick="navigateToFollowUp('${title}', '${status}')"></span>
    </div>
    `;
    return card;
}


function navigateToFollowUp(title, status) {
    const encodedTitle = encodeURIComponent(title);
    const encodedStatus = encodeURIComponent(status);
    window.location.href = `followup-updates.php?title=${encodedTitle}&status=${encodedStatus}`;
    event.stopPropagation();
}

function toggleColorPicker(icon) {
    const picker = icon.nextElementSibling;
    picker.style.display = picker.style.display === "block" ? "none" : "block";
    event.stopPropagation();
}

document.addEventListener("click", function(event) {
    const colorPickers = document.querySelectorAll(".color-picker");
    colorPickers.forEach(picker => {
        if (!picker.contains(event.target) && !picker.previousElementSibling.contains(event.target)) {
            picker.style.display = "none";
        }
    });
});

function changeFlagColor(element, color) {
    const flagIcon = element.parentElement.previousElementSibling;
    flagIcon.style.color = color;
    flagIcon.style.borderColor = color;
    flagIcon.classList.add("selected");
    element.parentElement.style.display = "none";
    event.stopPropagation();
}

// function deleteCard(icon) {
//     const card = icon.closest(".card");
//     event.stopPropagation();
//     card.remove();
//     allCards = allCards.filter(existingCard => existingCard.id !== card.id);
// }

function appendCardToTab(status, card) {
    const container = document.getElementById("cards-container");
    container.appendChild(card);
}

function setActiveTab(tab) {
    document.querySelectorAll('.nav-link').forEach(t => t.classList.remove('active'));
    document.getElementById(tab + '-tab').classList.add('active');
    refreshCards(tab);
}

function refreshCards() {
    const activeTab = document.querySelector('.nav-link.active')?.id.replace('-tab', '') || 'all';
    const container = document.getElementById("cards-container");
    container.innerHTML = '';

    allCards.forEach(card => {
        const status = card.getAttribute('data-status');
        card.style.backgroundColor = getColorForStatus(status);
        if (activeTab === 'all' || status === activeTab) {
            container.appendChild(card);
        }
    });
}

// ✅ Load existing followups from database on page load
window.addEventListener("DOMContentLoaded", () => {
    fetch('get_followups.php')
        .then(res => res.json())
        .then(data => {
            data.forEach(followup => {
                const { title, last_update, status, followupId } = followup; // <-- change updates to last_update
                const card = createCard(title, last_update, status, followupId); // <-- pass last_update
                allCards.push(card);
            });
            refreshCards(); // Display loaded cards
        })
        .catch(err => console.error('Failed to load followups:', err));
});


</script>

<!-- Edit Modal -->
<!-- Edit Modal -->
<div class="modal fade" id="editDesignationModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-body p-0">
        <div class="row no-gutters">
          <div class="col-12 p-3">
            <form id="editDesignationForm" action="update_followup.php" method="POST">
              <!-- Hidden ID -->
              <input type="hidden" id="editFollowupId" name="followupId">

              <!-- Title -->
              <div class="form-group">
                <label for="editTitleInput"><b>Title:</b></label>
                <input type="text" class="form-control" id="editTitleInput" name="title" required>
              </div>

              <!-- Previous Updates -->
              <div class="form-group">
                <label><b>Previous Updates:</b></label>
                <div id="previousUpdatesContainer" class="border p-2 rounded" style="min-height: 40px;"></div>
              </div>

              <!-- New Updates -->
              <div class="form-group">
                <label><b>New Updates:</b> 
                  <span onclick="addNewUpdateField()" style="cursor: pointer;" class="fas fa-plus-circle text-primary"></span>
                </label>
                <div id="newUpdateFields">
                  <!-- New update fields will be appended here dynamically -->

                </div>
              </div>

              <!-- Status -->
              <div class="form-group">
                <label for="editStatusSelect"><b>Status:</b></label>
                <?php
                  include('dbconn.php');
                  $sql = "SELECT FollowuptypeName FROM followuptype";
                  $result = $conn->query($sql);
                ?>
                <select class="form-control" id="editStatusSelect" name="status" required>
                  <option value="">Select</option>
                  <?php
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<option value='" . htmlspecialchars($row["FollowuptypeName"]) . "'>" . htmlspecialchars($row["FollowuptypeName"]) . "</option>";
                        }
                    } else {
                        echo "<option value=''>No statuses available</option>";
                    }
                    $conn->close();
                  ?>
                </select>
              </div>

              <!-- Submit -->
              <div class="text-center">
                <button type="submit" class="btn btn-primary">Update</button>
              </div>

            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  // JS function to dynamically add new update fields
  function addNewUpdateField() {
    const container = document.getElementById("newUpdateFields");
    const textarea = document.createElement("textarea");
    textarea.className = "form-control my-2";
    textarea.name = "newUpdate[]";  // use array to allow multiple updates
    textarea.rows = 2;
    textarea.required = true;
    container.appendChild(textarea);

  }
</script>

<script>
let cardToUpdate = null;

// Add new update field dynamically
function addNewUpdateField() {
    const container = document.getElementById("newUpdateFields");

    // If already has one textarea, don't add another
    if (container.querySelector("textarea")) return;

    const input = document.createElement("textarea");
    input.classList.add("form-control", "mb-2");
    input.placeholder = "Enter new update";
    input.rows = 2;
    container.appendChild(input);
}

// Open the edit modal and populate fields
function openEditModal(card) {
    cardToUpdate = card;

    document.getElementById("editTitleInput").value = card.querySelector(".card-title").textContent;

    // Populate all previous updates
    const updatesHTML = card.querySelector(".card-text").innerHTML.split('<br>').filter(Boolean);
    const previousUpdatesDiv = document.getElementById("previousUpdatesContainer");
    previousUpdatesDiv.innerHTML = '';

    const lastUpdate = updatesHTML.pop();
    if (lastUpdate) {
        const textarea = document.createElement("textarea");
        textarea.classList.add("form-control", "mb-2");
        textarea.value = lastUpdate;
        textarea.rows = 2;
        previousUpdatesDiv.appendChild(textarea);
    }


    // Clear any new update fields
    document.getElementById("newUpdateFields").innerHTML = '';

    const status = card.querySelector(".card-status").textContent.replace("Status: ", "");
    document.getElementById("editStatusSelect").value = status;
    document.getElementById("editFollowupId").value = card.dataset.id;

    $('#editDesignationModal').modal('show');
}

function addCardListeners(card) {
    card.addEventListener('click', function (event) {
        const clickedElement = event.target;
        const isInteractiveIcon = clickedElement.closest('.open-icon, .delete-icon, .flag-icon, .color-picker, .color-picker span');
        if (isInteractiveIcon) return;
        openEditModal(card);
    });
}

function createCard(title, description, status, followupId) {
    const card = document.createElement("div");
    const creationDate = new Date().toISOString();

    card.classList.add("card", "card-container", "col-12", "col-md-6", "col-lg-3", status);
    card.setAttribute('data-status', status);
    card.setAttribute('draggable', 'true');
    card.setAttribute('data-created-date', creationDate);
    card.setAttribute("data-id", followupId);

    card.innerHTML = `
    <div class="card-body">
        <span class="flag-icon fas fa-flag" style="float:right;" onclick="toggleColorPicker(this)"></span>
        <div class="color-picker">
            <span style="background: white;" onclick="changeFlagColor(this, 'white')"></span>
            <span style="background: red;" onclick="changeFlagColor(this, 'red')"></span>
            <span style="background: blue;" onclick="changeFlagColor(this, 'blue')"></span>
            <span style="background: green;" onclick="changeFlagColor(this, 'green')"></span>
            <span style="background: black;" onclick="changeFlagColor(this, 'black')"></span>
            <span style="background: orange;" onclick="changeFlagColor(this, 'orange')"></span>
        </div>      
        <p class="card-title">${title}</p>
        <p class="card-text">${description.split('<br>').pop()}</p>
        <p class="card-status"><strong>Status:</strong> ${status}</p>
        <span class="open-icon fas fa-eye" onclick="navigateToFollowUp('${title}', '${status}')"></span>
    </div>
    `;

    addCardListeners(card);

    return card;
}

document.getElementById("editDesignationForm").addEventListener("submit", function(event) {
    event.preventDefault();

    const title = document.getElementById("editTitleInput").value;
    const status = document.getElementById("editStatusSelect").value;
    const followupId = document.getElementById("editFollowupId").value;

    // Collect previous updates
    const previousUpdates = Array.from(document.querySelectorAll("#previousUpdatesContainer textarea"))
        .map(textarea => textarea.value.trim())
        .filter(Boolean);

    // Collect new updates
    const newUpdates = Array.from(document.querySelectorAll("#newUpdateFields textarea"))
        .map(textarea => textarea.value.trim())
        .filter(Boolean);

    const allUpdates = [...previousUpdates, ...newUpdates];

    fetch('update_followup.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `followupId=${followupId}&title=${encodeURIComponent(title)}&status=${encodeURIComponent(status)}&` +
            allUpdates.map(update => `newUpdate[]=${encodeURIComponent(update)}`).join('&')
    })
    .then(response => response.text())
    .then(result => {
    if (result.includes("Duplicate title and status")) {
        alert("A card with this title and status already exists.");
        return;
    }

    if (cardToUpdate) {
        cardToUpdate.querySelector(".card-title").textContent = title;
        cardToUpdate.querySelector(".card-text").innerHTML = allUpdates.join("<br>");
        cardToUpdate.querySelector(".card-status").innerHTML = `<strong>Status:</strong> ${status}`;
    }

    $('#editDesignationModal').modal('hide');
      location.reload();
  })

    .catch(error => {
        console.error('Error updating followup:', error);
    });
});
</script>
<script>
  function deleteCard(icon, followupId) {
    event.stopPropagation();

    if (!confirm("Are you sure you want to delete this card?")) return;

    fetch('delete_followup.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `id=${followupId}`
    })
    .then(res => res.json())
    .then(result => {
        if (result.success) {
            const card = icon.closest(".card");
            card.remove();
            allCards = allCards.filter(c => c.getAttribute("data-id") !== followupId.toString());
        } else {
            alert("Failed to delete: " + result.message);
        }
    })
    .catch(error => {
        console.error("Error deleting:", error);
    });
}

</script>
    <!-- /.container-fluid -->

            </div>

            <!-- End of Main Content -->

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
                    <a class="btn btn-primary" href="logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>
<!-- Side Modal for Card Details -->

    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable();
        });
    </script>

    
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <!-- Bootstrap JavaScript -->
    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>



</body>

</html>