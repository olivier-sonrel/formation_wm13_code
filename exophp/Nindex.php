<?php
echo "Combien y d'eleve:\n";
$nbrEleve = fread(STDIN, 80);

for ($i=0; $i < $nbrEleve ; $i++) {
  $num = $i + 1;
  echo "Nom eleve :$num\n";
  $nomEleve = fread(STDIN, 80);
  $tabEleve[$i] = ($nomEleve);
}

print_r($tabEleve);

echo "Il y a  '  $nbrEleve  '.\n";
?>
