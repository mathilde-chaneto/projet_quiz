const submitanswer = {

    checkAnswer: function(event) {

       // avoid the reload of page
        event.preventDefault();

         // get the click in the submit
        let submitTarget = event.target;
    

        //get the data-step of form
        let stepValidate = submitTarget.dataset.step;

        const urlCurrent = window.location.href;

        const partUrl = urlCurrent.split('/');

        const idURL = partUrl[4];
    
        console.log(idURL);
  
       

        const displayInfo = document.querySelectorAll('div.answer-content');
 

        const noAnswerInfo = document.querySelectorAll('div.warning');
       

        const sectionQuestion = document.querySelectorAll('section.questions');

        


      

       
        
        

        //browse all sections
            for(const section of sectionQuestion){
                //get their data step
                const keyStep = section.dataset.step;

                // if it's display block and data step of section and form match
                //browse all div info and no info, get their data step
                if(section.style.display == "block" && keyStep == stepValidate){
                  
                    //console.log
                    console.log(stepValidate);
                    console.log(keyStep);
                    console.log("premier check : ça correspond");

                    let checkedRadio = document.querySelectorAll('input[name="type"]:checked');

                   
                    for(const info of displayInfo){
                        let infoStep = info.dataset.step;   
                
                        for(const noInfo of noAnswerInfo){
                            let noInfoStep = noInfo.dataset.step ; 
                            
                            
                            if(infoStep == stepValidate && noInfoStep == stepValidate){
                                noInfo.classList.remove('none');
                            //browse all radiobutton
                            // for each of them, check if radiobutton is not null and their dsta step matchs with form data step
                            // if it is, get their data step,check if info and no info macth with form
                           for(const radio of checkedRadio){
                               
                               let radioStep = radio.dataset.step;
                               let radioDatasetQuestion = radio.dataset.question;
                               let answerId = radio.dataset.id;
                              
                               
                                if(radio != null && radioStep == stepValidate) {
                                
                                    

                                      //to access info about questions and answers
                                        let fetchOptions = {
                                            
                                            method: 'POST',
                                            
                                            mode: 'cors',
                                    
                                            cache: 'no-cache'
                                        }

                                    const requestUrl = fetch("http://localhost:8000/info/questions/" + radioDatasetQuestion , fetchOptions);


                                            requestUrl.then(

                                            function(response) {

                                                return response.json();
                                            })

                                                .then(
                                                    function(jsonResponse) {

                                                        const quest = jsonResponse;
                                                        const answerArray = quest.answerId;
                                                        console.log(quest); 
                                                   
                                                        for(const testAanswer in answerArray){

                                                            let getId = answerArray[testAanswer].id;
                                                            

                                                           

                                                            if(answerId == getId){
                                                                let isCorrect = answerArray[testAanswer].is_correct;
                                                                console.log(isCorrect);
                                                                
                                                                scoreDom = document.querySelectorAll('.score');

                                                                
                                                                if(isCorrect == true){
                                                                  
                                                                   score++;
                                                                   console.log("Bonne réponse !");
                                                                   scoreDom.innerHTML = score;

                                                                   for (const displayScore of scoreDom) {
                                                                     displayScore.innerText = "Score: " + score;
                                                                  }

                                                                  for (const displayAnswer of resultDom) {
                                                                    displayAnswer.innerText = "Bonne réponse !" ;
                                                                 }

                                                                   console.log("score" + score);
                                                             
                                                                }else {
                                                                    score;
                                                                    scoreDom.inner = score;

                                                                    for (const displayAnswer of resultDom) {
                                                                        displayAnswer.innerText = "Dommage, mauvaise réponse" ;
                                                                     }
                                                                    console.log("score" + score);
                                                                    console.log("Dommage, mauvaise réponse ");
                                                                }
                                                            }


                                                            
                                                        }
                                                     

                                                    }
                                                )

                                               


                                                if(infoStep == stepValidate && noInfoStep == stepValidate){

                                                        console.log("ça match !");
                                                        noInfo.classList.add('none');
                                                        info.classList.remove('none');
                                                    
                                                     
                                                        console.log('radio is selected');
                                                }


                                }else {
                                 
                                            if(infoStep == stepValidate && noInfoStep == stepValidate){
                                            
                                                info.classList.add('none');
                                                noInfo.classList.remove('none');
                                               
                                            }
                            
                                 }
                               
                           
                                
                                }

                            
                             

                            }
                                
                             
                            
                            
                        }
    
                    }
        
                }
                
            }
        
    },
     

}


