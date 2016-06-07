MvlabsPHPExcel
=========

MvlabsPHPExcel is a ZF2 module that allow easy to create, modify and read excel files (including pdf, xlsx, odt) using [PHPOffice/PHPExcel][PHPOffice/PHPExcel] library.

Installation
------------
#### With composer

1. Add to your `composer.json` :

    $composer require liuggio/excelbundle
    
    ```bash
    $ php composer.phar require mvlabs/mvlabs-phpexcel
    ```
    

2. Now tell composer to download MvlabsPHPExcel by running the command:

    ```bash
    $ php composer.phar update
    ```



#### Post installation

1. Enabling it in your `application.config.php`file.

    ```php
    <?php
    return [
        'modules' => [
            // ...
            'MvlabsPHPExcel',            
        ],
        // ...
    ];
    ```
 
 
 
 Requirements PHPExcel library
 -----------------------------
 * PHP version 5.5.0 or higher
 * PHP extension php_zip enabled (required if you need PHPExcel to handle .xlsx .ods or .gnumeric files)
 * PHP extension php_xml enabled
 * PHP extension php_gd2 enabled (optional, but required for exact column width autocalculation)


    
Usage
-----

The module registers one service:  

 - the `mvlabs.phpexcel.service` service allows you to interact with Excel files;
 

    

Credits
-------

MvlabsPHPExcel is based on the awesome [PHPOffice/PHPExcel][PHPOffice/PHPExcel] library.
MvlabsPHPExcel has been developed by [mvlabs][mvlabs].

[PHPOffice/PHPExcel]: https://github.com/PHPOffice/PHPExcel
[mvlabs]: http://www.mvlabs.it
[mvassociati]: http://www.mvassociati.it/en
