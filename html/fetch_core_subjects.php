<?php
// Include the database connection file
include 'db_connection.php';

// Get the student_id from the URL
$student_id = isset($_GET['student_id']) ? $_GET['student_id'] : null;

if (!$student_id) {
    echo "<p>Error: Student ID is not provided.</p>";
    exit;
}

// Fetch core subjects from the database
$query_core_subjects = "
    SELECT subject_code 
    FROM subjects 
    WHERE subject_type = 'Core'
";
$result_core_subjects = mysqli_query($conn, $query_core_subjects);

// Fetch enrolled core subjects for the student
$query_enrolled_core = "
    SELECT subject_code 
    FROM student_subjects 
    WHERE student_id = '{$student_id}'
";
$result_enrolled_core = mysqli_query($conn, $query_enrolled_core);
$enrolled_core_subjects = [];
while ($row = mysqli_fetch_assoc($result_enrolled_core)) {
    $enrolled_core_subjects[] = $row['subject_code'];
}

if ($result_core_subjects && mysqli_num_rows($result_core_subjects) > 0):
    $count = 0; // Counter to track rows
    while ($row = mysqli_fetch_assoc($result_core_subjects)):
        $subject_code = htmlspecialchars($row['subject_code']);
        $checked = in_array($subject_code, $enrolled_core_subjects) ? 'checked' : ''; // Check if enrolled
        if ($count % 8 === 0): // Start a new column every 8 rows
?>
            <div class="col-md-4"> <!-- 3 columns per row (12/4 = 3) -->
            <?php
        endif;
            ?>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="coreSubject-<?php echo $subject_code; ?>" name="coreSubjects[]" value="<?php echo $subject_code; ?>" <?php echo $checked; ?>>
                <label class="form-check-label" for="coreSubject-<?php echo $subject_code; ?>"><?php echo $subject_code; ?></label>
            </div>
            <?php
            $count++;
            if ($count % 8 === 0): // Close the column after 8 rows
            ?>
            </div>
        <?php
            endif;
        endwhile;
        if ($count % 8 !== 0): // Close the last column if it has fewer than 8 rows
        ?>
        </div>
<?php
        endif;
    else:
        echo "<p>No core subjects found.</p>";
    endif;
?>