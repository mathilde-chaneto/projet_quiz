const submitanswer = {

    checkAnswer: function(event) {

        // get the click in the submit
        event.preventDefault();

    
        let displayInfo = document.querySelectorAll('div.answer-content');
 

        let noAnswerInfo = document.querySelectorAll('div.warning');
       

        const sectionQuestion = document.querySelectorAll('section.questions');
        

        let selectedRadio = document.querySelector('input[name="type"]:checked');

        let webSite =  'https://localhost:8000';

        submitanswer.loadResponse();


        //browse section array
        //get the data-id for each section
        //check if section is "block"
        //if it is, browse info array and noInfo array, get their data-id
        //check if button radio is selected and check data-id with section's data-id
        
        // if their data-id match with section's data-id, and no button is selected show a div
        //to explain there is not answer selected. If one button is selected, hide the previous message and show the infoplus

        //probleme : when we select a button for ONE question send the form, and we select another question et send the form without button selected, 
        //we see the infoplus and we shouldn't see that in this case (where no button is selected);

        for(const section of sectionQuestion){
            const id = section.dataset.id;
            
            if(section.style.display == "block"){

                for(const info of displayInfo){
                    let test2 = info.dataset.id;   
                
                    for(const noInfo of noAnswerInfo){
                        let test1 = noInfo.dataset.id ;   

                        
                    
                        if(selectedRadio != null && test2 == id && test1 == id) {
    
                                
                                    info.classList.remove('none');
                                    noInfo.classList.add('none');
                                    console.log(info);
                                    console.log('radio is selected');
                                
                        }else {
                            
                            if(test2 == id && test1 == id){
                        
                            info.classList.add('none');
                            noInfo.classList.remove('none');
                            console.log('radio is not selected');
                            }
                            
                        }
    
                    }
        
                
                }



            }


        
        
        }
            
    },
    loadResponse: function(){

        let fetchOptions = {
            //http method
            method = 'GET',
            //security
            mode: 'cors',
            // no cache
            cache: 'no-cache'

        };
    
  
    }

};


   




