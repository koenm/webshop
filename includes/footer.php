<div class="row footer"></div>
</body>
</html>
<script type="text/javascript">
  update_cart();
  $("#cart_size").html(<?= (!isset($_SESSION["cart"])) ? '0' : count($_SESSION["cart"]) ?>);
</script>
