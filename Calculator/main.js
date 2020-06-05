function getText(id) {
    var e = document.getElementById(id);
    return e.innerHTML;
}

function addText(id, newText) {
    var e = document.getElementById(id);
    var x = e.innerHTML;
    e.innerHTML = x + newText;
    return e.innerHTML;
}

function button(x) {
    var y = getText + x
}

function replace(id, text) {
    var e = document.getElementById(id);
    e.innerHTML = text
    return e.innerHTML
}

function clearText(id) {
    var e = document.getElementById(id);
    e.innerHTML = "";
    return e.innerHTMl;
}

function back(id) {
    var e = document.getElementById(id);
    e.innerHTML = e.innerHTML.slice(0, -1);
}

function on(id) {
    var disp = document.getElementById("disp");
    disp.style.backgroundColor = "#F7FFF7";
}

function off(id) {
    var disp = document.getElementById("disp");
    disp.style.backgroundColor = "#1A2326";
    disp.style.transition = "background-color 1s";
    disp.style.color = "#1A2326";
}