<aside id="sidebar" 
  class="bg-white w-64 space-y-4 px-4 py-6 shadow-lg transform md:translate-x-0 -translate-x-full transition-transform duration-200
         fixed md:relative z-30 md:z-0 h-full md:h-screen md:min-h-screen">
  <nav class="space-y-2">
    <a href="dashboard.php" class="block px-3 py-2 rounded bg-blue-100 text-blue-600 font-medium">Dashboard</a>
    <a href="mock.php" class="block px-3 py-2 rounded hover:bg-gray-100">Mock exams</a>
    <a href="leaderboard.php" class="block px-3 py-2 rounded hover:bg-gray-100">Leaderboard</a>
    <a href="#" class="block px-3 py-2 rounded hover:bg-gray-100"><?php echo $_SESSION['user_type']==1 ? "Paid User" : "Unpaid User"; ?> </a>
  </nav>
</aside>

