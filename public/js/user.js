const user = {
    init: function() {

        const urlCurrent = window.location.href;

        const partUrl = urlCurrent.split('/');

        const partIdURL = parseInt(partUrl[4]);

  
        let fetchOptions = {
                                            
            method: 'POST',
            
            mode: 'cors',
    
            cache: 'no-cache'
        }

        const requestUrl = fetch("http://localhost:8000/info/user/" + partIdURL , fetchOptions);


            requestUrl.then(

            function(response) {

        
                return response.json();
               
            })

                .then(
                    function(jsonUser) {

                      
                      
                        // Converting json in js object
                        const test = JSON.parse(jsonUser.id);
                        console.log(test);

                        const user = {
                            "user_id": test,
                        }

                        //console.log(user);
                         // Converting js object in json
                        const data = JSON.stringify({"test" : [{user}] });
                        console.log(data);
                       
                       
                        let request = new XMLHttpRequest();

                        
                        const url = "http://localhost:8000/info/user/" + partIdURL ;

                        // open a connection
                        request.open("POST", url, true);
              
                        // Set the request header i.e. which type of content you are sending
                        request.setRequestHeader("Content-Type", "text/json");
              
                        // Sending data with the request
                        request.send(data);

                       //console.log(data);
                    

                    }
                )
        
               
    

    }
};
document.addEventListener('DOMContentLoaded', user.init);
