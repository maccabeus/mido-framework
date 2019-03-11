<?php
/**
 * Mido Framework
 * @package Mido
 * @author  Adeniyi Anthony A   <anthony.a@mido.org>
 * @link    www.mido.org
 */

/*
 * ---------------------------------------------------------------------------------------------------------------------
 * The file function much like an autoloader.
 * It loads all the paths and set things in motion for our application
 * ---------------------------------------------------------------------------------------------------------------------
 */

/**
 * make everything relative to application root here
 */
chdir(dirname(__DIR__));

/*
 * decline static file requests
 */
if (php_sapi_name() === 'cli-server' && is_file(__DIR__ . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH))) {
    return false;
}

if (file_exists(__DIR__ . '/config.php')) {
    $config = require_once(__DIR__ . '/config.php');
} else {
    throw new Exception ('Configuration file not found');
}
/*
 * load the language file here
 */
$languagePath = __DIR__ . '/General/Dic/' . $config['language']['iso'] . '.php';

if (file_exists($languagePath)) {
    $language = require_once $languagePath;
} else {
    throw new Exception ("Language file for " . $config['language']['iso'] . " is missing");
}

/*
 * Initialise the base class path for our application
 */

if (is_dir(__DIR__ . '/General/Mido/')) {
    /*
     * call the class loader
     */
    $midoPath = (__DIR__ . '/General/Mido');
    $classLoader = (__DIR__ . '/General/Mido/Design/Loader/ClassLoader.php');
    if (file_exists($classLoader)) {
        require_once $classLoader;
        $designer = new Mido\Design\Loader\ClassLoader();
        $designer->loadAllClass($midoPath);
    } else {
        throw new Exception  ($language['resolve']['default']['invalid_class_path']);
    }
} else {
    throw new Exception ($language['resolve']['default']['invalid_mido_path']);
}

/*
 * Attempt  to autoload composer
 */

if (file_exists(__DIR__ . '/plugins/autoload.php')) {
    $composer = include __DIR__ . '/plugins/autoload.php';
} else {
    $composer = null;
}

/*
 * load the application template here
 */
$templateLoader = new Mido\Design\Loader\TemplateLoader();
$template = $templateLoader->loadDefaultTemplate($config);

/*
 * commit all configurations, language, template, and settings to the globals space
 */
$globalSpace = new Mido\Http\Session\Globals;
$globalSpace->add('language', $language);
$globalSpace->add('config', $config);
$globalSpace->add('template', $template);


/*
 * That will be all. Allow the index file to run the switch
 */
