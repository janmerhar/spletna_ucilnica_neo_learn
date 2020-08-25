<template>
  <div class="login">
    <h2>Prijava</h2>
    <div class="vnos">
      <input
        type="text"
        name="username"
        placeholder="Uporabniško ime"
        required
        pattern="[a-zA-Z0-9]+"
        id="username"
      />
      <input type="password" name="password" placeholder="Geslo" required id="password" />
    </div>
    <input type="submit" value="Prijavi se!" onclick="loginJS(event)" />
    <!-- $('#geslo').modal('show') -->
    <div
      class="modal fade"
      id="potrdi"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Opozorilo</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">Potrdite svoj uporabniški račun!</div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Zapri</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
