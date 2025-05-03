<?php
session_start();

require_once 'functions.php'; // Include the functions file
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}
$results = rankStudents($_SESSION['user_id']);
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
        <h1 class="text-2xl font-bold mb-6">Leaderboard</h1>
      
        <!-- Top Performers -->
        <section class="mb-6">
          <h2 class="text-xl font-semibold mb-4 flex items-center gap-2">
            <svg class="w-6 h-6 text-yellow-500" fill="currentColor" viewBox="0 0 24 24">
              <path d="M12 2L15 9H22L17 14L19 21L12 17L5 21L7 14L2 9H9L12 2Z" />
            </svg>
            Top Performers
          </h2>
      
          <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <!-- 1st Place -->
            <?php
              $rankIcons = ['🥇', '🥈', '🥉'];

              foreach ($results as $row) {
                  if ($row['rank'] > 3) break; // Limit to top 3

                  $isCurrentUser = $row['user_id'] == $_SESSION['user_id'];
                  $name = $isCurrentUser ? '(You) ' . htmlspecialchars($row['name']) : htmlspecialchars($row['name']);
                  $display = $rankIcons[$row['rank'] - 1];

                  echo "
                  <div class='bg-yellow-50 border border-yellow-200 rounded-lg p-4 text-center'>
                      <div class='text-yellow-500 text-3xl mb-2'>$display</div>
                      <p class='text-gray-600 font-semibold'>#{$row['rank']}</p>
                      <h3 class='text-lg font-bold " . ($isCurrentUser ? 'text-blue-600' : '') . "'>$name</h3>
                      <p class='text-2xl font-bold text-black mt-2'>{$row['total_score']}</p>
                  </div>
                  ";
              }
            ?>
          </div>
        </section>
      
        <!-- Full Ranking Table -->
        <section class="bg-white rounded-lg shadow p-6">
          <div class="flex items-center justify-between mb-4">
            <h2 class="text-xl font-semibold flex items-center gap-2">
              <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" stroke-width="2"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                  d="M8 17l4-4 4 4m0-8l-4 4-4-4"></path>
              </svg>
              Ranking
            </h2>
            <div class="space-x-2">
              <button class="bg-blue-100 text-blue-600 px-3 py-1 rounded text-sm">All Time</button>
              <button class="text-gray-600 hover:text-blue-600 px-3 py-1 rounded text-sm">This Month</button>
              <button class="text-gray-600 hover:text-blue-600 px-3 py-1 rounded text-sm">This Week</button>
            </div>
          </div>
      
          <!-- Table -->
          <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
              <thead class="text-gray-500 border-b">
                <tr>
                  <th class="py-2">Rank</th>
                  <th class="py-2">Name</th>
                  <th class="py-2">Score</th>
                </tr>
              </thead>
              <tbody class="divide-y">
              <?php
                $rankIcons = ['🥇', '🥈', '🥉']; // For top 3

                foreach ($results as $row) {
                    $isCurrentUser = $row['user_id'] == $_SESSION['user_id'];
                    
                    // Get rank icon or fallback to number
                    $rankDisplay = $row['rank'] <= 3 ? $rankIcons[$row['rank'] - 1] : $row['rank'];

                    // Modify name if it's the current user
                    $nameDisplay = $isCurrentUser ? '(You) ' . htmlspecialchars($row['name']) : htmlspecialchars($row['name']);

                    // Add text-blue-600 class if it's the current user
                    $textColorClass = $isCurrentUser ? 'text-blue-600 font-semibold' : 'text-gray-800';

                    echo "
                    <tr>
                        <td class='py-2'>$rankDisplay</td>
                        <td class='py-2 $textColorClass'>$nameDisplay</td>
                        <td class='py-2 font-semibold'>{$row['total_score']}</td>
                    </tr>";
                }
                ?>
                <!-- Add more rows dynamically here -->
              </tbody>
            </table>
          </div>
        </section>
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
