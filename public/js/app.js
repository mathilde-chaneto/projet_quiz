
const app = {

  init: function () {

    // Get all "navbar-burger" elements
    const $navbarBurgers = Array.prototype.slice.call(document.querySelectorAll('.navbar-burger'), 0);

    // Check if there are any navbar burgers
    if ($navbarBurgers.length > 0) {

      // Add a click event on each of them
      for (const el of $navbarBurgers) {
        el.addEventListener('click', function () {

          // Get the target from the "data-target" attribute
          const target = el.dataset.target;
          const $target = document.getElementById(target);

          //Toggle the "is-active" class on both the "navbar-burger" and the "navbar-menu"
          el.classList.toggle('is-active');
          $target.classList.toggle('is-active');

        });

      }

    }

    const buttonQuestion = document.querySelectorAll('button.button-orange-questions');
    console.log(buttonQuestion);

    const nextButton = document.querySelectorAll('button.button-orange-next');

    for (const buttons of buttonQuestion) {
      buttons.addEventListener('click', app.buttonFunction);
      console.log('spies are ready !');

    }

    for(const nbuttons of nextButton){
      nbuttons.addEventListener('click', app.buttonNextFunction);
    }

  },

  buttonFunction: function (event) {

    //get button which is being clicked
    let clickedButton = event.target;

    //add class'is-active' when we click on it and disappear when we click again while this class is present
    clickedButton.classList.toggle('is-active');

    //change button's text color if class 'is-active' exist
    if (clickedButton.classList.contains('is-active')) {
      clickedButton.style.color = "white";
    } else {
      clickedButton.style.color = "white";
    }


    //put in variable the data-id of clickedButton
    let test = clickedButton.dataset.id;

    // this variable contains specific element : section html which have as class : 'questions' 
    const sectionQuestion = document.querySelectorAll('section.questions');

    //like sectionQuestion is an array, I must do a loop with condition.
    //if their value of dataset.id is matching so, let appear the block, if not, hide him.
    for (const sections of sectionQuestion) {
      let testSection = sections.dataset.id;


      if (test == testSection) {

        //start test in console
        console.log(test);
        console.log(testSection);
        //end of test

        sections.style.display = "block";
        sections.classList.add('is-active');

      } else {

        sections.style.display = "none";
        sections.classList.remove('is-active');
      
      }

    }

    let formQuiz = document.querySelector('#quiz');
    formQuiz.addEventListener('submit', submitanswer.checkAnswer);
  },
  





};

document.addEventListener('DOMContentLoaded', app.init);


//bulma js origin code : 

/*document.addEventListener('DOMContentLoaded', () => {

  Get all "navbar-burger" elements
  const $navbarBurgers = Array.prototype.slice.call(document.querySelectorAll('.navbar-burger'), 0);

   Check if there are any navbar burgers
  if ($navbarBurgers.length > 0) {

     Add a click event on each of them
    $navbarBurgers.forEach( el => {
      el.addEventListener('click', () => {

         Get the target from the "data-target" attribute
       const target = el.dataset.target;
        const $target = document.getElementById(target);

         Toggle the "is-active" class on both the "navbar-burger" and the "navbar-menu"
        el.classList.toggle('is-active');
        $target.classList.toggle('is-active');

      });
   });
 }

});*/