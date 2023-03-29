// add an event listener to the email input field
document.querySelector('#email').addEventListener('change', function() {
    // get the entered email address
    var email = this.value;

    // send an AJAX request to check if the email address is in the database
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'check_email.php');
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
        if (xhr.status === 200) {
            // parse the JSON response
            var response = JSON.parse(xhr.responseText);

            // check if the email address was found in the database
            if (response.status === 'success') {
                // display a welcome back message
                document.querySelector('#welcome-back-message').innerHTML = response.message;
            } else {
                // hide the welcome back message
                document.querySelector('#welcome-back-message').innerHTML = '';
            }
        }
    };
    xhr.send(encodeURI('email=' + email));
});