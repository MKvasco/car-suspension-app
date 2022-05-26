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
</head>
<body lang="<?=$_SESSION["lang"]?>">
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
            ><img alt="homeIcon" width="18" src="./Images/menu.png" /> Home</a
            >
        </li>
        <li>
            <a href=""
            ><img alt="mailIcon" width="18" src="./Images/email.png" /> Mail</a
            >
        </li>
        <li>
            <a href="#"
            ><img alt="infoIcon" width="18" src="./Images/information.png" />
                Help</a
            >
        </li>
        <li>
            <button type="button" onclick="setAsideVisible()">
                <img alt="UsersIcon" width="22" src="./Images/users.png" /> Other
                users
            </button>
        </li>
        <li class="userName">
            <button type="button" onclick="setInputUserNameVisible()">
                <img alt="loginIcon" width="18" src="./Images/user.png" />
                User Name
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
        <li><a href="">User1</a></li>
        <li><a href="">User2</a></li>
        <li><a href="">User3</a></li>
    </ul>
</aside>
<h2 style=" background-color: #313551">Informácie o API a webovej stránke</h2>
<div class="container" style="display: flex;align-items: flex-start;flex-direction: column;font-size: 20px;margin-left: 10%;width: 80%" >

    <div class="info-api" style="margin-top: 50px;width: 100%">
        <h2 style="background-color: #b3bbde;color: black;font-weight:bolder;padding-left: 0; border-bottom: 2px solid black;">API</h2>
        <h3>1.	Získať json hodnôt pre animáciu</h3>
        <p>
            <b>[GET]</b>
            cas_api.php?token=WebteToken&r=0.2
        </p>

        <h3>2.	Získanie json pre výsledok príkladu</h3>
        <p>
            <b>[GET]</b>
            cas_api.php?token=WebteToken&priklad=1+1
        </p>
    </div>

    <div class="info-website" style="margin-top: 50px;width: 100%" >
        <h2 style="background-color: #b3bbde;color: black;font-weight:bolder;padding-left: 0; border-bottom: 2px solid black;">Webová stránka</h2>
        <h3>1.	Zadanie mena</h3>
        <p>
            <b style="color: whitesmoke;"><img   alt="homeIcon" width="18" src="./Images/user.png" /> User Name</b>
            Zadanie mena používateľa umožní sledovanie jeho simulácie inými používateľmi.
        </p>
        <h3>2.	Ďalší používatelia</h3>
        <p>
            <b style="color: whitesmoke;"><img alt="UsersIcon" width="22" src="./Images/users.png" /> Other users</b>
            Zadanie mena používateľa umožní sledovanie jeho simulácie inými používateľmi.
        </p>
        <h3>3.	Pomoc</h3>
        <p>
            <b style="color: whitesmoke;"><img alt="infoIcon" width="18" src="./Images/information.png" /> Pomoc</b>
            Informácie o webovej stránke a API.
        </p>
        <h3>4.	Mail</h3>
        <p>
            <b style="color: whitesmoke;"><img alt="mailIcon" width="18" src="./Images/email.png" /> Mail</b>
            Zaslanie logov na mail.
        </p>
        <h3>5.	Ovládanie</h3>
        <p>
            <img alt="mailIcon"  src="./Images/Info.png" />

    </div>

</div>

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
