<?php
	
// Añadir nuevo menú (categorías)
if (isset($_POST['addmenu'])) {

	// Verificar si el campo 'menuname' no está vacío
	if (!empty($_POST['menuname'])) {
		$menuname = $sqlconnection->real_escape_string($_POST['menuname']);

		// Verificar si se ha cargado un archivo de imagen y no hay errores
		if (isset($_FILES['menu_imagen']) && $_FILES['menu_imagen']['error'] === UPLOAD_ERR_OK) {
			
			$fileTmpPath = $_FILES['menu_imagen']['tmp_name'];
			$fileName = $_FILES['menu_imagen']['name'];
			$fileSize = $_FILES['menu_imagen']['size'];
			$fileType = $_FILES['menu_imagen']['type'];
			$fileNameCmps = explode(".", $fileName);
			$fileExtension = strtolower(end($fileNameCmps));

			// Definir las extensiones de archivo permitidas
			$allowedfileExtensions = array('jpg', 'jpeg', 'png', 'gif');
			
			// Verificar si la extensión es permitida
			if (in_array($fileExtension, $allowedfileExtensions)) {
				// Verificar el tipo MIME del archivo para mayor seguridad
				$allowedMIMETypes = array('image/jpeg', 'image/png', 'image/gif');
				if (in_array($fileType, $allowedMIMETypes)) {

					// Generar un nombre de archivo único para evitar sobrescrituras
					$newFileName = md5(time() . $fileName) . '.' . $fileExtension;
					
					// Definir el directorio de destino
					$uploadFileDir = '../image/';
					$dest_path = $uploadFileDir . $newFileName;

					// Mover el archivo subido al directorio de destino
					if(move_uploaded_file($fileTmpPath, $dest_path)) {
						// Insertar en la base de datos tanto el nombre del menú como el nombre de la imagen
						$addMenuQuery = "INSERT INTO tbl_menu (menuName, menu_imagen) VALUES ('{$menuname}', '{$newFileName}')";

						if ($sqlconnection->query($addMenuQuery) === TRUE) {
							// Redirigir después de la inserción exitosa
							header("Location: menu.php");
						} else {
							echo "Error: No se pudo insertar los datos en la base de datos.";
						}
					} else {
						echo "Hubo un error al mover la imagen al directorio de destino.";
					}
				} else {
					echo "Tipo de archivo no permitido. El archivo debe ser una imagen válida.";
				}
			} else {
				echo "Tipo de archivo no permitido. Solo se permiten JPG, JPEG, PNG, y GIF.";
			}
		} else {
			// Si no se sube ninguna imagen o hay un error
			echo "Por favor, selecciona una imagen válida.";
		}

	} else {
		echo "El campo de nombre no puede estar vacío.";
	}
}
?>
