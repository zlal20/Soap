<?php

//ruta de la clase econea
require_once "vendor/econea/nusoap/src/nusoap.php";
$namespace = "InsertCategoriaSOAP";
$server = new soap_server();
$server->configureWSDL("InsertCategoria", $namespace);
$server->wsdl->schemaTargetNamespace = $namespace;

//estructura del servicio
$server->wsdl->addComplexType(

    'InsertCategoria',
    'complexType',
    'struct',
    'all',
    '',

    array(
        'nombre' => array('name' => 'nombre', 'type' => 'xsd:string'),
        'apellido' => array('name' => 'apellido', 'type' => 'xsd:string'),
        'correo' => array('name' => 'correo', 'type' => 'xsd:string'),

    )

);

//estructura de la respuesta del servicio

$server->wsdl->addComplexType(

    'response',
    'complexType',
    'struct',
    'all',
    '',

    array(
        'Resultado' => array('name' => 'Resultado', 'type' => 'xsd:boolean'),
    )
);


$server->register(

    "InsertCategoriaService",
    array("InsertCategoria" => "tns:InsertCategoria"),
    array("InsertCategoria" => "tns:response"),

    $namespace,
    false,
    "rpc",
    "encoded",
    "Inserta una categoria"
);

function InsertCategoriaService($request)

{

    require_once "config/conexion.php";
    require_once "models/Usuario.php";

    $Usuario = new Usuario();
    $Usuario->insert_usuario($request["nombre"], $request["apellido"], $request["correo"]);


    return array(

        "Resultado" => true
    );
}

$_POST_DATA = file_get_contents("php://input");
$server->service($_POST_DATA);
exit();
