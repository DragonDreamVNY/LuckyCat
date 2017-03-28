/*
	jQuery document ready.
*/
$(document).ready(function()
{
	/*
		assigning keyup event to password field
		so everytime user type code will execute
	*/

	$('#password').keyup(function()
	{
		$('#result').html(checkStrength($('#password').val()))
	})	
	
	/*
		checkStrength is function which will do the 
		main password strength checking for us
	*/
	
	function checkStrength(password)
	{
		//initial strength
		var strength = 0
		
		//if the password length is less than 6, return message.
		if (password.length < 5) { 
			$('#result').removeClass()
			$('#result').addClass('short')
			return 'Password is too short, Must be at least 5 characters' 
		}
		
		//length is ok, lets continue.
		
		//if length is 8 characters or more, increase strength value
		if (password.length > 7) strength += 1
		
		//if password contains both lower and uppercase characters, increase strength value
		if (password.match(/([a-z].*[A-Z])|([A-Z].*[a-z])/))  strength += 1
		
		//if it has numbers and characters, increase strength value
		if (password.match(/([a-zA-Z])/) && password.match(/([0-9])/))  strength += 1 
		
		//if it has one special character, increase strength value
		if (password.match(/([!,%,&,@,#,$,^,*,?,_,~])/))  strength += 1
		
		//if it has two special characters, increase strength value
		if (password.match(/(.*[!,%,&,@,#,$,^,*,?,_,~].*[!,%,&,@,#,$,^,*,?,_,~])/)) strength += 1
		
		//if it has three special characters, increase strength value
		if (password.match(/(.*[!,%,&,@,#,$,^,*,?,_,~].*[!,%,&,@,#,$,^,*,?,_,~].*[!,%,&,@,#,$,^,*,?,_,~])/)) strength += 1
		
		//if it has three special characters and is longer than 9 chracters, increase strength value
		if ((password.match(/(.*[!,%,&,@,#,$,^,*,?,_,~].*[!,%,&,@,#,$,^,*,?,_,~].*[!,%,&,@,#,$,^,*,?,_,~])/))&&password.length>9) strength += 1
		
		//now we have calculated strength value, we can return messages
		
		//if value is less than 2
		if (strength < 2 )
		{
			$('#result').removeClass()
			$('#result').addClass('weak')
			return 'Warning! Password is Weak - Try using special characters like !,%,&,@,#,$,^,*,?,_,~,*'			
		}
		else if (strength == 2 )
		{
			$('#result').removeClass()
			$('#result').addClass('good')
			return 'Password is Good -  Try using special characters like !,%,&,@,#,$,^,*,?,_,~,*'		
		}
		else if (strength > 2 &&  strength < 5)
		{
			$('#result').removeClass()
			$('#result').addClass('strong')
			return 'Password is Strong - try making it longer for more strength and using additional special characters like !,%,&,@,#,$,^,*,?,_,~,*'
		}
		else 
		{
			$('#result').removeClass()
			$('#result').addClass('strong')
			return 'Password is SUPER Strong'
		}
	}
});