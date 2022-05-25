<?php
session_start();
if (!isset($_SESSION["lang"])) { $_SESSION["lang"] = "en"; }
if (isset($_POST["lang"])) { $_SESSION["lang"] = $_POST["lang"]; }


require "../api/lang-" . $_SESSION["lang"] . ".php";

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
    <script src="https://cdn.plot.ly/plotly-2.4.2.min.js"></script>
    <script src="Scripts/graphScript.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/animejs@3.0.1/lib/anime.min.js"></script>
    <script src="./Scripts/script.js"></script>
  </head>
 <body lang="<?=$_SESSION["lang"]?>">
    <header>
      <form method="post" id="form_language">
      <input type="submit" name="lang" value="EN" id="en_flag"/>
      <input type="submit" name="lang" value="SK" id="sk_flag"/>
    </form>
      <h1 id="myflag"><?php echo $actualText["header"];?></h1>
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
          <a href=""
            ><img alt="loginIcon" width="18" src="./Images/user.png" />
            User_name</a
          >
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
      <label for="exampleValue" class="input-label"> Math example: </label>
      <textarea
        id="exampleValue"
        cols="50"
        rows="5"
        placeholder="Write some text..."
        onchange="makeDisable(id)"
      ></textarea>
      <br />
      <label for="rValue" class="input-label"> Value of r: </label>
      <input
        id="rValue"
        type="number"
        min="-1"
        max="1"
        step="0.01"
        placeholder="0,1"
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
  </body>
  <script src="./Scripts/animationScript.js"></script>
  <script></script>
</html>
