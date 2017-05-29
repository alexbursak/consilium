<?php

namespace ConsiliumBundle\Validator;


class DayValidator
{
    const REQUIRED_FIELDS = [
        'date',
        'note',
    ];

    private $data;
    private $errors = [];
    private $valid = false;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function validate()
    {
        if (empty($this->data)) {
            array_push($this->errors, 'NO DATA');
            return $this;
        }

        $dataArray = (array)json_decode($this->data);

        if ($this->checkRequiredKeysExists($dataArray)){
            foreach ($dataArray as $fiendsName => $field){
                if(empty($field)){
                    array_push($this->errors,  sprintf('EMPTY FIELD \'%s\'', $fiendsName));
                }
            }
        }else{
            array_push($this->errors,  'REQUIRED FIELD(S) MISSING');
        }

        if(empty($this->errors)){
            $this->valid = true;
        }

        return $this;
    }

    private function checkRequiredKeysExists(array $dataArray)
    {
            return !array_diff_key(array_flip(self::REQUIRED_FIELDS), $dataArray);
    }

    public function getErrors()
    {
        return $this->errors;
    }

    public function isValid()
    {
        return $this->valid;
    }
}