<?php require "partials/head.php"; ?>

<h2 class="centered">Login</h2>

<div class="inputarea">
<form  action="/login" method="post">
    <label for="nimi">Nimi:</label>
    <input id="nimi" type="text" name="nimi" maxlength=30 autocomplete="off">
    <label for="sposti">Sähköposti:</label>
    <input id="sposti" type="text" name="sposti" maxlength="50" autocomplete="off">
    <label for="salasana">Salasana:</label>
    <input id="salasana" type="password" name="salasana" maxlength=30>
    <input id="sendbutton" type="submit" value="Lähetä">
</form>
</div>

<?php require "partials/footer.php"; ?>