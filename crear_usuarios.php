<?php
$usuarios = [
    ['nombre' => 'admin', 'email' => 'admin@tulioriera.com', 'rol' => 'admin', 'pasillo' => null],
    ['nombre' => 'jefedeposito', 'email' => 'jefe@tulioriera.com', 'rol' => 'jefe_deposito', 'pasillo' => null],
    ['nombre' => 'pasillo7', 'email' => 'pasillo7@tulioriera.com', 'rol' => 'pasillo', 'pasillo' => 7]
];

$mysqli = new mysqli("localhost", "root", "", "tulioriera");

// Borrar usuarios anteriores
$mysqli->query("DELETE FROM usuarios");

// Crear usuarios con hash de contraseña
foreach ($usuarios as $u) {
    $pass = password_hash($u['nombre'] . '123', PASSWORD_DEFAULT);
    $stmt = $mysqli->prepare("INSERT INTO usuarios (nombre, email, password, rol, pasillo) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssi", $u['nombre'], $u['email'], $pass, $u['rol'], $u['pasillo']);
    $stmt->execute();
}

echo "Usuarios creados con éxito.";
