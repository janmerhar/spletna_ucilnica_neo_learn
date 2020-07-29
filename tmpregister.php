<?php
    require_once 'php/htmfunkcije.php';
    navbar(3, "");
    if(isset($_SESSION['username']))
      header("Location: indeks.php");

    levo();
    glava();
    ?>
    <div class="login container">
          <h2>Registracija</h2>
          <form action="php/register.php" method="post">
            <div class="vnos">
              <input
                type="text"
                name="username"
                placeholder="Uporabniško ime"
                required
                pattern="[a-zA-Z0-9]+"
                onkeyup="preveriUsername(this)"
                id="username"
              />

              <input type="text" name="ime" placeholder="Ime" required 
              pattern="[a-zA-Z ]+"
              />

              <input
                type="text"
                name="priimek"
                placeholder="Priimek"
                required
                pattern="[a-zA-Z ]+"
              />

              <input
                type="email"
                name="email1"
                placeholder="E-pošta"
                required
              />

              <input
                type="email"
                name="email2"
                placeholder="Ponovi e-pošto"
                required
              />

              <input
                type="password"
                name="geslo"
                placeholder="Geslo"
                required
                id="password"
              />
              <div class="mb-4">
                <div class="pwstrength_viewport_progress"></div>
              </div>
              <input
                type="password"
                name="geslo2"
                placeholder="Ponovi geslo"
                required
              />
            </div>
            <input type="submit" value="Registracija" required 
            onclick="registerForm()"/>
          </form>
        </div>

        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Opozorilo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body" >
                Napaka pri vnosu podatkov!
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Zapri</button>
              </div>
            </div>
          </div>
        </div>
        <!-- $('#myModal').modal('show') -->
    <?php
    desno();

?>
<script src="node_modules/pwstrength-bootstrap/dist/pwstrength-bootstrap.min.js"></script>
<script>
jQuery(document).ready(function () {
        "use strict";
        var options = {};
        options.ui = {
            viewports: {
                progress: ".pwstrength_viewport_progress"
            },
            showVerdictsInsideProgressBar: true
        };
        options.common = {
            debug: true,
            onLoad: function () {
                $('#messages').text('Start typing password');
            }
        };
        $('#password').pwstrength({
            ui: { showVerdictsInsideProgressBar: true }
        });
    });
</script>