<?php
session_start();

if (!isset($_SESSION['username']) && !isset($_SESSION['empUserName'])) {
    header("Location: login.php");
    exit();
}
?>

<?php
if (isset($_GET['rights'])) {
    $rights = urldecode($_GET['rights']); // Decode URL parameter
    $rightsArray = explode(',', $rights); // Convert to array

    // Define possible rights and assign numbers
    $statuses = [
        'View' => 1,
    ];

    // Sort rights array to ensure order consistency
    sort($rightsArray);
    $rightsKey = implode(',', $rightsArray); // Convert back to string

    // Determine status number
    $statusNo = isset($statuses[$rightsKey]) ? $statuses[$rightsKey] : 0; // Default 0 if unknown
}
?>

<script>
    // Get status number from PHP
    let statusNo = "<?php echo $statusNo; ?>";

    // Update URL without reloading
    let url = new URL(window.location.href);
    url.searchParams.set("status", statusNo);
    window.history.replaceState(null, "", url);

    // Redirect based on status number
    if (statusNo >= 1 && statusNo <= 7) {
        window.location.href = `dailyupdates_${statusNo}.php`;
    }
</script>


<?php include 'dbconn.php'; // Ensure this file has a valid DB connection ?>
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

    #dt1 th:nth-child(1), #dt1 td:nth-child(1) { width: 3%; }  /* S.no */
    #dt1 th:nth-child(2), #dt1 td:nth-child(2) { width: 8%; } /* Name */
    #dt1 th:nth-child(3), #dt1 td:nth-child(3) { width: 0%; } /* Date */
    #dt1 th:nth-child(4), #dt1 td:nth-child(4) { width: 15%; } /* Company */
    #dt1 th:nth-child(5), #dt1 td:nth-child(5) { width: 10%; } /* Project Title */
    #dt1 th:nth-child(6), #dt1 td:nth-child(6) { width: 14%; }  /* Total Days */
    #dt1 th:nth-child(7), #dt1 td:nth-child(7) { width: 20%; } /* Description */
    #dt1 th:nth-child(8), #dt1 td:nth-child(8) { width: 15%; } /* Total Time */
    #dt1 th:nth-child(9), #dt1 td:nth-child(9) { width: 20%; } /* Actual Time */
    #dt1 th:nth-child(10), #dt1 td:nth-child(10) { width: 12%; } /* Status */
thead{
    color:black;
}
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
.photo-icon:hover, .aadhar-icon:hover, .pan-icon:hover {
    transform: scale(1.3);
    color: #007bff;
}
@keyframes bounce {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-5px); }
}

.photo-icon:hover, .aadhar-icon:hover, .pan-icon:hover {
    animation: bounce 0.5s ease-in-out;
}
 #dt1 {
        font-size: 14px; /* Adjust size as needed */
    }
tbody{
    border-color: #f8f9fa;
}
    .status-icon {
            font-size: 1.2rem;
            transition: transform 0.3s ease-in-out, opacity 0.3s ease-in-out;
        }
        .ongoing { color: orange; animation: spin 1s linear infinite; }
        .pending { color: red; animation: pulse 1s infinite alternate; }
        .completed { color:  rgb(0, 148, 255); }
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
.table th, .table td {
    border: 1px solid #dee2e6;
}
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
    .l a.k i {
        color: white !important;
        font-size: 18px; /* Slightly larger icons */
        transition: color 0.3s ease-in-out;
    }
    .l:not(.active)  a.k:hover {
        background-color: rgb(45, 64, 113) !important; /* Light grey */
        color: white !important; /* Dark text */
        border-radius: 8px;
        width: 90%; /* Keep it smaller than the sidebar */
        margin: 0 auto; /* Center align */
    }
    .l:not(.active) a.k:hover i {
        color: white !important;
    }
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
    #dt1 tbody tr {
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
</style>

</head>



<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
<?php include("sidebar.php"); ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow" style=" background:white">

<!-- Sidebar Toggle (Topbar) -->
<button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
    <i class="fa fa-bars"></i>
</button>
<div class="mr-auto d-flex align-items-center pl-3 py-2">
    <h4 class="text-dark font-weight-bold mr-4" style="color: rgb(15,29,64); margin-top: 5px;">
        Daily Updates
    </h4>
</div>


<!-- Topbar Navbar -->
<ul class="navbar-nav ml-auto">


    <div class="topbar-divider d-none d-sm-block"></div>

    <!-- Nav Item - User Information -->
    <li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <img class="img-profile rounded-circle"
                src="img/p.png" style="width: 2rem;height: 2rem;">
        </a>
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
<style>
    #dt1 th:nth-child(3), 
    #dt1 td:nth-child(3) {
    display: none;
}
</style>
                <!-- Begin Page Content -->
                <div class="container-fluid">
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <p class="m-0" style="font-size: 16px; color:rgb(23, 25, 28); font-weight: 500;">
            <b>Daily Updates</b> 
            <span class="header-counter">0</span>  <!-- Counter will be updated dynamically -->
        </p>
        <div> 
            <input type="date" id="dateFilter" class="form-control d-inline" style="width: auto;">
        </div>
    </div>
    <div class="card-body">
    <div class="d-flex justify-content-end mb-2">
    <!-- <input type="text" id="tableSearch" class="form-control" placeholder="Search..." style="width: 250px;"> -->
</div>

        <div class="table-responsive">
            <table class="table text-center" id="dt1" width="100%">
                <thead>
                    <tr>
                        <th>S.no</th>
                        <th>Name</th>
                        <th>Date</th>
                        <th>Company-Title</th>
                        <th>Type</th>
                        <th>Total Days</th>
                        <th>Description</th>
                        <th>Total Hrs</th>
                        <th>Actual Hrs</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody id="table-body">
                <?php

$sql = "SELECT * FROM dailyupdates ORDER BY date DESC";
$result = $conn->query($sql);
$sno = 1;
if ($result->num_rows > 0) {
    
    while ($row = $result->fetch_assoc()) {
        $actualHrs = trim($row['actualHrs']);
        $status = ($actualHrs === '-' || empty($actualHrs)) 
            ? '<td><i class="fas fa-hourglass-half status-icon in-progress" style="font-size:12px;color:rgb(0, 148, 255);"></i>&nbsp;&nbsp;Inprogress</td>' 
            : '<td><i class="fas fa-check-circle status-icon completed" style="font-size:12px;color:rgb(0, 148, 255);"></i>&nbsp;&nbsp;Completed</td>';

        // Convert date format to match input field
        $formattedDate = date("d-m-Y", strtotime($row['date']));
        
        echo "<tr data-date='$formattedDate'>
            <td >{$sno}</td> 
            <td class='name'>{$row['name']}</td>
            <td class='date'>$formattedDate</td>
            <td>{$row['companyName']} - {$row['projectTitle']}</td>
            <td>{$row['projectType']}</td>
            <td>{$row['totalDays']}</td>
            <td>{$row['taskDetails']}</td>
            <td>{$row['totalHrs']}</td>
            <td>{$row['actualHrs']}</td>
            $status
        </tr>";
        $sno++;

    }
} else {
    echo "<tr><td colspan='10'>No records found</td></tr>";
}
?>
                </tbody>
            </table>
        </div>
    </div>
</div>
                </div>
            </div>

            
            <script>
// Function to renumber visible rows
function renumberSno() {
    let rows = document.querySelectorAll('#dt1 tbody tr');
    let sno = 1;

    rows.forEach(row => {
        if (row.style.display !== "none") {
            row.querySelector('td').textContent = sno++; // Update first cell with new sno
        }
    });
}


</script>


            <script>
document.getElementById("tableSearch").addEventListener("keyup", function() {
    let filter = this.value.toLowerCase();
    let rows = document.querySelectorAll("#table-body tr");

    rows.forEach(row => {
        let text = row.textContent.toLowerCase();
        row.style.display = text.includes(filter) ? "" : "none";
    });
});
    $(document).ready(function () {
        // Count the number of rows inside tbody (excluding any with 'No records found')
        var rowCount = $("#table-body tr").filter(function() {
            return $(this).find("td").length > 1; // Exclude 'no records found' row
        }).length;

        // Update the counter
        $(".header-counter").text(rowCount);
    });
</script>

           
<script>
document.addEventListener('DOMContentLoaded', function () {
    const tableBody = document.querySelector('#dt1 tbody');

    tableBody.addEventListener('click', function (event) {
        const clickedCell = event.target.closest('td');
        if (!clickedCell) return;

        const row = clickedCell.closest('tr');
        if (!row) return;

        const cellIndex = clickedCell.cellIndex;

        const name = row.cells[1]?.textContent.trim();
        const companyTitleFull = row.cells[3]?.textContent.trim();
        const type = row.cells[4]?.textContent.trim();
        const totalDays = row.cells[5]?.textContent.trim();
        const description = row.cells[6]?.textContent.trim();
        const totalHrs = row.cells[7]?.textContent.trim();
        const actualHrs = row.cells[8]?.textContent.trim();

        // Properly extract company and title even if no dash or multiple dashes
        let company = "", title = "";
        if (companyTitleFull.includes(" - ")) {
            [company, title] = companyTitleFull.split(" - ").map(str => str.trim());
        } else {
            company = companyTitleFull;
            title = "";
        }

        // For reports.php — Name, Company-Title, or Type clicks
        if ([1].includes(cellIndex)) {
            const url = `reports.php?name=${encodeURIComponent(name)}`;
            window.location.href = url;
            return;
        }
        if ([3].includes(cellIndex)) {
            const url = `reports.php?company=${encodeURIComponent(company)}`;
            window.location.href = url;
            return;
        }
        if ([4].includes(cellIndex)) {
            const url = `reports.php?type=${encodeURIComponent(type)}`;
            window.location.href = url;
            return;
        }
        
        // For admin-requirement.php — Other cells
        if ([5, 6, 7, 8].includes(cellIndex)) {
            fetch(`calculate_working_days1.php?company=${encodeURIComponent(company)}&title=${encodeURIComponent(title)}&type=${encodeURIComponent(type)}`)
                .then(response => response.json())
                .then(data => {
                    const teammates = encodeURIComponent(data.teammates || '');
                    const workingDays = encodeURIComponent(data.workingDays || '');

                    const url = `admin-requirement.php?company=${encodeURIComponent(company)}&title=${encodeURIComponent(title)}&type=${encodeURIComponent(type)}&totalDays=${encodeURIComponent(totalDays)}&description=${encodeURIComponent(description)}&totalHrs=${encodeURIComponent(totalHrs)}&actualHrs=${encodeURIComponent(actualHrs)}&teammates=${teammates}&workingDays=${workingDays}`;
                    window.location.href = url;
                })
                .catch(error => {
                    console.error('Error fetching admin requirement data:', error);
                    alert('Failed to fetch admin requirement data.');
                });
        }
    });
});
</script>


            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                       <h6> <b>Copyright &copy; Knock the Globe Technologies 2025</b></h6>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
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
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/sb-admin-2.min.js"></script>
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="js/demo/datatables-demo.js"></script>
    <script>
$(document).ready(function () {
    // Initialize DataTable
    let table = $('#dt1').DataTable({
        pageLength: 10,
        ordering: false,
        destroy: true,
        drawCallback: function () {
    let api = this.api();
    let startIndex = api.page.info().start;

    api.rows({ page: 'current', search: 'applied' }).every(function (rowIdx, tableLoop, rowLoop) {
        let cell = api.cell(rowIdx, 0).node();
        $(cell).html(startIndex + rowLoop + 1); // 🪄 Keeps it continuous across pages
    });
}

    });

    // Date Filter Function
    function filterByDate() {
        let selectedDate = $('#dateFilter').val();
        if (!selectedDate) return;

        let formattedDate = selectedDate.split("-").reverse().join("-"); // to dd-mm-yyyy

        table.column(2).search(formattedDate).draw(); // Filter by "Date" column (index 2)

        let visibleRows = table.rows({ filter: 'applied' }).count();
        $('.header-counter').text(visibleRows);

        if (visibleRows === 0) {
            if (!$("#no-records").length) {
                $("#dt1 tbody").append();
            }
        } else {
            $("#no-records").remove();
        }
    }

    // Auto load today's date
    let today = new Date().toISOString().split('T')[0];
    $('#dateFilter').val(today);
    filterByDate();

    // On Date Change
    $('#dateFilter').on('change', function () {
        filterByDate();
    });
});
</script>

</body>

</html>