
function openTabContent(evt, tabID) {
    // declare the variables used
    var i, tabcontent, tablinks;

    // Hide the tabcontent elements by default
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }

    // Make sure all the "tabLinks" elements do not have the "active" class
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }

    // Show the tab that was selected and add the "active" class to it
    document.getElementById(tabID).style.display = "block";
    evt.currentTarget.className += " active";
}
document.querySelectorAll('.tablinks').forEach(item => {
          item.addEventListener('click', function(){
          openTabContent(event,item.dataset.tab);
        });
  });
document.getElementById("defaultOpen").click();