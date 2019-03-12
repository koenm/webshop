<?php
require_once "includes/header.php";
?>
<script src="js/load-courses.js" charset="utf-8"></script>
<div class="row">
  <?php
  require_once "includes/filter.php";
  ?>
    <h3 id="header"></h3>
    <table class="table table_courses">
      <thead class="thead-light">
          <tr>
            <th colspan="10"><h5></h5></td>
          </tr>
          <tr class="table_subhead">
            <th></td>
            <th></td>
            <th></td>
            <th></td>
            <th>Titel</td>
            <th>Docent</td>
            <th>Prijs</td>
            <th></td>
          </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
  </div>
</div>
<?php
require_once "includes/footer.php";
?>
