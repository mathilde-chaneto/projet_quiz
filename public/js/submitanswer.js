const submitanswer = {

    checkAnswer: function(event) {

        event.preventDefault();

        let displayInfo = document.querySelector('div.answer-content');
        let noAnswerInfo = document.querySelector('div.warning');
        
        let selectedRadio = document.querySelectorAll('input[name="type"]:checked');

                    for(let radio of selectedRadio){
                        if(radio != null) {

                            noAnswerInfo.classList.add('none');

                            displayInfo.classList.remove('none');
                            console.log(displayInfo);
                            console.log('radio is selected');

                        }else {
                            displayInfo.classList.add('none');

                            noAnswerInfo.classList.remove('none');
                        
                            console.log('radio is not selected');
                        }
                    }
            
                
                
        
            
    }


   
};



