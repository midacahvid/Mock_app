<?php
session_start();
require_once 'functions.php'; // Include the functions file
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}

if(isset($_GET['exam']) && isset($_GET['page']) && isset($_GET['score'])){
$questions = reviewQuestions($_SESSION['user_id'], $_GET['exam'], $_GET['page']);
// echo $questions;
}else{
  header("Location: mock.php");
    exit;
}
if(count($questions) == 0){
  header("Location: mock.php");
  $percentage_score = 0;
}else{
  $percentage_score = ceil(($_GET['score']/count($questions))*100);
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
       <!-- Quiz Results -->
<div class="max-w-4xl mx-auto p-6 bg-white rounded-lg shadow-md mt-8">
    <!-- Header -->
    <div class="flex items-center mb-4">
      <button class="text-sm text-blue-600 hover:underline flex items-center">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
        </svg>
        Back to Dashboard
      </button>
      <h2 class="text-xl font-semibold ml-4"><?php echo $_GET['exam'] . " Mock " . $_GET['page']; ?> Results</h2>
    </div>
  
    <!-- Summary Box -->
    <div class="border rounded-lg p-6">
      <h3 class="text-lg font-semibold mb-6">Mock Summary</h3>
  
      <div class="grid grid-cols-1 md:grid-cols-3 text-center gap-6 mb-6">
        <!-- Score -->
        <div>
          <div class="flex justify-center mb-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 17l-5-5m0 0l5-5m-5 5h12" />
            </svg>
          </div>
          <div class="text-gray-600 text-sm">Score</div>
          <div class="text-2xl font-bold"><?php echo $percentage_score;?>%</div>
        </div>
  
        <!-- Correct Answers -->
        <div>
          <div class="flex justify-center mb-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
          </div>
          <div class="text-gray-600 text-sm">Correct Answers</div>
          <div class="text-2xl font-bold"><?php echo $_GET['score']; ?>/<?php echo count($questions) ?></div>
        </div>
  
        <!-- Total Questions -->
        <div>
          <div class="flex justify-center mb-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16h8M8 12h8m-8-4h8M4 6h16M4 10h16M4 14h16M4 18h16" />
            </svg>
          </div>
          <div class="text-gray-600 text-sm">Questions</div>
          <div class="text-2xl font-bold"><?php echo count($questions) ?></div>
        </div>
      </div>
  
      <!-- Progress Bar -->
      <div class="text-sm text-gray-600 flex justify-between mb-1">
        <span>0%</span>
        <span>Your score: <?php echo $percentage_score;?>%</span>
        <span>100%</span>
      </div>
      <div class="w-full h-2 bg-red-100 rounded-full mb-4">
        <div class="h-2 bg-red-300 rounded-full" style="width: <?php echo $percentage_score;?>%;"></div>
      </div>
  
      <!-- Review Button -->
      <div class="text-center">
        <button class="bg-blue-100 text-blue-700 px-4 py-2 rounded-md text-sm hover:bg-blue-200">
          Review each question below to see explanations and correct answers.
        </button>
      </div>
    </div>
  </div>
  <div class="mt-6 bg-white p-6 rounded-lg shadow-md space-y-6 max-w-4xl mx-auto">
    <h2 class="text-2xl font-semibold text-blue-600">Review of <?= $_GET['exam'] ?></h2>

    <?php foreach ($questions as $index => $q): ?>
        <div class="border-b pb-4">
            <p class="font-medium mb-2"><?= ($index + 1) . ". " . htmlspecialchars($q['question_text']) ?></p>
            <div class="space-y-2">
                <?php foreach (['A', 'B', 'C', 'D'] as $opt): 
                    $option_value = $q["option_" . strtolower($opt)];
                    $is_correct = $q['correct_option'] === $opt;
                    $is_selected = $q['selected_option'] === $opt;

                    $base = "block px-4 py-2 rounded";
                    if ($is_correct) {
                        $style = "bg-green-100 border border-green-500 text-green-800";
                    } elseif ($is_selected && !$is_correct) {
                        $style = "bg-red-100 border border-red-500 text-red-800";
                    } else {
                        $style = "bg-gray-100";
                    }
                ?>
                <label class="<?= $base . ' ' . $style ?>">
                    <input type="radio" disabled <?= $is_selected ? 'checked' : '' ?> class="mr-2">
                    <?= htmlspecialchars($option_value) ?>
                </label>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endforeach; ?>
</div>
          
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
  </script>
</body>
</html>
