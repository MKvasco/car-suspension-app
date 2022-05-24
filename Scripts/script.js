var example = false;
var carAnim = false;


function readJSON(){
    fetch('./data3.json')
        .then((resp) => resp.json())
        .then((function (data){

            //READ FROM RETURNED DATA!!!!
            data.forEach( element =>{
                    t.push(parseFloat(element["t"]));
                    x1.push(parseFloat(element["x1"]));
                    x3.push(parseFloat(element["x3"]));
                    carData.push((parseFloat(element["x3"]))-0.5);
                }
            )
            setTraces();
            setMarkers(0);
            drawGraph();
            document.getElementById("checkboxes").style.display="block";
            document.getElementById("carSuspension").style.display="block";
        }))


}

function submitForm(){

    let exampleValue= document.getElementById("exampleValue").value;
    let rValue=document.getElementById("rValue").value;

    document.getElementById("outputBox").style.display="none";
    document.getElementById("checkboxes").style.display="none";
    document.getElementById("carSuspension").style.display="none";
    example = false;
    carAnim = false;

    if( exampleValue !==""){
        example=true;
    }
    else if( rValue!==""){
        carAnim=true;
        readJSON();

    }

    if(rValue==="" && exampleValue==="") {
        console.log("Values not set;");
        //show error message
    }
    else {
        //call getDataFromOctave
    }
}


function getDataFromOctave(){
    $.ajax({
        type: 'GET',
        url: '',
        success: function(msg){

            if(msg){
                //simple example
                if (example) {
                    if(msg['result']) {
                        document.getElementById("outputBox").style.display="block";
                        document.getElementById("result").innerText=msg['result'];
                    }
                }

                // car animation data
                if(carAnim){
                    msg['t'].forEach( element => {
                            t.push(parseFloat(element["t"]));
                    })
                    msg['y'].forEach( element =>{
                        x3.push(parseFloat(element["x3"]));
                        carData.push((parseFloat(element["x3"]))-0.5);
                    })
                    msg['x']['0'].forEach( element =>{
                        x1.push(parseFloat(element["x1"]));
                    })

                    //set graph
                    setTraces();
                    setMarkers(0);
                    drawGraph();

                    document.getElementById("checkboxes").style.display="block";
                    document.getElementById("carSuspension").style.display="block";
                }


            }
        }});
}


function showAnimation(){
   if(document.getElementById('animCheckbox').checked) {
       document.getElementById("animation").style.display='inline-block';
   }
   else document.getElementById("animation").style.display='none';
}

function showGraph(){
    if(document.getElementById('graphCheckbox').checked) {
        document.getElementById("graphBox").style.display='inline-block';
    }
    else document.getElementById("graphBox").style.display='none';
}


function makeDisable(inputId){

    if(inputId==="rValue"){
        if(document.getElementById(inputId).value!=="")
            document.getElementById("exampleValue").disabled=true;
        else
            document.getElementById("exampleValue").disabled=false;
    }
    else {
        if(document.getElementById(inputId).value!=="")
            document.getElementById("rValue").disabled=true;
        else
            document.getElementById("rValue").disabled=false;
    }

}