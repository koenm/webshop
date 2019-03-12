<div class="col-3 filter">
  <ul id="root-level" data-parent="#root-level" class="list-group-flush">
    <?php
    $stmt = $mysqli->prepare("SELECT * from instelling");
    $stmt->execute();
    $rs = $stmt->get_result();
    $count = $rs->num_rows;
    $richting["id"] = 0;
    while($instelling = $rs->fetch_assoc()) {

      $filter = '{"instelling":"' . $instelling["id"] . '"}';

      ?>
      <li class="list-group-item list-group-item-action">
        <a onclick="filter_table(this)" data-toggle="collapse" data-filter='<?= $filter ?>' href="#level<?= $instelling["id"] ?>" aria-expanded="false" aria-controls="level<?= $instelling["id"] ?>">
          <img src="<?= $instelling["icon"] ?>" style="width: 20%" class="rounded" />&nbsp;&nbsp;<?= $instelling["naam"] ?>
        </a>
      </li>
      <ul id="level<?= $instelling["id"] ?>" class="collapse list-group-flush first-level" data-parent="#root-level">
        <!-- LEVEL 1 -->
        <?php
        $stmt = $mysqli->prepare("SELECT * from richtingen WHERE instelling = ?");
        $stmt->bind_param("i", $instelling["id"]);
        $stmt->execute();
        $rs2 = $stmt->get_result();
        while($richting = $rs2->fetch_assoc()) {

          $filter = '{"instelling":"' . $instelling["id"] . '", "richting":"' . $richting["richting"] . '"}';

          ?>
          <li class="list-group-item list-group-item-action">
            <a onclick="filter_table(this)" data-toggle="collapse" data-filter='<?= $filter ?>' href="#level<?= $instelling["id"].$richting["id"] ?>" aria-expanded="false" aria-controls="level<?= $instelling["id"].$richting["id"] ?>">
              <i class="fas fa-graduation-cap"></i>&nbsp;&nbsp;<?= $richting["richting_compleet"] ?>
            </a>
          </li>
          <ul id="level<?= $instelling["id"].$richting["id"] ?>" class="collapse list-group-flush second-level" data-parent="#level<?= $instelling["id"] ?>">
            <!-- LEVEL 2 -->
            <?php
            $stmt = $mysqli->prepare("SELECT DISTINCT(fase) AS fase from cursussen WHERE instelling = ? AND richting = ? ORDER BY fase ASC");
            $stmt->bind_param("is",
              $instelling["id"],
              $richting["richting"]
            );
            $stmt->execute();
            $rs3 = $stmt->get_result();
            while($fase = $rs3->fetch_assoc()) {

              $filter = '{"instelling":"' . $instelling["id"] . '", "richting":"' . $richting["richting"] . '", "fase":"' . $fase["fase"] . '"}';

              ?>
              <li class="list-group-item list-group-item-action">
                <a onclick="filter_table(this)" data-toggle="collapse" data-filter='<?= $filter ?>' href="#level<?= $instelling["id"].$richting["id"].$fase["fase"] ?>" aria-expanded="false" aria-controls="level<?= $instelling["id"].$richting["id"].$fase["fase"] ?>">
                  <i class="far fa-calendar-alt"></i>&nbsp;&nbsp;Fase <?= $fase["fase"] ?>
                </a>
              </li>
              <ul id="level<?= $instelling["id"].$richting["id"].$fase["fase"] ?>" class="collapse list-group-flush third-level" data-parent="#level<?= $instelling["id"].$richting["id"] ?>">
                <!-- LEVEL 3 -->
                <?php
                $stmt = $mysqli->prepare("SELECT DISTINCT(semester) AS semester from cursussen WHERE instelling = ? AND richting = ? AND fase = ? ORDER BY semester ASC");
                $stmt->bind_param("isi",
                  $instelling["id"],
                  $richting["richting"],
                  $fase["fase"]
                );
                $stmt->execute();
                $rs4 = $stmt->get_result();
                while($semester = $rs4->fetch_assoc()) {

                  $filter = '{"instelling":"' . $instelling["id"] . '", "richting":"' . $richting["richting"] . '", "fase":"' . $fase["fase"] . '", "semester":"' . $semester["semester"] . '"}';

                  ?>
                  <li class="list-group-item list-group-item-action">
                    <a onclick="filter_table(this)" data-toggle="collapse" data-filter='<?= $filter ?>' href="#level<?= $instelling["id"].$richting["id"].$fase["fase"].$semester["semester"] ?>" aria-expanded="false" aria-controls="level<?= $instelling["id"].$richting["id"].$fase["fase"].$semester["semester"] ?>">
                      <i class="fas fa-book"></i>&nbsp;&nbsp;Semester <?= $semester["semester"] ?>
                    </a>
                  </li>
                  <?php
                }
                ?>
              </ul>
            <?php
            }
            ?>
          </ul>
          <?php
        }
      ?>
    </ul>
      <?php
    }
    ?>
  </ul>
</div>
<div class="col-9">
