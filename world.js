window.onload = (event) => {
   
    
    const buttonCo = document.querySelector("#lookup");
    const buttonCi = document.querySelector("#cityLookup");

    const btnListenerCo =() => buttonCo.addEventListener("click", handleClick1);
    const btnListenerCi =() => buttonCi.addEventListener("click", handleClick2);
   
    function handleClick1(event){ //handle click for country
        var country =  document.querySelector("input").value;
      
        event.preventDefault();
        
    
      httpRequest = new XMLHttpRequest();


        var url= "world.php?country="+country;
        httpRequest.open('GET', url, true);
        httpRequest.onreadystatechange = loadPlace;
        httpRequest.send();
        console.log(country);
        
    };
    function handleClick2(event){ // handle click for cities
        var country =  document.querySelector("input").value;
      
        event.preventDefault();
        
    
      httpRequest = new XMLHttpRequest();


        var url= "world.php?country="+country+"&Lookup=cities";
        httpRequest.open('GET', url, true);
        httpRequest.onreadystatechange = loadPlace;
        httpRequest.send();
    
        
    };

    function loadPlace() {
        if (httpRequest.readyState == XMLHttpRequest.DONE) {
            if (httpRequest.status==200) {
                var response = httpRequest.responseText;
                var result = document.querySelector("#result");
                result.innerHTML = response;
                console.log(response);
            }
            else {
                alert("Something went wrong");
            }
        }
    }
    btnListenerCo();
    btnListenerCi();
}