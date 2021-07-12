const submitanswer = {

    checkAnswer: function(event) {
        // start traitment of form

       /*   - avoid the reload of page
            - get the click in the submit
            - get the data-step of form
            - select current url
            - cut url and get the id of quiz
            - select elemnt with id user, get his value
            - send theses data in back-end side
    
        ------launch jax request to get infos about user
            - select all div with class : 'answer-content' (show info+)
            - select all div with class : 'warning' (show message: 'no answer is selected')
            - select all sections with class : 'questions'
            - browse section array, get their dataset id, add condition :
            - if section has display block and if her dataset step of section match with dataset step of form :
              select all radio button with name : 'type'
              browse all div.answer-content and div.warning
              get their dataset step
            - another condition : if their dataset step match with the dataset step of form :
              show div.warning
            - browse radio buttons array
            - define :
              dataset step of radio button (id of step in form),  
              dataset questions (id of questions is bound) 
              dataset id (to identify id of answer in bdd)
            - condition : if radiobutton is not null (if it's selected) and their dataset step match with form data step.

        ------it is :  
              launch ajax request 
              define fetch options (methode http : 'post')
              give the url, id of questions (dataset questions) and fetch option to get infos about questions and answer
              get json data, save it in variable
              in another variable, define the array to browse
              browse this array and get porperty 'id'
              check if these id match with dataset id radio button 
              it is :
              get the property 'is_Correct' in  isCorrect
              select all div with class : 'score'
              check if value of iscorrect is true : 
              it is :
              increment score
              add  score in div.score
              add text in div.result-answer : "bonne réponse !"
              it is not :
              add  score in div.score
              add text in div.result-answer : "Dommage, mauvaise réponse"


            --if dataset step of div.warnig and div.answer-content check with dataset step of form :
              show div.answer-content
              hide div.warning

            --it is not :
              hide div.answer-content
              show div.warning 



       */
        event.preventDefault();

 
        let submitTarget = event.target;

        let stepValidate = submitTarget.dataset.step;



        const urlCurrent = window.location.href;

        const partUrl = urlCurrent.split('/');

        const quizId = partUrl[4];
    
        const user = document.getElementById('user').textContent;



        const displayInfo = document.querySelectorAll('div.answer-content');
 

        const noAnswerInfo = document.querySelectorAll('div.warning');
       

        const sectionQuestion = document.querySelectorAll('section.questions');

    
            for(const section of sectionQuestion){
          
                const keyStep = section.dataset.step;

                if(section.style.display == "block" && keyStep == stepValidate){

                    let checkedRadio = document.querySelectorAll('input[name="type"]:checked');

                   
                    for(const info of displayInfo){
                        let infoStep = info.dataset.step;   
                
                        for(const noInfo of noAnswerInfo){
                            let noInfoStep = noInfo.dataset.step ; 
                            
                            
                            if(infoStep == stepValidate && noInfoStep == stepValidate){
                                noInfo.classList.remove('none');

                           for(const radio of checkedRadio){
                               
                               let radioStep = radio.dataset.step;
                               let radioDatasetQuestion = radio.dataset.question;
                               let answerId = radio.dataset.id;
                              
                               
                                if(radio != null && radioStep == stepValidate) {
                                
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
                                                        //console.log(jsonResponse);

                                                        const quest = jsonResponse;
                                                        const answerArray = quest.answerId;
                                                   
                                                        for(const testAanswer in answerArray){

                                                            let getId = answerArray[testAanswer].id;

                                                            if(answerId == getId){
                                                                let isCorrect = answerArray[testAanswer].is_correct;
 
                                                                
                                                                scoreDom = document.querySelectorAll('.score');

                                                                // part to check if it's correct answer or not
                                                                if(isCorrect == true){

                                                                     score++;  
                                                                  
                                                                     if(!submitTarget.dataset.clicked) {
                                                                       
                                                                        submitTarget.dataset.clicked = true;

                                                                        console.log('1er click');


                                                                    } else {

                                                                        score--;
                                                                        console.log('deja clické !');

                                                                        return score;
                                                                        
                                                                    }
                                                                     // condition to limit the score on the active question
                                                                  
                                                                       
                                                                    

                                                                    var http = new XMLHttpRequest();
                                                                    var url = 'http://localhost:8000/info/'+ user;
                                                                    var params = '&quizId='+ parseInt(quizId) +'&score='+ score;
                                                                    http.open('POST', url, true);
                                            
                                                                    http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                                            
                                                                    //Call a function when the state changes.
                                                                    http.onreadystatechange = function() {
                                                                        if(http.readyState == 4 && http.status == 200) {
                                                                            console.log(score);
                                                                            //alert(http.responseText);
                                                                        }
                                                                    }
                                                                    http.send(params);
                                                    
                                                                   
                                                                   scoreDom.innerHTML = score;

                                                                   for (const displayScore of scoreDom) {
                                                                     displayScore.innerText = "Score: " + score;
                                                                   
                                                                  }

                                                                  for (const displayAnswer of resultDom) {
                                                                    displayAnswer.innerText = "Bonne réponse !" ;
                                                                    displayAnswer.style.color = "green";
                                                                 }

                                                                

                                                               
                                                             
                                                                }else {
                                                                    score;

                                                                    if(!submitTarget.dataset.clicked) {
                                                                       
                                                                        submitTarget.dataset.clicked = true;

                                                                        console.log('1er click');


                                                                    } else {

                                                                        score--;
                                                                        console.log('deja clické !');

                                                                        return score;
                                                                        
                                                                    }
                                                                
                                                                    for (const displayScore of scoreDom) {
                                                                        displayScore.innerText = "Score: " + score;
                                                                     }

                                                                    for (const displayAnswer of resultDom) {
                                                                        displayAnswer.innerText = "Dommage, mauvaise réponse" ;
                                                                        displayAnswer.style.color = "red";
                                                                     }

                                                                     var http = new XMLHttpRequest();
                                                                     var url = 'http://localhost:8000/info/'+ user;
                                                                     var params = '&quizId='+ parseInt(quizId) +'&score='+ score;
                                                                     http.open('POST', url, true);
                                             
                                                                     http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                                             
                                                                     //Call a function when the state changes.
                                                                     http.onreadystatechange = function() {
                                                                         if(http.readyState == 4 && http.status == 200) {
                                                                             console.log(score);
                                                                             //alert(http.responseText);
                                                                         }
                                                                     }
                                                                     http.send(params);
                                                                    
                                                                }
                                                            }


                                                            
                                                        }
                                                     
                                                       
                                                    }
                                                )

                                                if(infoStep == stepValidate && noInfoStep == stepValidate){

                                                        noInfo.classList.add('none');
                                                        info.classList.remove('none');
                                                    
                                                }

                                }else{
                                 
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


