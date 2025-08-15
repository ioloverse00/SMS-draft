<?php
include 'dashboard-data.php';
session_start();

// Check if the user is logged in
if (!isset($_SESSION["user_id"])) {
    header("Location: auth-login-basic.html");
    exit;
}

// Prevent browser caching
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

// Fetch the user's first name and last name from the database
$user_id = $_SESSION['user_id']; // Get the logged-in user's ID from the session

// Sanitize the user_id to prevent SQL injection
$user_id = mysqli_real_escape_string($conn, $user_id);

// Use quotes around the user_id in the query
$query_user = "SELECT first_name, last_name FROM users WHERE user_id = '$user_id'";
$result_user = mysqli_query($conn, $query_user);

if ($result_user && mysqli_num_rows($result_user) > 0) {
    $row_user = mysqli_fetch_assoc($result_user);
    $first_name = $row_user['first_name'] ?? 'Guest';
    $last_name = $row_user['last_name'] ?? '';
} else {
    $first_name = 'Guest';
    $last_name = '';
}

// Define the number of rows per page
$rowsPerPage = 8; // Set the number of rows per page

// Fetch the total number of rows for the teacher's assigned classes
$totalClassesQuery = "SELECT COUNT(*) AS total FROM section_subject_teacher WHERE teacher_id = '$user_id'";
$totalClassesResult = $conn->query($totalClassesQuery);
$totalClasses = $totalClassesResult->fetch_assoc()['total'];

// Calculate the total number of pages for the classes
$totalPages = ceil($totalClasses / $rowsPerPage);

// Calculate the offset for the SQL query
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$page = max($page, 1); // Ensure the page number is at least 1
$offset = ($page - 1) * $rowsPerPage;

// Fetch the rows for the teacher's assigned classes
$classesQuery = "SELECT section_subject_teacher.subject_code, section_subject_teacher.schedule, sections.section_name, section_subject_teacher.section_id 
                 FROM section_subject_teacher 
                 INNER JOIN sections ON section_subject_teacher.section_id = sections.section_id 
                 WHERE section_subject_teacher.teacher_id = '$user_id' 
                 LIMIT $rowsPerPage OFFSET $offset";
$classesResult = $conn->query($classesQuery);
?>
<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="../assets/" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-age=1.0" />
    <title>Attendance</title>
    <!-- Add your styles and scripts here -->
    <link rel="icon" type="image/x-icon" href="../assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="../assets/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="../assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="../assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="../assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <link rel="stylesheet" href="../assets/vendor/libs/apex-charts/apex-charts.css" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="../assets/vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="../assets/js/config.js"></script>
</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->

            <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
                <div class="app-brand demo">
                    <a href="index.php" class="app-brand-link">
                        <span class="app-brand-logo demo">
                            <svg
                                width="25"
                                viewBox="0 0 25 42"
                                version="1.1"
                                xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink">
                                <defs>
                                    <path
                                        d="M13.7918663,0.358365126 L3.39788168,7.44174259 C0.566865006,9.69408886 -0.379795268,12.4788597 0.557900856,15.7960551 C0.68998853,16.2305145 1.09562888,17.7872135 3.12357076,19.2293357 C3.8146334,19.7207684 5.32369333,20.3834223 7.65075054,21.2172976 L7.59773219,21.2525164 L2.63468769,24.5493413 C0.445452254,26.3002124 0.0884951797,28.5083815 1.56381646,31.1738486 C2.83770406,32.8170431 5.20850219,33.2640127 7.09180128,32.5391577 C8.347334,32.0559211 11.4559176,30.0011079 16.4175519,26.3747182 C18.0338572,24.4997857 18.6973423,22.4544883 18.4080071,20.2388261 C17.963753,17.5346866 16.1776345,15.5799961 13.0496516,14.3747546 L10.9194936,13.4715819 L18.6192054,7.984237 L13.7918663,0.358365126 Z"
                                        id="path-1"></path>
                                    <path
                                        d="M5.47320593,6.00457225 C4.05321814,8.216144 4.36334763,10.0722806 6.40359441,11.5729822 C8.61520715,12.571656 10.0999176,13.2171421 10.8577257,13.5094407 L15.5088241,14.433041 L18.6192054,7.984237 C15.5364148,3.11535317 13.9273018,0.573395879 13.7918663,0.358365126 C13.5790555,0.511491653 10.8061687,2.3935607 5.47320593,6.00457225 Z"
                                        id="path-3"></path>
                                    <path
                                        d="M7.50063644,21.2294429 L12.3234468,23.3159332 C14.1688022,24.7579751 14.3970980,26.4880487 13.0083340,28.506154 C11.6195701,30.5242593 10.3099883,31.7902410 9.07958868,32.3040991 C5.78142938,33.4346997 4.13234973,34 4.13234973,34 C4.13234973,34 2.75489982,33.0538207 2.37032616e-14,31.1614621 C-0.55822714,27.8186216 -0.55822714,26.0572515 -4.05231404e-15,25.8773518 C0.83734071,25.6075023 2.77988457,22.8248993 3.30493790,22.52991 C3.65497346,22.3332504 5.05353963,21.8997614 7.50063644,21.2294429 Z"
                                        id="path-4"></path>
                                    <path
                                        d="M20.6,7.13333333 L25.6,13.8 C26.2627417,14.6836556 26.0836556,15.9372583 25.2,16.6 C24.8538077,16.8596443 24.4327404,17 24,17 L14,17 C12.8954305,17 12,16.1045695 12,15 C12,14.5672596 12.1403557,14.1461923 12.4,13.8 L17.4,7.13333333 C18.0627417,6.24967773 19.3163444,6.07059163 20.2,6.73333333 C20.3516113,6.84704183 20.4862915,6.9817220 20.6,7.13333333 Z"
                                        id="path-5"></path>
                                </defs>
                                <g id="g-app-brand" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <g id="Brand-Logo" transform="translate(-27.000000, -15.000000)">
                                        <g id="Icon" transform="translate(27.000000, 15.000000)">
                                            <g id="Mask" transform="translate(0.000000, 8.000000)">
                                                <mask id="mask-2" fill="white">
                                                    <use xlink:href="#path-1"></use>
                                                </mask>
                                                <use fill="#696cff" xlink:href="#path-1"></use>
                                                <g id="Path-3" mask="url(#mask-2)">
                                                    <use fill="#696cff" xlink:href="#path-3"></use>
                                                    <use fill-opacity="0.2" fill="#FFFFFF" xlink:href="#path-3"></use>
                                                </g>
                                                <g id="Path-4" mask="url(#mask-2)">
                                                    <use fill="#696cff" xlink:href="#path-4"></use>
                                                    <use fill-opacity="0.2" fill="#FFFFFF" xlink:href="#path-4"></use>
                                                </g>
                                            </g>
                                            <g
                                                id="Triangle"
                                                transform="translate(19.000000, 11.000000) rotate(-300.000000) translate(-19.000000, -11.000000) ">
                                                <use fill="#696cff" xlink:href="#path-5"></use>
                                                <use fill-opacity="0.2" fill="#FFFFFF" xlink:href="#path-5"></use>
                                            </g>
                                        </g>
                                    </g>
                                </g>
                            </svg>
                        </span>
                        <span class="app-brand-text demo menu-text fw-bolder ms-2">Sneat</span>
                    </a>

                    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
                        <i class="bx bx-chevron-left bx-sm align-middle"></i>
                    </a>
                </div>

                <div class="menu-inner-shadow"></div>

                <ul class="menu-inner py-1">
                    <!-- Dashboard -->
                    <li class="menu-item">
                        <a href="tc-dashboard.php" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-home-circle"></i>
                            <div data-i18n="Dashboard">Dashboard</div>
                        </a>
                    </li>
                    <!-- / Dashboard -->

                    <!-- Classes -->
                    <li class="menu-header small text-uppercase">
                        <span class="menu-header-text">Classes</span>
                    </li>
                    <li class="menu-item active">
                        <a href="my-classes.php" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-chalkboard"></i>
                            <div data-i18n="My Classes">My Classes</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="my-advisory.php" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-book-open"></i>
                            <div data-i18n="My Advisor">My Advisory</div>
                        </a>
                    </li>
                    <!-- Resources -->
                    <li class="menu-header small text-uppercase">
                        <span class="menu-header-text">Resources</span>
                    </li>
                    <li class="menu-item">
                        <a href="teaching-materials.php" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-book"></i>
                            <div data-i18n="Teaching Materials">Teaching Materials</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="assignments.php" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-task"></i>
                            <div data-i18n="Assignments">Assignments</div>
                        </a>
                    </li>
                </ul>
            </aside>
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->

                <nav
                    class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
                    id="layout-navbar">
                    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
                        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                            <i class="bx bx-menu bx-sm"></i>
                        </a>
                    </div>

                    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
                        <!-- Search -->
                        <div class="navbar-nav align-items-center">
                            <div class="nav-item d-flex align-items-center">
                                <i class="bx bx-search fs-4 lh-0"></i>
                                <input
                                    type="text"
                                    class="form-control border-0 shadow-none"
                                    placeholder="Search..."
                                    aria-label="Search..." />
                            </div>
                        </div>
                        <!-- /Search -->

                        <ul class="navbar-nav flex-row align-items-center ms-auto">


                            <!-- User -->
                            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                                    <div class="avatar avatar-online">
                                        <img src="../assets/img/avatars/default.png" alt class="w-px-40 h-auto rounded-circle" />
                                    </div>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item" href="#">
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 me-3">
                                                    <div class="avatar avatar-online">
                                                       <img src="../assets/img/avatars/default.png" alt class="w-px-40 h-auto rounded-circle" />
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <span class="fw-semibold d-block"> <?php echo $first_name . ' ' . $last_name; ?></span>
                                                    <small class="text-muted">Teacher</small>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="dropdown-divider"></div>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="#">
                                            <i class="bx bx-user me-2"></i>
                                            <span class="align-middle">My Profile</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="#">
                                            <i class="bx bx-cog me-2"></i>
                                            <span class="align-middle">Settings</span>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="dropdown-divider"></div>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="logout.php">
                                            <i class="bx bx-power-off me-2"></i>
                                            <span class="align-middle">Log Out</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <!--/ User -->
                        </ul>
                    </div>
                </nav>

                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->
                    <?php
                    // Database connection
                    include 'db_connection.php';

                    // Define the number of rows per page
                    $rowsPerPage = 8;

                    // Get the current page number from the query string (default to 1 if not set)
                    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                    $page = max($page, 1); // Ensure the page number is at least 1

                    // Calculate the offset for the SQL query
                    $offset = ($page - 1) * $rowsPerPage;
                    ?>

                    <?php
                    // Retrieve the subject_code from the URL or set a default value
                    $subject_code = isset($_GET['subject_code']) ? mysqli_real_escape_string($conn, $_GET['subject_code']) : null;

                    if (!$subject_code) {
                        echo "<div class='alert alert-danger'>Subject code is missing.</div>";
                        exit;
                    }

                    // Fetch the subject_name and section_name based on the subject_code
                    $query_subject = "
                        SELECT 
                            section_subject_teacher.subject_code, 
                            subjects.subject_name, 
                            sections.section_name 
                        FROM 
                            section_subject_teacher
                        INNER JOIN 
                            subjects ON section_subject_teacher.subject_code = subjects.subject_code
                        INNER JOIN 
                            sections ON section_subject_teacher.section_id = sections.section_id
                        WHERE 
                            section_subject_teacher.subject_code = '$subject_code'
                    ";
                    $result_subject = $conn->query($query_subject);

                    if ($result_subject && $result_subject->num_rows > 0) {
                        $row_subject = $result_subject->fetch_assoc();
                        $subject_name = $row_subject['subject_name'];
                        $section_name = $row_subject['section_name'];
                    } else {
                        $subject_name = 'Unknown Subject';
                        $section_name = 'Unknown Section';
                    }
                    ?>
                    <?php
                    // Handle form submission
                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        $subject_code = mysqli_real_escape_string($conn, $_POST['subject_code']);
                        $week = isset($_POST['week']) ? (int)$_POST['week'] : 1; // Default to week 1 if not provided
                        $attendanceData = $_POST['attendance'] ?? [];

                        foreach ($attendanceData as $student_id => $days) {
                            foreach ($days as $day => $status) {
                                $status = mysqli_real_escape_string($conn, $status);
                                $day = mysqli_real_escape_string($conn, $day);

                                // Fetch the subject name based on the subject_code
                                $subjectQuery = "
SELECT subject_name 
FROM subjects 
WHERE subject_code = '$subject_code'
";
                                $subjectResult = $conn->query($subjectQuery);

                                if ($subjectResult && $subjectResult->num_rows > 0) {
                                    $subjectRow = $subjectResult->fetch_assoc();
                                    $subjectName = $subjectRow['subject_name'];
                                } else {
                                    $subjectName = 'Unknown Subject';
                                }

                                // Insert or update attendance record
                                $query = "
                                    INSERT INTO attendance (student_id, subject_code, week, day, status, recorded_by, created_at, term)
                                    VALUES ('$student_id', '$subject_code', '$week', '$day', '$status', '$user_id', NOW(), '1st')
                                    ON DUPLICATE KEY UPDATE 
                                        status = '$status', 
                                        recorded_by = '$user_id', 
                                        created_at = NOW(),
                                        term = '1st'
                                    ";
                                $conn->query($query);

                                // Fetch parent's ID and student details
                                $parentQuery = "
                                    SELECT students.parent_id, students.first_name, students.last_name
                                    FROM students
                                    WHERE students.student_id = '$student_id'
                                    ";
                                $parentResult = $conn->query($parentQuery);

                                if ($parentResult && $parentResult->num_rows > 0) {
                                    $parentRow = $parentResult->fetch_assoc();
                                    $parentId = $parentRow['parent_id'];
                                    $studentName = $parentRow['first_name'] . ' ' . $parentRow['last_name'];

                                    // Insert notification for the parent
                                    $notificationMessage = "Your child, $studentName, has been marked as $status in $subjectName today.";
                                    $notificationQuery = "
                                        INSERT INTO notifications (parent_id, student_id, message, is_read, created_at)
                                        VALUES ('$parentId', '$student_id', '$notificationMessage', 0, NOW())
                                    ";
                                    $conn->query($notificationQuery);
                                }
                            }
                        }

                        echo "<script>
                            const toastElement = document.getElementById('attendanceToast');
                            const toast = new bootstrap.Toast(toastElement);
                            toast.show();
                        </script>";
                    }

                    // Ensure $week is defined before using it in the query
                    $week = isset($_POST['week']) ? (int)$_POST['week'] : 1; // Default to week 1 if not provided

                    // Fetch attendance data for the table
                    $attendanceQuery = "
                        SELECT 
                            students.student_id, 
                            students.last_name,
                            students.first_name,
                            MAX(CASE WHEN attendance.day = 'day1' THEN attendance.status END) AS status_day1,
                            MAX(CASE WHEN attendance.day = 'day2' THEN attendance.status END) AS status_day2,
                            MAX(CASE WHEN attendance.day = 'day3' THEN attendance.status END) AS status_day3
                        FROM 
                            students
                        LEFT JOIN 
                            attendance ON students.student_id = attendance.student_id 
                            AND attendance.subject_code = '$subject_code'
                            AND attendance.week = '$week'
                        WHERE 
                            students.section_id = (SELECT section_id FROM section_subject_teacher WHERE subject_code = '$subject_code')
                        GROUP BY 
                            students.student_id, students.last_name, students.first_name
                    ";
                    $result = $conn->query($attendanceQuery);
                    ?>
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <h4 class="fw-bold py-3 mb-4">Attendance for <?php echo htmlspecialchars($section_name); ?></h4>
                        <div class="card mb-4">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="mb-0" id="attendanceHeading">Week 1 Attendance</h5>
                                <div class="dropdown">
                                    <button class="btn btn-primary dropdown-toggle" type="button" id="weekDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                        Select Week
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="weekDropdown">
                                        <?php for ($i = 1; $i <= 8; $i++): ?>
                                            <li>
                                                <a class="dropdown-item week-selector" href="javascript:void(0);" data-week="<?php echo $i; ?>">
                                                    Week <?php echo $i; ?>
                                                </a>
                                            </li>
                                        <?php endfor; ?>
                                    </ul>
                                </div>
                            </div>
                            <!-- Attendance Form -->
                            <form method="POST" action="" id="attendanceForm">
                                <input type="hidden" name="subject_code" value="<?php echo htmlspecialchars($subject_code); ?>">
                                <input type="hidden" name="week" id="selectedWeek" value="1"> <!-- Default to Week 1 -->
                                <div id="weekTables">
                                    <?php for ($week = 1; $week <= 8; $week++): ?>
                                        <div class="table-responsive text-nowrap week-table" data-week="<?php echo $week; ?>" style="display: <?php echo $week === 1 ? 'block' : 'none'; ?>;">
                                            <table class="table table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Last Name</th>
                                                        <th>First Name</th>
                                                        <th>Day 1</th>
                                                        <th>Day 2</th>
                                                        <th>Day 3</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    // Fetch attendance data for the current week
                                                    $attendanceQuery = "
                                                        SELECT 
                                                            students.student_id, 
                                                            students.last_name,
                                                            students.first_name,
                                                            MAX(CASE WHEN attendance.day = 'day1' THEN attendance.status END) AS status_day1,
                                                            MAX(CASE WHEN attendance.day = 'day2' THEN attendance.status END) AS status_day2,
                                                            MAX(CASE WHEN attendance.day = 'day3' THEN attendance.status END) AS status_day3
                                                        FROM 
                                                            students
                                                        LEFT JOIN 
                                                            attendance ON students.student_id = attendance.student_id 
                                                            AND attendance.subject_code = '$subject_code'
                                                            AND attendance.week = '$week'
                                                        WHERE 
                                                            students.section_id = (SELECT section_id FROM section_subject_teacher WHERE subject_code = '$subject_code')
                                                        GROUP BY 
                                                            students.student_id, students.last_name, students.first_name
                                                    ";
                                                    $result = $conn->query($attendanceQuery);
                                                    ?>
                                                    <?php if ($result->num_rows > 0): ?>
                                                        <?php while ($row = $result->fetch_assoc()): ?>
                                                            <tr>
                                                                <td><?php echo htmlspecialchars($row['last_name']); ?></td>
                                                                <td><?php echo htmlspecialchars($row['first_name']); ?></td>
                                                                <td>
                                                                    <select name="attendance[<?php echo $row['student_id']; ?>][day1]"
                                                                        class="form-select auto-submit"
                                                                        data-student-id="<?php echo $row['student_id']; ?>"
                                                                        data-week="<?php echo $week; ?>"
                                                                        data-day="day1"
                                                                        <?php echo !empty($row['status_day1']) ? 'disabled' : ''; ?>>
                                                                        <option value=""> </option> <!-- Blank option -->
                                                                        <option value="Present" <?php echo ($row['status_day1'] === 'Present') ? 'selected' : ''; ?>>Present</option>
                                                                        <option value="Absent" <?php echo ($row['status_day1'] === 'Absent') ? 'selected' : ''; ?>>Absent</option>
                                                                        <option value="Late" <?php echo ($row['status_day1'] === 'Late') ? 'selected' : ''; ?>>Late</option>
                                                                        <option value="Excused" <?php echo ($row['status_day1'] === 'Excused') ? 'selected' : ''; ?>>Excused</option>
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <select name="attendance[<?php echo $row['student_id']; ?>][day2]"
                                                                        class="form-select auto-submit"
                                                                        data-student-id="<?php echo $row['student_id']; ?>"
                                                                        data-week="<?php echo $week; ?>"
                                                                        data-day="day2"
                                                                        <?php echo !empty($row['status_day2']) ? 'disabled' : ''; ?>>
                                                                        <option value=""> </option> <!-- Blank option -->
                                                                        <option value="Present" <?php echo ($row['status_day2'] === 'Present') ? 'selected' : ''; ?>>Present</option>
                                                                        <option value="Absent" <?php echo ($row['status_day2'] === 'Absent') ? 'selected' : ''; ?>>Absent</option>
                                                                        <option value="Late" <?php echo ($row['status_day2'] === 'Late') ? 'selected' : ''; ?>>Late</option>
                                                                        <option value="Excused" <?php echo ($row['status_day2'] === 'Excused') ? 'selected' : ''; ?>>Excused</option>
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <select name="attendance[<?php echo $row['student_id']; ?>][day3]"
                                                                        class="form-select auto-submit"
                                                                        data-student-id="<?php echo $row['student_id']; ?>"
                                                                        data-week="<?php echo $week; ?>"
                                                                        data-day="day3"
                                                                        <?php echo !empty($row['status_day3']) ? 'disabled' : ''; ?>>
                                                                        <option value=""> </option> <!-- Blank option -->
                                                                        <option value="Present" <?php echo ($row['status_day3'] === 'Present') ? 'selected' : ''; ?>>Present</option>
                                                                        <option value="Absent" <?php echo ($row['status_day3'] === 'Absent') ? 'selected' : ''; ?>>Absent</option>
                                                                        <option value="Late" <?php echo ($row['status_day3'] === 'Late') ? 'selected' : ''; ?>>Late</option>
                                                                        <option value="Excused" <?php echo ($row['status_day3'] === 'Excused') ? 'selected' : ''; ?>>Excused</option>
                                                                    </select>
                                                                </td>
                                                            </tr>
                                                        <?php endwhile; ?>
                                                    <?php else: ?>
                                                        <tr>
                                                            <td colspan="5" class="text-center">No students found for Week <?php echo $week; ?>.</td>
                                                        </tr>
                                                    <?php endif; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    <?php endfor; ?>
                                </div>
                            </form>
                        </div>
                        <!-- Toast Container -->
                        <div class="toast-container position-fixed bottom-0 end-0 p-3">
                            <div id="attendanceToast" class="toast align-items-center text-bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
                                <div class="d-flex">
                                    <div class="toast-body">
                                        Attendance successfully recorded!
                                    </div>
                                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                                </div>
                            </div>
                        </div>
                        <!-- Pagination -->
                        <nav aria-label="Classes Pagination">
                            <ul class="pagination justify-content-center mt-3">
                                <?php if ($page > 1): ?>
                                    <li class="page-item">
                                        <a class="page-link" href="?page=<?php echo $page - 1; ?>" aria-label="Previous">
                                            <span aria-hidden="true">&laquo;</span>
                                        </a>
                                    </li>
                                <?php endif; ?>

                                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                                    <li class="page-item <?php echo ($i == $page) ? 'active' : ''; ?>">
                                        <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                                    </li>
                                <?php endfor; ?>

                                <?php if ($page < $totalPages): ?>
                                    <li class="page-item">
                                        <a class="page-link" href="?page=<?php echo $page + 1; ?>" aria-label="Next">
                                            <span aria-hidden="true">&raquo;</span>
                                        </a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </nav>
                    </div>
                    <!-- / Content -->
                    <!-- Footer -->
                    <footer class="content-footer footer bg-footer-theme">
                        <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                            <div class="mb-2 mb-md-0">
                                ©
                                <script>
                                    document.write(new Date().getFullYear());
                                </script>
                                , developed by
                                <a href="#" class="footer-link fw-bolder">ioloverse00</a>
                            </div>
                        </div>
                    </footer>
                    <!-- / Footer -->

                    <div class="content-backdrop fade"></div>
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="../assets/vendor/libs/jquery/jquery.js"></script>
    <script src="../assets/vendor/libs/popper/popper.js"></script>
    <script src="../assets/vendor/js/bootstrap.js"></script>
    <script src="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="../assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="../assets/vendor/libs/apex-charts/apexcharts.js"></script>

    <!-- Main JS -->
    <script src="../assets/js/main.js"></script>


    <script src="../assets/js/dashboards-analytics.js"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>

    <!-- Add this script before the closing body tag -->
    <script>
        // Force the browser to reload the page when navigating back
        window.addEventListener("pageshow", function(event) {
            if (event.persisted || (window.performance && window.performance.navigation.type === 2)) {
                window.location.reload();
            }
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const rows = document.querySelectorAll(".clickable-row");
            rows.forEach(row => {
                row.addEventListener("click", function() {
                    window.location.href = this.dataset.href;
                });
            });
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const dropdowns = document.querySelectorAll(".auto-submit");
            dropdowns.forEach(function(dropdown) {
                dropdown.addEventListener("change", function() {
                    // Create a new form
                    const form = document.createElement("form");
                    form.method = "POST";
                    form.action = "";

                    // Add the subject_code as a hidden input
                    const subjectCodeInput = document.createElement("input");
                    subjectCodeInput.type = "hidden";
                    subjectCodeInput.name = "subject_code";
                    subjectCodeInput.value = "<?php echo htmlspecialchars($subject_code); ?>";
                    form.appendChild(subjectCodeInput);

                    // Add the student_id, week, day, and status as hidden inputs
                    const studentIdInput = document.createElement("input");
                    studentIdInput.type = "hidden";
                    studentIdInput.name = `attendance[${dropdown.dataset.studentId}][${dropdown.dataset.day}]`;
                    studentIdInput.value = dropdown.value;
                    form.appendChild(studentIdInput);

                    const weekInput = document.createElement("input");
                    weekInput.type = "hidden";
                    weekInput.name = "week";
                    weekInput.value = dropdown.dataset.week;
                    form.appendChild(weekInput);

                    const dayInput = document.createElement("input");
                    dayInput.type = "hidden";
                    dayInput.name = "day";
                    dayInput.value = dropdown.dataset.day;
                    form.appendChild(dayInput);

                    // Append the form to the body and submit it
                    document.body.appendChild(form);
                    form.submit();

                    // Show the toast notification
                    const toastElement = document.getElementById("attendanceToast");
                    const toast = new bootstrap.Toast(toastElement);
                    toast.show();
                });
            });
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const weekSelectors = document.querySelectorAll(".week-selector");
            const weekTables = document.querySelectorAll(".week-table");
            const selectedWeekInput = document.getElementById("selectedWeek");
            const attendanceHeading = document.getElementById("attendanceHeading");

            weekSelectors.forEach(selector => {
                selector.addEventListener("click", function() {
                    const selectedWeek = this.dataset.week;
                    selectedWeekInput.value = selectedWeek;

                    // Update the heading text
                    attendanceHeading.textContent = `Week ${selectedWeek} Attendance`;

                    // Show the selected week's table and hide others
                    weekTables.forEach(table => {
                        table.style.display = table.dataset.week === selectedWeek ? "block" : "none";
                    });
                });
            });
        });
    </script>
</body>

</html>