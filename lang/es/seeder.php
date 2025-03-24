<?php

return [
    "project" => [
        "name" => "Proyecto Alpha",
        "description" => "Proyecto de prueba",
    ],
    "module" => [
        "name" => "Autenticación",
    ],
    "task" => [
        "name" => "Inicio de sesión del usuario",
        "description" => "El usuario puede iniciar sesión",
        "expected_flow" => [
            "El usuario visita la página de inicio de sesión",
            "El usuario ingresa sus credenciales",
            "El sistema valida las credenciales",
            "El usuario es redirigido al tablero en caso de éxito",
            "Se muestra un mensaje de error en caso de falla",
        ],
    ],
    "testCase" => [
        "title" => "Prueba de inicio de sesión del usuario",
        "description" => "Verificar que un usuario pueda iniciar sesión con credenciales válidas.",
        "steps" => [
            "Navegar a la página de inicio de sesión",
            "Ingresar nombre de usuario y contraseña válidos",
            "Hacer clic en el botón de inicio de sesión",
        ],
        "obtained_result" => "El usuario es redirigido al tablero",
        "test_comments" => "",
    ],
    "testCaseComment" => [
        "comment_1" => "Comentario inicial de la prueba de caso de John.",
        "comment_2" => "Sara agrega sus pensamientos sobre la prueba de caso.",
        "comment_3" => "Sara cuestiona la validez del comentario de John.",
        "comment_4" => "John reafirma su posición en respuesta a Sara.",
    ],
    "bugReport" => [
        "title" => "La tarea 1 no muestra la información correcta",
        "description" => "Cuando navego a la página de detalles de la tarea 1, muestra la descripción de la tarea 2.",
        "steps_to_reproduce" => [
            "Navegar al proyecto donde se encuentra la tarea 1.",
            "Hacer clic en la tarjeta de la tarea 1.",
            "Verificar que la descripción de la tarea 1 no esté mostrando.",
        ],
    ],
    "bugReportComment" => [
        "comment_1" => "Comentario inicial del informe de error de John.",
        "comment_2" => "Sara agrega sus pensamientos sobre el informe de error.",
        "comment_3" => "Sara cuestiona la validez del comentario de John.",
        "comment_4" => "John reafirma su posición en respuesta a Sara.",
    ]
];

