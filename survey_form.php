<?php 

 require_once 'common/global_constants.php';

                     $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

                        if($mysqli->connect_errno){
                           echo "Failure to connect : (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
                           die;
                        }


                                

                                $UID = $_POST['UID'];
                                $q1 = $_POST['q1'];
                                $q2 = $_POST['q2'];
                                $q3 = $_POST['q3'];
                                $q4 = $_POST['q4'];

                                

                            
                                $insert_sql =  "INSERT INTO survey(user_id, answer1, answer2, answer3, answer4) "
                                                . " VALUES ('$UID', '$q1', '$q2', '$q3', '$q4');";



                                                if(!$mysqli->query($insert_sql)){
                                                                echo "Query Failed!";
                                                            }

                                                
                                                else{
                                                        echo "
                                                                window.location.href='survey.php';
                                                                </script>";
   
                                                    }
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        
                                               


                    
                            
       

            ?>