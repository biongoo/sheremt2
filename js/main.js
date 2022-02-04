  $("a[href='#top']").click(function() {
    $("html, body").animate({ scrollTop: 0 }, "slow");
    return false;
  });

  function alercik(info)
  {
    window.onload = function () {
    $('<div class="alert-bg"><div class="alert"><p>'+info+'</p><div class="close-btn" onclick="this.parentElement.parentElement.style.animation=\'1.5s flyOut forwards\';">OK</div></div></div>').insertAfter( $( "main" ) );
    }
  }

  function unlock(name)
  {
    $('input[name="'+name+'"]').removeAttr('disabled');
  }