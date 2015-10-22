 $(function() {
    $( "#dialog" ).dialog({
      autoOpen: false,
      resizable: true,
      height:512,
      width:512,
      modal: true,
      buttons: {
        "Rešeno!": function() {
           $.ajax({
                        url: "main/finishOrder",
                        type: "GET",
                        data: { order: "done" },
                        success: function( responseText ) {
                            //$("#dialogResponse").html( responseText );
                        }
                    });
          $( this ).dialog( "close" );
        },
        Cancel: function() {
          $( this ).dialog( "close" );
        }
      }
    });
    $( "#opener" ).click(function() {
      $( "#dialog" ).dialog( "open" );
    });
  });
