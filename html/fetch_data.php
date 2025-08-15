<?php
// filepath: c:\xampp\htdocs\SMS - Ong\sneat-1.0.0\html\fetch_data.php
include 'db_connection.php';

if (isset($_GET['type'])) {
    $type = $_GET['type'];

    if ($type === 'subjects' && isset($_GET['strand'])) {
        $strand = $_GET['strand'];

        // Fetch core subjects (common across all strands)
        $coreQuery = "SELECT subject_code, subject_name FROM subjects WHERE strand = 'CORE'";
        $coreResult = $conn->query($coreQuery);

        $subjects = [];
        while ($row = $coreResult->fetch_assoc()) {
            $subjects[] = $row;
        }

        // Fetch specialized subjects for the selected strand
        $specializedQuery = "SELECT subject_code, subject_name FROM subjects WHERE strand = ?";
        $stmt = $conn->prepare($specializedQuery);
        $stmt->bind_param("s", $strand);
        $stmt->execute();
        $specializedResult = $stmt->get_result();

        while ($row = $specializedResult->fetch_assoc()) {
            $subjects[] = $row;
        }

        echo json_encode($subjects);
        $stmt->close();

    } elseif ($type === 'sections' && isset($_GET['strand'])) {
        $strand = $_GET['strand'];

        // Fetch sections for the selected strand
        $query = "SELECT section_id, section_name FROM sections WHERE strand = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $strand);
        $stmt->execute();
        $result = $stmt->get_result();

        $sections = [];
        while ($row = $result->fetch_assoc()) {
            $sections[] = $row;
        }

        echo json_encode($sections);
        $stmt->close();

    } elseif ($type === 'assignments' && isset($_GET['teacher_id']) && isset($_GET['strand']) && isset($_GET['subject_code'])) {
        $teacherId = $_GET['teacher_id'];
        $strand = $_GET['strand'];
        $subjectCode = $_GET['subject_code'];

        $query = "SELECT sst.section_id, sst.schedule 
                  FROM section_subject_teacher sst
                  JOIN sections sec ON sst.section_id = sec.section_id
                  WHERE sst.teacher_id = ? AND sec.strand = ? AND sst.subject_code = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sss", $teacherId, $strand, $subjectCode);
        $stmt->execute();
        $result = $stmt->get_result();

        $assignments = [];
        while ($row = $result->fetch_assoc()) {
            $assignments[$row['section_id']] = $row['schedule'];
        }

        echo json_encode($assignments);
        $stmt->close();
    }

    $conn->close();
}
?>
