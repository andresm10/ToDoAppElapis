<!DOCTYPE html>
<html>
<head>
	<title>Generar nueva contrase&ntilde;a</title>
</head>
<body>
	<p>
		Hola {{ $name }}!<br /><br />
		Tu -o alguien en tu nombre- has solicitado recuperar la contrase&ntilde;a ...
	</p>
	 <p>
		Has click en el siguiente link para poder obtener una nueva contrase&ntilde;a :<br />
		<ul>
			<li>
				<a href="{{ $link }}" target="_blank">Generar nueva Contrase&ntilde;a</a>
			</li>
		</ul>
		Este link tiene una vida &uacute;til de 30 minutos, pasados los 30min deber&aacute;s solicitar uno nuevo.
	 </p>

 	<p>
		El equipo de soporte:<br /><br />
		El cambio de contrase&ntilde;a fue pedido desde la IP: {{ $ip }} si no eres t&uacute; y esta situaci&oacute;n se repite en mas de 3 ocasiones, puedes enviarnos los mensajes que recibas al correo <a href="mailto:andresmajin7@gmail.com">andresmajin7@gmail.com</a> para solicitar asistencia.<br />
		Pero no te asustes, que si no tienen acceso a tu casilla de correo no podran recuperar tu contrase&ntilde;a.
 	</p>
</body>
</html>