<?php
session_start();
  if (!isset($_SESSION["lang"])) { $_SESSION["lang"] = "en"; }
  if (isset($_POST["lang"])) { $_SESSION["lang"] = $_POST["lang"]; }


require "lang-" . $_SESSION["lang"] . ".php";
  ?>
<!doctype html>

<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">


    <link rel="stylesheet" href="myStyle.css">
    <link rel="stylesheet" media="print" href="style_print.css">

    <!--  <title>final</title>-->

    <title><?=$_TXT[0]?></title>
</head>
<body lang="<?=$_SESSION["lang"]?>">

<form method="post">
    <input type="submit" name="lang" value="en" id="en_flag"/>
    <input type="submit" name="lang" value="sk" id="sk_flag"/>
</form>


<div id="game">
    <p><?=$_TXT[1]?></p>
</div>
<p id="hra" style="display: none" ><?=$_TXT[2]?></p>

<button onclick="window.print()"><?=$_TXT[3]?> </button>

<script>
    function changeLanguage(lang) {
        location.hash = lang;
        location.reload();
    }
</script>

</body>
</html>