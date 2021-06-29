<?php

    // Before any HTML code
    session_start();

    include_once("config/database.php");

    $database = new Database();
    $db = $database->getConnection();
    
    echo '<h1>Bienvenue</h1>';
    echo '<form method="post" action="controllers/posts.php">
    <fieldset>
    <legend>Connexion</legend>
    <p>
    <label for="email">Email : </label><input name="email" type="text" id="email" placeholder="Adresse mail" value="" autocomplete="off" /> <br />
<br />
    <label for="password">Mot de Passe : </label><input type="password" name="password" id="password" autocomplete="off"/>
    </p>
    </fieldset>
    <p><input type="submit" value="Connexion" /></p></form>
    <a href="../controllers/register.php">Pas encore inscrit ?</a>
     
    </div>
    </body>
    </html>';

?>
