
        function checkEmail() {
            let email = document.getElementById('email').value;
            if(email.length === 0) {
                document.getElementById('email-msg').innerHTML = '';
                return;
            }

            let xhttp = new XMLHttpRequest();
            xhttp.open("POST", "../controller/email_check.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("email=" + (email)); 

            xhttp.onreadystatechange = function() {
                if(this.readyState === 4 && this.status === 200) {
                    document.getElementById('email-msg').innerHTML = this.responseText;
                }
            };
        }
