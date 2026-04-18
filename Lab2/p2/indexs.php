<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $courses = $_POST['course_names'];
    $credits = $_POST['credits'];
    $grades = $_POST['grades'];
    $totalPoints = 0;
    $totalCredits = 0;
    $tableHtml = "<table border='1'><tr><th>Course</th><th>Credits</th><th>Grade</th><th>Grade Points</th></tr>";

    for ($i = 0; $i < count($courses); $i++) {
        $course = htmlspecialchars($courses[$i]);
        $cr = floatval($credits[$i]);
        $g = floatval($grades[$i]);
        if ($cr <= 0) continue;
        $pts = $cr * $g;
        $totalPoints += $pts;
        $totalCredits += $cr;
        $tableHtml .= "<tr><td>$course</td><td>$cr</td><td>$g</td><td>$pts</td></tr>";
    }
    $tableHtml .= "</table>";

    if ($totalCredits > 0) {
        $gpa = $totalPoints / $totalCredits;
        if ($gpa >= 3.7) {
            $interpretation = "Distinction";
        } elseif ($gpa >= 3.0) {
            $interpretation = "Merit";
        } elseif ($gpa >= 2.0) {
            $interpretation = "Pass";
        } else {
            $interpretation = "Fail";
        }
        $result = "Your GPA is " . number_format($gpa, 2) . " ($interpretation).";
    } else {
        $result = "No valid courses entered.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>GPA Calculator</title>
</head>
<body>
    <h2>GPA Calculator</h2>
    <form method="POST" action="">
        <div id="course-container">
            <div class="course-row">
                <label>Course:</label>
                <input type="text" name="course_names[]" required>
                <label>Credits:</label>
                <input type="number" name="credits[]" step="0.1" required>
                <label>Grade:</label>
                <select name="grades[]">
                    <option value="4.0">A</option>
                    <option value="3.0">B</option>
                    <option value="2.0">C</option>
                    <option value="1.0">D</option>
                    <option value="0.0">F</option>
                </select>
            </div>
        </div>
        <br>
        <button type="submit">Calculate</button>
        <button type="button" onclick="addCourse()">+ Add Course</button>
    </form>

    <div id="result">
        <?php 
        if (isset($tableHtml)) echo $tableHtml;
        if (isset($result)) echo "<h3>$result</h3>"; 
        ?>
    </div>

    <script>
    function addCourse() {
        const container = document.getElementById('course-container');
        const row = document.querySelector('.course-row').cloneNode(true);
        row.querySelectorAll('input').forEach(input => input.value = '');
        container.appendChild(row);
    }
    </script>
</body>
</html>