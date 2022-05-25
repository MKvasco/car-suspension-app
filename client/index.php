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
          <a href=""
            ><img alt="homeIcon" width="18" src="./Images/menu.png" /> Home</a
          >
        </li>
        <li>
          <a href=""
            ><img alt="mailIcon" width="18" src="./Images/email.png" /> Mail</a
          >
        </li>
        <li>
          <a href=""
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

    <form>
      <input
        id="userNameInput"
        type="text"
        placeholder="Enter Username"
        style="visibility: hidden"
      />
      <br />
      <textarea
        id="exampleValue"
        cols="50"
        rows="5"
        placeholder="Math example -> Write some text..."
        onchange="makeDisable(id)"
      ></textarea>
      <br />
      <input
        id="rValue"
        type="number"
        min="-1"
        max="1"
        step="0.01"
        placeholder="Value of r -> 0.1"
        onchange="makeDisable(id)"
      />
      <br />
      <button class="button" type="button" onclick="submitForm()">OK</button>
      <br />
      <div class="output-box" id="outputBox" style="display: none">
        <output id="result">Output text</output>
      </div>
    </form>

    <div id="checkboxes" style="display: none">
      <h2 id="animationTitle"></h2>
      <input
        id="animCheckbox"
        type="checkbox"
        checked
        onchange="showAnimation()"
      /><label for="animCheckbox">Animation</label>
      <input
        id="graphCheckbox"
        type="checkbox"
        checked
        onchange="showGraph()"
      /><label for="graphCheckbox">Graph</label>
    </div>

    <div id="carSuspension" style="display: none">
      <div id="animation">
        <div id="controlPanel">
          <button
            type="button"
            class="control-button"
            id="playButton"
            onclick="playAnimation()"
          >
            ▶<span>Play</span>
          </button>
          <button
            type="button"
            class="control-button"
            onclick="stopAnimation()"
          >
            ◼<span>Stop</span>
          </button>
        </div>

        <div style="display: grid; grid-template-columns: 2fr 1fr">
          <div id="animationBox" class="animation-box">
            <div id="carBox">
              <img
                alt="carImage"
                id="car"
                src="./Images/halfCarWhitePNG.png"
                width="400"
              />
            </div>
            <div id="wheelBox">
              <img
                alt="wheelImage"
                id="wheel"
                src="./Images/wheelWhitePNG.png"
                width="100"
                height="100"
              />
            </div>
            <canvas id="roadCanvas" width="500" height="400"> </canvas>
          </div>

          <div id="animationBox2" class="animation-box2">
            <div id="M1">M1</div>
            <div id="spring1">
              <img
                alt="springImage"
                id="springImage1"
                src="./Images/sp.png"
                width="20"
                height="100"
              />
            </div>
            <div id="M2">M2</div>
            <div id="spring2">
              <img
                alt="springImage"
                id="springImage2"
                src="./Images/sp.png"
                width="20"
                height="100"
              />
            </div>
            <div id="road2"></div>
          </div>
        </div>
      </div>

      <div class="graph-box" id="graphBox">
        <div id="graph"></div>
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
<!-- <!doctype html>

<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">


    <link rel="stylesheet" href="myStyle.css">
    <link rel="stylesheet" media="print" href="style_print.css">

     <title>final</title>

    <title><? //=$_TXT[0]?></title>
</head>
<body lang="<? //=$_SESSION["lang"]?>">

<form method="post">
    <input type="submit" name="lang" value="en" id="en_flag"/>
    <input type="submit" name="lang" value="sk" id="sk_flag"/>
</form>

<form method="post" action="mailto:">

</form>


<div id="game">
    <p><?//=$_TXT[1]?></p>
</div>
<p id="hra" style="display: none" ><?//=$_TXT[2]?></p>

<button onclick="window.print()"><?//=$_TXT[3]?> </button>

<script>
    function changeLanguage(lang) {
        location.hash = lang;
        location.reload();
    }
</script>

</body>
</html> -->
