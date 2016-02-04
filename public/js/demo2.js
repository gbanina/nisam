(function(){

	var button = document.getElementById('cn-button'),
    wrapper = document.getElementById('cn-wrapper');

    //open and close menu when the button is clicked
	var open = false;
	button.addEventListener('click', handler, true);

	function handler(){
	  if(!open){
	    this.innerHTML = "Zatvori";
	    classie.add(wrapper, 'opened-nav');
	  }
	  else{
	    this.innerHTML = "NISAM!";
		classie.remove(wrapper, 'opened-nav');
	  }
	  open = !open;
	}
	function closeWrapper(){
		classie.remove(wrapper, 'opened-nav');
	}

})();

$( document ).ready(function() {
	$( "#cn-button" ).click();
	
	// added submit by pressing Enter while in textarea
	$("#desc").on( "keypress", function(event) {
	    if (event.which == 13 && !event.shiftKey) {
	        event.preventDefault();
	        $("#order-form").submit();
	    }
	});
});
