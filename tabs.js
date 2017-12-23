function openTabcontent(evt, tabName) {
    // declare the variables used
    var i, tabcontent, tablinks;
    
    // Hide all the "tabcontent" elements by default
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    
    // Make sure all the "tablinks" elements do not have the "active" class
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    
    // Show the tab that was selected and add the "active" class to it
    
    document.getElementById(tabName).style.display = "block";
    evt.currentTarget.className += " active";
}