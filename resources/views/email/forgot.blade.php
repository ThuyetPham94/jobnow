<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Jobnow</title>
<style>
body{margin:0px; padding:0px;  font-family:Arial; }
.logo{
    text-transform: uppercase;    
    display: block;
    font-size: 23pt;
    font-weight: bold;
    text-decoration: none;    
}
.first-logo{
    color: #fa603c;
}
.last-logo{
    color: #337ab7;
}
</style>
</head>

<body>
<table cellpadding="0" cellspacing="0"  width="620" style="margin:auto auto; background:#273140; padding:32px 32px 48px 32px; border-radius:8px;">
	<tr cellpadding="0" cellspacing="0" >
    	<td valign="top" style="padding-bottom: 30px">
    		<a class="logo" href="http://jobnow.com.sg">
                <img src="http://jobnow.com.sg/frontend/jobnow_backend/images/logo.png" />
            </a>
    	</td>
    </tr>
    <tr cellpadding="0" cellspacing="0" >
		<td>			
            <table cellpadding="0" cellspacing="0"  style=" border-radius:8px; background:#fff; width:100%; padding:24px;">
				
                <tr><td height="36" valign="top" style="color:rgb(93,93,93); font-size:13px;">Hi <b>There</b></td></tr>
                <tr>
                	<td  valign="top" style="color:rgb(93,93,93); font-size:13px; line-height:24px;">
                    	We got a request to reset your JobNow password.<br/><br/>
                    </td>
                </tr>
                <tr>
                	<td  valign="top" style="color:rgb(93,93,93); font-size:13px; line-height:24px;">
                    	<b>Your reset password is: </b>{!! $newpass !!}
                    </td>
                </tr>

                <tr>
                	<td valign="top" style="color:rgb(93,93,93);padding-bottom: 10px; font-size:13px; line-height:24px;">
                    	If you ignore this message, your password won’t be changed.
                    </td>
                </tr>

                <tr>
                	<td valign="top" style="color:rgb(93,93,93); font-size:13px; line-height:24px;">
                    	If you didn’t request a password reset, please contact us at <a href="mailto:admin@jobnow.com.sg">admin@jobnow.com.sg</a>
                    </td>
                </tr>                
            </table>
        </td>
    </tr>
    
 
</table>
</body>
</html>