<?php

//apoderado_action.php

include('database_connection.php');

session_start();

if(isset($_POST["action"]))
{
	if($_POST["action"] == "fetch")
	{
		$query = "
		SELECT * FROM tbl_apoderado 
		INNER JOIN tbl_grade 
		ON tbl_grade.grade_id = tbl_apoderado.apoderado_grade_id 
		";
		if(isset($_POST["search"]["value"]))
		{
			$query .= '
			WHERE tbl_apoderado.apoderado_name LIKE "%'.$_POST["search"]["value"].'%" 
			OR tbl_apoderado.apoderado_emailid LIKE "%'.$_POST["search"]["value"].'%" 
			OR tbl_grade.grade_name LIKE "%'.$_POST["search"]["value"].'%" 
			';
		}
		if(isset($_POST["order"]))
		{
			$query .= '
			ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].'
			';
		}
		else
		{
			$query .= '
			ORDER BY tbl_apoderado.apoderado_id DESC 
			';
		}
		if($_POST["length"] != -1)
		{
			$query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
		}

		$statement = $connect->prepare($query);
		$statement->execute();
		$result = $statement->fetchAll();
		$data = array();
		$filtered_rows = $statement->rowCount();
		foreach($result as $row)
		{
			$sub_array = array();
			$sub_array[] = '<img src="apoderado_image/'.$row["apoderado_image"].'" class="img-thumbnail" width="75" />';
			$sub_array[] = $row["apoderado_name"];
			$sub_array[] = $row["apoderado_emailid"];
			$sub_array[] = $row["grade_name"];
			$sub_array[] = '<button type="button" name="view_apoderado" class="btn btn-dark btn-sm view_apoderado" id="'.$row["apoderado_id"].'">Ver</button>';
			$sub_array[] = '<button type="button" name="edit_apoderado" class="btn btn-primary btn-sm edit_apoderado" id="'.$row["apoderado_id"].'">Editar</button>';
			$sub_array[] = '<button type="button" name="delete_apoderado" class="btn btn-danger btn-sm delete_apoderado" id="'.$row["apoderado_id"].'">Eliminar</button>';
			$data[] = $sub_array;
		}
		$output = array(
			"draw"				=>	intval($_POST["draw"]),
			"recordsTotal"		=> 	$filtered_rows,
			"recordsFiltered"	=>	get_total_records($connect, 'tbl_apoderado'),
			"data"				=>	$data
		);
		echo json_encode($output);
	}

	if($_POST["action"] == 'Add' || $_POST["action"] == "Edit")
	{
		$apoderado_name = '';
		$apoderado_address = '';
		$apoderado_emailid = '';
		$apoderado_password = '';
		$apoderado_grade_id = '';
		$apoderado_qualification = '';
		$apoderado_doj = '';
		$apoderado_image = '';
		$error_apoderado_name = '';
		$error_apoderado_address = '';
		$error_apoderado_emailid = '';
		$error_apoderado_password = '';
		$error_apoderado_grade_id = '';
		$error_apoderado_qualification = '';
		$error_apoderado_doj = '';
		$error_apoderado_image = '';
		$error = 0;

		$apoderado_image = $_POST["hidden_apoderado_image"];
		if($_FILES["apoderado_image"]["name"] != '')
		{
			$file_name = $_FILES["apoderado_image"]["name"];
			$tmp_name = $_FILES["apoderado_image"]["tmp_name"];
			$extension_array = explode(".", $file_name);
			$extension = strtolower($extension_array[1]);
			$allowed_extension = array('jpg','png');
			if(!in_array($extension, $allowed_extension))
			{
				$error_apoderado_image = 'Invalid Image Format';
				$error++;
			}
			else
			{
				$apoderado_image = uniqid() . '.' . $extension;
				$upload_path = 'apoderado_image/' . $apoderado_image;
				move_uploaded_file($tmp_name, $upload_path);
			}
		}
		else
		{
			if($apoderado_image == '')
			{
				$error_apoderado_image = 'Image is required';
				$error++;
			}
		}
		if(empty($_POST["apoderado_name"]))
		{
			$error_apoderado_name = 'apoderado Name is required';
			$error++;
		}
		else
		{
			$apoderado_name = $_POST["apoderado_name"];
		}
		if(empty($_POST["apoderado_address"]))
		{
			$error_apoderado_address = 'apoderado Address is required';
			$error++;
		}
		else
		{
			$apoderado_address = $_POST["apoderado_address"];
		}
		if($_POST["action"] == "Add")
		{
			if(empty($_POST["apoderado_emailid"]))
			{
				$error_apoderado_emailid = 'Email Address is required';
				$error++;
			}
			else
			{
				if(!filter_var($_POST["apoderado_emailid"], FILTER_VALIDATE_EMAIL))
				{
					$error_apoderado_emailid = 'Invalid email format';
					$error++;
				}
				else
				{
					$apoderado_emailid = $_POST["apoderado_emailid"];
				}
			}
			if(empty($_POST["apoderado_password"]))
			{
				$error_apoderado_password = "Password is required";
				$error++;
			}
			else
			{
				$apoderado_password = $_POST["apoderado_password"];
			}
		}
		if(empty($_POST["apoderado_grade_id"]))
		{
			$error_apoderado_grade_id = "Grade is required";
			$error++;
		}
		else
		{
			$apoderado_grade_id = $_POST["apoderado_grade_id"];
		}
		if(empty($_POST["apoderado_qualification"]))
		{
			$error_apoderado_qualification = 'Qualification Field is required';
			$error++;
		}
		else
		{
			$apoderado_qualification = $_POST["apoderado_qualification"];
		}
		if(empty($_POST["apoderado_doj"]))
		{
			$error_apoderado_doj = 'Date of Join Field is required';
			$error++;
		}
		else
		{
			$apoderado_doj = $_POST["apoderado_doj"];
		}
		if($error > 0)
		{
			$output = array(
				'error'							=>	true,
				'error_apoderado_name'			=>	$error_apoderado_name,
				'error_apoderado_address'			=>	$error_apoderado_address,
				'error_apoderado_emailid'			=>	$error_apoderado_emailid,
				'error_apoderado_password'		=>	$error_apoderado_password,
				'error_apoderado_grade_id'		=>	$error_apoderado_grade_id,
				'error_apoderado_qualification'	=>	$error_apoderado_qualification,
				'error_apoderado_doj'				=>	$error_apoderado_doj,
				'error_apoderado_image'			=>	$error_apoderado_image
			);
		}
		else
		{
			if($_POST["action"] == 'Add')
			{
				$data = array(
					':apoderado_name'			=>	$apoderado_name,
					':apoderado_address'		=>	$apoderado_address,
					':apoderado_emailid'		=>	$apoderado_emailid,
					':apoderado_password'		=>	password_hash($apoderado_password, PASSWORD_DEFAULT),
					':apoderado_qualification'	=>	$apoderado_qualification,
					':apoderado_doj'			=>	$apoderado_doj,
					':apoderado_image'		=>	$apoderado_image,
					':apoderado_grade_id'		=>	$apoderado_grade_id
				);
				$query = "
				INSERT INTO tbl_apoderado 
				(apoderado_name, apoderado_address, apoderado_emailid, apoderado_password, apoderado_qualification, apoderado_doj, apoderado_image, apoderado_grade_id) 
				SELECT * FROM (SELECT :apoderado_name, :apoderado_address, :apoderado_emailid, :apoderado_password, :apoderado_qualification, :apoderado_doj, :apoderado_image, :apoderado_grade_id) as temp 
				WHERE NOT EXISTS (
					SELECT apoderado_emailid FROM tbl_apoderado WHERE apoderado_emailid = :apoderado_emailid
				) LIMIT 1
				";
				$statement = $connect->prepare($query);
				if($statement->execute($data))
				{
					if($statement->rowCount() > 0)
					{
						$output = array(
							'success'		=>	'Data Added Successfully',
						);
					}
					else
					{
						$output = array(
							'error'					=>	true,
							'error_apoderado_emailid'	=>	'Email Already Exists'
						);
					}
				}
			}
			if($_POST["action"] == "Edit")
			{
				$data = array(
					':apoderado_name'		=>	$apoderado_name,
					':apoderado_address'	=>	$apoderado_address,
					':apoderado_qualification'	=>	$apoderado_qualification,
					':apoderado_doj'		=>	$apoderado_doj,
					':apoderado_image'	=>	$apoderado_image,
					':apoderado_grade_id'	=>	$apoderado_grade_id,
					':apoderado_id'		=>	$_POST["apoderado_id"]
				);
				$query = "
				UPDATE tbl_apoderado 
				SET apoderado_name = :apoderado_name, 
				apoderado_address = :apoderado_address,  
				apoderado_grade_id = :apoderado_grade_id, 
				apoderado_qualification = :apoderado_qualification, 
				apoderado_doj = :apoderado_doj, 
				apoderado_image = :apoderado_image
				WHERE apoderado_id = :apoderado_id
				";
				$statement = $connect->prepare($query);
				if($statement->execute($data))
				{
					$output = array(
						'success'		=>	'Data Edited Successfully',
					);
				}
			}
		}
		echo json_encode($output);
	}



	if($_POST["action"] == "single_fetch")
	{
		$query = "
		SELECT * FROM tbl_apoderado 
		INNER JOIN tbl_grade 
		ON tbl_grade.grade_id = tbl_apoderado.apoderado_grade_id 
		WHERE tbl_apoderado.apoderado_id = '".$_POST["apoderado_id"]."'";
		$statement = $connect->prepare($query);
		if($statement->execute())
		{
			$result = $statement->fetchAll();
			$output = '
			<div class="row">
			';
			foreach($result as $row)
			{
				$output .= '
				<div class="col-md-3">
					<img src="apoderado_image/'.$row["apoderado_image"].'" class="img-thumbnail" />
				</div>
				<div class="col-md-9">
					<table class="table">
						<tr>
							<th>Nombre</th>
							<td>'.$row["apoderado_name"].'</td>
						</tr>
						<tr>
							<th>Dirección</th>
							<td>'.$row["apoderado_address"].'</td>
						</tr>
						<tr>
							<th>Correo</th>
							<td>'.$row["apoderado_emailid"].'</td>
						</tr>
						<tr>
							<th>Calificación</th>
							<td>'.$row["apoderado_qualification"].'</td>
						</tr>
						<tr>
							<th>Fecha de Ingreso</th>
							<td>'.$row["apoderado_doj"].'</td>
						</tr>
						<tr>
							<th>Curso</th>
							<td>'.$row["grade_name"].'</td>
						</tr>
					</table>
				</div>
				';
			}
			$output .= '</div>';
			echo $output;
		}
	}

	if($_POST["action"] == "edit_fetch")
	{
		$query = "
		SELECT * FROM tbl_apoderado WHERE apoderado_id = '".$_POST["apoderado_id"]."'
		";
		$statement = $connect->prepare($query);
		if($statement->execute())
		{
			$result = $statement->fetchAll();
			foreach($result as $row)
			{
				$output["apoderado_name"] = $row["apoderado_name"];
				$output["apoderado_address"] = $row["apoderado_address"];
				$output["apoderado_qualification"] = $row["apoderado_qualification"];
				$output["apoderado_doj"] = $row["apoderado_doj"];
				$output["apoderado_image"] = $row["apoderado_image"];
				$output["apoderado_grade_id"] = $row["apoderado_grade_id"];
				$output["apoderado_id"] = $row["apoderado_id"];
			}
			echo json_encode($output);
		}
	}

	if($_POST["action"] == "delete")
	{
		$query = "
		DELETE FROM tbl_apoderado 
		WHERE apoderado_id = '".$_POST["apoderado_id"]."'
		";
		$statement = $connect->prepare($query);
		if($statement->execute())
		{
			echo 'Data Deleted Successfully';
		}
	}
	
}

?>