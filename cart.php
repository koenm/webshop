<?php
require_once 'includes/header.php';
?>
<div class="row">
  <?php require_once "includes/filter.php"; ?>
    <h3>Winkelkar</h3>
    <table class="table">
    <?php
    if (count($_SESSION["cart"]) !== 0) {
      foreach ($_SESSION["cart"] as $key => $value) {
        $stmt_1 = $mysqli->prepare("SELECT * FROM cursussen WHERE id = ?");
        $stmt_1->bind_param("i",
          $key
        );
        $stmt_1->execute();
        $rs_1 = $stmt_1->get_result();
        while($cursus = $rs_1->fetch_assoc()) {
          ?>
          <tr>
            <td style="width: 37%"><?= $cursus["titel"] ?>&nbsp;&nbsp;<small><strong>[<?= $cursus["ondertitel"] ?>]</strong></small></td>
            <td style="width: 10%"><?= $cursus["docent"] ?></td>
            <td style="width: 5%"><?= $cursus["fase"] . " " . $cursus["richting"] ?></td>
            <td style="width: 5%"><select class="form-control" name="quantity" style="width: 4em;" onchange="update_quantity(this, <?= $cursus["id"] ?>, <?= $cursus["vprijs"] ?>)">
                  <option value="1" <?php if($value["quantity"] == "1") echo "SELECTED" ?>>1</option>
                  <option value="2" <?php if($value["quantity"] == "2") echo "SELECTED" ?>>2</option>
                  <option value="3" <?php if($value["quantity"] == "3") echo "SELECTED" ?>>3</option>
                  <option value="4" <?php if($value["quantity"] == "4") echo "SELECTED" ?>>4</option>
                  <option value="5" <?php if($value["quantity"] == "5") echo "SELECTED" ?>>5</option>
                  <option value="6" <?php if($value["quantity"] == "6") echo "SELECTED" ?>>6</option>
                  <option value="7" <?php if($value["quantity"] == "7") echo "SELECTED" ?>>7</option>
                  <option value="8" <?php if($value["quantity"] == "8") echo "SELECTED" ?>>8</option>
                  <option value="9" <?php if($value["quantity"] == "9") echo "SELECTED" ?>>9</option>
                  <option value="10" <?php if($value["quantity"] == "10") echo "SELECTED" ?>>10</option>
                </select>
            </td>
            <td style="width: 5%"><button type="button" name="button" class="btn btn-sm btn-dark" onclick="remove_from_cart(this, <?= $cursus["id"] ?>)"><i class="fas fa-trash-alt"></i></button></td>
            <td style="width: 10%"><strong>€ <span class="course_total_price" id="course_total_price_<?= $cursus["id"] ?>"><?= number_format($value["quantity"] * $cursus["vprijs"], 2) ?></span></strong></td>
          </tr>
          <?php
        }
      }
    ?>
    <tr>
      <td colspan="5" class="text-right">Totaal te betalen:</td>
      <td><strong>€ <span id="cart_total_price"></span></strong></td>
    </tr>
    <tr>
      <td colspan="7" class="text-right"><a href="/webshop/checkout" class="btn btn-primary"><i class="fas fa-chevron-right"></i>&nbsp;&nbsp;&nbsp;Bestellen</a></td>
    </tr>
  <?php
  } else {
    ?>
    <tr>
      <td>Je winkelkar is momenteel nog leeg.
        <br /><a href="/webshop">Laatste nieuwe cursussen</a></td>
    </tr>
    <?php
  }
  ?>
  </table>
</div>
</div>
<?php
require_once "includes/footer.php";
?>
