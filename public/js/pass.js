const pass = {
    init: function() {
        
        // select all password input
            const input = document.querySelectorAll('input[type=password]');

                    // initialize the variable
                    var i = 0;

            // browse the input array
            for(const pass of input){

                // set dataset id with a counter
                pass.dataset.id = i++;
        
                //  create new element in DOM : new span
                const newElement = document.createElement('span');

                // snew span content 
                newElement.innerHTML = '<img src="https://img.icons8.com/office/30/000000/visible--v2.png" class="showHide" alt="show password" title="affiche le mot de passe"/>';
                
                // add class to new element
                newElement.classList.add('showHidden');

                // add class to input type password
                pass.classList.add('password');
                
                // select parent of new element : first element with control class
                const parent = pass.closest('.control');

                // bound new element to closest element
                parent.appendChild(newElement); 
              
            }  

            // initialize the variable
            var index = 0;

            // select all elements with showHide class
            const imageElement = document.querySelectorAll('.showHide');

            // browse the image array
            for(const image of imageElement){ 

                // set dataset id with a counter
                image.dataset.id = index++;

                // add an event listener, call methode
                image.addEventListener('click', pass.hideFunction);
           
                //console.log("c'est passé ");
                
            }
  
    },
    hideFunction: function(event) {

        // get the clicked element
        const clickedEye = event.target;

        // get his dataset id
        const idEye = clickedEye.dataset.id;

        //console.log('id de l oeil' + idEye);


        // select all input with password class
        const input = document.querySelectorAll('.password');

        // browse this array
        for(const passInput of input){
            
            // compare dataset id of ideEye is the same than input dataset id
            if (idEye == passInput.dataset.id){

                // check type of password input
                if(passInput.type === "password"){
                     //console.log('je suis id de input ' + passInput.dataset.id);
                
                     // set text type
                     passInput.type = "text";

                     // set attribute
                     clickedEye.setAttribute("src", "https://img.icons8.com/office/30/000000/closed-eye.png");
                     clickedEye.setAttribute("alt", "oeil fermé");
                     clickedEye.setAttribute("title", "cache le mot de passe");
                  
                }else {
                    //console.log('je suis id de input ' + passInput.dataset.id);
                
                    // set password type
                    passInput.type = "password";

                    // set attribute
                    clickedEye.setAttribute("src", "https://img.icons8.com/office/30/000000/visible--v2.png");
                    clickedEye.setAttribute("alt", "oeil ouvert");
                    clickedEye.setAttribute("title", "affiche le mot de passe");

                }
            } 
             
        }
      
      
    }, 
   

  };
  document.addEventListener('DOMContentLoaded', pass.init);
  