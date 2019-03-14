<div class="row footer">
  <div class="col-12 text-center">
    &copy; 2019 Alpha Copy
  </div>
</div>
</body>
</html>
<script type="text/javascript">
  update_cart();
  $("#cart_size").html(<?= (!isset($_SESSION["cart"])) ? '0' : count($_SESSION["cart"]) ?>);
</script>
