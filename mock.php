<?php
session_start();
require_once 'functions.php'; // Include the function to check if the test has been taken
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}
$isPaidUser = $_SESSION['user_type'] == 1; // Check if the user is a paid user
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Mock Page</title>
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
        <h1 class="text-2xl font-bold mb-6">May Mock Exams 2025</h1>
      
        <!-- Start a New Quiz -->
        <div class="bg-white rounded-lg shadow p-6 mb-6">
  <h2 class="text-xl font-semibold mb-2">Note</h2>

  <?php if ($isPaidUser): ?>
    <p class="text-green-600 mb-4 font-semibold">
      ✅ You have successfully paid! You can now access the mock exam questions Tomorrow by 8am.
    </p>
    <p class="text-sm text-gray-500 mb-4">This Mock exam contains questions from all nursing categories.</p>
    <a href="#" class="bg-green-500 hover:bg-green-600 text-white font-semibold px-6 py-2 rounded transition">
      See Questions below
    </a>

  <?php else: ?>
    <p class="text-red-600 mb-4 font-semibold">
      Sorry, You did not pay for the mock exam, as such you cannot access the questions.
    </p>
    <p class="text-sm text-gray-500 mb-4">This Mock exam contains questions from all nursing categories.</p>
    <button  class="bg-blue-500 hover:bg-blue-600 text-white font-semibold px-6 py-2 rounded transition">
      <a href="deadline.php">Pay to access Questions</a>
    </button>
  <?php endif; ?>

</div>
      
        <!-- List of Exams -->
        <div class="bg-white rounded-lg shadow p-6">
          <h2 class="text-xl font-semibold mb-4">Available Exams</h2>
          <?php if ($isPaidUser): ?>
          <div class="space-y-4">
            <div class="flex items-center justify-between border-b pb-3">
              <div>
                <p class="font-medium">Paper 1 Mock 1</p>
                <p class="text-sm text-gray-500">50 Questions • 30 Minutes</p>
              </div>
              <?php 
              $takenTest = hasTakenTest($_SESSION['user_id'], 'Paper 1 Mock 1'); 
              ?>
              <?php if ($takenTest): ?>
              <a href="results.php?exam=<?= urlencode('Paper 1') ?>&page=1&score=<?= $takenTest['score']?>" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded text-sm font-medium">View Result</a>
              <?php else: ?>
              <a href="questions.php?page=1&exam=<?= urlencode('Paper 1') ?>" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded text-sm font-medium">Start Exam</a>
              <?php endif; ?>
            </div>
            <div class="flex items-center justify-between border-b pb-3">
              <div>
                <p class="font-medium">Paper 1 Mock 2</p>
                <p class="text-sm text-gray-500">50 Questions • 30 Minutes</p>
              </div>
              <?php 
              $takenTest = hasTakenTest($_SESSION['user_id'], 'Paper 1 Mock 2'); 
              ?>
              <?php if ($takenTest): ?>
              <a href="results.php?exam=<?= urlencode('Paper 1') ?>&page=2&score=<?= $takenTest['score']?>" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded text-sm font-medium">View Result</a>
              <?php else: ?>
              <a href="questions.php?page=2&exam=<?= urlencode('Paper 1') ?>" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded text-sm font-medium">Start Exam</a>
              <?php endif; ?>
            </div>
            <div class="flex items-center justify-between border-b pb-3">
              <div>
                <p class="font-medium">Paper 1 Mock 3</p>
                <p class="text-sm text-gray-500">50 Questions • 30 Minutes</p>
              </div>
              <?php 
              $takenTest = hasTakenTest($_SESSION['user_id'], 'Paper 1 Mock 3'); 
              ?>
              <?php if ($takenTest): ?>
              <a href="results.php?exam=<?= urlencode('Paper 1') ?>&page=3&score=<?= $takenTest['score']?>" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded text-sm font-medium">View Result</a>
              <?php else: ?>
              <a href="questions.php?page=3&exam=<?= urlencode('Paper 1') ?>" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded text-sm font-medium">Start Exam</a>
              <?php endif; ?>
            </div>
            <div class="flex items-center justify-between border-b pb-3">
              <div>
                <p class="font-medium">Paper 1 Mock 4</p>
                <p class="text-sm text-gray-500">50 Questions • 30 Minutes</p>
              </div>
              <?php 
              $takenTest = hasTakenTest($_SESSION['user_id'], 'Paper 1 Mock 4'); 
              ?>
              <?php if ($takenTest): ?>
              <a href="results.php?exam=<?= urlencode('Paper 1') ?>&page=4&score=<?= $takenTest['score']?>" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded text-sm font-medium">View Result</a>
              <?php else: ?>
              <a href="questions.php?page=4&exam=<?= urlencode('Paper 1') ?>" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded text-sm font-medium">Start Exam</a>
              <?php endif; ?>
            </div>
            <div class="flex items-center justify-between border-b pb-3">
              <div>
                <p class="font-medium">Paper 1 Mock 5</p>
                <p class="text-sm text-gray-500">50 Questions • 30 Minutes</p>
              </div>
              <?php 
              $takenTest = hasTakenTest($_SESSION['user_id'], 'Paper 1 Mock 5'); 
              ?>
              <?php if ($takenTest): ?>
              <a href="results.php?exam=<?= urlencode('Paper 1') ?>&page=5&score=<?= $takenTest['score']?>" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded text-sm font-medium">View Result</a>
              <?php else: ?>
              <a href="questions.php?page=5&exam=<?= urlencode('Paper 1') ?>" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded text-sm font-medium">Start Exam</a>
              <?php endif; ?>
            </div>
            <div class="flex items-center justify-between border-b pb-3">
              <div>
                <p class="font-medium">Paper 1 Mock 6</p>
                <p class="text-sm text-gray-500">50 Questions • 30 Minutes</p>
              </div>
              <?php 
              $takenTest = hasTakenTest($_SESSION['user_id'], 'Paper 1 Mock 6'); 
              ?>
              <?php if ($takenTest): ?>
              <a href="results.php?exam=<?= urlencode('Paper 1') ?>&page=6&score=<?= $takenTest['score']?>" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded text-sm font-medium">View Result</a>
              <?php else: ?>
              <a href="questions.php?page=6&exam=<?= urlencode('Paper 1') ?>" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded text-sm font-medium">Start Exam</a>
              <?php endif; ?>
            </div>

          </div>
          <?php else: ?>
            <p class="text-red-600 mb-4 font-semibold">
      Sorry, You did not pay for the mock exam, as such you cannot access the questions.
    </p>
    <p class="text-sm text-gray-500 mb-4">This Mock exam contains questions from all nursing categories.</p>
    <button  class="bg-blue-500 hover:bg-blue-600 text-white font-semibold px-6 py-2 rounded transition">
      <a href="deadline.php">Pay to access Questions</a>
    </button>
  <?php endif; ?>
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
