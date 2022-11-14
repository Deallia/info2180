window.onload = (event) => {
   
    
    const button = document.querySelector("#lookup");
    
    const btnListener =() => button.addEventListener("click", handleClick);
    
   
    function handleClick(event){
        var country =  document.querySelector("input").value;
      
        event.preventDefault();
        
    
      httpRequest = new XMLHttpRequest();


        var url= "world.php?country="+country;
        httpRequest.open('GET', url, true);
        httpRequest.onreadystatechange = loadCountry;
        httpRequest.send();
        console.log(country);
        
    };

    function loadCountry() {
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
    btnListener();
}