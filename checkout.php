<?php
require_once 'includes/header.php';
?>
<div class="row">
  <?php require_once "includes/filter.php" ?>
    <div class="row">
      <div class="col-12">
        <h3>Checkout</h3>
      </div>
    </div>
    <div class="row">
      <div class="col-5">
        <table style="width: 100%">
          <tr>
            <td colspan="2">
              <h6>Winkelkar</h6>
              <ul class="list-group mb-3">
              <?php
              $total_price = 0;
              foreach ($_SESSION["cart"] as $key => $value) {
                $total_price += ($value["quantity"] * $value["price"]);
                $stmt_1 = $mysqli->prepare("SELECT * FROM cursussen WHERE id = ?");
                $stmt_1->bind_param("i",
                  $key
                );
                $stmt_1->execute();
                $rs_1 = $stmt_1->get_result();
                while($cursus = $rs_1->fetch_assoc()) {
                  ?>
                  <li class="list-group-item d-flex justify-content-between align-items-center"><?= $cursus["titel"] ?>
                    <span class="badge badge-secondary badge-pill"><?= $value["quantity"]  ?></span>
                   </li>
                  <?php
                }
              }
              ?>
              </ul>
            </td>
          </tr>
          <tr>
            <td>Totaalprijs: </td>
            <td class="text-right"><strong>€ <?= number_format($total_price, 2) ?></strong></td>
          </tr>
          <tr>
            <td colspan="2" class="text-right"><a href="cart">Aanpassen</a></td>
          </tr>
        </table>
      </div>
      <div class="col-7">
        <h6>Persoonlijke info</h6>
        <form class="form needs-validation" action="check-out/create-payment.php" method="post" novalidate>
          <div class="form-group row mb-1 form-company">
            <label class="col-6 col-form-label form-control-label">
              <span class="form-label">Bedrijf</span>
              <input class="form-control" type="text" name="company" value="">
            </label>
            <label class="col-6 col-form-label form-control-label">
              <span class="form-label">BTW </span>
              <input class="form-control" type="text" name="vat" value="">
            </label>
          </div>
          <div class="form-group row mb-1">
            <label class="col-6 col-form-label form-control-label">
              <span class="form-label">Voornaam *</span>
              <input class="form-control" type="text" name="firstname" value="" required="required">
              <div class="invalid-feedback">
                Dit moet ingevuld worden.
              </div>
            </label>
            <label class="col-6 col-form-label form-control-label">
              <span class="form-label">Naam *</span>
              <input class="form-control" type="text" name="lastname" value="" required="required">
              <div class="invalid-feedback">
                Dit moet ingevuld worden.
              </div>
            </label>
          </div>
          <div class="form-group row mb-1">
            <label class="col-6 col-form-label form-control-label">
              <span class="form-label">Straat * </span>
              <input class="form-control" type="text" name="street" value="" required="required">
              <div class="invalid-feedback">
                Dit moet ingevuld worden.
              </div>
            </label>
            <label class="col-6 col-form-label form-control-label">
              <span class="form-label">Huisnummer en bus * </span>
              <input class="form-control" type="text" name="nr" value="" required="required">
              <div class="invalid-feedback">
                Dit moet ingevuld worden.
              </div>
            </label>
          </div>
          <div class="form-group row mb-1">
            <label class="col-6 col-form-label form-control-label">
              <span class="form-label">Postcode * </span>
              <input class="form-control" type="text" name="pc" value="" required="required">
              <div class="invalid-feedback">
                Dit moet ingevuld worden.
              </div>
            </label>
            <label class="col-6 col-form-label form-control-label">
              <span class="form-label">Stad * </span>
              <input class="form-control" type="text" name="city" value="" required="required">
              <div class="invalid-feedback">
                Dit moet ingevuld worden.
              </div>
            </label>
          </div>
          <div class="form-group row mb-1">
            <label class="col-12 col-form-label form-control-label">
              <span class="form-label">Land</span>
              <select class="form-control" name="country">
                <option value="AF">Afghanistan</option>
                <option value="AX">&Aring;land</option>
                <option value="AL">Albani&euml;</option>
                <option value="DZ">Algerije</option>
                <option value="VI">Amerikaanse Maagdeneilanden</option>
                <option value="AS">Amerikaans-Samoa</option>
                <option value="AD">Andorra</option>
                <option value="AO">Angola</option>
                <option value="AI">Anguilla</option>
                <option value="AQ">Antarctica</option>
                <option value="AG">Antigua en Barbuda</option>
                <option value="AR">Argentini&euml;</option>
                <option value="AM">Armeni&euml;</option>
                <option value="AW">Aruba</option>
                <option value="AU">Australi&euml;</option>
                <option value="AZ">Azerbeidzjan</option>
                <option value="BS">Bahama's</option>
                <option value="BH">Bahrein</option>
                <option value="BD">Bangladesh</option>
                <option value="BB">Barbados</option>
                <option value="BE" SELECTED>Belgi&euml;</option>
                <option value="BZ">Belize</option>
                <option value="BJ">Benin</option>
                <option value="BM">Bermuda</option>
                <option value="BT">Bhutan</option>
                <option value="BO">Bolivia</option>
                <option value="BQ">Bonaire, Sint Eustatius en Saba</option>
                <option value="BA">Bosni&euml; en Herzegovina</option>
                <option value="BW">Botswana</option>
                <option value="BV">Bouveteiland</option>
                <option value="BR">Brazili&euml;</option>
                <option value="VG">Britse Maagdeneilanden</option>
                <option value="IO">Brits Indische Oceaanterritorium</option>
                <option value="BN">Brunei</option>
                <option value="BG">Bulgarije</option>
                <option value="BF">Burkina Faso</option>
                <option value="BI">Burundi</option>
                <option value="KH">Cambodja</option>
                <option value="CA">Canada</option>
                <option value="CF">Centraal-Afrikaanse Republiek</option>
                <option value="CL">Chili</option>
                <option value="CN">China</option>
                <option value="CX">Christmaseiland</option>
                <option value="CC">Cocoseilanden</option>
                <option value="CO">Colombia</option>
                <option value="KM">Comoren</option>
                <option value="CG">Congo-Brazzaville</option>
                <option value="CD">Congo-Kinshasa</option>
                <option value="CK">Cookeilanden</option>
                <option value="CR">Costa Rica</option>
                <option value="CU">Cuba</option>
                <option value="CW">Cura&ccedil;ao</option>
                <option value="CY">Cyprus</option>
                <option value="DK">Denemarken</option>
                <option value="DJ">Djibouti</option>
                <option value="DM">Dominica</option>
                <option value="DO">Dominicaanse Republiek</option>
                <option value="DE">Duitsland</option>
                <option value="EC">Ecuador</option>
                <option value="EG">Egypte</option>
                <option value="SV">El Salvador</option>
                <option value="GQ">Equatoriaal-Guinea</option>
                <option value="ER">Eritrea</option>
                <option value="EE">Estland</option>
                <option value="ET">Ethiopi&euml;</option>
                <option value="FO">Faer&ouml;er</option>
                <option value="FK">Falklandeilanden</option>
                <option value="FJ">Fiji</option>
                <option value="PH">Filipijnen</option>
                <option value="FI">Finland</option>
                <option value="FR">Frankrijk</option>
                <option value="TF">Franse Zuidelijke en Antarctische Gebieden</option>
                <option value="GF">Frans-Guyana</option>
                <option value="PF">Frans-Polynesi&euml;</option>
                <option value="GA">Gabon</option>
                <option value="GM">Gambia</option>
                <option value="GE">Georgi&euml;</option>
                <option value="GH">Ghana</option>
                <option value="GI">Gibraltar</option>
                <option value="GD">Grenada</option>
                <option value="GR">Griekenland</option>
                <option value="GL">Groenland</option>
                <option value="GP">Guadeloupe</option>
                <option value="GU">Guam</option>
                <option value="GT">Guatemala</option>
                <option value="GG">Guernsey</option>
                <option value="GN">Guinee</option>
                <option value="GW">Guinee-Bissau</option>
                <option value="GY">Guyana</option>
                <option value="HT">Ha&iuml;ti</option>
                <option value="HM">Heard en McDonaldeilanden</option>
                <option value="HN">Honduras</option>
                <option value="HU">Hongarije</option>
                <option value="HK">Hongkong</option>
                <option value="IE">Ierland</option>
                <option value="IS">IJsland</option>
                <option value="IN">India</option>
                <option value="ID">Indonesi&euml;</option>
                <option value="IQ">Irak</option>
                <option value="IR">Iran</option>
                <option value="IL">Isra&euml;l</option>
                <option value="IT">Itali&euml;</option>
                <option value="CI">Ivoorkust</option>
                <option value="JM">Jamaica</option>
                <option value="JP">Japan</option>
                <option value="YE">Jemen</option>
                <option value="JE">Jersey</option>
                <option value="JO">Jordani&euml;</option>
                <option value="KY">Kaaimaneilanden</option>
                <option value="CV">Kaapverdi&euml;</option>
                <option value="CM">Kameroen</option>
                <option value="KZ">Kazachstan</option>
                <option value="KE">Kenia</option>
                <option value="KG">Kirgizi&euml;</option>
                <option value="KI">Kiribati</option>
                <option value="UM">Kleine Pacifische eilanden van de V.S.</option>
                <option value="KW">Koeweit</option>
                <option value="HR">Kroati&euml;</option>
                <option value="LA">Laos</option>
                <option value="LS">Lesotho</option>
                <option value="LV">Letland</option>
                <option value="LB">Libanon</option>
                <option value="LR">Liberia</option>
                <option value="LY">Libi&euml;</option>
                <option value="LI">Liechtenstein</option>
                <option value="LT">Litouwen</option>
                <option value="LU">Luxemburg</option>
                <option value="MO">Macau</option>
                <option value="MK">Macedoni&euml;</option>
                <option value="MG">Madagaskar</option>
                <option value="MW">Malawi</option>
                <option value="MV">Maldiven</option>
                <option value="MY">Maleisi&euml;</option>
                <option value="ML">Mali</option>
                <option value="MT">Malta</option>
                <option value="IM">Man</option>
                <option value="MA">Marokko</option>
                <option value="MH">Marshalleilanden</option>
                <option value="MQ">Martinique</option>
                <option value="MR">Mauritani&euml;</option>
                <option value="MU">Mauritius</option>
                <option value="YT">Mayotte</option>
                <option value="MX">Mexico</option>
                <option value="FM">Micronesia</option>
                <option value="MD">Moldavi&euml;</option>
                <option value="MC">Monaco</option>
                <option value="MN">Mongoli&euml;</option>
                <option value="ME">Montenegro</option>
                <option value="MS">Montserrat</option>
                <option value="MZ">Mozambique</option>
                <option value="MM">Myanmar</option>
                <option value="NA">Namibi&euml;</option>
                <option value="NR">Nauru</option>
                <option value="NL">Nederland</option>
                <option value="NP">Nepal</option>
                <option value="NI">Nicaragua</option>
                <option value="NC">Nieuw-Caledoni&euml;</option>
                <option value="NZ">Nieuw-Zeeland</option>
                <option value="NE">Niger</option>
                <option value="NG">Nigeria</option>
                <option value="NU">Niue</option>
                <option value="MP">Noordelijke Marianen</option>
                <option value="KP">Noord-Korea</option>
                <option value="NO">Noorwegen</option>
                <option value="NF">Norfolk</option>
                <option value="UG">Oeganda</option>
                <option value="UA">Oekra&iuml;ne</option>
                <option value="UZ">Oezbekistan</option>
                <option value="OM">Oman</option>
                <option value="AT">Oostenrijk</option>
                <option value="TL">Oost-Timor</option>
                <option value="PK">Pakistan</option>
                <option value="PW">Palau</option>
                <option value="PS">Palestina</option>
                <option value="PA">Panama</option>
                <option value="PG">Papoea-Nieuw-Guinea</option>
                <option value="PY">Paraguay</option>
                <option value="PE">Peru</option>
                <option value="PN">Pitcairneilanden</option>
                <option value="PL">Polen</option>
                <option value="PT">Portugal</option>
                <option value="PR">Puerto Rico</option>
                <option value="QA">Qatar</option>
                <option value="RE">R&eacute;union</option>
                <option value="RO">Roemeni&euml;</option>
                <option value="RU">Rusland</option>
                <option value="RW">Rwanda</option>
                <option value="BL">Saint-Barth&eacute;lemy</option>
                <option value="KN">Saint Kitts en Nevis</option>
                <option value="LC">Saint Lucia</option>
                <option value="PM">Saint-Pierre en Miquelon</option>
                <option value="VC">Saint Vincent en de Grenadines</option>
                <option value="SB">Salomonseilanden</option>
                <option value="WS">Samoa</option>
                <option value="SM">San Marino</option>
                <option value="SA">Saoedi-Arabi&euml;</option>
                <option value="ST">Sao Tom&eacute; en Principe</option>
                <option value="SN">Senegal</option>
                <option value="RS">Servi&euml;</option>
                <option value="SC">Seychellen</option>
                <option value="SL">Sierra Leone</option>
                <option value="SG">Singapore</option>
                <option value="SH">Sint-Helena, Ascension en Tristan da Cunha</option>
                <option value="MF">Sint-Maarten</option>
                <option value="SX">Sint Maarten</option>
                <option value="SI">Sloveni&euml;</option>
                <option value="SK">Slowakije</option>
                <option value="SD">Soedan</option>
                <option value="SO">Somali&euml;</option>
                <option value="ES">Spanje</option>
                <option value="SJ">Spitsbergen en Jan Mayen</option>
                <option value="LK">Sri Lanka</option>
                <option value="SR">Suriname</option>
                <option value="SZ">Swaziland</option>
                <option value="SY">Syri&euml;</option>
                <option value="TJ">Tadzjikistan</option>
                <option value="TW">Taiwan</option>
                <option value="TZ">Tanzania</option>
                <option value="TH">Thailand</option>
                <option value="TG">Togo</option>
                <option value="TK">Tokelau</option>
                <option value="TO">Tonga</option>
                <option value="TT">Trinidad en Tobago</option>
                <option value="TD">Tsjaad</option>
                <option value="CZ">Tsjechi&euml;</option>
                <option value="TN">Tunesi&euml;</option>
                <option value="TR">Turkije</option>
                <option value="TM">Turkmenistan</option>
                <option value="TC">Turks- en Caicoseilanden</option>
                <option value="TV">Tuvalu</option>
                <option value="UY">Uruguay</option>
                <option value="VU">Vanuatu</option>
                <option value="VA">Vaticaanstad</option>
                <option value="VE">Venezuela</option>
                <option value="AE">Verenigde Arabische Emiraten</option>
                <option value="US">Verenigde Staten</option>
                <option value="GB">Verenigd Koninkrijk</option>
                <option value="VN">Vietnam</option>
                <option value="WF">Wallis en Futuna</option>
                <option value="EH">Westelijke Sahara</option>
                <option value="BY">Wit-Rusland</option>
                <option value="ZM">Zambia</option>
                <option value="ZW">Zimbabwe</option>
                <option value="ZA">Zuid-Afrika</option>
                <option value="GS">Zuid-Georgia en de Zuidelijke Sandwicheilanden</option>
                <option value="KR">Zuid-Korea</option>
                <option value="SS">Zuid-Soedan</option>
                <option value="SE">Zweden</option>
                <option value="CH">Zwitserland</option>
              </select>
            </label>
          </div>
          <div class="form-group row mb-1">
            <label class="col-12 col-form-label form-control-label">
              <span class="form-label">Email * </span>
              <input class="form-control" type="email" name="email" value="" required="required">
              <div class="invalid-feedback">
                Dit moet ingevuld worden.
              </div>
            </label>
          </div>
          <div class="form-group row mb-1">
            <label class="col-12">
              Kies een van onderstaande betaalmogelijkheden:
            </label>
          </div>
          <div class="form-group row mb-1">
            <label class="col-12 input-group mb-1 col-form-label form-control-label">
              <div class="input-group-prepend">
                <div class="input-group-text">
                  <input type="radio" name="payment-method" id="bc" value="bancontact" required="required">
                </div>
              </div>
              <label for="bc" class="form-control">
                &nbsp;&nbsp;&nbsp;<img src="https://www.bancontact.com/img/bancontact/logo.svg" alt="" style="width: 2.5rem">
                &nbsp;&nbsp;&nbsp;Bancontact
              </label>
            </label>
          </div>
          <div class="form-group row mb-1">
            <label class="col-12 input-group mb-1 col-form-label form-control-label">
              <div class="input-group-prepend">
                <div class="input-group-text">
                  <input type="radio" name="payment-method" id="kbc" value="kbc" required="required">
                </div>
              </div>
              <label for="kbc" class="form-control">
                &nbsp;&nbsp;&nbsp;<img src="https://www.kbc.be/content/dam/particulieren/nl/campagne/fluitje-van-een-cent/kbc-touch-icoon.jpg.renditions./_jcr_content/renditions/cq5dam.web.680.9999.jpeg" alt="" style="width: 2.5rem">
                &nbsp;&nbsp;&nbsp;KBC Touch
              </label>
            </label>
          </div>
          <div class="form-group row mb-1">
            <label class="col-12 input-group mb-1 col-form-label form-control-label">
              <div class="input-group-prepend">
                <div class="input-group-text">
                  <input type="radio" name="payment-method" id="pp" value="paypal" required="required">
                </div>
              </div>
              <label for="pp" class="form-control">
                &nbsp;&nbsp;&nbsp;<img src="https://upload.wikimedia.org/wikipedia/commons/thumb/b/b5/PayPal.svg/1024px-PayPal.svg.png" alt="" style="width: 2.5rem">
                &nbsp;&nbsp;&nbsp;Paypal
              </label>
              <div class="invalid-feedback">
                Dit moet ingevuld worden.
              </div>
            </label>
          </div>
          <div class="row text-right">
            <div class="col-12">
              <p class="alert alert-secondary">
                Deze info is enkel voor facturatiedoeleinden.
                <br />Bestelde cursussen zijn steeds af te halen in de winkel.
                <br />
                Door op "Betalen" te klikken gaat u akkoord met de <a href="../terms" class="alert-link">verkoopsvoorwaarden</a>.
              </p>
              <button type="submit" class="btn btn-primary mb-5"><i class="fas fa-chevron-right"></i> Betalen</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<?php require_once 'includes/footer.php' ?>

<script>
// Example starter JavaScript for disabling form submissions if there are invalid fields
(function() {
  'use strict';
  window.addEventListener('load', function() {
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();
</script>
