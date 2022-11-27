<?php

//check_apoderado_login.php

include('admin/database_connection.php');

session_start();

$apoderado_emailid = '';
$apoderado_password = '';
$error_apoderado_emailid = '';
$error_apoderado_password = '';
$error = 0;

if(empty($_POST["apoderado_emailid"]))
{
	$error_apoderado_emailid = 'El campo Email es requerido..';
	$error++;
}
else
{
	$apoderado_emailid = $_POST["apoderado_emailid"];
}

if(empty($_POST["apoderado_password"]))
{	
	$error_apoderado_password = 'La contraseña es requerida..';
	$error++;
}
else
{
	$apoderado_password = $_POST["apoderado_password"];
}

if($error == 0)
{
	$query = "
	SELECT * FROM tbl_apoderado 
	WHERE apoderado_emailid = '".$apoderado_emailid."'
	";

	$statement = $connect->prepare($query);
	if($statement->execute())
	{
		$total_row = $statement->rowCount();
		if($total_row > 0)
		{
			$result = $statement->fetchAll();
			foreach($result as $row)
			{
				if(password_verify($apoderado_password, $row["apoderado_password"]))
				{
					$_SESSION["apoderado_id"] = $row["apoderado_id"];
				}
				else
				{
					$error_apoderado_password = "Contraseña incorrecta.";
					$error++;
				}
			}
		}
		else
		{
			$error_apoderado_emailid = "Correo incorrecto - no Existente.";
			$error++;
		}
	}
}

if($error > 0)
{
	$output = array(
		'error'			=>	true,
		'error_apoderado_emailid'	=>	$error_apoderado_emailid,
		'error_apoderado_password'	=>	$error_apoderado_password
	);
}
else
{
	$output = array(
		'success'		=>	true
	);
}

echo json_encode($output);

?>