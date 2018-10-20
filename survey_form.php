<?php 

 require_once 'common/global_constants.php';

                     $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

                        if($mysqli->connect_errno){
                           echo "Failure to connect : (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
                           die;
                        }

                                $UID = $_SESSION['user'];
                                $q1 = str_replace(' ', '', $_POST['q1']);
                                $q2 = str_replace(' ', '', $_POST['q2']);
                                $q3 = str_replace(' ', '', $_POST['q3']);
                                $q4 = str_replace(' ', '', $_POST['q4']);


                                

                            
                                $insert_sql =  "insert into survey(user_id, answer1, answer2, answer3, answer4)values('$UID','$q1','$q2','$q3','$q4');";



                                                if(!$mysqli->query($insert_sql)){
                                                                echo "Query Failed!";
                                                            }

                                                
                                                else{
                                                        echo "<script>
                                                                window.location.href='survey.php';
                                                                </script>";
   
                                                    }
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        
                                               


                    
                            
       

            ?>
