MvlabsSnappy
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
    
Usage
-----

The module registers one service:  

 - the `mvlabs.phpexcel.service` service allows you to interact with Excel files;
 

    

