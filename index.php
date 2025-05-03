<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
<div>
  <div class="flex min-h-screen items-center justify-center bg-blue-500 p-5">
    <div class="grid md:grid-cols-2 grid-cols-1 items-center gap-10 md:px-10 max-w-7xl">
      <!-- Text Content -->
      <div>
        <h1 class="mb-4 text-4xl font-extrabold text-white leading-snug">
          <span class="text-green-400">Welcome to BrighterMock</span> – Powered by Brighter Nurses
        </h1>
        <p class="mb-4 text-lg text-white">
          Prepare with Confidence for the May Council Exams!
        </p>
        <ul class="list-disc list-inside text-white mb-6 space-y-2">
          <li><strong>500 Questions Total</strong> – 250 each for Paper 1 and Paper 2</li>
          <li><strong>Covers All Nursing Courses</strong> – ensuring complete preparation</li>
          <li><strong>Mock Exam Duration:</strong> April 28th – 30th, 2025</li>
          <li><strong>Access Fee:</strong> Just ₦500</li>
          <li><strong>Review Feature:</strong> Students can review both correct and failed questions</li>
        </ul>
        <p class="mb-6 text-white font-semibold">
          <strong>Registration Period:</strong> April 22nd – April 27th, 2025
        </p>
        <div class="flex flex-wrap gap-4">
          <button class="flex items-center justify-center gap-2 rounded-2xl bg-rose-500 px-6 py-3 font-semibold text-white hover:bg-rose-700">
            <a href="register.php">Sign Up</a>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z"/>
            </svg>
          </button>
          <button class="flex items-center justify-center gap-2 rounded-2xl bg-white px-6 py-3 font-semibold">
            <a href="login.php">Log In
            </a><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="m9 12.75 3 3m0 0 3-3m-3 3v-7.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
            </svg>
          </button>
        </div>
      </div>
      <!-- Image Content -->
      <div class="flex justify-center">
        <img src="images/nurse.jfif" alt="Nurse" class="md:w-96 w-72 rounded-full shadow-lg" />
      </div>
    </div>
  </div>
</div>
</body>
</html>