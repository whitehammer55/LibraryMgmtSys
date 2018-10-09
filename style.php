
<?php 
    header("Content-type: text/css; charset: UTF-8");
    // Rest of the file is interpreted as CSS

    // Source:
    // https://css-tricks.com/css-variables-with-php/

    // This line is needed to include PHP variables from global constants
    require_once 'common/global_constants.php';


?>


.header {
    background-color: #283593;
    height: 100px;

}
.main-content {
    background-color: #283593;
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

    height: 400px;
    overflow: auto;
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
            /*white-space: -o-pre-wrap;
          word-wrap: break-word;
          white-space: pre-wrap;
          white-space: -moz-pre-wrap;
          white-space: -pre-wrap;*/
        }

        /*td{
          white-space: -o-pre-wrap;
          word-wrap: break-word;
          white-space: pre-wrap;
          white-space: -moz-pre-wrap;
          white-space: -pre-wrap;
        }*/


        

/*Login Checkbox*/



/*Button Ripple CSS*/
*,
*:after,
*:before {
  box-sizing: border-box;  
}
html {
  -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
}

.c-ripple {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  overflow: hidden;
  background: transparent;
}

.c-ripple__circle {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  opacity: 0;
  width: 0;
  height: 0;
  border-radius: 50%;
  background: rgba(255, 255, 255, .25);
  .c-ripple.is-active & {
    animation: a-ripple .4s ease-in;
  }
}

/**
 * Animation: Ripple
 * --------------------------------------------------
 */

@keyframes a-ripple {
  0% {
    opacity: 0;
  }
  25% {
    opacity: 1;
  }
  100% {
    width: 200%;
    padding-bottom: 200%;
    opacity: 0;
  }
}
