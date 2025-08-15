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

// Fetch the parent's child from the students table
$parent_id = $_SESSION['user_id']; // Assuming the parent's ID is stored in the session

// Sanitize the parent_id to prevent SQL injection
$parent_id = mysqli_real_escape_string($conn, $parent_id);

// Query to fetch the child details
$query_child = "SELECT first_name, middle_name, last_name FROM students WHERE parent_id = '$parent_id'";
$result_child = mysqli_query($conn, $query_child);

if ($result_child && mysqli_num_rows($result_child) > 0) {
    $row_child = mysqli_fetch_assoc($result_child);
    $child_name = $row_child['first_name'] . ' ' . $row_child['middle_name'] . ' ' . $row_child['last_name'];
} else {
    $child_name = 'No child found';
}

// Fetch additional student details, including the adviser's name
$query_student_details = "
    SELECT 
        students.grade_level, 
        sections.strand, 
        sections.section_name AS section, 
        CONCAT(users.first_name, ' ', users.last_name) AS adviser_name, 
        sections.schedule 
    FROM students 
    LEFT JOIN sections ON students.section_id = sections.section_id 
    LEFT JOIN users ON sections.adviser_id = users.user_id 
    WHERE students.parent_id = '$parent_id'
";
$result_student_details = mysqli_query($conn, $query_student_details);

if ($result_student_details && mysqli_num_rows($result_student_details) > 0) {
    $row_details = mysqli_fetch_assoc($result_student_details);
    $grade_level = $row_details['grade_level'];
    $strand = $row_details['strand'];
    $section = $row_details['section'];
    $adviser = $row_details['adviser_name'] ?? 'No adviser assigned'; // Adviser's name
    $schedule = $row_details['schedule'] ?? 'No schedule available';
} else {
    $grade_level = 'N/A';
    $strand = 'N/A';
    $section = 'N/A';
    $adviser = 'N/A';
    $schedule = 'N/A';
}

// Fetch the student's ID based on the parent's ID
$query_student_id = "
    SELECT student_id 
    FROM students 
    WHERE parent_id = '$parent_id'
";
$result_student_id = mysqli_query($conn, $query_student_id);

if ($result_student_id && mysqli_num_rows($result_student_id) > 0) {
    $row_student_id = mysqli_fetch_assoc($result_student_id);
    $student_id = $row_student_id['student_id'];
} else {
    $student_id = null; // No student found
}

// Fetch total lates
$query_lates = "
    SELECT COUNT(*) AS total_lates 
    FROM attendance 
    WHERE student_id = '$student_id' AND status = 'Late'
";
$result_lates = mysqli_query($conn, $query_lates);
$total_lates = ($result_lates && mysqli_num_rows($result_lates) > 0) ? mysqli_fetch_assoc($result_lates)['total_lates'] : 0;

// Fetch total absences
$query_absences = "
    SELECT COUNT(*) AS total_absences 
    FROM attendance 
    WHERE student_id = '$student_id' AND status = 'Absent'
";
$result_absences = mysqli_query($conn, $query_absences);
$total_absences = ($result_absences && mysqli_num_rows($result_absences) > 0) ? mysqli_fetch_assoc($result_absences)['total_absences'] : 0;

// Fetch total present
$query_present = "
    SELECT COUNT(*) AS total_present 
    FROM attendance 
    WHERE student_id = '$student_id' AND status = 'Present'
";
$result_present = mysqli_query($conn, $query_present);
$total_present = ($result_present && mysqli_num_rows($result_present) > 0) ? mysqli_fetch_assoc($result_present)['total_present'] : 0;

// Query to fetch core subjects the student is enrolled in
$query_core_subjects = "
    SELECT subjects.subject_code 
    FROM subjects
    INNER JOIN student_subjects ON subjects.subject_code = student_subjects.subject_code
    WHERE subjects.subject_type = 'Core' AND student_subjects.student_id = '$student_id'
";
$result_core_subjects = mysqli_query($conn, $query_core_subjects);

// Query to fetch specialized subjects the student is enrolled in
$query_specialized_subjects = "
    SELECT subjects.subject_code 
    FROM subjects
    INNER JOIN student_subjects ON subjects.subject_code = student_subjects.subject_code
    WHERE subjects.subject_type = 'Specialized' AND student_subjects.student_id = '$student_id'
";
$result_specialized_subjects = mysqli_query($conn, $query_specialized_subjects);
?>
<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="../assets/" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>Dashboard</title>
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
                                        d="M7.50063644,21.2294429 L12.3234468,23.3159332 C14.1688022,24.7579751 14.397098,26.4880487 13.008334,28.506154 C11.6195701,30.5242593 10.3099883,31.790241 9.07958868,32.3040991 C5.78142938,33.4346997 4.13234973,34 4.13234973,34 C4.13234973,34 2.75489982,33.0538207 2.37032616e-14,31.1614621 C-0.55822714,27.8186216 -0.55822714,26.0572515 -4.05231404e-15,25.8773518 C0.83734071,25.6075023 2.77988457,22.8248993 3.3049379,22.52991 C3.65497346,22.3332504 5.05353963,21.8997614 7.50063644,21.2294429 Z"
                                        id="path-4"></path>
                                    <path
                                        d="M20.6,7.13333333 L25.6,13.8 C26.2627417,14.6836556 26.0836556,15.9372583 25.2,16.6 C24.8538077,16.8596443 24.4327404,17 24,17 L14,17 C12.8954305,17 12,16.1045695 12,15 C12,14.5672596 12.1403557,14.1461923 12.4,13.8 L17.4,7.13333333 C18.0627417,6.24967773 19.3163444,6.07059163 20.2,6.73333333 C20.3516113,6.84704183 20.4862915,6.981722 20.6,7.13333333 Z"
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
                    <li class="menu-item active">
                        <a href="p-dashboard.php" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-home-circle"></i>
                            <div data-i18n="Dashboard">Dashboard</div>
                        </a>
                    </li>
                    <!-- / Dashboard -->

                    <!-- Classes -->
                    <li class="menu-header small text-uppercase">
                        <span class="menu-header-text">Enrolled Subjects</span>
                    </li>
                    <li class="menu-item">
                        <a href="javascript:void(0)" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons bx bx-bulb"></i>
                            <div data-i18n="Extended UI">Core</div>
                        </a>
                        <ul class="menu-sub">
                            <?php if ($result_core_subjects && mysqli_num_rows($result_core_subjects) > 0): ?>
                                <?php while ($subject = mysqli_fetch_assoc($result_core_subjects)): ?>
                                    <li class="menu-item">
                                        <a href="subject-performance.php?subject=<?php echo urlencode($subject['subject_code']); ?>" class="menu-link">
                                            <div data-i18n="Connections"><?php echo htmlspecialchars($subject['subject_code']); ?></div>
                                        </a>
                                    </li>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <li class="menu-item">
                                    <a href="javascript:void(0)" class="menu-link">
                                        <div data-i18n="Connections">No Core Subjects Found</div>
                                    </a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </li>
                    <li class="menu-item">
                        <a href="javascript:void(0)" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons bx bx-star"></i>
                            <div data-i18n="Extended UI">Specialized</div>
                        </a>
                        <ul class="menu-sub">
                            <?php if ($result_specialized_subjects && mysqli_num_rows($result_specialized_subjects) > 0): ?>
                                <?php while ($subject = mysqli_fetch_assoc($result_specialized_subjects)): ?>
                                    <li class="menu-item">
                                        <a href="subject-performance.php?subject=<?php echo urlencode($subject['subject_code']); ?>" class="menu-link">
                                            <div data-i18n="Connections"><?php echo htmlspecialchars($subject['subject_code']); ?></div>
                                        </a>
                                    </li>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <li class="menu-item">
                                    <a href="javascript:void(0)" class="menu-link">
                                        <div data-i18n="Connections">No Specialized Subjects Found</div>
                                    </a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </li>
                    <!-- Resources -->
                    <li class="menu-header small text-uppercase">
                        <span class="menu-header-text">Print Grade</span>
                    </li>
                    <li class="menu-item">
                        <a href="#" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-printer"></i>
                            <div data-i18n="Teaching Materials">Generate PDF</div>
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
                                                    <small class="text-muted">Parent</small>
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

                    <div class="container-xxl flex-grow-1 container-p-y">
                        <div class="row">
                            <div class="col-lg-8 mb-4 order-0">
                                <div class="card">
                                    <div class="d-flex align-items-end row">
                                        <div class="col-sm-7">
                                            <div class="card-body">
                                                <h5 class="card-title text-primary">
                                                    <?php echo $child_name; ?>
                                                </h5>
                                                <small class="mb-4">
                                                    Grade Level: <span class="fw-bold"><?php echo $grade_level; ?></span><br>
                                                    Strand: <span class="fw-bold"><?php
                                                                                    if ($strand == 'ICT') {
                                                                                        echo 'Information and Communication Technology';
                                                                                    } elseif ($strand == 'STEM') {
                                                                                        echo 'Science Technology Engineering and Mathematics';
                                                                                    } elseif ($strand == 'ABM') {
                                                                                        echo 'Accountancy Business and Management';
                                                                                    } elseif ($strand == 'HUMSS') {
                                                                                        echo 'Humanities and Social Sciences';
                                                                                    } else {
                                                                                        echo 'Unknown Strand';
                                                                                    }
                                                                                    ?></span><br>
                                                    Section: <span class="fw-bold"><?php echo $section; ?></span><br>
                                                    Adviser: <span class="fw-bold"><?php echo $adviser; ?></span><br>
                                                    Schedule: <span class="fw-bold"><?php echo $schedule; ?></span>
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Modify the parent container to use flexbox -->
                            <div class="col-lg-4 col-md-4 order-1">
                                <div class="row d-flex align-items-stretch">
                                    <div class="col-lg-6 col-md-12 col-6 mb-4 flex-grow-1">
                                        <div class="card h-100">
                                            <div class="card-body">
                                                <div class="card-title d-flex align-items-start justify-content-between">
                                                    <div class="avatar flex-shrink-0">
                                                        <i class="bx bxs-user text-primary fs-1"></i>
                                                    </div>
                                                </div>
                                                <span class="fw-semibold d-block mb-1">Present</span>
                                                <h3 class="card-title mb-2"><?php echo $total_present; ?></h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Total Revenue -->
                            <div class="col-12 col-lg-8 order-2 order-md-3 order-lg-2 mb-4">
                                <div class="card">
                                    <div class="card h-100">
                                        <div class="card-header d-flex align-items-center justify-content-between">
                                            <h5 class="card-title mb-0">Notifications</h5>
                                            <small class="text-muted">Recent Notifications</small>
                                        </div>
                                        <div class="card-body px-0">
                                            <ul class="list-group list-group-flush">
                                                <?php
                                                // Fetch the latest 5 notifications for the parent
                                                $notificationsQuery = "
                                                    SELECT message, type, created_at
                                                    FROM notifications
                                                    WHERE parent_id = '$parent_id'
                                                    ORDER BY created_at DESC
                                                    LIMIT 5
                                                ";
                                                $notificationsResult = mysqli_query($conn, $notificationsQuery);

                                                if ($notificationsResult && mysqli_num_rows($notificationsResult) > 0):
                                                    while ($notification = mysqli_fetch_assoc($notificationsResult)):
                                                        // Determine the icon based on the notification type
                                                        $iconClass = 'bx bx-info-circle'; // Default icon
                                                        $iconBgClass = 'bg-label-secondary'; // Default background color

                                                        if ($notification['type'] === 'Attendance') {
                                                            $iconClass = 'bx bx-time'; // Clock icon for attendance
                                                            $iconBgClass = 'bg-label-warning';
                                                        } elseif ($notification['type'] === 'Activity') {
                                                            $iconClass = 'bx bx-pencil'; // Pencil icon for activity
                                                            $iconBgClass = 'bg-label-primary';
                                                        } elseif ($notification['type'] === 'Performance Task') {
                                                            $iconClass = 'bx bx-line-chart'; // Chart icon for performance
                                                            $iconBgClass = 'bg-label-secondary';
                                                        } elseif ($notification['type'] === 'Examination') {
                                                            $iconClass = 'bx bx-file'; // File icon for examination
                                                            $iconBgClass = 'bg-label-success';
                                                        }
                                                ?>
                                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                                            <div class="d-flex align-items-center">
                                                                <div class="avatar flex-shrink-0 me-3">
                                                                    <span class="avatar-initial rounded-circle <?php echo $iconBgClass; ?>">
                                                                        <i class="<?php echo $iconClass; ?>"></i>
                                                                    </span>
                                                                </div>
                                                                <div>
                                                                    <h6 class="mb-0">
                                                                        <?php echo ucfirst($notification['type']); ?>
                                                                    </h6>
                                                                    <small class="text-muted"><?php echo htmlspecialchars($notification['message']); ?></small>
                                                                </div>
                                                            </div>
                                                            <span class="badge <?php echo $iconBgClass; ?> rounded-pill">
                                                                <?php echo date('M d, Y | h:i:s A', strtotime($notification['created_at'])); ?>
                                                            </span>
                                                        </li>
                                                    <?php endwhile;
                                                else: ?>
                                                    <li class="list-group-item">
                                                        <div class="d-flex align-items-center">
                                                            <div class="avatar flex-shrink-0 me-3">
                                                                <span class="avatar-initial rounded-circle bg-label-secondary">
                                                                    <i class="bx bx-info-circle"></i>
                                                                </span>
                                                            </div>
                                                            <div>
                                                                <h6 class="mb-0">No Notifications</h6>
                                                                <small class="text-muted">You have no new notifications.</small>
                                                            </div>
                                                        </div>
                                                    </li>
                                                <?php endif; ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--/ Total Revenue -->
                            <div class="col-12 col-md-8 col-lg-4 order-3 order-md-2">
                                <div class="row">
                                    <div class="col-12 mb-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="card-title d-flex align-items-start justify-content-between">
                                                    <div class="avatar flex-shrink-0">
                                                        <i class="bx bx-id-card text-warning fs-1"></i>
                                                    </div>
                                                </div>
                                                <span class="d-block mb-1">Absences</span>
                                                <h3 class="card-title text-nowrap mb-2"><?php echo $total_absences; ?></h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 mb-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="card-title d-flex align-items-start justify-content-between">
                                                <div class="avatar flex-shrink-0">
                                                    <i class="bx bxs-group text-success fs-1"></i>
                                                </div>
                                            </div>
                                            <span class="d-block mb-1">Lates</span>
                                            <h3 class="card-title text-nowrap mb-2"><?php echo $total_lates; ?></h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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

    <!-- Page JS -->
    <script>
        const yearlyStudentsData = <?php echo json_encode($yearly_students_data); ?>;
        const strandsData = <?php echo json_encode($strands_data); ?>;
    </script>
    <script src="chart.js"></script>

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
</body>

</html>