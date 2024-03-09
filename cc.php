<!DOCTYPE html>
<html>
<body>

<h2>Form Pengecekan Kartu Kredit</h2>

<form action="" method="post">
  <label for="card_number">Nomor Kartu Kredit:</label><br>
  <input type="text" id="card_number" name="card_number"><br>
  <input type="submit" value="Periksa Kartu">
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once('vendor/autoload.php');

    // Ganti dengan API Key Anda
    \Stripe\Stripe::setApiKey("sk_test_xxxxxxxxxxxxxxxxxxxxxx");

    // Ambil nomor kartu dari form
    $card_number = $_POST['card_number'];

    try {
        $token = \Stripe\Token::create(array(
            "card" => array(
                "number" => $card_number,
                "exp_month" => 12, // Bulan kedaluwarsa harus valid
                "exp_year" => 2025, // Tahun kedaluwarsa harus valid
                "cvc" => "123" // CVC harus valid
            )
        ));

        echo "Token berhasil dibuat untuk kartu dengan nomor " . $card_number . ".<br>";
    } catch (\Stripe\Error\Card $e) {
        echo "Kartu kredit dengan nomor " . $card_number . " tidak valid: " . $e->getMessage() . "<br>";
    }
}
?>

</body>
</html>
