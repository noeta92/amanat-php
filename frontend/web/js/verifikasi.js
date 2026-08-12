var periode;

$("#pilih-periode").change(function(){
	periode = $("#pilih-periode option").filter(":selected").data('periode');
    // $(".periode").val(periode); 
});

$( ".btn-renstra" ).click(function( event ) {

    event.preventDefault();
    //var periode = $("periode").val(periode);
    //var periode = $('#pilih-periode').val();
    var tujuan = $(this).attr('href');
	var variabel = '&periode='+periode;

    console.log(periode);


	if ($("#pilih-periode").val() == 0) {
		alert('Pilih Periode terlebih dahulu');
	}
      else{
          var win = window.open(tujuan+variabel, '_blank');
          if (win) {
          //Browser has allowed it to be opened
          win.focus();
          } else {
              //Browser has blocked it
              alert('Please allow popups for this website');
          }
      }
  });


  $( ".btn-renja" ).click(function( event ) {

    event.preventDefault();
    //var periode = $("periode").val(periode);
    //var periode = $('#pilih-periode').val();
    var tujuan = $(this).attr('href');
	var variabel = '&periode='+periode;

    console.log(periode);


	if ($("#pilih-periode").val() == 0) {
		alert('Pilih Periode / Tahapan terlebih dahulu');
	}
      else{
          var win = window.open(tujuan+variabel, '_blank');
          if (win) {
          //Browser has allowed it to be opened
          win.focus();
          } else {
              //Browser has blocked it
              alert('Please allow popups for this website');
          }
      }
  });