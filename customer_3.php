<?php
include 'dbconn.php'; // Ensure you have a database connection
?>
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <title>Task Manager</title>
<!-- Load jQuery first -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
        thead{
            color:black;
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
            display: none;
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

</style>
<style>
  /* Base styles for the side modal */
.side-modal {
  position: fixed;
  top: 0;
  right: -100%; /* Initially hidden */
  width: 400px;
  height: 100vh;
  background: rgba(15, 29, 64); /* Transparent bluish effect */
  backdrop-filter: blur(10px); /* Glassmorphism effect */
  clip-path: polygon(25% 0%, 100% 0%, 100% 100%, 0% 100%);
  transition: right 0.4s ease-in-out;
  z-index: 1000;
  padding: 10px; /* Reduce padding */
  color: white;
  display: flex;
  align-items: center;
  justify-content: center;
  box-shadow: -5px 0px 15px rgba(0, 0, 0, 0.3);
}

/* Open state */
.side-modal.open {
  right: 0;
}

/* Modal content */
.modal-content1 {
  position: relative;
  width: 90%; /* Ensure it fits within modal */
  display: flex;
  flex-direction: column;
  align-items: center;
  background: none;
  padding: 5px;
}

/* Close button */
.side-modal .close {
  position: absolute;
  top: 10px;
  right: 15px;
  font-size: 24px;
  cursor: pointer;
  color: white;
  transition: transform 0.3s ease;
}

.side-modal .close:hover {
  transform: rotate(90deg);
}

/* Form styling */
#modalForm1 {
  display: flex;
  flex-direction: column;
  width: 100%; /* Full width */
  align-items: right; /* Center elements */
}

/* Input Fields */
#modalForm1 input {
  width: 100%; /* Full width */
  max-width: 90%; /* Ensure it doesn't overflow */
  margin-bottom: 12px;
  padding: 10px;
  border: 2px solid rgb(255, 255, 255);
  border-radius: 8px;
  background: rgb(255, 255, 255);
  color: rgba(15, 29, 64);
  font-size: 16px;
  transition: border 0.3s ease, box-shadow 0.3s ease;
}

#modalForm1 input:focus {
  border-color: rgb(248, 165, 178);
  box-shadow: 0px 0px 10px rgba(248, 165, 178, 0.5);
  outline: none;
}

#modalForm1 input::placeholder {
  color: rgba(15, 29, 64, 0.6); /* Darker placeholder for visibility */
}

/* Submit Button */
#modalForm1 button {
  background: rgb(248, 165, 178);
  color: white;
  padding: 12px;
  width: 90%;
  border: none;
  border-radius: 8px;
  cursor: pointer;
  font-size: 16px;
  transition: background 0.3s ease, transform 0.2s ease;
}
.modal-content1 {
  padding-left: 30px;
}
.side-modal {
  clip-path: none;
}


#modalForm1 button:hover {
  background: rgb(220, 145, 158);
  transform: scale(1.05);
}
.card-body{
  color:black;
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
</style>
<!-- Modal Styles -->



</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

<?php include ("sidebar.php"); ?>

        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar static-top shadow" style="background:white;">
                    
<!-- Sidebar Toggle (Topbar) -->
<button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
    <i class="fa fa-bars"></i>
</button>
  <!-- Create Customer Button -->
  <div class="mr-auto d-flex align-items-center pl-3 py-2">
    <h4 class="text-dark font-weight-bold mr-4" 
        style="color: rgb(15,29,64); margin-top: 5px;">
        Master &gt; Customer Details
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
  <!-- (Other topbar items can go here) -->
  
</nav>

<div class="container-fluid">
<div class="container mb-4 mt-4" style="background: white; ">
</div>
<script>
    $(document).ready(function () {
    // Restrict numbers in text fields
    $(" #stateInput, #districtInput").on("input", function () {
        $(this).val($(this).val().replace(/\d/g, '')); // Remove numbers
    });

    // Allow only numbers in phone number and pincode fields
    $("#customerno, #pincode").on("input", function () {
        $(this).val($(this).val().replace(/\D/g, '')); // Remove non-numeric characters
    });

    // Validate form on submit
    $("#customerForm").submit(function (e) {
        e.preventDefault(); // Prevent form submission if validation fails

        let isValid = true;
        let phoneNumber = $("#customerno").val();
        let pincode = $("#pincode").val();
        
        // Phone number validation (10 digits)
        if (!/^\d{10}$/.test(phoneNumber)) {
            alert("Please enter a valid 10-digit phone number.");
            isValid = false;
        }

        // Pincode validation (6 digits)
        if (!/^\d{6}$/.test(pincode)) {
            alert("Please enter a valid 6-digit pincode.");
            isValid = false;
        }

        if (isValid) {
            this.submit(); // Submit the form if all validations pass
        }
    });
});

</script>

<script>
// List of states and districts for India
const statesAndDistricts = {
   "Andhra Pradesh": ["Visakhapatnam", "Vijayawada", "Guntur", "Nellore", "Kurnool", "Chittoor", "Anantapur", "East Godavari", "West Godavari", "Prakasam", "Srikakulam", "Kadapa", "Krishna", "Rayalaseema"],
"Arunachal Pradesh": ["Itanagar", "Tawang", "Ziro", "Pasighat", "West Kameng", "East Kameng", "Lower Subansiri", "Upper Subansiri", "West Siang", "East Siang", "Lohit", "Namsai"],
"Assam": ["Guwahati", "Silchar", "Dibrugarh", "Tezpur", "Jorhat", "Nagaon", "Barpeta", "Bongaigaon", "Karimganj", "Sonitpur", "Sivasagar", "Cachar", "Kokrajhar", "Morigaon"],
"Bihar": ["Patna", "Gaya", "Muzaffarpur", "Bhagalpur", "Darbhanga", "Purnia", "Nalanda", "Samastipur", "Begusarai", "Saran", "Vaishali", "Madhubani", "Katihar", "Araria"],
"Chhattisgarh": ["Raipur", "Bilaspur", "Durg", "Korba", "Jagdalpur", "Rajnandgaon", "Surguja", "Koriya", "Raigarh", "Jashpur"],
"Goa": ["North Goa", "South Goa"],
"Gujarat": ["Ahmedabad", "Surat", "Vadodara", "Rajkot", "Gandhinagar", "Bhavnagar", "Jamnagar", "Anand", "Kutch", "Sabarkantha", "Patan", "Junagadh"],
"Haryana": ["Gurugram", "Faridabad", "Panipat", "Ambala", "Hisar", "Karnal", "Rewari", "Sonipat", "Fatehabad", "Sirsa", "Jhajjar"],
"Himachal Pradesh": ["Shimla", "Kullu", "Manali", "Dharamshala", "Solan", "Mandi", "Kangra", "Bilaspur", "Hamirpur", "Kullu", "Una", "Chamba"],
"Jharkhand": ["Ranchi", "Jamshedpur", "Dhanbad", "Bokaro", "Hazaribagh", "Dumka", "Giridih", "Jamtara", "Deoghar", "Ramgarh"],
"Karnataka": ["Bengaluru", "Mysore", "Hubli", "Mangalore", "Belagavi", "Tumkur", "Udupi", "Dakshina Kannada", "Hassan", "Kodagu", "Bijapur", "Bidar", "Chikkaballapur", "Chikkamagaluru"],
"Kerala": ["Thiruvananthapuram", "Kochi", "Kozhikode", "Thrissur", "Kottayam", "Malappuram", "Palakkad", "Ernakulam", "Kollam", "Pathanamthitta", "Alappuzha", "Idukki"],
"Madhya Pradesh": ["Bhopal", "Indore", "Gwalior", "Jabalpur", "Ujjain", "Sagar", "Katni", "Khandwa", "Hoshangabad", "Rewa", "Satna", "Dewas", "Vidisha"],
"Maharashtra": ["Mumbai", "Pune", "Nagpur", "Nashik", "Thane", "Aurangabad", "Kolhapur", "Solapur", "Nanded", "Amravati", "Chandrapur", "Jalna"],
"Manipur": ["Imphal", "Churachandpur", "Thoubal", "Bishnupur", "Ukhrul", "Senapati", "Tamenglong", "Chandel", "Kangpokpi"],
"Meghalaya": ["Shillong", "Tura", "Jowai", "Nongstoin", "East Khasi Hills", "West Khasi Hills", "Ri Bhoi", "South West Khasi Hills"],
"Mizoram": ["Aizawl", "Lunglei", "Champhai", "Serchhip", "Kolasib", "Mamit"],
"Nagaland": ["Kohima", "Dimapur", "Mokokchung", "Tuensang", "Mon", "Peren", "Wokha"],
"Odisha": ["Bhubaneswar", "Cuttack", "Puri", "Sambalpur", "Rourkela", "Berhampur", "Bargarh", "Ganjam", "Balasore", "Dhenkanal"],
"Punjab": ["Amritsar", "Ludhiana", "Patiala", "Jalandhar", "Bathinda", "Mohali", "Gurdaspur", "Firozpur", "Mansa", "Sangrur"],
"Rajasthan": ["Jaipur", "Udaipur", "Jodhpur", "Kota", "Ajmer", "Bikaner", "Sikar", "Alwar", "Bharatpur", "Pali"],
"Sikkim": ["Gangtok", "Namchi", "Mangan", "Gyalshing"],
"Tamil Nadu": ["Chennai", "Coimbatore", "Madurai", "Tiruchirappalli", "Salem", "Vellore", "Tirunelveli", "Erode", "Dindigul", "Karur", "Tanjore", "Thoothukudi", "Kanyakumari", "Cuddalore", "Villupuram", "Theni", "Ramanathapuram", "Nilgiris", "Virudhunagar", "Perambalur", "Krishnagiri", "Ariyalur", "Namakkal", "Pudukottai", "Sivaganga"],
"Telangana": ["Hyderabad", "Warangal", "Karimnagar", "Nizamabad", "Khammam", "Mahabubnagar", "Adilabad", "Nalgonda", "Rangareddy", "Medak"],
"Tripura": ["Agartala", "Udaipur", "Dharmanagar", "Kailashahar"],
"Uttar Pradesh": ["Lucknow", "Kanpur", "Varanasi", "Noida", "Agra", "Meerut", "Ghaziabad", "Allahabad", "Bareilly", "Aligarh", "Moradabad", "Saharanpur", "Firozabad", "Muzaffarnagar"],
"Uttarakhand": ["Dehradun", "Haridwar", "Nainital", "Almora", "Udham Singh Nagar", "Pauri Garhwal", "Tehri Garhwal", "Champawat"],
"West Bengal": ["Kolkata", "Darjeeling", "Siliguri", "Howrah", "Asansol", "Durgapur", "Malda", "Purulia", "Bankura", "Nadia"],
"Andaman and Nicobar Islands": ["Port Blair"],
"Chandigarh": ["Chandigarh"],
"Dadra and Nagar Haveli and Daman and Diu": ["Daman", "Diu", "Silvassa"],
"Lakshadweep": ["Kavaratti"],
"Delhi": ["Central Delhi", "East Delhi", "South Delhi", "West Delhi"],
"Puducherry": ["Pondicherry", "Karaikal", "Mahe", "Yanam"],
"Jammu and Kashmir": ["Srinagar", "Jammu", "Anantnag", "Baramulla", "Kupwara", "Poonch", "Rajouri", "Kathua"],
"Ladakh": ["Leh", "Kargil"]

};

// List of all 195 countries
const countries = [
    "India", "United States", "United Kingdom", "Canada", "Australia", "Germany", "France", "China", "Japan", "Brazil",
    "Russia", "South Korea", "Italy", "Spain", "Mexico", "Indonesia", "Netherlands", "Saudi Arabia", "Turkey", "Switzerland",
    "South Africa", "Sweden", "Argentina", "Poland", "Belgium", "Norway", "Thailand", "Ireland", "Austria", "Singapore",
    "New Zealand", "Denmark", "Finland", "Malaysia", "Portugal", "Greece", "Czech Republic", "Israel", "United Arab Emirates",
    "Vietnam", "Hungary", "Philippines", "Colombia", "Pakistan", "Chile", "Bangladesh", "Egypt", "Nigeria", "Ukraine",
    "Peru", "Venezuela", "Kazakhstan", "Romania", "Algeria", "Ecuador", "Iraq", "Morocco", "Slovakia", "Belarus", "Serbia",
    "Sri Lanka", "Croatia", "Lithuania", "Bulgaria", "Tunisia", "Slovenia", "Jordan", "Paraguay", "Uruguay", "Lebanon",
    "Georgia", "Azerbaijan", "Panama", "Armenia", "Oman", "Bolivia", "Myanmar", "Luxembourg", "Cuba", "Sudan", "Afghanistan",
    "Nepal", "Honduras", "Costa Rica", "North Macedonia", "Estonia", "El Salvador", "Cyprus", "Jamaica", "Latvia", "Bahrain",
    "Trinidad and Tobago", "Iceland", "Botswana", "Namibia", "Mauritius", "Montenegro", "Moldova", "Zambia", "Ethiopia",
    "Ghana", "Senegal", "Cameroon", "Madagascar", "Tanzania", "Kenya", "Mozambique", "Fiji", "Malta", "Bosnia and Herzegovina",
    "Gabon", "Burkina Faso", "Benin", "Guatemala", "Laos", "Papua New Guinea", "Uganda", "Mongolia", "Brunei", "Togo", "Nicaragua",
    "Seychelles", "Congo", "Malawi", "Suriname", "Maldives", "Somalia", "Eswatini", "Bhutan", "Guyana", "Belize", "Chad",
    "Burundi", "Mauritania", "Sierra Leone", "Lesotho", "Guinea", "Djibouti", "Comoros", "Liberia", "Saint Lucia", "Saint Vincent",
    "Grenadines", "Sao Tome and Principe", "Samoa", "Solomon Islands", "Vanuatu", "Gambia"
];

// Populate Country Dropdown
let countryDropdown = document.getElementById("country");
countries.forEach(country => {
    let option = document.createElement("option");
    option.value = country;
    option.textContent = country;
    countryDropdown.appendChild(option);
});

// Populate State Dropdown (for India)
let stateDropdown = document.getElementById("stateDropdown");
for (let state in statesAndDistricts) {
    let option = document.createElement("option");
    option.value = state;
    option.textContent = state;
    stateDropdown.appendChild(option);
}

// Handle State Selection
stateDropdown.addEventListener("change", function() {
    let selectedState = this.value;
    let districtDropdown = document.getElementById("districtDropdown");
    districtDropdown.innerHTML = '<option value="">Select District</option>';

    if (selectedState && statesAndDistricts[selectedState]) {
        statesAndDistricts[selectedState].forEach(district => {
            let option = document.createElement("option");
            option.value = district;
            option.textContent = district;
            districtDropdown.appendChild(option);
        });
    }
});

// Handle Country Selection
countryDropdown.addEventListener("change", function() {
    let country = this.value;
    let stateDropdown = document.getElementById("stateDropdown");
    let stateInput = document.getElementById("stateInput");
    let districtDropdown = document.getElementById("districtDropdown");
    let districtInput = document.getElementById("districtInput");

    if (country === "India") {
        stateDropdown.classList.remove("d-none");
        stateInput.classList.add("d-none");
        districtDropdown.classList.remove("d-none");
        districtInput.classList.add("d-none");
    } else {
        stateDropdown.classList.add("d-none");
        stateInput.classList.remove("d-none");
        districtDropdown.classList.add("d-none");
        districtInput.classList.remove("d-none");
    }
});

</script>


        <!-- DataTales Example -->
        <div class="card shadow mb-4">
        <div class="card-header py-3">
        <p class="m-0" style="font-size: 16px;color:rgb(23, 25, 28);font-style: normal;
    overflow: hidden;
    white-space: nowrap;
    text-overflow: ellipsis;
    color: rgb(23, 25, 28);
    font-size: 16px;
    font-weight: 500;"><b>Customer Details</b> 
        <span class="header-counter">0</span>  <!-- Counter next to heading -->
</p>
       
    </div>
    <div class="card-body">
    <div class="table-responsive">
        <table class="table table-bordered text-center" style="font-size:14px;" id="dataTable" width="100%">
            <thead>
                <tr class="thead">
                    <th>S.no</th>
                    <th>Name</th>
                    <th>Company Name</th>
                    <th>Contact</th>
                    <th>Address</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="customerTableBody">
                <?php
                $query = "SELECT * FROM customer ORDER BY ID DESC";
                $result = mysqli_query($conn, $query);
                $sno = 1;
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>
                            <td>{$sno}</td>
                            <td>{$row['customerName']}</td>
                            <td>{$row['companyName']}</td>
                            <td>{$row['phoneno']}</td>
                            <td>{$row['companyAddress']}, {$row['district']}, {$row['state']}, {$row['country']} - {$row['pincode']}</td>
                            <td class='action-buttons'>
                                <button class='btn-action btn-edit' data-id='{$row['ID']}'><i class='fas fa-edit'></i></button>
                                <button class='btn-action btn-delete' data-id='{$row['ID']}'><i class='fas fa-trash-alt' style='color: rgb(238, 153, 129);'></i></button>
                            </td>
                        </tr>";
                    $sno++;
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
        </div>

    </div>
    <script src="vendor/jquery/jquery.min.js"></script>

<!-- Bootstrap core JavaScript -->
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript -->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages -->
<script src="js/sb-admin-2.min.js"></script>




<!-- jQuery, Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

            <!-- End of Main Content -->

            <!-- Footer -->
           
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->
        <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                       <h6> <b>Copyright &copy; Knock the Globe Technologies 2025</b></h6>
                    </div>
                </div>
            </footer>
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

   <!-- jQuery (Must be loaded first) -->
   <script src="vendor/jquery/jquery.min.js"></script>

<!-- Bootstrap core JavaScript -->
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript -->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- Custom scripts for all pages -->
<script src="js/sb-admin-2.min.js"></script>

<!-- DataTables Plugin (Ensure it's loaded after jQuery) -->
<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Initialize DataTable AFTER all dependencies are loaded -->
<script>
    $(document).ready(function() {
        $('#dataTable').DataTable();
    });
</script>
<script>
$(document).ready(function () {
    $("#stateDropdown").change(function () {
        if ($(this).val() !== "") {
            $("#stateInput").hide().prop("required", false);
            $(this).prop("required", true);
        } else {
            $("#stateInput").show().prop("required", true);
            $(this).prop("required", false);
        }
    });
});


$(document).ready(function () {
    loadCustomers(); // Fetch data when the page loads


    $("#customerbtn").click(function (e) { 
    e.preventDefault();
      // Check if form is valid before sending AJAX
  if (!$("#customerForm")[0].checkValidity()) {
        $("#customerForm")[0].reportValidity(); // Shows default validation messages
        return; // Stop function execution
    }
    var customerData = {
    customername: $("#customername").val(),
    companyname: $("#companyname").val(),
    customerno: $("#customerno").val(),
    customeraddress: $("#customeraddress").val(),
    country: $("#country").val(),
    state: ($("#country").val() === "India") ? $("#stateDropdown").val() : $("#stateInput").val(),
    district: ($("#country").val() === "India") ? $("#districtDropdown").val() : $("#districtInput").val(),
    pincode: $("#pincode").val(),
};


    $.ajax({
        url: "customerBackend.php",
        type: "POST",
        data: customerData,
        success: function (response) {
            Swal.fire({
                title: "Success!",
                text: "Customer details have been added successfully.",
                icon: "success",
                confirmButtonColor: "rgb(0, 148, 255)", // Updated OK button color
                confirmButtonText: "OK"
            }).then(() => {
                location.reload(); // ✅ Reload the page after clicking OK
            });

            $("#customerForm")[0].reset();
        }
    });
});

    function loadCustomers() { 
    $.ajax({
        url: "customerBackend.php",
        type: "GET",
        dataType: "json",
        success: function (data) {
            if ($.fn.DataTable.isDataTable("#dataTable")) {
                $("#dataTable").DataTable().destroy(); // Destroy existing DataTable
            }

            // ✅ Check if there's any data; otherwise, show a message
            if (data.count > 0) {
                $("#customerTableBody").html(data.tableData);
            } else {
                $("#customerTableBody").html(`
                    <tr>
                        <td colspan="8" class="text-center">No customers found</td>
                    </tr>
                `);
            }

            // ✅ Ensure DataTable initializes even when empty
            $("#dataTable").DataTable(); 
            $(".header-counter").text(data.count);
        },
        error: function (xhr, status, error) {
            console.error("Error fetching customers:", error);
        }
    });
}


$(document).on("click", ".btn-delete", function () {
    var customerId = $(this).data("id");

    Swal.fire({
        title: "Are you sure?",
        text: "This action cannot be undone!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "rgb(0, 148, 255)", // Updated Yes button color
        cancelButtonColor: "#d33", // Updated No button color
        confirmButtonText: "Yes, I want to delete",
        cancelButtonText: "No, Don’t delete"
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "customerBackend.php",
                type: "POST",
                data: { delete: true, id: customerId },
                success: function () {
                    Swal.fire({
                        title: "Deleted!",
                        text: "The customer has been removed.",
                        icon: "success",
                        confirmButtonColor: "rgb(0, 148, 255)", // Updated OK button color
                        confirmButtonText: "OK"
                    }).then(() => {
                        location.reload(); // ✅ Reload the page after clicking OK
                    });
                }
            });
        }
    });
});


    // ✅ Edit button functionality
    $(document).on("click", ".btn-edit", function () {
        var customerId = $(this).data("id");

        $.ajax({
            url: "customerBackend.php",
            type: "POST",
            data: { edit: true, id: customerId },
            dataType: "json",
            success: function (customer) {
                $("#customername").val(customer.customerName);
                $("#companyname").val(customer.companyName);
                $("#customerno").val(customer.phoneno);
                $("#customeraddress").val(customer.companyAddress);
                $("#country").val(customer.country);
                $("#stateInput").val(customer.state);
                $("#districtInput").val(customer.district);
                $("#pincode").val(customer.pincode);

                $("#customerbtn").off("click").text("Update Customer").attr("data-update", customerId);
            }
        });
    });

   // ✅ Update Customer with SweetAlert Confirmation
$(document).on("click", "#customerbtn[data-update]", function (e) {
    e.preventDefault();
    var customerId = $(this).attr("data-update");

    var updatedData = {
        update: true,
        id: customerId,
        customername: $("#customername").val(),
        companyname: $("#companyname").val(),
        customerno: $("#customerno").val(),
        customeraddress: $("#customeraddress").val(),
        country: $("#country").val(),
        state: $("#stateInput").val(),
        district: $("#districtInput").val(),
        pincode: $("#pincode").val(),
    };

    $.ajax({
        url: "customerBackend.php",
        type: "POST",
        data: updatedData,
        success: function () {
            Swal.fire({
                title: "Updated!",
                text: "Customer details have been successfully updated.",
                icon: "success",
                confirmButtonColor: "rgb(0, 148, 255)", // Updated OK button color
                confirmButtonText: "OK"
            }).then(() => {
                location.reload(); // ✅ Reload the page after clicking OK
            });

            $("#customerForm")[0].reset();
        }
    });
});


});


</script>

</body>

</html>