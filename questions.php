<?php
session_start();
require_once 'functions.php';
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}

// Include the database connection file
require_once 'includes/dbh.php';
if (isset($_GET['page']) && isset($_GET['exam'])) {
  $page = $_GET['page'];
  $examType = $_GET['exam'];
  
  // Pagination logic
  $limit = 50; // Number of questions per page
  $offset = ($page - 1) * $limit;
  
  // Fetch 50 questions for the given exam type
  $pdo = Dbh::connect();
  $stmt = $pdo->prepare("SELECT * FROM questions WHERE exam_type = :examType LIMIT :offset, :limit");
  $stmt->bindValue(':examType', $examType);
  $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
  $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
  $stmt->execute();
  
  $questions = $stmt->fetchAll(PDO::FETCH_ASSOC);
}else{
  header("Location: mock.php");
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Dashboard with Sidebar</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 font-sans text-gray-900">
  <!-- Top Navbar -->
  <?php include 'header.php'; ?>

  <div class="flex min-h-screen">
    <!-- Sidebar -->
    
  <?php include 'sidebar.php'; ?>


    <!-- Main Content -->
    <main class="flex-1 p-6">
        <div class="bg-white p-6 rounded-lg shadow-md max-w-4xl mx-auto mb-6">
            <div class="flex justify-between items-center mb-4">
              <h2 class="text-xl font-semibold text-gray-800">Total Questions: 5</h2>
              <span class="text-sm text-gray-600 time-left">Time left: </span>
            </div>
          
            <!-- Question Progress Bar -->
            <!-- <div class="w-full h-2 bg-purple-100 rounded-full mb-4">
              <div class="h-2 bg-blue-500 rounded-full" style="width: 10%;"></div>
            </div> -->
          
            <!-- Time Remaining Label -->
            <div class="text-sm text-gray-500 mb-1">Time Remaining</div>
          
            <!-- Time Progress Bar -->
            <div class="w-full h-2 bg-purple-100 rounded-full">
              <div class="h-2 bg-blue-400 rounded-full time-bar" style="width: 70%;"></div>
            </div>
          </div>
        <div class="bg-white p-6 rounded-lg shadow-md space-y-6 max-w-4xl mx-auto">
            <h2 class="text-2xl font-semibold text-blue-600"><?php echo $_GET['exam'] . " Mock " . $_GET['page']; ?>
            </h2>
            <form id="quizForm" method="POST" action="submit.php">
            <input type="hidden" name="student_id" value="<?php echo $_SESSION['user_id']; ?>">
            <input type="hidden" name="exam" value="<?php echo $_GET['exam']; ?>">
            <input type="hidden" name="page" value="<?php echo $_GET['page']; ?>">
            <!-- Question 1 -->
            <?php foreach ($questions as $index => $q): ?>
            <div>
              <p class="font-medium mb-2"><?= ($index+1).". ".$q['question_text'] ?></p>
              <div class="space-y-2">
              <?php foreach (['A','B','C','D'] as $opt): ?>
                <label class="block"><input type="radio" name="answers[<?= $q['id'] ?>]"  value="<?= $opt ?>" class="mr-2"><?= $q["option_" . strtolower($opt)] ?></label>
              <?php endforeach; ?>
              </div>
            </div>
            <?php endforeach; ?>
          
            <!-- Submit Button -->
            <div class="pt-6 text-right">
              <button id="autoSubmitBtn" type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">Submit</button>
            </div>
          </div>
          </form>
    </main>
      
    <!-- end main -->
  </div>

  <!-- Toggle Script -->
  <script>
    const toggleBtn = document.getElementById('menu-toggle');
    const sidebar = document.getElementById('sidebar');

    toggleBtn.addEventListener('click', () => {
      sidebar.classList.toggle('-translate-x-full');
    });

    // Set total time in seconds (e.g., 10 minutes = 600 seconds)
  let totalTime = 1800; // 30 minutes
  const timerDisplay = document.querySelector(".time-left");
  const timeBar = document.querySelector(".time-bar");
  const submitButton = document.querySelector("#autoSubmitBtn");

  const updateTimer = () => {
    const minutes = Math.floor(totalTime / 60);
    const seconds = totalTime % 60;

    // Update timer text
    timerDisplay.textContent = `Time left: ${minutes}:${seconds < 10 ? '0' + seconds : seconds}`;

    // Update time bar progress
    const percent = ((600 - totalTime) / 600) * 100;
    timeBar.style.width = `${percent}%`;

    // Countdown
    if (totalTime > 0) {
      totalTime--;
    } else {
      // Time is up - trigger the submit button
      if (submitButton) {
        submitButton.click();
      }
    }
  };

  // Run the update function every second
  setInterval(updateTimer, 1000);
  </script>
</body>
</html>
