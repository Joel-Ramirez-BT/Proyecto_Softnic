<?php
// Capturar el contenido generado
$contenido = ob_get_clean();

// Array de traducciones
$traducciones = [
    'Sistema' => 'yapti',
    'water' => 'li',
    'food' => 'nani',
    'love' => 'laiki',
    // Añadir más traducciones
];

// Función para traducir el contenido
function traducir($contenido, $traducciones) {
    foreach ($traducciones as $palabra_ingles => $palabra_miskito) {
        // Reemplazar las palabras en inglés por miskito (case-insensitive)
        $contenido = preg_replace("/\b$palabra_ingles\b/i", $palabra_miskito, $contenido);
    }
    return $contenido;
}

// Traducir el contenido
$contenido_traducido = traducir($contenido, $traducciones);

// Mostrar el contenido traducido
echo $contenido_traducido;
?>
