wheelSize = document.getElementById('wheel').width; // or just 100
animationBoxWidht=400;
wheelX = 225;
wheelY = 170;
var roadPartSize= Math.round(wheelSize/3) ;
var pixelRation=50;
var actualRoadPartX=wheelX+roadPartSize+1;
var actualRoadPartY=wheelY+wheelSize;

let m1Position;
let m2Position;
function drawRoad(i){

    ctx.clearRect(0,0,500,400);
    ctx.lineWidth=5;
    ctx.strokeStyle='#dbdbdc';
    ctx.beginPath();

    //draw first part of road
    let startX = actualRoadPartX;
    let startY=actualRoadPartY;
    let heightDifference = 0 ;

    for(y=0;y<= Math.round(actualRoadPartX/roadPartSize);y++){
        if(i-y>=0){
            heightDifference=x1[i-y]*(-pixelRation);
        }
        else heightDifference=0;
        ctx.moveTo(startX-roadPartSize, startY+heightDifference);
        if(i-y-1>=0){
            heightDifference=x1[i-y-1]*(-pixelRation)
        }
        else heightDifference=0;
        ctx.lineTo(startX,startY+heightDifference);
        startX-=roadPartSize;
    }

    //draw actual part
    ctx.moveTo(actualRoadPartX, startY+x1[i]*(-pixelRation));
    ctx.lineTo(actualRoadPartX+roadPartSize,startY+x1[i+1]*(-pixelRation));

    //draw last part of road
    startX = actualRoadPartX+roadPartSize;
    heightDifference = 0 ;
    for(y=1;y<=Math.round((animationBoxWidht-actualRoadPartX)/roadPartSize);y++){
        if(i+y<t.length){
            heightDifference=x1[i+y]*(-pixelRation);
        }
        else heightDifference=x1[t.length-1]*(-pixelRation);

        ctx.moveTo(startX, startY+heightDifference);

        if(i+y+1<t.length-1){
            heightDifference=x1[i+y+1]*(-pixelRation);
        }
        else
            heightDifference=x1[t.length-1]*(-pixelRation);

        ctx.lineTo(startX+roadPartSize,startY+heightDifference);
        startX+=roadPartSize;
    }
    ctx.stroke();
}

function playAnimation(){
    document.getElementById('playButton').disabled=true;
    stopped=false;
    myLoop(actualTime);
}

function stopAnimation(){
    stopped=true;
    document.getElementById('playButton').disabled=false;
}

function myLoop(i) {
    setTimeout(function () {
            if(stopped){
                actualTime=i;
                return;
            }

            carPosition=x1[i]*(-pixelRation);

            wheelRotation+=15;
            wheelPosition= x1[i]*(-pixelRation)-x3[i]*(-pixelRation)*10;

            //round values
            carPosition=Math.round(carPosition);
            wheelPosition=Math.ceil(wheelPosition);

            m1Position=Math.ceil(x1[i]*(-pixelRation));
            m2Position=Math.ceil(x3[i]*(-pixelRation));

            //animate car
            if(i>0 && carPosition !== x1[i-1]*(-pixelRation) ){
                anime({
                    targets:document.getElementById('carBox'),
                    translateY:carPosition
                });
            }

            //rotate wheel
            anime({
                targets:document.getElementById('wheel'),
                rotate:wheelRotation.toString()+'deg',
            });
            //animate wheel
            if(i>0 && wheelPosition !== x1[i-1]*(-pixelRation)-x3[i-1]*(-pixelRation)*10 ){
                anime({
                    targets:document.getElementById('wheelBox'),
                    translateY:wheelPosition
                });
            }

            //animate M1
            if(i>0 && m1Position !== Math.ceil(x1[i-1]*(-pixelRation)) ){
                anime({
                    targets:document.getElementById('M1'),
                    translateY:m1Position
                });
                anime({
                    targets:document.getElementById('springImage1'),
                    translateY:m1Position,
                    height: 100-m1Position
                })
            }

            //animate M2
            if(i>0 && m2Position !== Math.ceil(x3[i-1]*(-pixelRation)) ){
                anime({
                    targets:document.getElementById('M2'),
                    translateY:m2Position
                });
                anime({
                    targets:document.getElementById('springImage2'),
                    translateY:m2Position,
                    height: 100-m2Position
                })
            }

            drawRoad(i);

            //change markers on graph
            setMarkers(i);
            drawGraph();

            if (++i <t.length-1) myLoop(i);//  increment i and call myLoop again
            else {
                actualTime=0;
                document.getElementById('playButton').disabled=false;
            }
        },
        2)
}