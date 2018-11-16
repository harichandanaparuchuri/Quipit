<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once ("sql.php");

// if $_POST has a filmpk element, call the update method

if (isset($_POST['quipid']))
{
    //echo"sfdwdwwff";
    updateQuip((int)$_POST['quipid'], $_POST['quiptitle'], $_POST['quiptext'],$_POST['dateofquip'], (int)$_POST['category']);
}


header("Location: yourquip.php");

exit;