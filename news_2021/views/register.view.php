<?php require "partials/head.php"; ?>

<h2 class="centered">Rekisteröidy</h2>

<div class="inputarea">
<form  action="/register" method="post">
    <label for="nimi">Etunimi:</label> 
    <input id="nimi" type="text" name="nimi" maxlength=30>
    <label for="sposti">Sähköposti:</label>
    <input type="email" name="sposti" id="sposti" maxlength=30>
    <label for="salasana">Salasana:</label>
    <input id="salasana" type="password" name="salasana" maxlength=30>
    <input id="sendbutton" type="submit" value="Lähetä">
</form>
</div>

<?php require "partials/footer.php"; ?>