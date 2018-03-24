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
                
                <tr><td height="36" valign="top" style="color:rgb(93,93,93); font-size:13px;">Kính chào <b>{{ $username }}</b></td></tr>
                <tr>
                    <td  valign="top" style="color:rgb(93,93,93); font-size:13px; line-height:24px;">
                        Cảm ơn bạn đã dành thời gian để xem xét {{ $companyName }}. Chúng tôi muốn cho bạn biết rằng người sử dụng lao động đã không chọn bạn cho vị trí {{ $jobTitle }}.<br/>
                    </td>
                </tr>
                <tr>
                    <td  valign="top" style="color:rgb(93,93,93); font-size:13px; line-height:24px;">
                       Nhóm của chúng tôi đã rất ấn tượng với kỹ năng và thành tích của bạn. Chúng tôi nghĩ bạn có thể phù hợp để mở cửa trong tương lai. Đừng bỏ cuộc và tiếp tục xin việc!<br>
                    </td>
                </tr>               
                
                <tr>
                    <td valign="top" style="color:rgb(93,93,93); font-size:13px; line-height:24px;">
                        <i>Chúng tôi chúc các bạn tìm kiếm công việc tốt nhất.</i><br>
                    </td>
                </tr>
                
                <tr>
                    <td valign="top" style="color:rgb(93,93,93); font-size:13px; line-height:24px;">
                        Trân trọng kính chào,
                    </td>
                </tr>

                <tr>
                    <td valign="top" style="color:rgb(93,93,93); font-size:15px; line-height:26px;">
                        <h3>JobNow Team</h3>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    
 
</table>
</body>
</html>