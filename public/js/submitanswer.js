const submitanswer = {

    checkAnswer: function (event) {
        // start traitment of form

        // avoid the reload of page

        event.preventDefault();

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



        // select all div .score
        var scoreDom = document.querySelectorAll('.score');

        // select all div .result-answer
        var resultDom = document.querySelectorAll('.result-answer');

        // select all info+
        const displayInfo = document.querySelectorAll('div.answer-content');

        // select all warning message we send an empty form
        const noAnswerInfo = document.querySelectorAll('div.warning');

        // select all div 'section.questions'
        const sectionQuestion = document.querySelectorAll('section.questions');

        // get all input named by "type" and checked
        //checked = property to check if it's true
        let checkedRadio = document.querySelectorAll('input[name="type"]:checked');


        var arrayGetId = [];

        var arrayAnswerId = [];

        //  browse all sections and get their data step
        // check if data step of section is matching with data step of form
        // yes : get all info+ and warning message, get their data step and if input is selected check if it's same the stepf of form
        // if no answer are selected display warning message, if not, hide him and display info+

        // browse section.questions array
        for (const section of sectionQuestion) {

            // get their data-step
            const keyStep = section.dataset.step;

            // put in array all input are selected
            // browse input named 'type' and checked (array), put in array selected answer by user
            for (var radio of checkedRadio) {

                // get data-step of input
                var radioStep = radio.dataset.step;

                // gete data-id of answer
                let answerId = radio.dataset.id;

                // get dataset question (question id)
                var radioDatasetQuestion = radio.dataset.question;

                // compare if dataset step of section and input are the same and the form && input is selected
                if (keyStep == radioStep && keyStep == stepValidate && radio !== null) {

                    // console.log('test');
                    // put in an array id of user answers he's selected
                    arrayAnswerId.push(parseInt(answerId));

                    cptInput++;
                }
            }

            // if display section is block and their data-step matches with data-step of form
            if (section.style.display == "block" && keyStep == stepValidate) {

                // browse info+ array
                for (const info of displayInfo) {

                    // get their data-step
                    let infoStep = info.dataset.step;

                    // browse warning message array
                    for (const noInfo of noAnswerInfo) {

                        //get their data-step
                        let noInfoStep = noInfo.dataset.step;

                        // if step of info+ and noInfo matche with step of form
                        if (infoStep == stepValidate && noInfoStep == stepValidate) {

                            // remove class 'none'  on warning message
                            noInfo.classList.remove('none');

                        }
                        // radio is selectd and step of radio is matching with step of form , display or not blocks
                        if (radio != null && radioStep == stepValidate) {

                            if (infoStep == stepValidate && noInfoStep == stepValidate) {

                                noInfo.classList.add('none');
                                info.classList.remove('none');

                            }


                            else {

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



        //console.log('test ' + arrayAnswerId);
        //console.log('confirm ' + confirm);


        console.log('test2 ' + arrayAnswerId);


        // last step : get infos with ajax and check answers with answers of user

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

                    //scoreDom;

                    // count number of answer are true 
                    if (isCorrect === true) {

                        cptTrue++;
                        //console.log('id des bonnes réponses ' + getId);

                        arrayGetId.push(parseInt(getId));

                    }

                }

                console.log('bonnes réponses ' + arrayGetId);
                console.log('réponses du user ' + arrayAnswerId);

                // compare arrays
                const result = JSON.stringify(arrayGetId) == JSON.stringify(arrayAnswerId);
                // arrayAnswerId = [];

                //console.log('je suis dans le fetch et je suis vidé ' + arrayAnswerId);


                // if result is true
                if (result) {
                    console.log('The arrays have the same elements.');
                    confirm = true;
                }
                else {
                    console.log('The arrays have different elements.');
                    confirm = false;
                }

                console.log('nb input ' + cptInput);
                console.log('nb vraies réponses ' + cptTrue);

                if (cptTrue == cptInput && confirm == true) {

                    console.log('ça fonctionne !!');

                    score++;

                    if (!submitTarget.dataset.clicked) {

                        submitTarget.dataset.clicked = true;

                        console.log('1er click');


                    } else {

                        score--;
                        console.log('déjà clické !');

                    }

                    scoreDom.innerHTML = score;

                    for (const displayScore of scoreDom) {
                        displayScore.innerText = "Score: " + score;
                    }

                    for (const displayAnswer of resultDom) {
                        displayAnswer.innerText = "Bien, bonne réponse";
                        displayAnswer.style.color = "green";
                    }

                    //arrayAnswerId = [];
                    //console.log('on vide arrayAnswerId' + arrayAnswerId);
                    // using fetch

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

                    if (!submitTarget.dataset.clicked) {

                        submitTarget.dataset.clicked = true;

                        console.log('1er click');


                    } else {

                        score;
                        console.log('déjà clické !');

                    }


                    scoreDom.innerHTML = score;

                    for (const displayScore of scoreDom) {
                        displayScore.innerText = "Score: " + score;
                    }

                    for (const displayAnswer of resultDom) {
                        displayAnswer.innerText = "Dommage, mauvaise réponse";
                        displayAnswer.style.color = "red";

                    }

                    //arrayAnswerId = [];
                    ///console.log('on vide arrayAnswerId' + arrayAnswerId);

                    // using fetch

                    fetch('http://localhost:8000/info/' + user, {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify({ quiz: quizId, scoreGame: score })
                    })


                        .then(response => console.log(response.text()))
                        .catch(error => console.log(error));

                }

                cptTrue = 0;
                cptInput = 0;



            })






    },


}



