window.onload = function() {
    var lookupButton = document.getElementById("lookup");

    lookupButton.onclick = lookupCountry;

    function lookupCountry() {
        event.preventDefault();
        httpRequest = new XMLHttpRequest();
        var userInput = document.getElementById("country").value;
        var url = "world.php" + "?country=" + userInput;

        httpRequest.onreadystatechange = getResults;
        httpRequest.open('GET', url);
        httpRequest.send();
    }

    function getResults() {
        if(httpRequest.readyState === XMLHttpRequest.DONE) {
          if(httpRequest.status === 200) {
            var response = httpRequest.responseText;
            var resultDiv = document.getElementById("result");
            resultDiv.innerHTML = response;
          } else {
            alert("Something went wrong with the request! Request Status = " + httpRequest.status);
          }
        }
      }


}