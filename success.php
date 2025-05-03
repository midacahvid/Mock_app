<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Payment successfull</title>
</head>
<body>
    <?php 
        if (isset($_GET['status']) && urldecode($_GET['status']) == 'success') {?>
    <div class="bg-gray-100 h-screen">
      <div class="bg-white p-6  md:mx-auto">
        <svg viewBox="0 0 24 24" class="text-green-600 w-16 h-16 mx-auto my-6">
            <path fill="currentColor"
                d="M12,0A12,12,0,1,0,24,12,12.014,12.014,0,0,0,12,0Zm6.927,8.2-6.845,9.289a1.011,1.011,0,0,1-1.43.188L5.764,13.769a1,1,0,1,1,1.25-1.562l4.076,3.261,6.227-8.451A1,1,0,1,1,18.927,8.2Z">
            </path>
        </svg>
        <div class="text-center">
            <h3 class="md:text-2xl text-base text-gray-900 font-semibold text-center">Payment Done!</h3>
            <p class="text-gray-600 my-2">Thank you for completing your secure online payment.</p>
            <p> Have a great day!  </p>
            <div class="py-10 text-center">
                <a href="dashboard.php" class="px-12 bg-indigo-600 hover:bg-indigo-500 text-white font-semibold py-3">
                    Go to dashboard 
               </a>
            </div>
        </div>
    </div>
  </div>
            <?php  
        }else {?>
            <section class="bg-white dark:bg-gray-900">
    <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6">
        <div class="mx-auto max-w-screen-sm text-center">
            <h1 class="mb-4 text-7xl tracking-tight font-extrabold lg:text-9xl text-primary-600 dark:text-primary-500">Sorry</h1>
            <p class="mb-4 text-3xl tracking-tight font-bold text-gray-900 md:text-4xl dark:text-white">You are not allow to view this page.</p>
            <p class="mb-4 text-lg font-light text-gray-500 dark:text-gray-400">Go back to <span class="font-bold"><a href="dashboard.php">home page</a></span> </p>
        </div>   
    </div>
</section>
        <?php }
    ?>

</body>
</html>