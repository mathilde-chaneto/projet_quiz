const submitanswer = {

    checkAnswer: function (event) {
        // start traitment of form

        // avoid the reload of page


        event.preventDefault();

        cptInput = 0;

        // get the click in the submit
        let submitTarget = event.target;

        // get the data-step of form
        let stepValidate = submitTarget.dataset.step;

        // get current url
        const urlCurrent = window.location.href;

        // separate url
        const partUrl = urlCurrent.split('/');

        // get quiz id
        const quizId = partUrl[4];

        // get user id 
        const user = document.getElementById('user').textContent;
        //console.log(user);


        // select all info+
        const displayInfo = document.querySelectorAll('div.answer-content');

        // select all warning message we send an empty form
        const noAnswerInfo = document.querySelectorAll('div.warning');

        // select all div 'section.questions'
        const sectionQuestion = document.querySelectorAll('section.questions');









        // browse section.questions array
        for (const section of sectionQuestion) {

            // get their data-step
            const keyStep = section.dataset.step;

            // if display section is block and their data-step matches with data-step of form
            if (section.style.display == "block" && keyStep == stepValidate) {

                // get all input named by "type" and checked
                //checked = property to check if it's true
                let checkedRadio = document.querySelectorAll('input[name="type"]:checked');


                // browse info+ array
                for (const info of displayInfo) {

                    // get their data-step
                    let infoStep = info.dataset.step;

                    // browse warning message array
                    for (const noInfo of noAnswerInfo) {

                        //get their data-step
                        let noInfoStep = noInfo.dataset.step;

                        // if data-stepf of info+ matches with data-step of form and same thing with warning message data-step
                        if (infoStep == stepValidate && noInfoStep == stepValidate) {

                            // remove class 'none'  on warning message
                            noInfo.classList.remove('none');

                            // browse input named 'type' and checked (array) ***
                            for (const radio of checkedRadio) {

                                // get data-step of input
                                let radioStep = radio.dataset.step;

                                // get data-questions (id of question)
                                let radioDatasetQuestion = radio.dataset.question;

                                // gete data-id of answer
                                let answerId = radio.dataset.id;


                                //console.log(arrayAnswerId);

                                //  if input is not null and input data-step matches with data-step of form 
                                if (radio != null && radioStep == stepValidate) {

                                    // put in an array id of user answers he's selected
                                    let arrayAnswerId = [
                                        parseInt(answerId),
                                    ];


                                    for (let test of arrayAnswerId) {
                                        cptInput++;
                                    }

                                    //just get informations on this link
                                    const url = "http://localhost:8000/info/questions/" + radioDatasetQuestion;


                                    var request = new Request(url, {
                                        method: 'POST',
                                        mode: 'cors',
                                        cache: 'no-cache'
                                    })

                                    // get request
                                    fetch(request)
                                        .then(function (response) {

                                            // get json object
                                            return response.json();

                                        })
                                        .then(function (jsonResponse) {

                                            //display in console json object
                                            console.log(jsonResponse);

                                            // put in variable json object
                                            const quest = jsonResponse;

                                            // get answerId array
                                            const answerArray = quest.answerId;



                                            // browse answerId array (json object)
                                            for (const answer in answerArray) {

                                                // get id of answer in this array (ex : 712, 713)
                                                var getId = answerArray[answer].id;

                                                // get value of is_correct in json object ( false, true...)
                                                var isCorrect = answerArray[answer].is_correct;

                                                scoreDom = document.querySelectorAll('.score');

                                                // count number of answer are true 
                                                if (isCorrect === true) {

                                                    cptTrue++;
                                                    //console.log('id des bonnes réponses ' + getId);


                                                    let arrayGetId = [
                                                        getId,
                                                    ];

                                                    for (var testId of arrayGetId) {
                                                        console.log('je suis testId ' + testId);
                                                        console.log(arrayAnswerId.includes(testId));

                                                        if (testId == arrayAnswerId) {

                                                            console.log('je suis testId : ' + testId + ' et je suis arrayAnswerId : ' + arrayAnswerId);
                                                            confirm = true;



                                                        } else {
                                                            console.log('Attention, ça ne correspond pas');
                                                            confirm = false;
                                                        }
                                                    }

                                                }

                                            }


                                            if (cptTrue == cptInput && confirm == true) {

                                                console.log('ça fonctionne !!');

                                                score++;


                                                if (!submitTarget.dataset.clicked) {

                                                    submitTarget.dataset.clicked = true;

                                                    console.log('1er click');


                                                } else  {
                                                    
                                                    score--;
                                                    console.log('deja clické !');

                                                }

                                                scoreDom.innerHTML = score;

                                                for (const displayScore of scoreDom) {
                                                    displayScore.innerText = "Score: " + score;
                                                }

                                                for (const displayAnswer of resultDom) {
                                                    displayAnswer.innerText = "Bien, bonne réponse";
                                                    displayAnswer.style.color = "green";
                                                }


                                                // using in fetch

                                                fetch('http://localhost:8000/info/' + user, {
                                                    method: 'POST',
                                                    headers: { 'Content-Type': 'application/json' },
                                                    body: JSON.stringify({ quiz: quizId, scoreGame: score })
                                                })


                                                    .then(response => console.log(response.text()))
                                                    .catch(error => console.log(error));

                                            } else {
                                                console.log('Il y a une erreur');

                                                score;
                                                scoreDom.innerHTML = score;

                                                for (const displayScore of scoreDom) {
                                                    displayScore.innerText = "Score: " + score;
                                                }

                                                for (const displayAnswer of resultDom) {
                                                    displayAnswer.innerText = "Dommage, mauvaise réponse";
                                                    displayAnswer.style.color = "red";

                                                }

                                                // using in fetch

                                                fetch('http://localhost:8000/info/' + user, {
                                                    method: 'POST',
                                                    headers: { 'Content-Type': 'application/json' },
                                                    body: JSON.stringify({ quiz: quizId, scoreGame: score })
                                                })


                                                    .then(response => console.log(response.text()))
                                                    .catch(error => console.log(error));

                                            }



                                            console.log(cptInput);
                                            console.log(cptTrue);

                                            cptTrue = 0;

                                        })

                                    if (infoStep == stepValidate && noInfoStep == stepValidate) {

                                        noInfo.classList.add('none');
                                        info.classList.remove('none');
                                    }

                                } else {

                                    if (infoStep == stepValidate && noInfoStep == stepValidate) {

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
