function openTable(evt, teamName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(teamName).style.display = "block";
  evt.currentTarget.className += " active";
}

function clearText(){
  document.getElementById("textField").value="";
}

function alertBox(){
  alert("Nova equipa criada!");
}

function disable(button) {
  document.getElementById(button).disabled=true;
}

function enable(button) {
  document.getElementById(button).disabled=false;
}

function table(){
  
}





