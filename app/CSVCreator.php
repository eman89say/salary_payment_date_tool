<?php

namespace App;

class CSVCreator 
{
    private $data;
    private $outputFile;
    private $list;

    const SALARY = 'salary';
    const BONUS = 'bonus';

    public function __construct(array $data, string $outputFile)
    {
        $this->data = $data;
        $this->outputFile = $outputFile;
    }

    public function createCSV()
    {
        $this->addHeader();
        $this->addData();
        $this->openCSVAndWrite();
    }

    private function addHeader()
    {
        $this->list = [ 
            ['Month Name', 'Salary Payment Date', 'Bonus Payment Date']
        ];
    }

    private function addData()
    {
        foreach ($this->data as $key => $value) {
            array_push($this->list, 
                [
                    $key, $value[self::SALARY], $value[self::BONUS]
                ]
            );
        }
    }

    private function openCSVAndWrite()
    {
        $fp = fopen($this->outputFile, 'w');

        foreach ($this->list as $field) {
            fputcsv($fp, $field);
        }

        fclose($fp);
    }
}