
function validateForm() {
    var author = document.forms["feedbackForm"]["author"].value;
    var feedback = document.forms["feedbackForm"]["feedback"].values;
    if (author === "" || feedback === "") {
        document.getElementById("submitBtn").disabled = true;
    } else {
        document.getElementById("submitBtn").disabled = false;
    }
}