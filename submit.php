<?php
include 'includes/dbh.php';

$student_id = $_POST['student_id'];
$page = $_POST['page'];
$exam = $_POST['exam'];
$examSafe = htmlspecialchars($exam);
$answers = $_POST['answers'] ?? [];

$limit = 50;
$offset = ($page - 1) * $limit;

// Fetch 50 questions for the given exam type
$pdo = Dbh::connect();
// Fetch correct answers
$stmt = $pdo->query("SELECT id, correct_option FROM questions 
        WHERE exam_type = '$examSafe' 
        LIMIT $offset, $limit");
$correctAnswers = [];
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $correctAnswers[$row['id']] = $row['correct_option'];
}

$score = 0;
$exam_name = $examSafe . " Mock " . $page;
foreach ($answers as $question_id => $selected_option) {
    $correct = $correctAnswers[$question_id] === $selected_option ? 1 : 0;
    if ($correct) $score++;

    // Check if the student already answered this question
    $checkStmt = $pdo->prepare("SELECT COUNT(*) FROM student_answers WHERE student_id = ? AND question_id = ?");
    $checkStmt->execute([$student_id, $question_id]);
    $alreadyExists = $checkStmt->fetchColumn();

    if ($alreadyExists == 0) {
        // Only insert if not already present
        $stmt = $pdo->prepare("INSERT INTO student_answers (student_id, question_id, selected_option, is_correct, type)
                               VALUES (?, ?, ?, ?,?)");
        $stmt->execute([$student_id, $question_id, $selected_option, $correct, $exam_name]);
    }
}

$total = count($correctAnswers);


// Check if user has already taken the test
$checkStmt = $pdo->prepare("SELECT COUNT(*) FROM test_results WHERE user_id = ? AND test_name = ?");
$checkStmt->execute([$student_id, $exam_name]);
$alreadyTaken = $checkStmt->fetchColumn();

if ($alreadyTaken > 0) {
    header("Location: mock.php");
    exit;
} else {
    // Proceed to insert new result
    $stmt = $pdo->prepare("INSERT INTO test_results (user_id, test_name, score) VALUES (?, ?, ?)");
    $stmt->execute([$student_id, $exam_name, $score]);
    // echo "Your result has been submitted successfully.";
}

header("Location: results.php?exam=$examSafe&page=$page&score=$score");
// header("Location: mock.php?status=success");
