<?php
require_once 'includes/dbh.php';
function hasTakenTest($user_id, $exam) {
    try {
        $pdo = Dbh::connect();
        $stmt = $pdo->prepare("SELECT * FROM test_results WHERE user_id = :user_id AND test_name = :test_name");
        $stmt->execute([
            'user_id' => $user_id,
            'test_name' => $exam
        ]);
        return $stmt->fetch(PDO::FETCH_ASSOC); // returns associative array or false
    } catch (PDOException $e) {
        // Handle error (log it, show user-friendly message, etc.)
        return false;
    }
}

function reviewQuestions($user_id, $exam, $page){
    $limit = 50; // Number of questions per page
    $offset = ($page - 1) * $limit;
    $exam_name = $exam . " Mock " . $page;
    try {
        $pdo = Dbh::connect();
        // Fetch all questions and student selected options
        $stmt = $pdo->prepare("SELECT q.id, q.question_text, q.exam_type, q.option_a, q.option_b, q.option_c, q.option_d, q.correct_option, a.selected_option
            FROM questions q
            JOIN student_answers a ON q.id = a.question_id
            WHERE a.student_id = :user_id AND q.exam_type = :exam AND a.type = :exam_name
            ");
        $stmt->execute([
            'user_id' => $user_id,
            'exam' => $exam,
            'exam_name' => $exam_name
        ]);
    
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    } catch (PDOException $e) {
        return "Error fetching review: " . $e->getMessage();
        exit;
    }
}


function rankStudents($user_id){
    // $user_id = $_SESSION['user_id']; // Logged-in user
try {
    //code...
    $pdo = Dbh::connect();
    $sql = "WITH ranked_scores AS (
        SELECT 
        u.name,
        tr.user_id,
        SUM(tr.score) AS total_score,
        RANK() OVER (ORDER BY SUM(tr.score) desc) AS rank
        FROM test_results tr
        JOIN users u ON tr.user_id = u.id
        GROUP BY tr.user_id
        ORDER BY rank ASC
    )
    SELECT * FROM ranked_scores
    WHERE rank <= 10 OR user_id = :current_user_id
    ";

    $stmt = $pdo->prepare($sql);
    $stmt->execute(['current_user_id' => $user_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    return "Error fetching students scores: " . $e->getMessage();
    exit;
}

}

function userScores($user_id){
    // $user_id = $_SESSION['user_id']; // Logged-in user
try {
    //code...
    $pdo = Dbh::connect();
    $sql = "SELECT 
        count(*) AS total_tests,
        SUM(score) AS total_score
        FROM test_results
        where user_id = :current_user_id";

    $stmt = $pdo->prepare($sql);
    $stmt->execute(['current_user_id' => $user_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    return "Error fetching students scores: " . $e->getMessage();
    exit;
}

}

function questionsAttempted($user_id){
    // $user_id = $_SESSION['user_id']; // Logged-in user
try {
    //code...
    $pdo = Dbh::connect();
    $sql = "SELECT 
        count(*) AS total_questions
        FROM student_answers
        where student_id = :current_user_id";

    $stmt = $pdo->prepare($sql);
    $stmt->execute(['current_user_id' => $user_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    return "Error fetching students scores: " . $e->getMessage();
    exit;
}

}