const quiz = {
    init: function() {
        // start part of quiz page feature
      
      /* - select all button with class : button-orange-questions
         - define a global variable to access in another file to change score in submit.checkAnswer
         - select all div with class "score" (display "Score :" + number) use in submit.checkAnswer
         - select all p with class : result-answer ( display if godd or bad answer) use in submit.checkAnswer
         - browse array of buttons questions and add an event listener when we click on them, call the method : buttonFunction

       */
      

      const buttonQuestion = document.querySelectorAll('button.button-orange-questions');

      const urlCurrent = window.location.href;

        const partUrl = urlCurrent.split('/');

        const partIdURL = partUrl[4];
  
        let fetchOptions = {
                                            
            method: 'POST',
            
            mode: 'cors',
    
            cache: 'no-cache'
        }

        const requestUrl = fetch("http://localhost:8000/info/" + partIdURL , fetchOptions);


            requestUrl.then(

            function(response) {

                return response.json();
            })

                .then(
                    function(jsonQuiz) {

                        const infoQuiz = jsonQuiz;
                        const quizId = infoQuiz.id
                        console.log(infoQuiz);                   
                       
                        const quizDetail = {
                        
                          id : quizId,
                         
                          }
                          const data = JSON.stringify(quizDetail);
                          console.log(data);  

                    }
                )

      score = 0;
      scoreDom = document.querySelectorAll('.score');

      resultDom = document.querySelectorAll('.result-answer');
     

      for (const buttons of buttonQuestion) {
        buttons.addEventListener('click', quiz.buttonFunction);

      }

      //TODO : feature to can click on next button see the next questions..
      /*  const nextButton = document.querySelectorAll('button.button-orange-next');
          for(const nbuttons of nextButton){
          nbuttons.addEventListener('click', app.buttonNextFunction);
          }
      */ 
    },
    buttonFunction: function (event) {

        /*  - get button which is being clicked
            - put in variable the data-id of clickedButton
            - select sections with class : 'questions' 
            - browse the section array, and add condition : 
              compare the dataset id of section and button :
              If they match, show this section, if it 's not , hide her.
            - select all form with class : 'form'
            - browse the form array, add an event listener when we click on them and call the file submitanswer.js and the method : checkAnswer
            -
        */
        let clickedButton = event.target;

        let test = clickedButton.dataset.id;

        const sectionQuestion = document.querySelectorAll('section.questions');


        for (const sections of sectionQuestion) {
          let testSection = sections.dataset.id;


            if (test == testSection) {

              sections.style.display = "block";

            } else {

              sections.style.display = "none";

            }

        }

        const formQuiz = document.querySelectorAll('.form');

        for(const quiz of formQuiz){

        quiz.addEventListener('submit', submitanswer.checkAnswer);

        }


    },
  
};
document.addEventListener('DOMContentLoaded', quiz.init);



