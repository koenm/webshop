// TABEL VULLEN MET ALLES CURSUSSEN

var cart = [];
$.getJSON("functions/load-cart.php", function (cart) {

  btn_buy = "<button class=\"btn btn-sm btn-primary\"><i class=\"fas fa-book-medical\"></i>&nbsp;&nbsp;Koop</button>";
  btn_in_cart = "<button class=\"btn btn-sm btn-outline-success\" disabled=\"\"><span class=\"checkmark\"><i class=\"fas fa-check\"></i></span>&nbsp;&nbsp;In winkelkar</button>";

  table_search = $(".table_courses").DataTable({
    serverSide: false,
    ajax: {
      url: "functions/load-table.php",
      dataSrc: ""
    },
    info: false,
    searching: true,
    paging: false,
    columns: [
      {
        name: "instelling",
        data: "instelling",
        visible: false
      },
      {
        name: "richting",
        data: "richting",
        visible: false
      },
      {
        name: "fase",
        data: "fase",
        visible: false
      },
      {
        name: "semester",
        data: "semester",
        visible: false
      },
      {
        name: "titel",
        data: null,
        render: function(data, type) {
          return data.titel + "&nbsp;&nbsp;<small><strong>[" + data.ondertitel + "] [" + data.fase + " " + data.richting + "]</strong></small>";
        },
        width: "54%"
      },
      {
        name: "docent",
        data: "docent",
        width: "17%"
      },
      {
        name: "prijs",
        data: null,
        render: function (data, type) {
          return "&euro; " + data.vprijs.toFixed(2);
        },
        width: "12%",
      },
      {
        data: null,
        render: function(data, type) {
          if (cart.indexOf(data.id) >= 0) {
            return btn_in_cart;
          } else {
            return btn_buy;
          }
        },
        class: "text-center",
        width: "23%",
        orderable: false
      }
    ],
  });

  $('.table_courses tbody').on( 'click', 'button', function () {
    var data = table_search.row($(this).parents("tr")).data();
    add_cart(this, data.id, data.vprijs);
  });

  // DEZE IF GEBEURD ENKEL OP DE PAGINA MET CURUSLIJST

  if (Cookies.get('filter')) {
    var filter = JSON.parse(Cookies.get('filter'));
    filter_table(null, filter.filter);
  }
});
