var example = false;
var carAnim = false;
let t = [];
let x1 = [];
let x3 = [];
let carData = [];

var r = 0.1;
var carPosition = 0;
var wheelRotation = 0;
var wheelPosition = 0;
var springHeight = 80;
let stopped = false;
let actualTime = 0;
var ctx;

let currentUser = null;

const userName = document.querySelector("#userNameInput");
const formHandler = document.querySelector("#formHandler");
let flag = true;

window.onload = function () {
  fetchUsers();
  //readJSON();
  canvas = document.getElementById("roadCanvas");
  ctx = canvas.getContext("2d");
  graphResize();
  //set sizes
  document.getElementById("wheelBox").style.width =
    String(document.getElementById("wheel").width) + "px";
  document.getElementById("wheelBox").style.height =
    String(document.getElementById("wheel").width) + "px";
  document.getElementById("carBox").style.width =
    String(document.getElementById("car").width) + "px";
  document.getElementById("carBox").style.height =
    String(document.getElementById("car").height) + "px";
};

// window.onunload = () => {}

window.onresize = function () {
  graphResize();
};

function setAsideVisible() {
  document.getElementById("otherUsers").style.display = "block";
}

function setAsideInvisible() {
  document.getElementById("otherUsers").style.display = "none";
}

function graphResize() {
  let graphWidth = window.innerWidth - 660;
  if (window.innerWidth < 1200) graphWidth = window.innerWidth - 50;

  document.getElementById("graphBox").style.width = String(graphWidth) + "px";
  drawGraph();
}

//TODO delete this function
function readJSON() {
  t = [];
  x1 = [];
  x3 = [];
  carData = [];
  fetch("./data3.json")
    .then((resp) => resp.json())
    .then(function (data) {
      //READ FROM RETURNED DATA!!!!
      data.forEach((element) => {
        t.push(parseFloat(element["t"]));
        x1.push(parseFloat(element["x1"]));
        x3.push(parseFloat(element["x3"]));
        carData.push(parseFloat(element["x3"]) - 0.5);
      });
      setTraces();
      setMarkers(0);
      drawGraph();
      document.getElementById("animationTitle").innerText =
        "Car suspension model r = " + x1[x1.length - 1];

      document.getElementById("checkboxes").style.display = "block";
      document.getElementById("carSuspension").style.display = "block";
      actualTime = 0;
    });
}

const submitForm = async () => {
  let exampleValue = document.getElementById("exampleValue").value;
  let rValue = document.getElementById("rValue").value;

  if (exampleValue === "" && rValue !== "") {
    formHandler.style.display = "none";
  }

  if (userName.value !== "" && rValue !== "") {
    const response = await fetch(
      `/api/data_upload.php?user=${userName.value}&value=${rValue}`
    );
    const result = await response.json();
    currentUser = result.user_id;
  }

  if (currentUser != null) {
    document.body.onbeforeunload = async () => {
      await fetch(`/api/data_upload.php?id=${currentUser}`);
      currentUser = null;
    };
  }

  document.getElementById("outputBox").style.display = "none";
  document.getElementById("checkboxes").style.display = "none";
  document.getElementById("carSuspension").style.display = "none";
  carAnim = false;

  if (exampleValue !== "") {
    userName.style.visbility = "hidden";
    exampleValue = encodeURIComponent(exampleValue);
    const response = await fetch(
      `/api/cas_api.php?token=WebteToken&priklad=${exampleValue}`
    );
    const result = await response.json();
    setValue(document.getElementById("exampleValue"), result.result);
  } else if (rValue !== "") {
    carAnim = true;
    //readJSON();
  }

  if (rValue === "" && exampleValue === "") {
    console.log("Values not set;");
    //show error message
  } else {
    //clear inputs
    document.getElementById("exampleValue").value = "";
    document.getElementById("rValue").value = "";

    //call getDataFromOctave
    getDataFromOctave(rValue);
  }
};
const setValue = (component, result) => {
  setTimeout(() => {
    component.value = result;
  }, 2);
};

const getDataFromOctave = async (rValue) => {
  $.ajax({
    type: "GET",
    url: `/api/cas_api.php?token=WebteToken&r=${rValue}`,
    success: function (msg) {
      if (msg) {
        //simple example
        if (example) {
          if (msg["result"]) {
            document.getElementById("outputBox").style.display = "block";
            document.getElementById("result").innerText = msg["result"];
          }
        }

        // car animation data
        if (carAnim) {
          t = [];
          x1 = [];
          x3 = [];
          carData = [];
          msg["t"].forEach((element) => {
            t.push(element);
          });
          msg["y"].forEach((element) => {
            x3.push(element);
            carData.push(element - 0.5);
          });
          msg["x"]["0"].forEach((element) => {
            x1.push(element);
          });

          //set graph
          setTraces();
          setMarkers(0);
          drawGraph();

          document.getElementById("animationTitle").innerText =
            "Car suspension model r = " + x1[x1.length - 1];
          document.getElementById("checkboxes").style.display = "block";
          document.getElementById("carSuspension").style.display = "block";
        }
      }
    },
  });
};

function showAnimation() {
  if (document.getElementById("animCheckbox").checked) {
    document.getElementById("animation").style.display = "inline-block";
  } else document.getElementById("animation").style.display = "none";
}

function showGraph() {
  if (document.getElementById("graphCheckbox").checked) {
    document.getElementById("graphBox").style.display = "inline-block";
  } else document.getElementById("graphBox").style.display = "none";
}

function makeDisable(inputId) {
  if (inputId === "rValue") {
    if (document.getElementById(inputId).value !== "")
      document.getElementById("exampleValue").disabled = true;
    else document.getElementById("exampleValue").disabled = false;
  } else {
    if (document.getElementById(inputId).value !== "")
      document.getElementById("rValue").disabled = true;
    else document.getElementById("rValue").disabled = false;
  }
}

const fetchUsers = async () => {
  const usersList = document.querySelector("#listOfUsers");
  const fetchData = async () => {
    const response = await fetch("/api/get_users.php");
    const result = await response.json();
    result.forEach((user) => {
      const li = document.createElement("li");
      const a = document.createElement("a");
      a.addEventListener("click", async () => {
        carAnim = !carAnim;
        await getDataFromOctave(user.value_r);
      });
      if (user.id != currentUser) {
        a.text = user.username;
        li.append(a);
        usersList.appendChild(li);
      }
    });
  };
  fetchData();
  setInterval(async () => {
    usersList.innerHTML = "";
    fetchData();
  }, 5000);
};
