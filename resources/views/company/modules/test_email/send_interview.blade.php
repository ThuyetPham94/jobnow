<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body{margin:0px; padding:0px;  font-family:Arial; }
.td td{
    padding: 10px;
}
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
            <table cellpadding="0" cellspacing="0"  style="background:#fff; width:100%; padding:24px;">
                
                <tr><td height="36" valign="top" style="color:rgb(93,93,93); font-size:13px;">Kính chào {!! $Name !!}</td></tr>
                <tr>
                    <td  valign="top" style="color:rgb(93,93,93); font-size:13px; line-height:24px;">
                       Cảm ơn bạn đã đăng ký <b>{!! $company !!}</b><br/><br/>
                    </td>
                </tr>
                <tr>
                    <td  valign="top" style="color:rgb(93,93,93); font-size:13px; line-height:24px;padding-bottom: 10px">
                        Đơn của bạn cho vị trí <b>{!! $Title !!}</b> nổi bật đối với chúng tôi và chúng tôi muốn mời bạn phỏng vấn tại văn phòng của chúng tôi để tìm hiểu bạn một chút.
                    </td>
                </tr>


                <tr>
                    <td  valign="top" style="color:rgb(93,93,93); font-size:13px; line-height:24px;padding-bottom: 10px">
                        Bạn sẽ gặp người phỏng vấn <b>{!! $Manage !!}</b>. Cuộc phỏng vấn sẽ kéo dài từ <b>{!! $Start_time !!}</b> tới <b>{!! $End_time !!}</b> Và bạn sẽ có cơ hội để thảo luận về vị trí <b>{!! $Title !!}</b> và tìm hiểu thêm về công ty của chúng tôi.
                    </td>
                </tr>

                <tr>
                    <td valign="top" style="color:rgb(93,93,93); font-size:13px; line-height:24px;padding-bottom: 10px">
                        Bạn có sẵn sàng không <b>{!! date('Y-m-d',strtotime($datetime)) !!}</b> ? tại <b>{!! $Location !!}</b>. 
                    </td>
                </tr>                
                
                <tr>
                    <td  valign="top" style="color:rgb(93,93,93); font-size:13px; line-height:24px;padding-bottom: 10px">
                        Mong muốn được nghe từ bạn,
                    </td>
                </tr>

                <tr>
                    <td valign="top" style="color:rgb(93,93,93); font-size:13px; line-height:26px;">
                        <span>Kính chào,</span><br/>
                        {!! $company !!}
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    
 
</table>
</body>
</html>