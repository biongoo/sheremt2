next = 0;
function emailOn()
{
    if(next)
        $('input[name="reg_butt"]').prop("disabled", false);
}

function recaptchaCallback()
{
    $('input[name="reg_butt"]').removeAttr('disabled');
    next = 1;
}

function send()
{
	$('input[name="button"]').attr('disabled', true);
	email = document.forms["step1"]["email"].value;
    if (window.XMLHttpRequest) { xmlhttp = new XMLHttpRequest(); }
    xmlhttp.onreadystatechange = function()
    {
        if (this.readyState == 4 && this.status == 200)
        {
            if(this.responseText)
                alercik(this.responseText);
            else
                alercik('Wprowadź adres email!');
        }
    }
    xmlhttp.open("GET","email/"+email,true);
    xmlhttp.send();
}

function send2()
{
	email = document.forms["step2"]["email"].value;
	login = document.forms["step2"]["login"].value;
	password = document.forms["step2"]["password"].value;
	password_repeat = document.forms["step2"]["password_repeat"].value;
	real_name = document.forms["step2"]["real_name"].value;
	social_id = document.forms["step2"]["social_id"].value;
	random = document.forms["step2"]["random"].value;

	if(!email || !login || !password || !password_repeat || !real_name || !social_id || !random)
	{
		alercik('Uzupełnij wszystkie pola!');
		return;
	}

	if(password != password_repeat)
	{
		alercik('Podane hasła nie są takie same!');
		return;
	}

	if(login.length <= 3)
	{
		alercik('Login musi posiadać przynajmniej 4 znaki!');
		return;
	}

	if(password.length <= 3)
	{
		alercik('Hasło musi posiadać przynajmniej 4 znaki!');
		return;
	}

	if(real_name.length < 3)
	{
		alercik('Imię musi posiadać przynajmniej 3 znaki!');
		return;
	}

	if(social_id.length != 7)
	{
		alercik('Kod usunięcia postaci musi posiadać 7 znaków!');
		return;
	}

	$('input[name="reg_butt"]').attr('disabled', true);

	if (window.XMLHttpRequest) { xmlhttp = new XMLHttpRequest(); }
    xmlhttp.onreadystatechange = function()
    {
        if (this.readyState == 4 && this.status == 200)
        {
			if(this.responseText)
			{
				if(this.responseText.charAt(0) == '<')
				{
					document.getElementsByTagName("main")[0].innerHTML = this.responseText;
					alercik('Rejestracja zakończona pomyślnie!');
				}
				else
				{
					alercik(this.responseText);
				}
			}
            else
                alercik('Ups.. Coś się zepsuło. Spróbuj ponownie!');
        }
    }
    xmlhttp.open("GET","insert/"+email+"/"+login+"/"+password+"/"+password_repeat+"/"+real_name+"/"+social_id+"/"+random,true);
    xmlhttp.send();
}
