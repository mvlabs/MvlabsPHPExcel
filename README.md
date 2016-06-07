MvlabsPHPExcel
=========

MvlabsPHPExcel is a ZF2 module that allow easy to create, modify and read excel files (including pdf, xlsx, odt) using [PHPOffice/PHPExcel][PHPOffice/PHPExcel] library.

Requirements PHPExcel library
-----------------------------
 * PHP version 5.5.0 or higher
 * PHP extension php_zip enabled (required if you need PHPExcel to handle .xlsx .ods or .gnumeric files)
 * PHP extension php_xml enabled
 * PHP extension php_gd2 enabled (optional, but required for exact column width autocalculation)


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
 
- Creating a new workbook:
If you want to create a new workbook, then you simply need to instantiate it as a new PHPExcel object.

``` php
$phpExcelObject = $this->serviceLocator->get('mvlabs.phpexcel.service')->createPHPExcelObject();
```

- Loading a Workbook from a file:

``` php
$phpExcelObject = $this->serviceLocator->get('mvlabs.phpexcel.service')->createPHPExcelObject('myExcelFile.xls');
```

- Create a Excel2007 and save it to a file:

```php
$myWriter = $this->serviceLocator->get('mvlabs.phpexcel.service')->createWriter($phpExcelObject, 'Excel2007');
$myWriter->save('myExcelFile.xls');
```

### Render a excel document as response from a controller

```php
    public function testPHPExcelAction() {
        // I recommend constructor injection for all needed dependencies ;-)
        $this->phpExcelService = $this->serviceLocator->get('mvlabs.phpexcel.service');
        
        $objPHPExcel = $this->phpExcelService->createPHPExcelObject();
        $objPHPExcel->getProperties()->setCreator("Diego Drigani")
            ->setLastModifiedBy("Diego Drigani")
            ->setTitle("MvlabsPHPExcel Test Document")
            ->setSubject("MvlabsPHPExcel Test Document")
            ->setDescription("Test document for MvlabsPHPExcel, generated using Zend Framework 2 and PHPExcel.")
            ->setKeywords("office PHPExcel php zf2 mvlabs")
            ->setCategory("Test result file");
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Hello')
            ->setCellValue('B2', 'world!')
            ->setCellValue('C1', 'Hello')
            ->setCellValue('D2', 'world!');
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A4', 'Miscellaneous glyphs')
            ->setCellValue('A5', 'éàèùâêîôûëïüÿäöüç');

        $objPHPExcel->getActiveSheet()->setCellValue('A8',"Hello\nWorld");
        $objPHPExcel->getActiveSheet()->getRowDimension(8)->setRowHeight(-1);
        $objPHPExcel->getActiveSheet()->getStyle('A8')->getAlignment()->setWrapText(true);
        $objPHPExcel->getActiveSheet()->setTitle('Mvlabs');
        $objPHPExcel->setActiveSheetIndex(0);

        $objWriter = $this->phpExcelService->createWriter($objPHPExcel, 'Excel2007' );

        $response = $this->phpExcelService->createHttpResponse($objWriter, 200, [
            'Pragma' => 'public',
            'Cache-control' => 'must-revalidate, post-check=0, pre-check=0',
            'Cache-control' => 'private',
            'Expires' => '0000-00-00',
            'Content-Type' => 'application/vnd.ms-excel; charset=utf-8',
            'Content-Disposition' => 'attachment; filename=' . 'myTest.xls',
            ]);

        return $response;
    
    }    
```  
    

Credits
-------

MvlabsPHPExcel is based on the awesome [PHPOffice/PHPExcel][PHPOffice/PHPExcel] library.
MvlabsPHPExcel has been developed by [mvlabs][mvlabs].

[PHPOffice/PHPExcel]: https://github.com/PHPOffice/PHPExcel
[mvlabs]: http://www.mvlabs.it
[mvassociati]: http://www.mvassociati.it/en
