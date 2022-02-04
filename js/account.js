function unbug(nick)
{
      $('#unbugform').append('<input type="hidden" name="un_nick" value="'+nick+'">');
      $("#unbugform").submit(); 
}