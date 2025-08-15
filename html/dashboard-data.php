<?php 
include 'db_connection.php';

$current_year = date("Y");

// Fetch total number of students
$students_result = $conn->query("SELECT COUNT(*) AS total_students FROM students");
$students_row = $students_result->fetch_assoc();
$total_students = $students_row['total_students'];

// Fetch total number of parents
$parents_result = $conn->query("SELECT COUNT(*) AS total_parents FROM users WHERE role = 'Parent'");
$parents_row = $parents_result->fetch_assoc();
$total_parents = $parents_row['total_parents'];

// Fetch total number of users
$users_result = $conn->query("SELECT COUNT(*) AS total_users FROM users");
$users_row = $users_result->fetch_assoc();
$total_users = $users_row['total_users'];

// Fetch total number of teachers
$teachers_result = $conn->query("SELECT COUNT(*) AS total_teachers FROM users WHERE role = 'Teacher'");
$teachers_row = $teachers_result->fetch_assoc();
$total_teachers = $teachers_row['total_teachers'];

// Fetch enrolled students per strand for the current year
$strands_result = $conn->query("SELECT strand, COUNT(*) AS total_students FROM students WHERE YEAR(created_at) = $current_year GROUP BY strand");
$strands_data = [];
while ($row = $strands_result->fetch_assoc()) {
    $strands_data[$row['strand']] = $row['total_students'];
}

// Assign strand-specific totals to variables
$total_students_abm = $strands_data['ABM'] ?? 0;
$total_students_stem = $strands_data['STEM'] ?? 0;
$total_students_humss = $strands_data['HUMSS'] ?? 0;
$total_students_ict = $strands_data['ICT'] ?? 0;

// Fetch total number of students per year
$yearly_students_result = $conn->query("SELECT YEAR(created_at) AS year, COUNT(*) AS total_students FROM students GROUP BY YEAR(created_at)");
$yearly_students_data = [];
while ($row = $yearly_students_result->fetch_assoc()) {
    $yearly_students_data[] = $row;
}

// Fetch total number of students for the current year
$students_current_year_result = $conn->query("SELECT COUNT(*) AS total_students_current_year FROM students WHERE YEAR(created_at) = $current_year");
$students_current_year_row = $students_current_year_result->fetch_assoc();
$total_students_current_year = $students_current_year_row['total_students_current_year'];

// Fetch activity log data
$activity_log_result = $conn->query("SELECT activity_type, description, timestamp, badge_color FROM activity_log ORDER BY timestamp DESC LIMIT 7");
$activity_log = [];
while ($row = $activity_log_result->fetch_assoc()) {
    $activity_log[] = $row;
}

// Check if there are no activities
if (empty($activity_log)) {
    $activity_log[] = [
        'activity_type' => 'No Activities',
        'description' => 'There are no recent activities to display.',
        'timestamp' => date('Y-m-d H:i:s'),
        'badge_color' => 'bg-label-secondary'
    ];
}
?>
