<?php
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP
 *
 * @package	Blog
 * @author	lmx
 * @copyright	Copyright (c) (http://blog.net/)
 * @link	http://blog.net
 * @since	Version 1.0.0
 * @filesource
 */

/*
 *---------------------------------------------------------------
 * APPLICATION ENVIRONMENT
 *---------------------------------------------------------------
 *
 * You can load different configurations depending on your
 * current environment. Setting the environment also influences
 * things like logging and error reporting.
 *
 * This can be set to anything, but default usage is:
 *
 *     development
 *     testing
 *     production
 *
 * NOTE: If you change these, also change the error_reporting() code below
 */
	define('ENVIRONMENT', isset($_SERVER['CI_ENV']) ? $_SERVER['CI_ENV'] : 'development');
	switch(ENVIRONMENT){
		case "development":
			error_reporting(-1);
			ini_set('display_errors', 1);
		break;
		case "production":
		case "testing":
			ini_set('display_errors', 0);
			if (version_compare(PHP_VERSION, '5.3', '>='))
			{
				error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED & ~E_STRICT & ~E_USER_NOTICE & ~E_USER_DEPRECATED);
			}
			else
			{
				error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_USER_NOTICE);
			}
		break;
		default:
			header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
			echo 'The application environment is not set correctly.';
			exit(1);
		break;
	}
/*
 *---------------------------------------------------------------
 * SYSTEM FOLDER NAME
 *---------------------------------------------------------------
 *
 * This variable must contain the name of your "system" folder.
 * Include the path if the folder is not in the same directory
 * as this file.
 */
	$system_path = 'system';

/*
 *---------------------------------------------------------------
 * APPLICATION FOLDER NAME
 *---------------------------------------------------------------
 *
 * If you want this front controller to use a different "application"
 * folder than the default one you can set its name here. The folder
 * can also be renamed or relocated anywhere on your server. If
 * you do, use a full server path. For more info please see the user guide:
 * http://codeigniter.com/user_guide/general/managing_apps.html
 *
 * NO TRAILING SLASH!
 */
	$application_folder = 'manageapp';

/*
 *---------------------------------------------------------------
 * VIEW FOLDER NAME
 *---------------------------------------------------------------
 *
 * If you want to move the view folder out of the application
 * folder set the path to the folder here. The folder can be renamed
 * and relocated anywhere on your server. If blank, it will default
 * to the standard location inside your application folder. If you
 * do move this, use the full server path to this folder.
 *
 * NO TRAILING SLASH!
 */
	$view_folder = 'manage';
/*
 * ---------------------------------------------------------------
 *  Resolve the system path for increased reliability
 * ---------------------------------------------------------------
 */
 	if(defined("STDIN")){
 		chdir(dirname(__FILE__));
 	}	
 	if(($_temp = realpath($system_path))!= FALSE){
 		$system_path = $_temp."/";
 	}else{
 		$system_path = rtime($system_path,"/")."/";
 	}
 	if(!is_dir($system_path)){
 		header("HTTP/1.1 503 Service Unavailable.",TRUE,503);
 		echo "Your system folder path does not appear to be set correctly. Please open the following file and correct this:".pathinfo(__FILE__,PATHINFO_BASENAME);
 		exit(3);
 	}
/*
 * -------------------------------------------------------------------
 *  Now that we know the path, set the main path constants
 * -------------------------------------------------------------------
 */
	define("SELF",pathinfo(__FILE__,PATHINFO_BASENAME)); //admin.php
	define("BASEPATH",str_replace("\\","/",$system_path)); //F:/www/private/blog/system/
	define('FCPATH',dirname(__FILE__)); //F:\www\private\blog
	define('SYSDIR',trim(strrchr(trim(BASEPATH,'/'),'/'),'/')); //system

	if(is_dir($application_folder)){
		if(($_temp = realpath($application_folder))!== FALSE){
			$application_folder = $_temp;
		}
		define('APPPATH',$application_folder.DIRECTORY_SEPARATOR); //F:\www\private\blog\application\
	}else{
		if(!is_dir(BASEPATH.$application_folder.DIRECTORY_SEPARATOR)){
			header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
			echo 'Your application folder path does not appear to be set correctly. Please open the following file and correct this: '.SELF;
			exit(3); 
		}
		define('APPPATH',BASEPATH.$application_folder.DIRECTORY_SEPARATOR);
	}
/*
 * -----------------------------------------------------------------
 * The Path to the "views" folder
 * -----------------------------------------------------------------
 */
	if(!is_dir($view_folder)){
		if(! empty($view_folder) && is_dir(APPPATH.$view_folder.DIRECTORY_SEPARATOR)){
			$view_folder = APPPATH.$view_folder;
		}elseif(! is_dir(APPPATH."views".DIRECTORY_SEPARATOR)){
			header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
			echo 'Your view folder path does not appear to be set correctly. Please open the following file and correct this: '.SELF;
			exit(3);
		}else{
			$view_folder = APPPATH."views";
		}
	}

	if(($_temp = realpath($view_folder)) !== FALSE){
		$view_folder = $_temp.DIRECTORY_SEPARATOR;
	}else{
		$view_folder = rtrim($view_folder,"/\\").DIRECTORY_SEPARATOR;
	}
	define("VIEWPATH",$view_folder);
/*
 * --------------------------------------------------------------------
 * LOAD THE BOOTSTRAP FILE
 * --------------------------------------------------------------------
 */
	require_once(BASEPATH."core/CodeIgniter.php");