/*const form = {
    init: function() {



        const test1 = document.querySelectorAll('.control');
        test1[2].classList.add('correct-answers');


        const test2 = document.createElement("button");
        test2.setAttribute('id', 'add-answer');

        test1[0].appendChild(test2);


        const test3 = document.querySelectorAll('.field');
        test3[1].classList.add('field-answers');


        let fieldAnswers = document.querySelector('.field-answers');
        fieldAnswers.children[1].classList.add('control-input');


        let correctAnswers = document.querySelector('.correct-answers');
        fieldAnswers.appendChild(correctAnswers);

        let controlInput = document.querySelector('.control-input');
        controlInput.appendChild(correctAnswers);


        let buttonAnswer = document.getElementById('add-answer');
        buttonAnswer.innerHTML = "<p>Ajouter une réponse</p>";
        buttonAnswer.style.marginTop = "2rem";
        buttonAnswer.style.backgroundColor = "seagreen";

        buttonAnswer.addEventListener('click', form.field);


    },
    field: function(event) {

        const eventTarget = event.target;
        const test = parseInt(document.getElementById('answers_questions_numberAnswers').value);
        console.log(test);


        let controlInput = document.querySelector('.control-input');

        let correctAnswers = document.querySelector('.correct-answers');

        for (var i = 1; i <= test; i++) {


            let input = document.getElementById('answers_questions_nameAnswer');

            console.log(controlInput);

            inputClone = input.cloneNode(true);

            inputClone.id = "answers_questions_nameAnswer" + i;

            controlInput.appendChild(inputClone);

            input.nextElementSibling(inputClone);


            /* controlInput.appendChild(correctAnswers)

             let correct = document.getElementById('answers_questions_is_correct');

             correctClone = correct.cloneNode(true);

             correctClone.id = "answers_questions_is_correct" + i;

             correct.appendChild(correctClone);

             correct.nextElementSibling(correctClone);


        }






    }


};
document.addEventListener('DOMContentLoaded', form.init);*/
*