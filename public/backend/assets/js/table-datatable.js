$(function() {
	"use strict";

    $(document).ready(function() {
        $('#example').DataTable();
      } );


      $(document).ready(function() {
        var table = $('#example2').DataTable( {
            lengthChange: true,
            buttons: [ ]
        } );
     
        table.buttons().container()
            .appendTo( '#example2_wrapper .col-md-6:eq(0)' );
    } );


});