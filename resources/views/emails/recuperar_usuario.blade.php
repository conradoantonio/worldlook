<!DOCTYPE html>
<html>
<head>
	<title>Oxxo pay</title>
</head>
<style type="text/css">
	html{
		font-family: sans-serif;
	}
	body{
		margin:auto;
		width: 100%;
	}
	#recibo{
		margin:auto;
	}
	.recibo_body{
		width: 75%;
		margin: auto;
		border: 1px solid black;
		border-radius: 0px 0px 5px 5px;
		padding-bottom: 15px;
	}
	.upper{
		text-transform: uppercase;
	}
	.normal{
		text-transform: capitalize;
		font-size: 13px;
	}
	.center{
		text-align: center;
	}
	.header{
		margin:auto;
		text-transform: uppercase;
		background: black;
		text-align: center;
    	padding: 12px;
	}
	.header span{
		color: white;
	}
	.col-6{
		width: 49%;
		display: inline-block;
	}
	.margin-bottom{
		margin-bottom: 12px;
	}
	.referencia{
		margin: auto;
		width: 70%;
	}
	.referencia .numero{
		display: block;
		font-weight: 900;
		border: 1px solid black;
		text-align: center;
		padding: 10px;
		letter-spacing: 8px;
		border-radius: 10px;
	}
	.instrucciones, .alert{
		width: 80%;
		margin: auto;
	}
	ol li{
		padding: 5px 0px;
		text-align: justify;
	}
	.alert{
		width: 61%;
		border: 1px solid #48943B;
	}
	.alert p{
		padding: 0px 18%;
		color: #48943B;
		text-align: justify;
	}
</style>
<body>
    <div class='header1'>
		<div>
			<img src='{{asset('img/header_mail.png')}}' style='width: 100%;'>
		</div>
	</div>
	<div id="recibo" style="margin:auto;">
		<div class="header" style="margin:auto;text-transform: uppercase;background: black;text-align: center;padding: 12px;">
			<span style="color: white;">Restablecimiento de contraseña para su usuario en la aplicación World Look</span>
		</div>
		<div class="recibo_body" style="width: 75%;margin: auto;border: 1px solid black;border-radius: 0px 0px 5px 5px;padding-bottom: 15px;">
			<div class="referencia" style="margin: auto;width: 70%;">
				<h3>Contraseña nueva:</h3>
				<span class="numero" style="display: block;font-weight: 900;border: 1px solid black;text-align: center;padding: 10px;letter-spacing: 8px;border-radius: 10px;">{{$contra}}</span>
			</div>
			<hr class="divider">
			<div class="instrucciones" style="margin: auto;">
				<h4 style="margin-left: 1em;">Recomendaciones</h4>
				<ol style="width: 90%;">
					<li style="padding: 5px 0px;text-align: justify;">Cambia tu contraseña desde la aplicación y utiliza letras mayúsculas y minúsculas combinadas con números.</li>
					<li style="padding: 5px 0px;text-align: justify;">Trata de no utilizar palabras en tu contraseña.</li>
					<li style="padding: 5px 0px;text-align: justify;">No brinde a nadie información personal como tarjetas o contraseñas.</li>
				</ol>
			</div>
			<div class="alert" style="width: 80%;margin: auto;width: 61%;border: 1px solid #48943B;">
				<p style="padding: 0px 18%;color: #48943B;text-align: justify;">Si recibió este correo y no solicitó un cambio de contraseña, por favor, contáctanos.</p>
			</div>
		</div>
	</div>
	{{-- <div style='text-align: center; color: #efd225; font-size: 21px; padding: 8px 0px; font-weight: 600;'>
        <span>Más info en:</span>
    </div>
    <div style='text-align:center;background: #212121; font-size: 17px; font-weight: 900; padding: 13px 25px;'>
        <div style='display: inline-block;color:#efd225;font-size: 17px;margin-right:10px;'>
            <a href='https://www.google.com' style='text-decoration: none; color: #f0d400;' >
                <img style='width: 20%;vertical-align: text-bottom;margin-right: 2%;' src='https://www.socios.kangup.com.mx/images/mail/fb_icon.png'>
                /KangUp</a>
        </div>
        <div style='display: inline-block;color:#efd225;font-size: 17px;margin-right:10px;'>
            <a href='http://descarga.kangup.eleclean.com/' style='text-decoration: none; color: #f0d400;'>
            <img style='width: 9%;vertical-align: text-bottom;margin-right: 2%;' src='https://www.socios.kangup.com.mx/images/mail/android.png'>descarga.kangup.com.mx</a>
        </div>
        <div style='display: inline-block;color:#efd225;font-size: 17px;'>
            <a href='http://descarga.kangup.eleclean.com/' style='text-decoration: none; color: #f0d400;'>
            <img style='width: 9%;vertical-align: text-bottom;margin-right: 2%;' src='https://www.socios.kangup.com.mx/images/mail/ios.png'>descarga.kangup.com.mx</a>
        </div>
    </div> --}}
</body>
</html>