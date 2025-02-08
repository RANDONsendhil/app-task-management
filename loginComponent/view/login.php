  <style>
.container {
  max-width: 500px;

  padding: 20px;
  background-color: #fff;
  border-radius: 8px;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}
  </style>
  <fieldset>
    <legend>
      <h3 class="text-center m-2">SE CONNECTER</h3>
    </legend>
    <div class="container-mb-5">
      <div class="container-sm shadow-lg p-3 mb-5 bg-body-tertiary rounded">
        <form method="POST" action="/">
          <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" required><br><br>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required><br><br>
            <input class="btn btn-primary align-center" type="submit" value="Login">
          </div>
        </form>
      </div>
  </fieldset>