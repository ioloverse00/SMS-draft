<?php
session_start();
?>

<!DOCTYPE html>
<html
    lang="en"
    class="light-style layout-menu-fixed"
    dir="ltr"
    data-theme="theme-default"
    data-assets-path="../assets/"
    data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Enrolees | Grade 11</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700&display=swap"
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
                    <li class="menu-item">
                        <a href="index.php" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-home-circle"></i>
                            <div data-i18n="Analytics">Dashboard</div>
                        </a>
                    </li>
                    <!-- / Dashboard -->

                    <!-- Users -->
                    <li class="menu-header small text-uppercase">
                        <span class="menu-header-text">Users</span>
                    </li>
                    <li class="menu-item">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons bx bxs-user-account"></i>
                            <div data-i18n="Form Elements">Accounts</div>
                        </a>
                        <ul class="menu-sub">
                            <li class="menu-item">
                                <a href="parents.php" class="menu-link">
                                    <div data-i18n="Input groups">Parents Accounts</div>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="teachers.php" class="menu-link">
                                    <div data-i18n="Input groups">Teachers Accounts</div>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <!-- Strands -->
                    <li class="menu-header small text-uppercase">
                        <span class="menu-header-text">Strands</span>
                    </li>
                    <li class="menu-item">
                        <a href="javascript:void(0)" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons bx bx-coin-stack"></i>
                            <div data-i18n="Extended UI">ABM</div>
                        </a>
                        <ul class="menu-sub">
                            <li class="menu-item">
                                <a href="abm-subjects.php" class="menu-link">
                                    <div data-i18n="Account">Subjects</div>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="abm-sections.php" class="menu-link">
                                    <div data-i18n="Connections">Sections</div>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="menu-item">
                        <a href="javascript:void(0)" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons bx bxs-bong"></i>
                            <div data-i18n="Extended UI">STEM</div>
                        </a>
                        <ul class="menu-sub">
                            <li class="menu-item">
                                <a href="stem-subjects.php" class="menu-link">
                                    <div data-i18n="Account">Subjects</div>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="stem-sections.php" class="menu-link">
                                    <div data-i18n="Connections">Students</div>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="menu-item">
                        <a href="javascript:void(0)" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons bx bx-home-alt"></i>
                            <div data-i18n="Extended UI">HUMSS</div>
                        </a>
                        <ul class="menu-sub">
                            <li class="menu-item">
                                <a href="humss-subjects.php" class="menu-link">
                                    <div data-i18n="Account">Subjects</div>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="humss-sections.php" class="menu-link">
                                    <div data-i18n="Connections">Students</div>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="menu-item">
                        <a href="javascript:void(0)" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons bx bx-desktop"></i>
                            <div data-i18n="Extended UI">ICT</div>
                        </a>
                        <ul class="menu-sub">
                            <li class="menu-item">
                                <a href="ict-subjects.php" class="menu-link">
                                    <div data-i18n="Account">Subjects</div>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="ict-sections.php" class="menu-link">
                                    <div data-i18n="Connections">Students</div>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <!-- / Strands -->

                    <!-- Enrolees -->
                    <li class="menu-header small text-uppercase">
                        <span class="menu-header-text">Enrolees</span>
                    </li>
                    <li class="menu-item  active open">
                        <a href="javascript:void(0)" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons bx bx-server"></i>
                            <div data-i18n="Extended UI">Grade Level</div>
                        </a>
                        <ul class="menu-sub">
                            <li class="menu-item active">
                                <a href="students_11.php" class="menu-link">
                                    <div data-i18n="Account">Grade 11</div>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="students_12.php" class="menu-link">
                                    <div data-i18n="Connections">Grade 12</div>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <!-- / Enrolees -->

                    <!-- Staffs -->
                    <li class="menu-header small text-uppercase">
                        <span class="menu-header-text">Staffs</span>
                    </li>
                    <li class="menu-item">
                        <a href="javascript:void(0)" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons bx bx-group"></i>
                            <div data-i18n="Extended UI">Faculty</div>
                        </a>
                        <ul class="menu-sub">
                            <li class="menu-item">
                                <a href="#" class="menu-link">
                                    <div data-i18n="Account">Admins</div>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="teachers_info.php" class="menu-link">
                                    <div data-i18n="Connections">Teachers</div>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <!-- / Staffs -->
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
                                                    <span class="fw-semibold d-block">John Doe</span>
                                                    <small class="text-muted">Admin</small>
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
                    <!-- Students Table -->
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <h4 class="fw-bold py-3 mb-4">Grade 11 Enrolees</h4>
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">Students</h5>
                                <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#addStudentModal">Add New Student</button>
                            </div>
                            <div class="table-responsive text-nowrap">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Student ID</th>
                                            <th>Full Name</th>
                                            <th>Sex</th>
                                            <th>Birthdate</th>
                                            <th>Address</th>
                                            <th>Section</th>
                                            <th>Parent/Guardian</th>
                                            <th>Enrolled Date</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // Database connection
                                        include 'db_connection.php';

                                        // Fetch students data with section name
                                        $query = "SELECT students.student_id, students.first_name, students.middle_name, students.last_name, students.gender, students.birthdate, students.address, students.grade_level, sections.section_id, sections.section_name, students.parent_id, users.first_name AS parent_first_name, users.last_name AS parent_last_name, students.created_at 
                                                  FROM students 
                                                  JOIN sections ON students.section_id = sections.section_id
                                                  JOIN users ON students.parent_id = users.user_id
                                                  WHERE students.grade_level = '11'";
                                        $result = $conn->query($query);

                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                $full_name = $row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['last_name'];
                                                echo "<tr>";
                                                echo "<td>" . $row['student_id'] . "</td>";
                                                echo "<td>" . $full_name . "</td>";
                                                echo "<td>" . $row['gender'] . "</td>";
                                                echo "<td>" . $row['birthdate'] . "</td>";
                                                echo "<td>" . $row['address'] . "</td>";
                                                echo "<td>" . $row['section_name'] . "</td>";
                                                echo "<td>" . $row['parent_first_name'] . " " . $row['parent_last_name'] . "</td>";
                                                echo "<td>" . $row['created_at'] . "</td>";
                                                echo "<td>
                                                        <button 
                                                            class='btn btn-sm btn-primary' 
                                                            data-bs-toggle='modal' 
                                                            data-bs-target='#editStudentModal'
                                                            data-id='" . $row['student_id'] . "'
                                                            data-name='" . $full_name . "'
                                                            data-gender='" . $row['gender'] . "'
                                                            data-birthdate='" . $row['birthdate'] . "'
                                                            data-address='" . $row['address'] . "'
                                                            data-section='" . $row['section_id'] . "'
                                                            data-parent='" . $row['parent_first_name'] . " " . $row['parent_last_name'] . "'
                                                            >
                                                            Edit
                                                        </button>
                                                        <button 
                                                            class='btn btn-sm btn-danger' 
                                                            data-bs-toggle='modal' 
                                                            data-bs-target='#deleteStudentModal' 
                                                            data-id='" . $row['student_id'] . "'>
                                                            Remove
                                                        </button>
                                                      </td>";
                                                echo "</tr>";
                                            }
                                        } else {
                                            echo "<tr><td colspan='9' class='text-center'>No students found</td></tr>";
                                        }

                                        $conn->close();
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Add the modals below the table or at the end of the body -->

                    <!-- Add New Student Modal -->
                    <div class="modal fade" id="addStudentModal" tabindex="-1" aria-labelledby="addStudentModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="addStudentModalLabel">Add New Student</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form id="addStudentForm" method="POST" action="add_student.php">
                                        <div class="mb-3">
                                            <label for="addStudentName" class="form-label">Full Name (First Middle Last)</label>
                                            <input type="text" class="form-control" id="addStudentName" name="addStudentName" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="addStudentGender" class="form-label">Sex</label>
                                            <select class="form-select" id="addStudentGender" name="addStudentGender" required>
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="addStudentBirthdate" class="form-label">Birthdate</label>
                                            <input type="date" class="form-control" id="addStudentBirthdate" name="addStudentBirthdate" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="addStudentAddress" class="form-label">Address</label>
                                            <input type="text" class="form-control" id="addStudentAddress" name="addStudentAddress" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="addStudentSection" class="form-label">Section</label>
                                            <select class="form-select" id="addStudentSection" name="addStudentSection" required>
                                                <option value="" disabled selected>Select Section</option>
                                                <?php
                                                include 'db_connection.php';

                                                // Fetch sections with grade level 11
                                                $sectionQuery = "
                                                    SELECT section_id, section_name 
                                                    FROM sections 
                                                    WHERE grade_level = '11'
                                                    ORDER BY section_name ASC
                                                ";
                                                $sectionResult = $conn->query($sectionQuery);

                                                if ($sectionResult->num_rows > 0) {
                                                    while ($sectionRow = $sectionResult->fetch_assoc()) {
                                                        $sectionId = $sectionRow['section_id'];
                                                        $sectionName = $sectionRow['section_name'];
                                                        echo "<option value='$sectionId'>$sectionName</option>";
                                                    }
                                                } else {
                                                    echo "<option value='' disabled>No sections found</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="addStudentParent" class="form-label">Parent/Guardian</label>
                                            <select class="form-select" id="addStudentParent" name="addStudentParent" required>
                                                <option value="" disabled selected>Select Parent/Guardian</option>
                                                <?php
                                                include 'db_connection.php';

                                                // Fetch parents who do not have an associated student
                                                $parentQuery = "
                                                    SELECT users.user_id, users.first_name, users.last_name 
                                                    FROM users 
                                                    LEFT JOIN students ON users.user_id = students.parent_id 
                                                    WHERE users.user_id LIKE 'p%' AND students.parent_id IS NULL
                                                ";
                                                $parentResult = $conn->query($parentQuery);

                                                if ($parentResult->num_rows > 0) {
                                                    while ($parentRow = $parentResult->fetch_assoc()) {
                                                        $parentId = $parentRow['user_id'];
                                                        $parentName = $parentRow['first_name'] . ' ' . $parentRow['last_name'];
                                                        echo "<option value='$parentId'>$parentName</option>";
                                                    }
                                                } else {
                                                    echo "<option value='' disabled>No parents found</option>";
                                                }
                                                ?>
                                            </select>
                                            <input type="hidden" name="grade_level" value="11">
                                        </div>
                                        <button type="submit" class="btn btn-success">Add Student</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Edit Student Modal -->
                    <div class="modal fade" id="editStudentModal" tabindex="-1" aria-labelledby="editStudentModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editStudentModalLabel">Edit Student</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form id="editStudentForm" method="POST" action="edit-student.php">
                                        <div class="row">
                                            <!-- Left Side: Student Details -->
                                            <div class="col-md-6">
                                                <input type="hidden" id="editStudentId" name="student_id">

                                                <div class="mb-3">
                                                    <label for="editStudentName" class="form-label">Full Name (First Middle Last)</label>
                                                    <input type="text" class="form-control" id="editStudentName" name="editStudentName" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="editStudentGender" class="form-label">Sex</label>
                                                    <select class="form-select" id="editStudentGender" name="editStudentGender" required>
                                                        <option value="Male">Male</option>
                                                        <option value="Female">Female</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="editStudentBirthdate" class="form-label">Birthdate</label>
                                                    <input type="date" class="form-control" id="editStudentBirthdate" name="editStudentBirthdate" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="editStudentAddress" class="form-label">Address</label>
                                                    <input type="text" class="form-control" id="editStudentAddress" name="editStudentAddress" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="editStudentSection" class="form-label">Section</label>
                                                    <select class="form-select" id="editStudentSection" name="editStudentSection" required>
                                                        <option value="" disabled selected>Select Section</option>
                                                        <?php
                                                        include 'db_connection.php';

                                                        // Fetch sections with grade level 11
                                                        $sectionQuery = "
                                                            SELECT section_id, section_name 
                                                            FROM sections 
                                                            WHERE grade_level = '11'
                                                            ORDER BY section_name ASC
                                                        ";
                                                        $sectionResult = $conn->query($sectionQuery);

                                                        if ($sectionResult->num_rows > 0) {
                                                            while ($sectionRow = $sectionResult->fetch_assoc()) {
                                                                $sectionId = $sectionRow['section_id'];
                                                                $sectionName = $sectionRow['section_name'];
                                                                echo "<option value='$sectionId'>$sectionName</option>";
                                                            }
                                                        } else {
                                                            echo "<option value='' disabled>No sections found</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="editStudentParent" class="form-label">Parent/Guardian</label>
                                                    <select class="form-select" id="editStudentParent" name="editStudentParent" required>
                                                        <option value="" disabled>Select Parent/Guardian</option>
                                                        <?php
                                                        include 'db_connection.php';

                                                        // Fetch all parents
                                                        $parentQuery = "
                                                            SELECT users.user_id, users.first_name, users.last_name 
                                                            FROM users 
                                                            WHERE users.user_id LIKE 'p%'
                                                        ";
                                                        $parentResult = $conn->query($parentQuery);

                                                        if ($parentResult->num_rows > 0) {
                                                            while ($parentRow = $parentResult->fetch_assoc()) {
                                                                $parentId = $parentRow['user_id'];
                                                                $parentName = $parentRow['first_name'] . ' ' . $parentRow['last_name'];
                                                                echo "<option value='$parentId'>$parentName</option>";
                                                            }
                                                        } else {
                                                            echo "<option value='' disabled>No parents found</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <!-- Right Side: Subjects -->
                                            <div class="col-md-6">
                                                <h5>Enrolled Subjects</h5>
                                                <hr>
                                                <h6>CORE</h6>
                                                <div id="studentCoreSubjects" class="row"></div>
                                                <hr>
                                                <h6>SPECIALIZED</h6>
                                                <div id="studentSpecializedSubjects" class="row"></div>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary mt-3">Save Changes</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Delete Student Modal -->
                    <div class="modal fade" id="deleteStudentModal" tabindex="-1" aria-labelledby="deleteStudentModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form id="deleteStudentForm" method="POST" action="delete-student.php">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteStudentModalLabel">Remove Student</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Are you sure you want to remove this student?</p>
                                        <!-- Hidden input to pass the student ID -->
                                        <input type="hidden" id="deleteStudentId" name="student_id">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-danger">Remove</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

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

    <script src="chart.js"></script>

    <script src="../assets/js/dashboards-analytics.js"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>

    <script>
        var editStudentModal = document.getElementById('editStudentModal');
        editStudentModal.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget;

            var studentId = button.getAttribute('data-id');
            var studentName = button.getAttribute('data-name');
            var studentGender = button.getAttribute('data-gender');
            var studentBirthdate = button.getAttribute('data-birthdate');
            var studentAddress = button.getAttribute('data-address');
            var studentSection = button.getAttribute('data-section');
            var studentParent = button.getAttribute('data-parent');

            var modalStudentId = editStudentModal.querySelector('#editStudentId');
            var modalStudentName = editStudentModal.querySelector('#editStudentName');
            var modalStudentGender = editStudentModal.querySelector('#editStudentGender');
            var modalStudentBirthdate = editStudentModal.querySelector('#editStudentBirthdate');
            var modalStudentAddress = editStudentModal.querySelector('#editStudentAddress');
            var modalStudentSection = editStudentModal.querySelector('#editStudentSection');
            var modalStudentParent = editStudentModal.querySelector('#editStudentParent');

            modalStudentId.value = studentId;
            modalStudentName.value = studentName;
            modalStudentGender.value = studentGender;
            modalStudentBirthdate.value = studentBirthdate;
            modalStudentAddress.value = studentAddress;

            Array.from(modalStudentSection.options).forEach(function(option) {
                if (option.value === studentSection) {
                    option.selected = true;
                }
            });

            Array.from(modalStudentParent.options).forEach(function(option) {
                if (option.text === studentParent) {
                    option.selected = true;
                }
            });

            // Fetch and display core and specialized subjects inside the modal
            fetch('fetch_specialized_subjects.php?student_id=' + studentId)
                .then(response => response.text())
                .then(html => {
                    const subjectContainer = editStudentModal.querySelector('#studentSpecializedSubjects');
                    subjectContainer.innerHTML = html;
                })
                .catch(error => {
                    console.error('Error fetching specialized subjects:', error);
                });

            fetch('fetch_core_subjects.php?student_id=' + studentId)
                .then(response => response.text())
                .then(html => {
                    const subjectContainer = editStudentModal.querySelector('#studentCoreSubjects');
                    subjectContainer.innerHTML = html;
                })
                .catch(error => {
                    console.error('Error fetching core subjects:', error);
                });

            // Add student_id to the URL parameter
            addStudentIdToUrl(studentId);
        });

        // Function to add student_id to the URL parameter
        function addStudentIdToUrl(studentId) {
            const url = new URL(window.location.href);
            url.searchParams.set('student_id', studentId);
            window.history.replaceState(null, '', url.toString());
        }
    </script>
</body>

</html>