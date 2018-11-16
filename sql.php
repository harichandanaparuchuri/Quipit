<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once 'dbsql.php';


function getQuipList()
{
    // the SQL query to be executed on the database

    $query = "Select quipid, userid, quiptitle, quiptext, dateofquip, categoryid
            From [dbo].[quip]
           ";
   
   // call the executeQuery method (in dbConnExec.php)
   // and return the result

   return executeQuery($query);
   
   //Alternatively, call a stored procedure
   
//    return executeQuery("Exec getFilmsList");
}

function updateQuip($quipid, $quiptitle, $quiptext, $dateofquip, $categoryid)
{
    $quiptitle = str_replace('\'', '\'\'', trim($quiptitle));
    $quiptext = str_replace('\'', '\'\'', trim($quiptext));
   

    $query = <<<STR
Update [dbo].[quip]
Set quiptitle = '$quiptitle', quiptext = '$quiptext', dateofquip = '$dateofquip', categoryid = '$categoryid'
Where quipid = '$quipid'
STR;


    $results=executeQuery($query);
}