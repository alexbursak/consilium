<?php

namespace ConsiliumBundle\Validator;


class DayValidator
{
    const REQUIRED_FIELDS = [
        'date',
        'note',
    ];

    /**
     * Raw data from Request
     *
     * @var mixed
     */
    private $data;

    /**
     * @var array
     */
    private $errors = [];

    /**
     * @var bool
     */
    private $valid = false;

    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Validates data format (basic)
     *
     * @return $this
     */
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

    /**
     * @param array $dataArray
     *
     * @return bool
     */
    private function checkRequiredKeysExists(array $dataArray)
    {
            return !array_diff_key(array_flip(self::REQUIRED_FIELDS), $dataArray);
    }

    /**
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * @return bool
     */
    public function isValid()
    {
        return $this->valid;
    }
}