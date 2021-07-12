const pass = {
    init: function() {
        
            const input = document.querySelectorAll('input[type=password]');

            for(const pass of input){
        
                const newElement = document.createElement('span');
                newElement.innerHTML = '<img src="https://img.icons8.com/office/30/000000/visible--v2.png" class="showHide" alt="show password" title="affiche le mot de passe"/>';
                newElement.classList.add('showHidden');
                pass.classList.add('password');
                
                const parent = pass.closest('.control');
                parent.appendChild(newElement); 
              
            }  

            var index = 0;

            const imageElement = document.querySelectorAll('.showHide');

            for(const image of imageElement){ 

                image.dataset.id = index++;
                image.addEventListener('click', pass.hideFunction);
           
                console.log("c'est passé ");
                
            }

            var i = 0;
            for( const passInput of input){

                passInput.dataset.id = i++;
            }
  
    },
    hideFunction: function(event) {

        const clickedEye = event.target;

        const idEye = clickedEye.dataset.id;

        console.log('id de l oeil' + idEye);

        const input = document.querySelectorAll('.password');

        for(const passInput of input){
            

            if (idEye == passInput.dataset.id && passInput.type === "password") {
                console.log('je suis id de input ' + passInput.dataset.id);
                
                    passInput.type = "text";
                    clickedEye.setAttribute("src", "https://img.icons8.com/office/30/000000/closed-eye.png");
                    clickedEye.setAttribute("alt", "oeil fermé");
                    clickedEye.setAttribute("title", "cache le mot de passe");
                        

            } else if (idEye == passInput.dataset.id && passInput.type === "text") {
                console.log('je suis id de input ' + passInput.dataset.id);
                
                    passInput.type = "password";
                    clickedEye.setAttribute("src", "https://img.icons8.com/office/30/000000/visible--v2.png");
                    clickedEye.setAttribute("alt", "oeil ouvert");
                    clickedEye.setAttribute("title", "affiche le mot de passe");

            } 
    
             
        }
      
      
    }, 
   

  };
  document.addEventListener('DOMContentLoaded', pass.init);
  