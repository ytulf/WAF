### Téléchargement des sources
`wget https://www.cert.ssi.gouv.fr/feed/ -O cert.txt`;

### On isole les titres, descriptions et URL pour les détails

# On crée un tableau pour insérer les valeurs
my @list = ();

# On récupére les éléments du fichier
open FILE1, "< cert.txt";
while ($reg1 = <FILE1>) {
	$reg1 =~ /<t.*>(.*)<\/t.*>.*\s*<l.*>(.*)<\/l.*>.*\s*.*\s.*\s*<d.*>(.*)<\/p> \]\]><\/d.*>/g;
	$titre = $1;
	$url = $2;
	$description = $3;
    @list = ($1, $2 , $3);
   }
print '@list';

