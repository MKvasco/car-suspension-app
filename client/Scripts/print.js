$(document).ready(function (){
    var specialElementHandlers = {
        "#editor":function (element, renderer){
            return true;
        }
    };
    $("#cmd").click(function (){
        var doc = new jsPDF();
        doc.formHTML($("#target").html(),15,15,{
            "width":170,
            "elementHandlers":specialElementHandlers
        });

        doc.save("car-suspension-app.pdf")
    });

});