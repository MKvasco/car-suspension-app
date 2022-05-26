<?php
session_start();
if (!isset($_SESSION["lang"])) { $_SESSION["lang"] = "en"; }
if (isset($_POST["lang"])) { $_SESSION["lang"] = $_POST["lang"]; }


require "./api/lang-" . $_SESSION["lang"] . ".php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Car Suspension Simulation</title>
    <style>
        @import "./Styles/basicStyle.css";
        @import "./Styles/animationStyle.css";
        @import "./Styles/formStyle.css";
        @import "./Styles/myStyle.css";

    </style>
    <link rel="stylesheet" media="print" href="./Styles/style_print.css">
</head>
<body lang="<?=$_SESSION["lang"]?>">
<div class="dont_print">
<header>
    <form method="post" id="form_language">
        <input type="submit" name="lang" value="en" id="en_flag"/>
        <input type="submit" name="lang" value="sk" id="sk_flag"/>
    </form>
    <h1 id="myflag"><?php echo $_TXT[0];?></h1>
</header>
<menu class="menu">
    <ul>
        <li>
            <a href="index.php"
            ><img alt="homeIcon" width="18" src="./Images/menu.png" /> <?php echo $_TXT[1];?></a
            >
        </li>
        <li>
            <a href=""
            ><img alt="mailIcon" width="18" src="./Images/email.png" /> <?php echo $_TXT[2];?></a
            >
        </li>
        <li>
            <a href=""
            ><img alt="infoIcon" width="18" src="./Images/information.png" />
                <?php echo $_TXT[3];?></a
            >
        </li>
        <li>
            <button type="button" onclick="setAsideVisible()">
                <img alt="UsersIcon" width="22" src="./Images/users.png" />
                <?php echo $_TXT[4];?>
            </button>
        </li>
    </ul>
</menu>

<aside id="otherUsers" style="display: none">
    <button type="button" onclick="setAsideInvisible()">
        <span>🗙</span>
    </button>
    <br />
    <ul id="listOfUsers">
    </ul>
</aside>
</div>

<h2 style=" background-color: #313551"><?php echo $_TXT[17];?></h2>
<div class="container" style="display: flex;align-items: flex-start;flex-direction: column;font-size: 20px;margin-left: 10%;width: 80%" >

    <div class="info-api" style="margin-top: 50px;width: 100%">
        <h2 style="background-color: #b3bbde;color: black;font-weight:bolder;padding-left: 0; border-bottom: 2px solid black;">API</h2>
        <h3><?php echo $_TXT[18];?></h3>
        <p>
            <b>[GET]</b>
            <?php echo $_TXT[19];?>
        </p>

        <h3><?php echo $_TXT[20];?></h3>
        <p>
            <b>[GET]</b>
            <?php echo $_TXT[21];?>
        </p>
    </div>

    <div class="info-website" style="margin-top: 50px;width: 100%" >
        <h2 style="background-color: #b3bbde;color: black;font-weight:bolder;padding-left: 0; border-bottom: 2px solid black;"><?php echo $_TXT[22];?></h2>
        <h3><?php echo $_TXT[23];?></h3>
        <p>
            <b style="color: whitesmoke;"><img   alt="homeIcon" width="18" src="./Images/user.png" /> <?php echo $_TXT[5];?></b>
            <?php echo $_TXT[24];?>
        </p>
        <h3>2.	<?php echo $_TXT[4];?></h3>
        <p>
            <b style="color: whitesmoke;"><img alt="UsersIcon" width="22" src="./Images/users.png" /> <?php echo $_TXT[4];?></b>
            <?php echo $_TXT[25];?>
        </p>
        <h3>3.	<?php echo $_TXT[3];?></h3>
        <p>
            <b style="color: whitesmoke;"><img alt="infoIcon" width="18" src="./Images/information.png" /> <?php echo $_TXT[3];?></b>
            <?php echo $_TXT[26];?>
        </p>
        <h3>4.	<?php echo $_TXT[2];?></h3>
        <p>
            <b style="color: whitesmoke;"><img alt="mailIcon" width="18" src="./Images/email.png" /><?php echo $_TXT[2];?></b>
            <?php echo $_TXT[27];?>
        </p>
        <h3>5.	<?php echo $_TXT[28];?></h3>
        <p>
            <img alt="mailIcon"  src="./Images/Info.png" />

    </div>

</div>

<button onclick="window.print()"><? echo $_TXT[29]?> </button>


<script src="./Scripts/animation.js"></script>
<script src="./Scripts/graph.js"></script>
<script src="./Scripts/index.js"></script>
<script src="https://cdn.plot.ly/plotly-2.4.2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/animejs@3.0.1/lib/anime.min.js"></script>
<script
    src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
    integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
    crossorigin="anonymous"
    referrerpolicy="no-referrer"
></script>
</body>
</html>
