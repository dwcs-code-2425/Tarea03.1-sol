<?php
function readIniFile($file = "db_settings.ini"): array
{
    //https://www.php.net/manual/es/function.parse-ini-file.php
//carga el fichero ini especificado en $file, y devuelve las configuraciones que hay en él a un array asociativo $settings 
//o false si hay algún error y no consigue leer el fichero. 
    if (!$settings = parse_ini_file($file, TRUE))
        throw new exception('Unable to open ' . $file . '.');
    return $settings;
}

function getConnection(): PDO
{
    //leemos datos del ini file en un array asociativo
    $settings = readIniFile();

    //Creamos cadena de conexión concatenando
    $dsn = $settings['database']['driver'] .
        ':host=' . $settings['database']['host'] .
        ((!empty($settings['database']['port'])) ? (';port=' . $settings['database']['port']) : '') .
        ';dbname=' . $settings['database']['schema'];

    //Creamos el objeto PDO
    $conn = new PDO($dsn, $settings['database']['username'], $settings['database']['password']);
    return $conn;

}