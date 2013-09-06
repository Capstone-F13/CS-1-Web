function change_case() {
    document.myForm.user.value = document.myForm.user.value.toLowerCase();
}

function check_Spacess(Generic)
{
    if (Generic === "") {
        return false;
    } else {
        return true;
    }
}

function formCheck()
{
    if (!check_Spacess(document.myForm.user.value))
    {
        alert("Please Fill out Account Name.");
        document.myForm.user.focus();
        document.myForm.user.select();
        return false;
    }

    if (!check_Spacess(document.myForm.pass.value)) {
        alert("Please Fill out Current Password.");
        document.myForm.pass.focus();
        document.myForm.pass.select();
        return false;
    }

    if (!check_Spacess(document.myForm.passnew.value)) {
        alert("Please Fill out new Password.");
        document.myForm.passnew.focus();
        document.myForm.passnew.select();
        return false;
    }

    if (!check_Spacess(document.myForm.again.value)) {
        alert("Please Fill out new password again.");
        document.myForm.again.focus();
        document.myForm.again.select();
        return false;
    }

    if (document.myForm.user.value.length < 2) {
        alert("Username must be more than 2 characters.  Please try again.");
        document.myForm.user.focus();
        document.myForm.user.select();
        return false;
    }

    if (document.myForm.pass.value.length < 8 || document.myForm.pass.value.length > 64) {
        alert("Password must be at least 6 characters and no more than 64 characters.");
        document.myForm.pass.focus();
        document.myForm.pass.select();
        return false;
    }

    if (document.myForm.passnew.value.length < 8 || document.myForm.passnew.value.length > 64) {
        alert("Password must be at least 8 characters and no more than 64 characters.  Please try again.");
        document.myForm.passnew.focus();
        document.myForm.passnew.select();
        return false;
    }

    if (document.myForm.passnew.value !== document.myForm.again.value) {
        alert("New passwords do not match.  Please try again.");
        document.myForm.passnew.focus();
        document.myForm.passnew.select();
        return false;
    }

    if (document.myForm.pass.value === document.myForm.passnew.value) {
        alert("New password can not be the same as the original password. Please try again.");
        document.myForm.passnew.focus();
        document.myForm.passnew.select();
        return false;
    }

    var pattern1 = /\d{1,}/;
    var pattern2 = /(?=.*[a-zA-Z].*[a-zA-Z])/;
    var exclude1 = /\@/;
    var exclude2 = /\*/;
    var exclude3 = /\|/;
    var exclude4 = /\,/;
    var exclude5 = /\"/;
    var exclude6 = /\:/;
    var exclude7 = /\;/;
    var exclude8 = /\ /;
    var exclude9 = /\&/;
    var exclude10 = /\\/;
    var exclude11 = /\$/;
    var exclude12 = /\~/;
    var exclude13 = /\`/;
    var exclude14 = /\'/;
    var exclude15 = /\%/;
    var exclude16 = /\^/;
    var exclude17 = /\(/;
    var exclude18 = /\)/;
    var exclude19 = /\</;
    var exclude20 = /\>/;
    var exclude21 = /\#/;

    if (pattern1.test(document.myForm.passnew.value.substring(0, 8)) !== true) {
        alert("New password needs at least one numerical character within the first eight characters.  Please try again.");
        document.myForm.passnew.focus();
        document.myForm.passnew.select();
        return false;
    }



    if (pattern2.test(document.myForm.passnew.value.substring(0, 8)) !== true) {
        alert("New password needs at least two alphabetical characters within the first eight characters.  Please try again.");
        document.myForm.passnew.focus();
        document.myForm.passnew.select();
        return false;
    }



    if (exclude1.test(document.myForm.passnew.value)) {
        alert("New password can not contain the '@' symbol.  Please try again.");
        document.myForm.passnew.focus();
        document.myForm.passnew.select();
        return false;
    }

    if (exclude2.test(document.myForm.passnew.value)) {
        alert("New password can not contain the '*' symbol.  Please try again.");
        document.myForm.passnew.focus();
        document.myForm.passnew.select();
        return false;
    }

    if (exclude3.test(document.myForm.passnew.value)) {
        alert("New password can not contain the '|' symbol.  Please try again.");
        document.myForm.passnew.focus();
        document.myForm.passnew.select();
        return false;
    }

    if (exclude4.test(document.myForm.passnew.value)) {
        alert("New password can not contain the ',' symbol.  Please try again.");
        document.myForm.passnew.focus();
        document.myForm.passnew.select();
        return false;
    }

    if (exclude5.test(document.myForm.passnew.value)) {
        alert("New password can not contain the ' \" ' symbol.  Please try again.");
        document.myForm.passnew.focus();
        document.myForm.passnew.select();
        return false;
    }

    if (exclude6.test(document.myForm.passnew.value)) {
        alert("New password can not contain the ':' symbol.  Please try again.");
        document.myForm.passnew.focus();
        document.myForm.passnew.select();
        return false;
    }

    if (exclude7.test(document.myForm.passnew.value)) {
        alert("New password can not contain the ';' symbol.  Please try again.");
        document.myForm.passnew.focus();
        document.myForm.passnew.select();
        return false;
    }

    if (exclude8.test(document.myForm.passnew.value)) {
        alert("New password can not contain a space symbol.  Please try again.");
        document.myForm.passnew.focus();
        document.myForm.passnew.select();
        return false;
    }

    if (exclude9.test(document.myForm.passnew.value)) {
        alert("New password can not contain a '&' symbol.  Please try again.");
        document.myForm.passnew.focus();
        document.myForm.passnew.select();
        return false;
    }

    if (exclude10.test(document.myForm.passnew.value)) {
        alert("New password can not contain a '\\' symbol.  Please try again.");
        document.myForm.passnew.focus();
        document.myForm.passnew.select();
        return false;
    }

    if (exclude11.test(document.myForm.passnew.value)) {
        alert("New password can not contain a '$' symbol.  Please try again.");
        document.myForm.passnew.focus();
        document.myForm.passnew.select();
        return false;
    }

    if (exclude12.test(document.myForm.passnew.value)) {
        alert("New password can not contain a '~' symbol.  Please try again.");
        document.myForm.passnew.focus();
        document.myForm.passnew.select();
        return false;
    }

    if (exclude13.test(document.myForm.passnew.value)) {
        alert("New password can not contain a '`' symbol.  Please try again.");
        document.myForm.passnew.focus();
        document.myForm.passnew.select();
        return false;
    }

    if (exclude14.test(document.myForm.passnew.value)) {
        alert("New password can not contain a ''' symbol.  Please try again.");
        document.myForm.passnew.focus();
        document.myForm.passnew.select();
        return false;
    }

    if (exclude15.test(document.myForm.passnew.value)) {
        alert("New password can not contain a '%' symbol.  Please try again.");
        document.myForm.passnew.focus();
        document.myForm.passnew.select();
        return false;
    }

    if (exclude16.test(document.myForm.passnew.value)) {
        alert("New password can not contain a '^' symbol.  Please try again.");
        document.myForm.passnew.focus();
        document.myForm.passnew.select();
        return false;
    }

    if (exclude17.test(document.myForm.passnew.value)) {
        alert("New password can not contain a '(' symbol.  Please try again.");
        document.myForm.passnew.focus();
        document.myForm.passnew.select();
        return false;
    }

    if (exclude18.test(document.myForm.passnew.value)) {
        alert("New password can not contain a ')' symbol.  Please try again.");
        document.myForm.passnew.focus();
        document.myForm.passnew.select();
        return false;
    }

    if (exclude19.test(document.myForm.passnew.value)) {
        alert("New password can not contain a '<' symbol.  Please try again.");
        document.myForm.passnew.focus();
        document.myForm.passnew.select();
        return false;
    }

    if (exclude20.test(document.myForm.passnew.value)) {
        alert("New password can not contain a '>' symbol.  Please try again.");
        document.myForm.passnew.focus();
        document.myForm.passnew.select();
        return false;
    }

    if (exclude21.test(document.myForm.passnew.value)) {
        alert("New password can not contain a '#' symbol.  Please try again.");
        document.myForm.passnew.focus();
        document.myForm.passnew.select();
        return false;
    }
}

function testMinOccurrences(pattern, string, minDesired)
{
    if (string.match(pattern) === null || string.match(pattern).length < minDesired)
        return false;
    else
        return true;
}

function testPassword(passwd)
{
    var description = new Array();

    description[0] = "<table border=0 cellpadding=0 cellspacing=0><tr><td class=bold width=50>New Password Strength:</td><td><table cellpadding=0 cellspacing=2><tr><td height=15 width=50 bgcolor=#ff0000></td><td height=15 width=50 bgcolor=#dddddd></td></tr></table></td><td class=bold>Weakest</td></tr></table>";
    description[1] = "<table border=0 cellpadding=0 cellspacing=0><tr><td class=bold width=50>New Password Strength:</td><td><table cellpadding=0 cellspacing=2><tr><td height=15 width=50 bgcolor=#bb0000></td><td height=15 width=50 bgcolor=#dddddd></td></tr></table></td><td class=bold>Weak</td></tr></table>";
    description[2] = "<table border=0 cellpadding=0 cellspacing=0><tr><td class=bold width=50>New Password Strength:</td><td><table cellpadding=0 cellspacing=2><tr><td height=15 width=50 bgcolor=#ff9900></td><td height=15 width=50 bgcolor=#dddddd></td></tr></table></td><td class=bold>Medium</td></tr></table>";
    description[3] = "<table border=0 cellpadding=0 cellspacing=0><tr><td class=bold width=50>New Password Strength:</td><td><table cellpadding=0 cellspacing=2><tr><td height=15 width=50 bgcolor=#00bb00></td><td height=15 width=50 bgcolor=#dddddd></td></tr></table></td><td class=bold>Strong</td></tr></table>";
    description[4] = "<table border=0 cellpadding=0 cellspacing=0><tr><td class=bold width=50>New Password Strength:</td><td><table cellpadding=0 cellspacing=2><tr><td height=15 width=50 bgcolor=#00ee00></td></tr></table></td><td class=bold>Strongest</td></tr></table>";
    description[5] = "<table border=0 cellpadding=0 cellspacing=0><tr><td class=bold width=50>New Password Strength:</td><td><table cellpadding=0 cellspacing=2><tr><td height=15 width=50 bgcolor=#dddddd></td></tr></table></td><td class=bold>Strength will be displayed as password is entered</td></tr></table>";

    var intScore = 0;
    var strVerdict = 0;

    // PASSWORD LENGTH
    if (passwd.length === 0 || !passwd.length)                         // length 0
    {
        intScore = -1;
    }
    else if (passwd.length > 0 && passwd.length < 8) // length between 1 and 4
    {
        intScore += 3;
    }
    else if (passwd.length > 5 && passwd.length < 8) // length between 5 and 7
    {
        intScore += 6;
    }
    else if (passwd.length > 7 && passwd.length < 15)// length between 8 and 16
    {
        intScore += 12;
    }
    else if (passwd.length > 15)                    // length 16 or more
    {
        intScore += 18;
    }
    
    // LETTERS (Not exactly implemented as dictacted above because of my limited understanding of Regex)
    if (passwd.match(/[a-z]/))                              // [verified] at least one lower case letter
    {
        intScore += 1;
    }
    if (passwd.match(/[A-Z]/))                              // [verified] at least one upper case letter
    {
        intScore += 5;
    }

    // NUMBERS
    if (passwd.match(/\d+/))                                 // [verified] at least one number
    {
        intScore += 5;
    }
    if (passwd.match(/(.*[0-9].*[0-9].*[0-9])/))             // [verified] at least three numbers
    {
        intScore += 5;
    }
    
    // SPECIAL CHAR
    if (passwd.match(/.[!,$,%,^,&,?,_,~]/))            // [verified] at least one special character
    {
        intScore += 5;
    }
    
    // [verified] at least two special characters
    if (passwd.match(/(.*[!,$,%,^,&,?,_,~].*[!,$,%,^,&,?,_,~])/))
    {
        intScore += 5;
    }

    // COMBOS
    if (passwd.match(/([a-z].*[A-Z])|([A-Z].*[a-z])/))        // [verified] both upper and lower case
    {
        intScore += 2;
    }
    if (passwd.match(/(\d.*\D)|(\D.*\d)/))                    // [FAILED] both letters and numbers, almost works because an additional character is required
    {
        intScore += 2;
    }
    
    // [verified] letters, numbers, and special characters
    if (passwd.match(/([a-zA-Z0-9].*[!,$,%,^,&,?,_,~])|([!,$,%,^,&,?,_,~].*[a-zA-Z0-9])/))
    {
        intScore += 2;
    }
    if (intScore === -1)
    {
        strVerdict = description[5];
    }
    else if (intScore > -1 && intScore < 16)
    {
        strVerdict = description[0];
    }
    else if (intScore > 15 && intScore < 25)
    {
        strVerdict = description[1];
    }
    else if (intScore > 24 && intScore < 35)
    {
        strVerdict = description[2];
    }
    else if (intScore > 34 && intScore < 45)
    {
        strVerdict = description[3];
    }
    else
    {
        strVerdict = description[4];
    }
    document.getElementById("Words").innerHTML = (strVerdict);
}

$(document).ready(function() {
	$(".slidingDivAbout, .slidingDivAboutArr, .slidingDivContact, .slidingDivContactArr, .slidingDivContact1, .slidingDivContact1Arr").hide(0);

	$('.show_hideAbout').click(function() {
		$(".slidingDivContact").slideUp(300, function() {
			$(".slidingDivContactArr").fadeOut(300, function() {
				$(".slidingDivAbout").slideToggle(350, "linear", function() {
					$(".slidingDivAboutArr").fadeToggle(350);
				});
			});
		});
	});
	$('.show_hideAbout').click(function() {
		$(".slidingDivContact1").slideUp(300, function() {
			$(".slidingDivContact1Arr").fadeOut(300, function() {
			});
		});
	});
	$('.show_hideContact').click(function() {
		$(".slidingDivAbout").slideUp(300, function() {
			$(".slidingDivAboutArr").fadeOut(300, function() {
				$(".slidingDivContact").slideToggle(350, function() {
					$(".slidingDivContactArr").fadeToggle(350, "linear");
				});
			});
		});
	});
	$('.show_hideContact').click(function() {
		$(".slidingDivContact1").slideUp(300, function() {
			$(".slidingDivContact1Arr").fadeOut(300, function() {

			});
		});
	});
	$('.show_hideContact1').click(function() {
		$(".slidingDivContact").slideUp(300, function() {
			$(".slidingDivContactArr").fadeOut(300, function() {
				$(".slidingDivContact1").slideToggle(350, function() {
					$(".slidingDivContact1Arr").fadeToggle(350, "linear");
				});
			});
		});
	});
	$('.show_hideContact1').click(function() {
		$(".slidingDivAbout").slideUp(300, function() {
			$(".slidingDivAboutArr").fadeOut(300, function() {

			});
		});
	});
});

$(document).ready(function() {
    $('#submissionTextArea').bind("cut copy paste", function(e) {
        e.preventDefault();
        $('#submissionTextArea').bind("contextmenu", function(e) {
            e.preventDefault();
        });
    });
});