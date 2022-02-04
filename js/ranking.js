$(document).ready(function() {
  $('.labels').click(function() {
	  $(this).toggleClass('active');
    $(this).next().toggleClass('active');
    $(this).next('.hide').toggle('linear');
  });
});

function submitRank() {
  document.forms["search"].submit();
}
