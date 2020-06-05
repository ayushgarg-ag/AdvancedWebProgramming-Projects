//Global variables
var key = -1;
var key1 = -1;
var xDir = "right";
var yDir = "down";
var scoreA = 0;
var scoreB = 0;
var timerNum = -1;
var countdowntimer = -1;
var gamemode = "start";
var timer = 10;

function keys() {
    //2 different key variables so both players can move their paddles at the same time.
    if (event.keyCode == 87 || event.keyCode == 83) {
        key = event.keyCode;
    }
    if (event.keyCode == 38 || event.keyCode == 40) {
        key1 = event.keyCode;
    }
}
function stop() {
    //2 different key variables to simultaneously control the left paddle with 'w' and 's' keys and the right paddle with the up and down arrow keys
    stopKey = event.keyCode;
    if (key == stopKey) {
        key = -1;
    }
    if (key1 == stopKey) {
        key1 = -1
    }
}

function move() {
    var x = parseInt(getStyle("ball", "left"));
    var y = parseInt(getStyle("ball", "top"));
    var bw = parseInt(getStyle("ball", "width"));
    var bh = parseInt(getStyle("ball", "height"));
    var fw = parseInt(getStyle("frame", "width"));
    var fh = parseInt(getStyle("frame", "height"));
    var lpw = parseInt(getStyle("leftpaddle", "width"));

    if (gamemode == "start") {
        //Checks for a collision between the paddles and the ball and sets the ball in the opposite direction
        if (collision("leftpaddle", "ball") == true) {
            // setStyle ("ball", "right", (fw - lpw - bw) + "px");
            xDir = "right";
        }
        if (collision("rightpaddle", "ball") == true) {
            // setStyle ("ball", "left", (fw - lpw - bw) + "px");
            xDir = "left";
        }

        //If the x direction is "right" then 6 is added to the ball's left and if not, then 6 is subtracted
        if (xDir == "right") {
            x = x + 6;
        }
        else {
            x = x - 6;
        }

        //If the ball touches the left or right sides of the frame then a point is added to the other side's score and the updated score is shown in the div.
        if (x <= -6) {
            // setStyle ("ball", "left", bw + "px");
            // xDir = "right";
            // if(scoreB < 10){
            scoreB = scoreB + 1;
            setText("p2score", scoreB)
            setStyle("ball", "left", ballposition + "px");
            gamemode = "stop";
            // timer = 20;
            // }
        }
        else if (x > fw - bw) {
            scoreA = scoreA + 1;
            setText("p1score", scoreA)
            setStyle("ball", "left", ballposition + "px");
            gamemode = "stop";
        }
        else {
            setStyle("ball", "left", x + "px");
        }

        //If the y direction is "down" then 6 is added to the ball's top and if not, then 6 is subtracted
        if (yDir == "down") {
            y = y + 6;
        }
        else {
            y = y - 6;
        }

        //If the ball touches the bottom or top sides of the frame, the ball bounches and it's direction changes
        if (y <= 0) {
            setStyle("ball", "top", y + "px");
            yDir = "down";
        }
        else if (y >= fh - bh + 6) {
            setStyle("ball", "top", (fh - bh) + "px");
            yDir = "up";
        }
        else {
            setStyle("ball", "top", y + "px");
        }
    }
    //If a player on either side scores 5, then the game is over and that player wins. Then, the page is reloaded to play again
    if (scoreA == 5) {
        scoreA = 0;
        alert("Game over! Player 1 wins!!");
        location.reload();
    }
    if (scoreB == 5) {
        scoreB = 0;
        alert("Game over! Player 2 wins!!");
        location.reload();
    }
    if (countdowntimer == -1) {
        countdowntimer = setInterval("ballpause()", 1250);
    }
}

function ballpause() {
    //If a point is scored, then this function is called. It waits for a little while before the ball starts moving again
    if (gamemode == "stop") {
        while (timer > 0) {
            timer = timer - 1;
        }
        if (timer == 0) {
            gamemode = "start";
        }
        timer = 10;
    }
}


function startgame() {
    //When this function is called, the move function is called to make the ball move and paddle functions to move the paddles
    gamemode = "start";
    if (timerNum == -1) {
        timerNum = setInterval("move()", 10);
        setInterval("leftpaddle()", 20);
        setInterval("rightpaddle()", 20);
    }
}


function stopMove() {
    if (timerNum != -1) {
        clearInterval(timerNum);
        timerNum = -1;
        gamemode = "pause";
    }
}

function leftpaddle() {
    if (gamemode == "start") {
        var y = parseInt(getStyle("leftpaddle", "top"));
        var fh = parseInt(getStyle("frame", "height"));
        var ph = parseInt(getStyle("leftpaddle", "height"));

        //If the 'w' key is pressed and if the ball is within the frame then move the ball's top position up 6
        if (key == 83 && y < fh - ph) {
            y = y + 6;
        }

        //If the 's' key is pressed and if the ball is within the frame then move the ball's top position down 6
        else if (key == 87 && y > 0) {
            y = y - 6;
        }
        setStyle("leftpaddle", "top", y + "px");
    }
}


function rightpaddle() {
    if (gamemode == "start") {

        var y = parseInt(getStyle("rightpaddle", "top"));
        var fh = parseInt(getStyle("frame", "height"));
        var ph = parseInt(getStyle("rightpaddle", "height"));

        //If the up arrow key is pressed and if the ball is within the frame then move the ball's top position up 6
        if (key1 == 40 && y < fh - ph) {
            y = y + 6;
        }
        //If the down arrow key is pressed and if the ball is within the frame then move the ball's top position down 6
        else if (key1 == 38 && y > 0) {
            y = y - 6;
        }
        setStyle("rightpaddle", "top", y + "px");
    }
}

function instructions() {
    var instructions = document.getElementById("howtoplay");
    instructions.style.opacity = "1";
    instructions.style.backgroundColor = "black";
    instructions.style.color = "white";
    instructions.style.left = "0px";
    instructions.style.top = "0px";
    instructions.style.width = "100%";
    instructions.style.height = "75vh";
    var stuff = "Click the 'W' and 'S' keys for Player 1. And the up and down arrow keys for Player 2."
    setText("howtoplay", stuff)
    var ballL = getStyle("ball", "left");
    var ballT = getStyle("ball", "top");
    setStyle("ball", "left", ballL);
    setStyle("ball", "top", ballT);
    gamemode = "pause"
    timerNum = 1;
}

function instructions2() {
    var instructions = document.getElementById("howtoplay");
    instructions.style.opacity = "0";
    instructions.style.color = "white";
    var stuff = "Click the 'W' and 'S' keys if you are Player 1 on the left. If you are Player 2 on the right, use the up and down arrow keys."
    setText("howtoplay", stuff)
    gamemode = "start";
}

function restart() {
    //Restarts the Page
    location.reload();
}

// locate the element in the document with the specified id and return its contents
function getText(id) {
    var e = document.getElementById(id);
    if (e === null) {
        alert("There is no element with the id: \"" + id + "\" in this document.");
        return null;
    }
    else {
        return e.innerHTML;
    }
}

// locate the element in the document with the specified id and change its contents to newText
function setText(id, newText) {
    var e = document.getElementById(id);
    if (e === null) {
        alert("There is no element with the id: \"" + id + "\" in this document.");
        return false;
    }
    else {
        e.innerHTML = newText;
        return true;
    }
}

// locate an element and add text to the end of what is already being displayed in it
function addText(id, text) {
    var current = getText(id);
    var newText = current + text;
    setText(id, newText);
}

function getStyle(id, property) {
    var e = document.getElementById(id);
    if (e === null) {
        alert("There is no element with the id: \"" + id + "\" in this document.");
        return null;
    }
    var strValue = "";

    // non-IE
    if (window.getComputedStyle) {
        strValue = getComputedStyle(e).getPropertyValue(property);
    }
    //IE
    else if (e.currentStyle) {
        try {
            strValue = e.currentStyle[property];
        }
        catch (e) {
            alert("The element with id: " + id + " does not contain a style property: " + property);
        }
    }

    return strValue;
}

function setStyle(id, property, value) {
    var e = document.getElementById(id);
    if (e === null) {
        alert("There is no element with the id: \"" + id + "\" in this document.");
        return null;
    }
    var cmd = "document.getElementById('" + id + "').style." + camelCase(property) + "='" + value + "';";
    eval(cmd);
    function camelCase(str) {
        return str.replace(/\-([a-z])/gi, function (match, p1) { // p1 references submatch in parentheses
            return p1.toUpperCase(); // convert first letter after "-" to uppercase
        });
    }
}

function collision(id1, id2) {
    // get bounding rectangle for each element
    var e1 = document.getElementById(id1);
    var rect1 = e1.getBoundingClientRect();
    var e2 = document.getElementById(id2);
    var rect2 = e2.getBoundingClientRect();

    // check for overlap for all four sides
    if (rect1.right >= rect2.left && rect2.right >= rect1.left && rect1.bottom >= rect2.top && rect2.bottom >= rect1.top) {
        return true;
    }
    else {
        return false;
    }

}