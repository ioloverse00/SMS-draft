<?php
// Include the database connection file
include 'db_connection.php';

// Get the student_id from the URL
$student_id = isset($_GET['student_id']) ? $_GET['student_id'] : null;

if (!$student_id) {
    echo "<p>Error: Student ID is not provided.</p>";
    exit;
}

// Fetch the strand of the student
$strandQuery = "
    SELECT strand 
    FROM students 
    WHERE student_id = ?
";
$strandStmt = $conn->prepare($strandQuery);
$strandStmt->bind_param("s", $student_id);
$strandStmt->execute();
$strandResult = $strandStmt->get_result();

if ($strandResult && $strandResult->num_rows > 0) {
    $strand = $strandResult->fetch_assoc()['strand'];

    // Fetch specialized subjects for the student's strand
    $subjectsQuery = "
        SELECT subject_code 
        FROM subjects 
        WHERE subject_type = 'Specialized' AND strand = ?
    ";
    $subjectsStmt = $conn->prepare($subjectsQuery);
    $subjectsStmt->bind_param("s", $strand);
    $subjectsStmt->execute();
    $subjectsResult = $subjectsStmt->get_result();

    // Fetch enrolled specialized subjects for the student
    $enrolledQuery = "
        SELECT subject_code 
        FROM student_subjects 
        WHERE student_id = ?
    ";
    $enrolledStmt = $conn->prepare($enrolledQuery);
    $enrolledStmt->bind_param("s", $student_id);
    $enrolledStmt->execute();
    $enrolledResult = $enrolledStmt->get_result();

    $enrolledSubjects = [];
    while ($row = $enrolledResult->fetch_assoc()) {
        $enrolledSubjects[] = $row['subject_code'];
    }

    if ($subjectsResult && $subjectsResult->num_rows > 0) {
        $count = 0; // Counter to track rows
        while ($row = $subjectsResult->fetch_assoc()) {
            $subject_code = htmlspecialchars($row['subject_code']);
            $checked = in_array($subject_code, $enrolledSubjects) ? 'checked' : ''; // Check if enrolled
            if ($count % 6 === 0): // Start a new column every 6 rows
?>
                <div class="col-md-4"> <!-- 3 columns per row (12/4 = 3) -->
                <?php
            endif;
                ?>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="specializedSubject-<?php echo $subject_code; ?>" name="specializedSubjects[]" value="<?php echo $subject_code; ?>" <?php echo $checked; ?>>
                    <label class="form-check-label" for="specializedSubject-<?php echo $subject_code; ?>"><?php echo $subject_code; ?></label>
                </div>
                <?php
                $count++;
                if ($count % 6 === 0): // Close the column after 6 rows
                ?>
                </div>
            <?php
                endif;
            }
            if ($count % 6 !== 0): // Close the last column if it has fewer than 6 rows
            ?>
            </div>
<?php
            endif;
        } else {
            echo "<p>No specialized subjects found for this strand.</p>";
        }
    } else {
        echo "<p>Strand not found for this student.</p>";
    }
?>