<?php // 
	require_once 'dbsql.php';
//        $username="dtxcfvgh";
//        $firstname="rttfgy";
//        $lastname="rxtcfhgv";
//        $emailid="hari199@gmail.com";
//        $about="";$quipcount=0;$dateofmembership="2/21/2017";
//        $password="gvjbhnk";
//         $query = <<<ABC
//        Insert Into [dbo].[user](username,firstname,lastname,emailid,about,quipcount,dateofmembership,password)
//        Values('$username','$firstname','$lastname','$emailid','$about','$quipcount','$dateofmembership','$password') 
//ABC;
//            $results = executeQuery($query);
//            if($results){
//                echo"ftgyjhkl";
//            }  else {
//                
//            echo $results['userid'];
//                echo "chgvjbn,.";
//            }
//   // call the executeQuery method (in dbConnExec.php)
//   // and return the result
        
 //More than 100 million people worldwide are facing acute malnutrition and 
 //risk starving to death, a senior United Nations official has warned.
 //Latest figures showed 102 million people were on the brink of starvation last year,
 // an increase of almost 30 per cent from 80 million in 2015. The rise has been attributed 
 // to deepening humanitarian crises in Yemen, South Sudan, Nigeria and Somalia, where conflict
 // and severe drought have crippled food production levels.        
// require_once 'dbsql.php';
//$status="Novice";
//$point=0;
//$quiptitle="Number of people facing severe hunger rises";
//$quiptext="More than 100 million people worldwide are facing acute malnutrition and risk starving to death.";
//
//$dateofquip="3/7/2017";
//$categoryid=4;
//$userid=22;
//$category="Mi";
//if( strlen($quiptitle)>50 )
//{
//    echo "quip title length cannot be more than 50 chracters";
//}elseif(strlen($quiptext)>3000)
//{
//     echo "quip text length cannot be more than 3000 chracters";
//}
//else{
//   $query = <<<ABC
//        Insert Into [dbo].[quip](userid,quiptitle,quiptext,dateofquip,categoryid)
//        Values($userid,'$quiptitle','$quiptext','$dateofquip',$categoryid)
//ABC;
// $results = executeQuery($query);
//}
 
 //print_r($query);
                      //$query = "Insert Into quip(userid,quiptitle,quiptext,dateofquip,categoryid) Values('$userid','$quiptitle','$quiptext','$dateofquip','$categoryid')";
                      
//    $query = "Insert Into [dbo].[quip](userid,quiptitle,quiptext,) Values('useri)";
//                     $results = executeQuery($query);
//                     
//                    $quipcount= count($results);
//                    echo $quipcount;
//                     if(count($results)===1)
//                     {
//                         foreach($results as $res)
//                         {
//                             $status=$res['status'];
//                             echo $status;
//                         }
//                     }
                        
//                     echo $quipcount;
//                     
//                     
//// Values('$status','$points','$userid')
//                     
//require_once 'dbsql.php';
//       $comment="helllooooo ";
//       $userid=21;
//       $quipid=19;
//       $dateofcomment=date("Y-m-d h:i:sa");
// $query = <<<STR
//Delete
//From [dbo].[comments]            
//where quipid = $quipid 
//STR;
// $results=  executeQuery($query);   
//       
//        


//$quipid=27;
//               $query = "Select quiptitle,quiptext,dateofquip,categoryid From [dbo].[quip] Where quipid='$quipid'";
//                     $results = executeQuery($query);
//
//if(count($results)!=0)                    {
//        foreach($results as $res)
//            {
//                $Quiptitle=$res['quiptitle'];
//                $quiptext=$res['quiptext'];
//                $dateofquip=$res['dateofquip'];
//                $categoryid=$res['categoryid'];
//                
//                           //$query = "Select quipid From [dbo].[quip] Where userid='$userid'";
////                           echo $categoryid; 
//              
//                           echo"<br/>";
//                           echo $Quiptitle;
//                            echo"<br/>";  echo $quiptext;
//                            echo"<br/>";
//                            echo $dateofquip;
//                            echo"<br/>";
////                            echo $categoryid;
////                            echo"<br/>";
////                            echo $quipid;
////                            echo"<br/>";
//                              $query = "Select category From [dbo].[category] Where categoryid='$categoryid'";
//                $results0 = executeQuery($query);
//                if(count($results0)===1)
//                {                               
//                    foreach($results0 as $res0)
//                    {
//                        $category=$res0['category'];
//                        echo "category :".$category." ";
//                                  
//                    }
//                              
////                               echo $category;
//                }
//                            $query = "Select comment,dateofcomment,userid From [dbo].[comments] Where quipid='$quipid'";
//                            $results1 = executeQuery($query);
//                            //echo count($results1);
//                            if(count($results1)!=0)                    {
//        foreach($results1 as $res1)
//        {
//            $commentofquip=$res1['comment'];
//            $dateofcomment=$res1['dateofcomment'];
//            $useridofcomment=$res1['userid'];
//            
//            echo"comment:<br/>".$useridofcomment;
//            echo $commentofquip;
//            echo"<br/>".$dateofcomment;
//            echo"-------------------------------------------------<br/>";
//            
//        }    
//                       }
//                       else{
//                           echo"no comments";
//                       }
////}
//}}else
//         {
//             echo"there are no quips posted";
//         }
//
//// require_once 'dbsql.php';
//$status="Novice";
//$point=0;
$userid=18;
//$query=<<<ABC
//   Insert Into [dbo].[status](status,point,userid)
//   Values('$status','$points','$userid')    
//ABC;
//$results=  executeQuery($query);
        
        
        
//                   $statusquery=<<<ABC
//        Select point From [dbo].[status] Where userid='$userid'
//ABC;
//           $statusresults = executeQuery($statusquery);
//           if(count($statusresults)===1)
//           {
//           foreach($statusresults as $res)
//           {
//               $points=$res['point'];
//               echo "<script type='text/javascript'>alert('".$points."')</script>";
//               $points+=5;
//               //echo "<script type='text/javascript'>alert('".$points."')</script>";
//               $updatequery=<<<ABC
//        Update [dbo].[status] Set point='$points' Where userid='$userid'
//ABC;
//              $stresults = executeQuery($updatequery);
//              
//           }
//           }
$userid=22;
           $statquery=<<<ABC
        Select point From [dbo].[status] Where userid=22
ABC;
              $stresults = executeQuery($statquery);
               if(count($stresults)===1)
           {
           foreach($stresults as $res1)
           {
               
             $point=$res1['point'];
               //echo "<script type='text/javascript'>alert('".$point."')</script>";  
               
               if($point >150 & $point <=250)
                {//intrmediate
                   $status="intermediate";
                   $updatequery=<<<ABC
                  Update [dbo].[status] Set status='$status' Where userid='$userid'
ABC;
               
                 $stresults = executeQuery($updatequery);
                
                
                }
                if($point >250 & $point <=550)
                {
                   $status="practitioner";
                   $updatequery=<<<ABC
                  Update [dbo].[status] Set status='$status' Where userid='$userid'
ABC;
               
                 $stresults = executeQuery($updatequery);
                 //practioner
                }
                if($point >550 & $point <=750)
                {$status="expert";
                   $updatequery=<<<ABC
                  Update [dbo].[status] Set status='$status' Where userid='$userid'
ABC;
               
                 $stresults = executeQuery($updatequery);
                    //expert
                }
                if($point>1000)
                {$status="guru";
                   $updatequery=<<<ABC
                  Update [dbo].[status] Set status='$status' Where userid='$userid'
ABC;
               
                 $stresults = executeQuery($updatequery);
                    //guru
                }
           }
           } 
//                else{
//                     $status="Novice";
//                   $updatequery=<<<ABC
//                  Update [dbo].[status] Set status='$status' Where userid='$userid'
//ABC;
//               
//                 $stresults = executeQuery($updatequery);
//                
//                    echo"still novice";
//                }
//               
//               
//               
//               
//           }
//           }
//
//
//$statusquery=<<<ABC
//        delete point From [dbo].[status] Where userid='$userid''
//ABC;
//          $statusresults = executeQuery($statusquery);
//
//
////
//$updatedquiptitle="how are you guys!!!";
//$updatedquiptext=" hi i am chandana from csu.";
//$dateofquip=date("Y-m-d h:i:sa");
//$cid=9;
//$quipid=22;
//$query ="Update [dbo].[quip] Set quiptitle = '$updatedquiptitle', quiptext = '$updatedquiptext', dateofquip ='$dateofquip', categoryid= '$cid' Where quipid = '$quipid'";
//
//            $results = executeQuery($query);
//           

       ?>