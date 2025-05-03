<?php
require_once 'includes/dbh.php'; // Include your database connection file
session_start();
// tx_ref=ref&transaction_id=30490&status=successful
$tx_ref = $_GET['tx_ref'];
$tx_id = $_GET['transaction_id'];
$tx_status = $_GET['status'];
// echo $tx_id, $tx_ref, $tx_status;
if ($tx_ref = "" && $tx_id = "") {
    header("Location:javascript://history.go(-1)");
}
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.flutterwave.com/v3/transactions/$tx_id/verify",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => [
    "Content-Type: application/json",
    "Authorization: Bearer FLWSECK_TEST-a6f8c86f360786f898bff3516ba5d62d-X"
  ],
));

$response = curl_exec($curl);
curl_close($curl);
// $result = json_decode($response);
// echo $result;
if ($response) {
    $result = json_decode($response);
    // Check if the transaction was successful
    if ($result->status === 'success') {
    try {
            $user_id = $_SESSION['user_id'];
            
            
            // Execute the statement
                $status =1;
                $updateSql = "UPDATE users SET is_paid = :status WHERE id = :user_id";
                $pdo = Dbh::connect();
                $updateStmt = $pdo->prepare($updateSql);
                $updateStmt->bindParam(':status', $status, PDO::PARAM_INT);
                $updateStmt->bindParam(':user_id', $user_id, PDO::PARAM_STR);

                if ($updateStmt->execute()) {
                    // echo json_encode(["status" => "success", "message" => 'Wallet balance updated successfully']);
                    $_SESSION['user_type'] =  $status;
                    header('Location:success.php?status=success');
                } else {
                    echo json_encode(["status" => "error", "message" => 'Failed to update wallet balance']);
                }
                exit();

        } catch (PDOException $e) {
            die("Database error: " . $e->getMessage());
        }
    } else {
      echo 'failed';
    }
} else {
    
}
?>
