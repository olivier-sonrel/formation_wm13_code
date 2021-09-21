<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>Combo Pays</title>
</head>

<body>
  <?php include("tab_pays.php") ?>
  <?php print_r($arrayPays) ?>
</br>
</br>

<form class="" action="reponse.php" method="post">
  <label for="pays-select">Choisis un pays:</label>
    <select name="ville" id="pays-select">
      "<option value="">--choisis un pays--</option>"
        <?php foreach ($arrayPays as $key => $value){
        echo "<option value='$value'>$key</option>";}?>
      </select>

        <input type="submit" value="Envoyer" />
        <input type="reset" value="Annuler" />
</form>

</body>
</html>
