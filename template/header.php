<?php
ob_start();

include("functions/main.php");
?>
<!DOCTYPE html>
<head>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script src="functions/prototype.js"></script>
   <script type="text/javascript">
        $(document).ready(function(){

            $(".toggle_container").hide();
            $("h2.trigger").click(function() {

                $(this).next().toggle("normal");
                $(this).toggleClass("active");

                if($("h2.trigger").is(":visible"))
                {
                    $("h2.trigger").not($(this)).next().hide("normal");
                    $("h2.trigger").not($(this)).removeClass("active");
                }
            });
        });
    </script>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />

    <meta name="author" content="Michał Spirała" />

    <meta name="description" content="" />

    <meta name="keywords" content="" />

    <link rel="stylesheet" href="CSS/glowna.css" type="text/css" />

    <title><?php echo $title; ?></title>

</head>

<body>

    <div class="cookie-bar">
        <div>
            W ramach naszej witryny stosujemy pliki cookies, aby ułatwić Ci korzystanie z naszego serwisu oraz do celów statystycznych. Korzystanie z witryny bez zmiany ustawień dotyczących plików cookies oznacza zgodę na ich użycie oraz zapisanie w pamięci urządzenia. Możesz samodzielnie zarządzać cookies i dokonać zmiany ustawień w swojej przeglądarce.<br>
            </div>
    </div>
    <style type="text/css">
        .cookie-bar {position:relative; background:#eee; overflow:hidden; box-shadow:inset 0 -1px 1px rgba(0, 0, 0, 0.2);}
        .cookie-bar > div {font:11px Arial, sans-serif; color:#444; max-width:960px; margin:10px auto; text-align: left; padding-left:10px; padding-right:100px;}
        .cookie-bar a {text-decoration:none; color:#1373cc; text-decoration: underline;}
        .cookie-bar .close {font:bold 12px/28px Arial, sans-serif; color:#fff; position:absolute; top:50%; margin-top:-15px; right:10px; cursor:pointer; background: #666; display:inline-block; border-radius:3px; height:30px; width:60px; display:block; text-align:center; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;}
        .cookie-bar .close:hover {background:#555;}
        @media only screen and (max-width: 400px) {
            .cookie-bar > div {padding-left:10px; padding-right:10px; margin:15px 0;}
            .cookie-bar .close {position: relative; display:block; width:96%; margin:5px 2%; top:0; right:0;}
        }
    </style>

<div id="body">
<br /><br />
     <div id="menu">

        <ol>

            <?php
            include ('menu.php');
            ?>

        </ol>

    </div>

    <br />