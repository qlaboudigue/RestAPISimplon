<?php

session_start();
$titre="Enregistrement";
//include("includes/identifiants.php");
//include("includes/debut.php");
//include("includes/menu.php");
echo '<p><i>Retour à l\'écran de connexion</i> : <a href="../index.php"> Se connecter </a>';

// if ($id!=0) erreur(ERR_IS_CO);

if (empty($_POST['email'])) // Si on la variable est vide, on peut considérer qu'on est sur la page de formulaire
{
    echo '<h1>Inscription</h1>';
    echo '<form method="post" action="register.php" enctype="multipart/form-data">
    <fieldset><legend>Identifiants</legend>
    <label for="Adresse mal">* Email :</label>  <input name="email" type="text" id="email" /> <br /> <br />
    <label for="password">* Mot de Passe :</label>  <input type="password" name="password" id="password" /><br /> <br />
    <label for="confirm">* Confirmer le mot de passe :</label>  <input type="password" name="confirm" id="confirm" />
    </fieldset>
        <br />
    <fieldset> <legend> Date de naissance </legend>
        <input type="date" id="start" name="trip-start"
               value="2000-01-01"
               min="1990-01-01" max="2021-01-01">
    </fieldset>
        <br />
    <p><input type="submit" value="S\'inscrire" /></p></form>
    </div>
    </body>
    </html>';
    
    
} //Fin de la partie formulaire


?>
