<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>

<?php   $arrayName = array('bob','machin','machine'); ?>
<?php $arrayCapital = array('France' =>'Paris' , 'USA' =>'Washington', 'Allemagne'=>'Berlin'); ?>
<p><?php print_r($arrayCapital) ?>;</p>

<h1>On est le <?php echo date('j F Y'); ?>.</h1>
<ul>
  <?php
  foreach ($arrayName as $value) {
    echo "<li> Son nom est $value.</li>\n";
  } ?>
</ul>

<table>
    <thead>
        <tr>
            <th>Pays</th>
            <th>Country</th>
        </tr>
    </thead>
    <tbody>
      <?php foreach ($arrayCapital as $key => $value){
        echo  "<tr>
                    <td> $key </td>
                    <td> $value </td>
                </tr>";
      }

        ?>
    </tbody>
</table>


  </body>
</html>
