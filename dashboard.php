<?php
session_start();
require_once 'functions.php';
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}

$user_details = userScores($_SESSION['user_id']);
$question_attempted = questionsAttempted($_SESSION['user_id']);

if((int)$question_attempted[0]['total_questions'] == 0){
  $average_score = 0;
}else{
  $average_score = ceil(((int)$user_details[0]['total_score']/(int)$question_attempted[0]['total_questions'])*100);
}

// echo $user_details;
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
    <main class="flex-1 p-6 md:ml-16 mt-4">
      <h2 class="text-2xl font-bold mb-6">Dashboard</h2>

      <!-- Cards -->
      <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
        <div class="bg-white rounded-lg p-4 shadow">
          <p class="text-gray-500">Total Score</p>
          <h2 class="text-3xl font-semibold mt-2"><?php echo $user_details[0]['total_score']==null ? 0 :$user_details[0]['total_score'] ;?></h2>
          <p class="text-sm text-gray-400">Points earned</p>
        </div>
        <div class="bg-white rounded-lg p-4 shadow">
          <p class="text-gray-500">Exams Completed</p>
          <h2 class="text-3xl font-semibold mt-2"><?php echo $user_details[0]['total_tests'];?></h2>
          <p class="text-sm text-gray-400">Practice exams</p>
        </div>
        <div class="bg-white rounded-lg p-4 shadow">
          <p class="text-gray-500">Questions Attempted</p>
          <h2 class="text-3xl font-semibold mt-2"><?php echo $question_attempted[0]['total_questions']; ?></h2>
          <p class="text-sm text-gray-400">Total questions</p>
        </div>
        <div class="bg-yellow-100 rounded-lg p-4 shadow">
          <p class="text-gray-500">Average Score</p>
          <h2 class="text-3xl font-semibold mt-2 text-yellow-600"><?php echo $average_score;?>%</h2>
          <p class="text-sm text-gray-400">Correct answers</p>
        </div>
      </div>

      <!-- Performance + Pie -->
      <!-- Start Quiz & Leaderboard Section -->
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-8">
        <!-- Start New Quiz -->
        <div class="bg-white rounded-lg p-6 shadow">
          <h3 class="text-lg font-semibold mb-2">Pay for the mock</h3>
          <p class="text-sm text-gray-500 mb-4">
            Pay for the mock to access the questions of the mock. Students who did not pay will not have access to the questions on the period of the mock
          </p>
          <button class="bg-sky-500 hover:bg-sky-600 text-white text-sm font-medium py-2 px-4 rounded flex items-center gap-1">
          <a href="deadline.php">Click here to Pay</a><span>&rarr;</span>
          </button>
        </div>
        <div class="bg-white rounded-lg p-6 shadow">
          <h3 class="text-lg font-semibold mb-2">Take a practice Mock</h3>
          <p class="text-sm text-gray-500 mb-4">
            Take a practice mock test to have a feel of the platform and see what to expect on the day of exams
          </p>
          <button  class="bg-sky-500 hover:bg-sky-600 text-white text-sm font-medium py-2 px-4 rounded flex items-center gap-1">
             <a href="mock.php">Begin Test Mock</a><span>&rarr;</span>
          </button>
        </div>

        <!-- Check Leaderboard -->
        <div class="bg-white rounded-lg p-6 shadow">
          <h3 class="text-lg font-semibold mb-2">Check Leaderboard</h3>
          <p class="text-sm text-gray-500 mb-4">
            See how you compare to other nursing students preparing for their exams.
          </p>
          <button class="border border-gray-300 hover:bg-gray-100 text-sm font-medium py-2 px-4 rounded flex items-center gap-1">
            <a href="leaderboard.php">View Leaderboard</a><span>&rarr;</span>
          </button>
        </div>
    </main>
  </div>

  <!-- Toggle Script -->
  <script>
    const toggleBtn = document.getElementById('menu-toggle');
    const sidebar = document.getElementById('sidebar');

    toggleBtn.addEventListener('click', () => {
      sidebar.classList.toggle('-translate-x-full');
    });
  </script>

  <!-- getting user details  -->
  <?php 
        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
          $email = $_SESSION['email'];
          $Name = $_SESSION['name'];
        }
      ?>
    <!-- flutawave payment integration  -->
     <script src="https://checkout.flutterwave.com/v3.js"></script>
     <script>
      
        function makePayment() {
          // const amountToPay = document.getElementById('amount').value;
          FlutterwaveCheckout({
            public_key: 'FLWPUBK_TEST-15a033fb86ff9c9aa45a17ec3d69f5b6-X',
            tx_ref: 'titanic-8981487343MDI0NzMx',
            amount: 500,
            currency: 'NGN',
            payment_options: 'card, banktransfer',
            redirect_url: 'http://localhost/quiz/verify_transaction.php',
            meta: {
              consumer_id: 23,
              consumer_mac: '92a3-912ba-1192a',
            },
            customer: {
              email: '<?php echo $email; ?>',
              // phone_number: '08102909304',
              name: '<?php echo $Name; ?>',
            },
            customizations: {
              title: 'Brighter Nurses',
              description: 'Payment for mock test',
              logo: 'https://www.logolynx.com/images/logolynx/22/2239ca38f5505fbfce7e55bbc0604386.jpeg',
            },
          });
        }
     </script>
</body>
</html>
