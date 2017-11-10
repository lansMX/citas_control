<!-- GLOBAL.PHP -->
<?php
/**
 * Global Configuration Override
 *
 * You can use this file for overriding configuration values from modules, etc.
 * You would place values in here that are agnostic to the environment and not
 * sensitive to security.
 *
 * @NOTE: In practice, this file will typically be INCLUDED in your source
 * control, so do not include passwords or other sensitive information in this
 * file.


return array(
    'db' => array(
        'driver'         => 'Pdo',
        'dsn'            => 'mysql:dbname=psicologa;host=localhost',
        // 'dsn'            => 'mysql:dbname=Nucleo;host=localhost',
        'driver_options' => array(
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''
        ),

        'adapters'=>array(
            'adapterCore' => array(
                'driver'  => 'Pdo',
                'dsn'     => 'mysql:dbname=psicologa;host=localhost',
                // 'dsn'     => 'mysql:dbname=Nucleo;host=localhost',
                'driver_options' => array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'")
            ),
            'adapterRh' => array(
                'driver'  => 'Pdo',
                'dsn'     => 'mysql:dbname=psicologa;host=localhost',
                'driver_options' => array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'")
            ),
        )
    ),
    'service_manager' => array(
        'abstract_factories' => array(
            'Zend\Db\Adapter\AdapterAbstractServiceFactory',
        ),

        'factories' => array(
            'Zend\Db\Adapter\Adapter' => 'Zend\Db\Adapter\AdapterServiceFactory',
        ),
    ),
);
 */

/**
 * Global Configuration Override
 *
 * You can use this file for overriding configuration values from modules, etc.
 * You would place values in here that are agnostic to the environment and not
 * sensitive to security.
 *
 * @NOTE: In practice, this file will typically be INCLUDED in your source
 * control, so do not include passwords or other sensitive information in this
 * file.
 */

return array(
    // ...
);

















// LOCAL.PHP

<?php
/**
 * Local Configuration Override
 *
 * This configuration override file is for overriding environment-specific and
 * security-sensitive configuration information. Copy this file without the
 * .dist extension at the end and populate values as needed.
 *
 * @NOTE: This file is ignored from Git by default with the .gitignore included
 * in ZendSkeletonApplication. This is a good practice, as it prevents sensitive
 * credentials from accidentally being committed into version control.
 

return array(
);*/

/**
 * Local Configuration Override
 *
 * This configuration override file is for overriding environment-specific and
 * security-sensitive configuration information. Copy this file without the
 * .dist extension at the end and populate values as needed.
 *
 * @NOTE: This file is ignored from Git by default with the .gitignore included
 * in ZendSkeletonApplication. This is a good practice, as it prevents sensitive
 * credentials from accidentally being committed into version control.
 */
ini_set('display_errors', '0');
date_default_timezone_set('America/Mexico_City');
return [
    'service_manager' => [
        'factories' => [
            'Zend\Db\Adapter' => 'Zend\Db\Adapter\AdapterServiceFactory',
        ],
    ],
    'db'              => [
        // 'username' => 'soporte',
        'username' => 'root',
        // 'password' => '1q2w3e4r',
        'password' => '',
        'driver'   => 'Pdo',
        // 'dsn'      => 'mysql:dbname=InverCity;host=192.168.1.100',
        'dsn'      => 'mysql:dbname=psicologa;host=localhost',
        
        'driver_options' => [
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'utf8\''
        ],
    ],
];
