$("#btn-kirim-skpd").click(function(){
    $("#btn-kirim-skpd").attr('disabled', true);
    //$("#modal-skpd-content").html("Proses ...");
    $('#modal_selesai_loading').css({'display':'block'});
    $('#modal_selesai_isi').css({'display':'none'});
    $.ajax({ 
      type: "POST",
      url:'index.php?r=ta-musrenbang-kecamatan-acara/selesai',
      data:'',
      success: function(isi){
        $("#modal-skpd-content").html(isi);
        location.reload();
      },
      error: function(){
        alert("failure");
      }
    });
  });
  