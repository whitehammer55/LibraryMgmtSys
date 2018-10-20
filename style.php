
<?php 
    header("Content-type: text/css; charset: UTF-8");
    // Rest of the file is interpreted as CSS

    // Source:
    // https://css-tricks.com/css-variables-with-php/

    // This line is needed to include PHP variables from global constants
    require_once 'common/global_constants.php';


?>

*{
	font-family: helvetica;
}

.header {
    background-color: #283593;
    height: 100px;

}
.main-content {
    background-color: #6c757d;
    margin-left: <?php echo (SIDE_NAV_WIDTH + 60) . 'px'; ?>;
    margin-top: 30px;
    margin-right: 30px;

    /* + 10 is provide gap between side bar and main content */
}
.table-content {
    background-color: white;
    margin-left: <?php echo (SIDE_NAV_WIDTH + 60) . 'px'; ?>;
    margin-top: 30px;
    margin-right: 30px;
/*    overflow: auto;*/
}
.nav-bar {
    background-color: #283593;
    width: <?php echo SIDE_NAV_WIDTH . 'px'; ?>;
    position: fixed; /* Fixed Sidebar (stay in place on scroll) */
    height: 560px; /* Full-height */
    /*z-index: 1;*/  /*Stay on top */
    margin-top: 30px;
    margin-left: 30px;
}
.index-content{
    background-color: white;
    margin-left: <?php echo (SIDE_NAV_WIDTH + 60) . 'px'; ?>;
    margin-top: 30px;
    margin-right: 600px;
}
.bg{
  background-color: #f1f1f1 ;
}

        table, tr, td, th {
            border: 1px solid black;
            table-layout: fixed;
            word-wrap: break-word;
            width: 69%;
}

/*nav bar list position*/
.row{
                margin-left: 300px;
                margin-top: 25px;
           } 

        

/*Login Page*/
            
           .form-group.form-check.login{
                margin-top: 50px;
                width: 500px;

           }
           .login-header{
                margin-left: 200px;
           }
           .form-horizontal.login{
            margin-left: 80px;
           }
           .form-control.login{
                width: 350px;
                border-radius: 15px;
           }
           .form-control.btn.btn-primary.custom-btn.login{
                width: 350px; 
                border-radius: 15px; 
                background-color: #001064; 
                border-color: #001064; 
           }


/*Signup Page*/

            .signup_success_div_p{
                width: 40%;
                margin: auto;
                position: relative;
                padding: 10px;
                top: 50%;
                transform: translateY(-50%);


                text-align: center;
                background-color: #f1f1f4;
                font-size: 1.5em;
                border: 1px solid #f1f1e1;
                border-radius: 10px;
            }

            .col-sm-10.signup{
                width: 550px; 
                margin-left: 300px; 
                margin-top: 70px;
            }
            .signup-header{
                margin-left: 125px;
            }
            .form-horizontal.signup{
                margin-left: 50px;
            }
            .form-group.form-check.signup{
                margin-top: -50px;
            }
            .form-control.signup{
                width: 300px;
                border-radius: 15px;
            }
            .form-control.date.signup{
                width: 300px;
                border-radius: 15px;                
            }
            .form-control.btn.btn-primary.custom-btn.signup{
                width: 300px; 
                background-color: #001064;
                border-color: #001064; 
                border-radius: 15px;  
            }

/*            delete_books page*/

            .form-control.del-bks{
                width: 350px; 
                border-radius: 15px; 
                margin-top: 20px; 
            }

            .form-control.btn.btn-primary.custom-btn.del-bks{
                width: 350px; 
                border-radius: 15px; 
                background-color: #001064; 
                border-color: #001064; 

            }
            .p.del-bks{
                margin-left: 30px;
                margin-top: 15px;
                margin-bottom: 20px;
            }


            /*reissue/return books page*/

            .form-control.rrbks{
                width: 350px; 
                border-radius: 15px; 
                margin-top: 20px;
            }.form-control.btn.btn-primary.custom-btn.rrbks{
                width: 350px; 
                border-radius: 15px; 
                background-color: #001064; 
                border-color: #001064;
            }

/*            Add books page*/

            .form-control.add-bks{
                width: 350px; 
                border-radius: 15px; 
                margin-top: 20px; 
            }
            .form-control.btn.btn-primary.custom-btn.add-bks{
                width: 350px; 
                border-radius: 15px; 
                background-color: #001064; 
                border-color: #001064; 
                margin-left: 40px;
            }
            .p.add-bks{
                margin-left: 30px;
                margin-top: 15px;
            }

/*<!--             Issue Books page -->*/
            .form-control.ibks{
                width: 350px; 
                border-radius: 15px; 
                margin-top: 20px;
            }            
            .form-control.btn.btn-primary.custom-btn.ibks{
                width: 350px; 
                border-radius: 15px; 
                background-color: #001064; 
                border-color: #001064;
            }
            .p.ibks{
            	margin-left: 30px;
            	margin-top: 15px;
            }
/*            search books page*/
                .sfb{
                    border: 0px solid black;
                    table-layout: fixed;
                    word-wrap: break-word;
                    width: 69%
                }
                .form-control.sfb{
                    width: 600px; 
                    border-radius: 15px; 
                    margin-left: 25px; 
                    margin-top: 15px;
                }
                .form-control.btn.btn-primary.custom-btn.sfb{
                    width: 320px; 
                    background-color: #001064; 
                    border-color: #001064; 
                    border-radius: 15px; 
                    margin-left: 315px; 
                    margin-right: 15px; 
                    margin-top: 15px;
                }
/*                Survey Page*/
                .form-control.survey{
                    width: 350px; 
                    border-radius: 15px; 
                    margin-top: 20px; 
                }
                .form-control.btn.btn-primary.custom-btn.survey{
                    width: 350px; 
                    border-radius: 15px; 
                    background-color: #001064; 
                    border-color: #001064; 
                }
                .p.survey{
                    margin-left: 30px;
                    margin-top: 15px;
                }
                .surveyhead{
                    margin-left: 80px;
                }