
const app = {
  

  init: function () {
      // start part bulma js


      /*-  Get all "navbar-burger" elements
        - Check if there are any navbar burgers
        - Add a click event on each of them
        - Get the target from the "data-target" attribute
        - Toggle the "is-active" class on both the "navbar-burger" and the "navbar-menu"
      */
      const $navbarBurgers = Array.prototype.slice.call(document.querySelectorAll('.navbar-burger'), 0);

        
        if ($navbarBurgers.length > 0) {

          
            for (const el of $navbarBurgers) {
              el.addEventListener('click', function () {

                
                const target = el.dataset.target;
                const $target = document.getElementById(target);

                
                el.classList.toggle('is-active');
                $target.classList.toggle('is-active');

              });

            }

        }
      // end of part js bulma

  },

};


/**
 * when page is loaded, call init method of app.js
 * to execute feature bulma js and to place event listener on buttons
 *  
 * */
document.addEventListener('DOMContentLoaded', app.init);


//bulma js origin code : 

/*document.addEventListener('DOMContentLoaded', () => {

  //Get all "navbar-burger" elements
  const $navbarBurgers = Array.prototype.slice.call(document.querySelectorAll('.navbar-burger'), 0);

    //Check if there are any navbar burgers
    if ($navbarBurgers.length > 0) {

     //Add a click event on each of them
    $navbarBurgers.forEach( el => {
      el.addEventListener('click', () => {

         //Get the target from the "data-target" attribute
       const target = el.dataset.target;
        const $target = document.getElementById(target);

         //Toggle the "is-active" class on both the "navbar-burger" and the "navbar-menu"
        el.classList.toggle('is-active');
        $target.classList.toggle('is-active');

      });
   });
 }

});*/