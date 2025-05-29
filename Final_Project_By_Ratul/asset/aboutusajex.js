function load() {
      let xhttp = new XMLHttpRequest();
     
      xhttp.open("GET", "aboutus.php", true);
      xhttp.send();
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          document.getElementById("demo").innerHTML = this.responseText;
        }
    }
    };