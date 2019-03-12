var table_search, filter_arr = [];
$(document).ready(function () {

  if (!Cookies.get("cookie-accept")) {
    var html = `
    <div class='col-10'>Wij gebruiken cookies om ervoor te zorgen dat onze website voor de bezoeker beter werkt.
    <br />Daarnaast gebruiken wij o.a. cookies voor onze webstatistieken.
    </div>
    <div class="col-2">
    <a href=\"privacy-statement\" class=\"btn btn-light btn-sm float-right\">Lees meer</a><button onclick=\"close_consent(this)\" class=\"btn btn-light btn-sm float-right\">OK</button>
    </div>
    `;

    $(".footer").html(html);
    $(".footer").addClass("cookie-consent");
  }

  if (Cookies.get('filter')) {
    var filter = JSON.parse(Cookies.get('filter'));

    $(filter.target).addClass("show");
    $("a[href='" + filter.target + "']").parents("ul").addClass("show");

    $("a[href='" + filter.target + "']").parent().addClass("active");
  }
});

function add_cart(e, id, price) {
  $.get("add-cart/" + id + "/" + price, function (response) {
    var cart_size = Number($("#cart_size").html());
    cart_size++;
    $("#cart_size").html(cart_size);
    $(e).prop("disabled", true);
    $(e).addClass("btn-outline-success");
    $(e).removeClass("btn-primary");

    $(".cart-arrow").addClass("animate").show().delay(3000).fadeOut();

    $(e).html('<span class="checkmark"><i class="fas fa-check"></i></span> In winkelkar');
  });
}

function close_consent(e) {
  Cookies.set("cookie-accept", true, { expires: 365 });
  $(e).parents('div.footer').removeClass("cookie-consent");
  $(e).parents("div.footer").html("");
}

function filter_table(e, filter) {
  const url = new URL(window.location.href);
  if (url.pathname !== "/webshop/") {
    // CURSUSLIJST RESETTEN

    window.location.href = "/webshop/";
  } else {
    table_search.columns().search('').draw();


    // IS ER OP HET FILTERMENU GEKLIKT? ANDERE GEKLIKT ITEM UIT COOKIE HALEN
    if ($(e).attr("href")) {
      target = $(e).attr("href");
    } else {
      target = JSON.parse(Cookies.get('filter')).target;
    }

    if (!filter) {
      filter = $(e).data("filter");
    }

    $.post("functions/get-header.php", {instelling: filter.instelling, richting: filter.richting}, function(header) {
      header = JSON.parse(header);

      var h = "";
      if (header.instelling) {
        h += header.instelling;
      }
      if (header.richting) {
        h += " &raquo " + header.richting;
      }
      if (filter.fase) {
        h += " &raquo Fase " + filter.fase;
      }
      if (filter.semester) {
        h += " &raquo Semester " + filter.semester;
      }
      $("#header").html(h);
    });

    // ACTIVE STATUS OP GEKLIKTE FILTER

    $(".list-group-item.active").removeClass("active");
    $(e).parent(".list-group-item").addClass("active");

    // FILTER DE CURSUSLIJST

    $.each(filter, function (key, val) {
      table_search.columns(key + ":name").search(val).draw();
    });

    // VUL COOKIE MET HUIDIGE STATUS

    Cookies.set('filter', {target: target, filter: filter}, { expires: 7 });
  }
}

function remove_from_cart(e, id) {
  $.get("remove-item/" + id, function (response) {
    var cart_size = Number($("#cart_size").html());
    cart_size--;
    $("#cart_size").html(cart_size);
    if (cart_size === 0) {
      window.location.href = "cart.php";
    } else {
      $(e).parents("tr").remove();
    }

    update_cart();
  });
}

function update_cart() {
  var cart_total_price = 0;
  $.each($(".course_total_price"), function(i, val) {
    cart_total_price += Number($(val).html());
  });
  $("#cart_total_price").html(cart_total_price.toFixed(2));
}

function update_quantity(e, id, price) {
  var quantity = Number($(e).val());
  $.get("update-item/" + id + "/" + quantity + "/" + price, function (response) {
    $("#course_total_price_" + id).html((quantity * price).toFixed(2));
      update_cart();
  });
}
