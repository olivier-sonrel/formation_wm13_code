<?php

$sommeNote=0;
$minNote=20;
$maxNote=0;

echo "Combien y d'eleve:\n";
(int)$nbrEleve = fread(STDIN, 80);

for ($i=0; $i < $nbrEleve ; $i++) {
  $num = $i + 1;
  echo "Note eleve :$num\n";
  $noteEleve = fread(STDIN, 80);
  $tabEleve[$i] = $noteEleve;
}

print_r($tabEleve);
echo "Il y a $nbrEleve eleves.\n";

foreach ($tabEleve as $value) {
  $sommeNote = $sommeNote + (int)$value;
    if ($value <= $minNote) {$minNote = $value;}
    if ($value >= $maxNote) {$maxNote = $value;}
}

$moyenne = (int)$sommeNote/(int)$nbrEleve;
echo "Moyenne note est $moyenne\n";
echo "note mini est $minNote\n";
echo "note max est $maxNote\n";

?>
