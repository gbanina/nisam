$( document ).ready(function() {
	$( "#cn-button" ).click();

	var $body = $("body");
	var $wrap = $(".piemenu");
	var $pie  = $wrap.find("ul");

	$pie.on("piemenutoggle", function() {
	  $body
		.removeClass("piemenuopen")
		.addClass($wrap.hasClass("active") ? "piemenuopen" : "_temp")
		.removeClass("_temp")
	});

	// added submit by pressing Enter while in textarea
	$("#desc").on( "keypress", function(event) {
	    if (event.which == 13 && !event.shiftKey) {
	        event.preventDefault();
	        $("#order-form").submit();
	    }
	});

    if ($(".user-order-container").length) {
        var orderCheckInterval = setInterval(function() {
            $.ajax({
                url: $("meta[name=api-url]").attr("content") + '/orders',
            }).done(function(data) {
                var html = "";

                $(data.orders).each(function(index, el) {
                    html += "<p>"+el.user.name+" - "+el.order.desc+"</p>";
                });

                $(".user-order-container").html(html);
            });

        }, 5000);
    }
});
