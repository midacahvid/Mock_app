<header class="bg-white shadow-md px-4 py-3 flex justify-between items-center">
    <div class="flex items-center gap-2">
      <button id="menu-toggle" class="md:hidden text-gray-700 focus:outline-none">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
          viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
          <path d="M4 6h16M4 12h16M4 18h16"/>
        </svg>
      </button>
      <h1 class="text-xl font-bold text-blue-600">BrighterMock</h1>
    </div>
    <div class="flex items-center gap-4">
      <?php 
      $user_details = userScores($_SESSION['user_id']);
      ?>
      <span class="text-sm hidden lg:block"><?php echo $_SESSION['name'];?> <span class="text-gray-500 hidden lg:block">Score: <?php echo $user_details[0]['total_score']==null? 0 :$user_details[0]['total_score'] ;?> pts</span></span>
      <a href="includes/logout.inc.php" class="bg-gray-100 px-3 py-1 rounded hover:bg-gray-200">Sign Out</a>
    </div>
  </header>