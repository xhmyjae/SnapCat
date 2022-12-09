// Assign the command to execute and the number of seconds to wait
var strCmd = "document.getElementById('popup').style.display = 'none'";
var waitseconds = 5;

// Calculate time out period then execute the command
var timeOutPeriod = waitseconds * 1000;
var hideTimer = setTimeout(strCmd, timeOutPeriod);