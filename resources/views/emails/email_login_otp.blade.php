<!DOCTYPE html>
<html lang="en-US">

<head>
	<meta charset="utf-8">
</head>
 
<body>
    <div style="margin: 0; padding: 30px; width: 640px;">
        <img src="{{app_url()}}assets/img/logo.png" alt="" width="55" height="72" />
		<div style="margin: 15px 0; padding: 30px; border: 4px solid #002654;">
			<h3 style="font-size:24px;font-weight:100;">Your One Time Password is</h3>

			<p>
				{{$email_data['email_otp']}}
				 
			</p>	
			 
		</div>
	</div>
</body>

</html>