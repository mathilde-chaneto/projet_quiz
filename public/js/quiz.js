const quiz = {
    init: function() {
        // start part of quiz page feature

        /*
           - select all button with class : button-orange-questions
           - define a global variable to access in another file to change score in submit.checkAnswer
           - select all div with class "score" (display "Score :" + number) use in submit.checkAnswer
           - select all p with class : result-answer ( display if godd or bad answer) use in submit.checkAnswer
           - browse array of buttons questions and add an event listener when we click on them, call the method : buttonFunction
         */


        // do something better than that
        // try with export import but the page reload and I don't why, stay on the same page
        // so I'm looking for to improve theses few variables
        // try with var : not works

        cptInput = 0;

        score = 0;

        cptTrue = 0;

        confirm = null;

        const buttonQuestion = document.querySelectorAll('button.button-orange-questions');

        for (const buttons of buttonQuestion) {

            buttons.addEventListener('click', quiz.buttonFunction);

        }
        //console.log("je suis là");

    },
    buttonFunction: function(event) {

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

        const sectionQuestion = document.querySelectorAll('section.quiz-questions');
        //console.log("je suis là 2");


        for (const sections of sectionQuestion) {
            let testSection = sections.dataset.id;

            if (test == testSection) {

                sections.style.display = "block";
                //console.log("je suis là 3");

            } else {

                sections.style.display = "none";
                //console.log("je suis là 4");

            }

        }

        const formQuiz = document.querySelectorAll('.form');

        for (const quiz of formQuiz) {


            quiz.addEventListener('submit', submitanswer.checkAnswer);

        }

    },

};
document.addEventListener('DOMContentLoaded', quiz.init);