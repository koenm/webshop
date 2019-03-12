<?php
require_once 'includes/header.php';

// STATUS BETALING OPHALEN
$stmt = $mysqli->prepare("SELECT order_id, status FROM orders WHERE order_id = ?");
$stmt->bind_param("i", $_GET["order_id"]);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($order_id, $status);
$stmt->fetch();

?>
<div class="row">
  <?php require_once "includes/filter.php"; ?>
  <?php
switch ($status) {
  case 'paid':
    $_SESSION["cart"] = [];
    unset($_SESSION["user"]);
    ?>
    <h3>Bestelling en betaling geslaagd.</h3>
    <p>Bedankt voor je bestelling.
      <br />Je ontvangt weldra een email met alle gegevens.
      <br />Breng deze mee bij afhalen (op papier of gsm)
    </p>
    <?php
    break;

  default:
    ?>
    <h3>Oeps, er is een probleem met je betaling.</h3>
    <p>Stuur ons een <a href="mailto:webshop@alphacopyleuven.be">mailtje</a> met daarin vermelding van je bestelnummer <strong>(<?= $order_id ?>)</strong> en we contacteren jou zo spoedig mogelijk.
    </p>
    <?php
    break;
}
  ?>

  </div>
</div>
<?php
require_once 'includes/footer.php';
?>
