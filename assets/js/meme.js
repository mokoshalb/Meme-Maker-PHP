$(document).ready(function () {
    $('.thumbnail').on('click', 'img', function () {
        var image = $(this).attr('src');
        $('#memeCanvas').find('.img-responsive').attr('src', image);
        $('#memeCanvas').find('.img-responsive').attr('rel', image);
        $('input[name="secretimage"]').attr('value', image);
    });

    $('input[name="toptext"], input[name="bottomtext').on('blur paste', function () {
        var toptext = $('input[name="toptext"]').val();
        var bottomtext = $('input[name="bottomtext"]').val();
        var image = $('#memeCanvas').find('.img-responsive').attr('rel');
        $("#memeCanvas").find('.img-responsive').attr("src", "MemeGenerator.php?image=" + image + "&top=" + toptext + "&bottom=" + bottomtext + "&preview=1");
    });

    $('.meme').on('click', function(e){
        e.preventDefault();
        var html = document.getElementsByTagName('html')[0];
	html.className = 'loading';
        var toptext = $('input[name="toptext"]').val();
        var bottomtext = $('input[name="bottomtext"]').val();
        var image = $('#memeCanvas').find('.img-responsive').attr('rel');
        $.ajax({
        url: 'MemeGenerator.php',
        timeout: 5000,
        type: 'POST',
        data: {top: toptext, bottom: bottomtext, preview: 0, image: image},
        success: function(e){
          $('#memeCanvas').attr('src', e);
          $('body').append(e);
          $('#myModalMeme').modal('show');
          setTimeout(function() {
	  html.className = html.className.replace(/loading/, '');
	  }, 1500);
        },
        error: function(xmlhttprequest, textstatus, message) {
          if(textstatus==="timeout") {
            html.className = html.className.replace(/loading/, '');
            alert("Request Timeout, Please Try Again.");
          } else {
            html.className = html.className.replace(/loading/, '');
            alert(textstatus);
          }
        }
      })
    });
});