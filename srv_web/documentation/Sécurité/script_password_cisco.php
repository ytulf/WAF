<?php
main();

function main() // Passé sous une fonction permettant aux erreur de faire juste un return et non un exit
{
// ********************************************
// Nom du script : script_password_cisco.php
// Auteur : Thomas SAVIO
// ********************************************

// **********************************************
// Récupération de la chaine crypté qui doit être déchiffré
// **********************************************
$password_crypte=$_POST['champ1'];
if ($password_crypte=="")
            $password_crypte="0820564B1B0D1C"; // S'il n'y a pas de chaine on en met une par défaut pour l'exemple


// **********************************************
// Initialisation des variables pour connaitre la longueur et le seed
// **********************************************
$len_password_crypte=strlen($password_crypte);
$valeur=0;
$seed=0;

// ********************************************
// Conversion de la chaine en minuscule afin de simplifier
// ********************************************
$password_crypte=strtolower($password_crypte);

// **********************************************
// Vérification si la chaîne saisie possède au minimum de 4 caractères
// **********************************************
if ($len_password_crypte<4)
            {
            echo '<p style="text-align: center;"><b>Erreur, </b>la chaine saisie est trop courte</p>';
            return (0);
            }

// **********************************************
// Vérification si la chaîne saisie n'est pas trop longue (ne dépasse pas 100 caractères)
// **********************************************
if ($len_password_crypte>100)
            {
            echo '<p style="text-align: center;"><b>Erreur, </b>la chaine saisie est trop longue</p>';
            return (0);
            }

// **********************************************
// Vérification si la chaîne saisie est bien paire (le hash ne fonctionne que par paire donc inutile de se préoccuper des chaines impaires)
// **********************************************
if ( ($len_password_crypte % 2) != 0) // % modulo et ne garde que ce qu'il y a après la virgule
            {
            echo '<p style="text-align: center;"><b>Erreur, </b>la chaine saisie ne contient pas un nombre paire de caractère</p>';
            return (0);
            }

// **********************************************
// Vérification si la chaîne siaise est bien en hexadécimal (le format par défaut)
// **********************************************
for ($i=0;$i<$len_password_crypte;$i++)
            if ( ((($password_crypte[$i]>='0')&&($password_crypte[$i]<='9')) || (($password_crypte[$i]>='a')&&($password_crypte[$i]<='f')))==0)
                        {
                        echo '<p style="text-align: center;"><b>Erreur, </b>le caractère numéro '.($i+1).' de la chaine saisie n\'est pas un caractère HEXA</p>';
                        return (0);
                        }

// **********************************************
// Initialisation des tableaux de correspondance statiques
// **********************************************
$tableau_de_caractere[0]=0x64;
$tableau_de_caractere[1]=0x73;
$tableau_de_caractere[2]=0x66;
$tableau_de_caractere[3]=0x64;
$tableau_de_caractere[4]=0x3b;
$tableau_de_caractere[5]=0x6b;
$tableau_de_caractere[6]=0x66;
$tableau_de_caractere[7]=0x6f;
$tableau_de_caractere[8]=0x41;
$tableau_de_caractere[9]=0x2c;
$tableau_de_caractere[10]=0x2e;
$tableau_de_caractere[11]=0x69;
$tableau_de_caractere[12]=0x79;
$tableau_de_caractere[13]=0x65;
$tableau_de_caractere[14]=0x77;
$tableau_de_caractere[15]=0x72;
$tableau_de_caractere[16]=0x6b;
$tableau_de_caractere[17]=0x6c;
$tableau_de_caractere[18]=0x64;
$tableau_de_caractere[19]=0x4a;
$tableau_de_caractere[20]=0x4b;
$tableau_de_caractere[21]=0x44;
$tableau_de_caractere[22]=0x48;
$tableau_de_caractere[23]=0x53;
$tableau_de_caractere[24]=0x55;
$tableau_de_caractere[25]=0x42;

// **********************************************
// Définition du seed
// **********************************************
$seed=($password_crypte[0]-'0')*10+($password_crypte[1]-'0');

// **********************************************
// Décryptage de chaque caractère
// **********************************************
for ($i=2;$i<=$len_password_crypte;$i++)
            {          
            if ( ($i!=2) && !($i&1) )
                        {
                        $password_en_claire[$i/2-2]=$valeur^$tableau_de_caractere[$seed];
                        $seed++;
                        $valeur=0;
                        }
                        
            $valeur=$valeur*16;

            if( ($password_crypte[$i]>='0') && ($password_crypte[$i]<='9') )
                        $valeur=$valeur+ord($password_crypte[$i])-ord('0');

            else if ( ($password_crypte[$i]>='a') && ($password_crypte[$i]<='f') )
                        $valeur=$valeur+ord($password_crypte[$i])-ord('a')+10;
             }

// **********************************************
// Longueur du mot de passe en claire
// **********************************************
$len_password_claire=($len_password_crypte/2)-1;

// **********************************************
// Transformation du tableau
// **********************************************
// La fonction 'Join' permet de convertir un tableau en chaine
// La fonction "array_map('chr'", permet de convertir les valeures ascii en caractere ascii, car $password_en_claire contient uniquement des nombres et pas des caractères
$password_en_claire_format_chaine=join(array_map('chr',$password_en_claire));

// ********************************************
// Affichage du résultat
// ********************************************
echo '<p style="text-align: center;"><b>Le resultat a été trouvé</b></p>

            <table border="0" id="dgdhdsu676ETTt" align="center">
                        <tr>
                                   <td width="50%"><p style="text-align: right;">HASH Cisco 7 demandé :</p></td>
                                   <td><p >'.$password_crypte.'</p></td>
                        </tr>
                        <tr>
                                   <td width="50%"><p style="text-align: right;">Mot de passe correspondant :</p></td>
                                   <td><p >'.$password_en_claire_format_chaine.'</p></td>
                        </tr>
            </table>
            ';
return(1);
}
?>
