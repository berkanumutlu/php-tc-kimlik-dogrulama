<?php

/**
 * Republic of Turkey Identity Card
 */
class TCKimlik
{
    /*
     * TR Identity No (11 digits)
     * @var string
     */
    private $number;
    /*
     * Given Name(s)
     * @var string
     */
    private $name;
    /*
     * Surname
     * @var string
     */
    private $surname;
    /*
     * Date of Birth (e.g. 01.12.1997)
     * @var string
     */
    private $birthDate;
    /*
     * Year of Birth (e.g. 1997)
     * @var string|int
     */
    private $birthYear;
    /*
     * Month of Birth (e.g. 2)
     * @var string|int
     */
    private $birthMonth;
    /*
     * Day of Birth (e.g. 1)
     * @var string|int
     */
    private $birthDay;
    /*
     * Gender (e.g. 'E' or 'K' / 'M' or 'F')
     * @var string
     */
    private $gender;
    /*
     * Nationality (e.g. 'T.C.' / 'TUR')
     * @var string
     */
    private $nationality;
    /*
     * Document No (e.g. A0123456)
     * @var string
     */
    private $documentNo;

    /**
     * @return mixed
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @param  mixed  $number
     */
    public function setNumber($number)
    {
        $this->number = $number;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param  mixed  $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * @param  mixed  $surname
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;
    }

    /**
     * @return mixed
     */
    public function getBirthDate()
    {
        return $this->birthDate;
    }

    /**
     * @param  mixed  $birthDate
     */
    public function setBirthDate($birthDate)
    {
        $this->birthDate = $birthDate;
    }

    /**
     * @return mixed
     */
    public function getBirthYear()
    {
        return $this->birthYear;
    }

    /**
     * @param  mixed  $birthYear
     */
    public function setBirthYear($birthYear)
    {
        $this->birthYear = $birthYear;
    }

    /**
     * @return mixed
     */
    public function getBirthMonth()
    {
        return $this->birthMonth;
    }

    /**
     * @param  mixed  $birthMonth
     */
    public function setBirthMonth($birthMonth)
    {
        $this->birthMonth = $birthMonth;
    }

    /**
     * @return mixed
     */
    public function getBirthDay()
    {
        return $this->birthDay;
    }

    /**
     * @param  mixed  $birthDay
     */
    public function setBirthDay($birthDay)
    {
        $this->birthDay = $birthDay;
    }

    /**
     * @return mixed
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * @param  mixed  $gender
     */
    public function setGender($gender)
    {
        $this->gender = $gender;
    }

    /**
     * @return mixed
     */
    public function getNationality()
    {
        return $this->nationality;
    }

    /**
     * @param  mixed  $nationality
     */
    public function setNationality($nationality)
    {
        $this->nationality = $nationality;
    }

    /**
     * @return mixed
     */
    public function getDocumentNo()
    {
        return $this->documentNo;
    }

    /**
     * @param  mixed  $documentNo
     */
    public function setDocumentNo($documentNo)
    {
        $this->documentNo = $documentNo;
    }

    /**
     * @return bool
     */
    public function verify()
    {
        $number = $this->getNumber();
        // First Rule
        if (!ctype_digit($number)) {
            return false;
        }
        // Second Rule
        $numberArray = str_split($number);
        $firstDigit = current($numberArray);
        if ($firstDigit == '0') {
            return false;
        }
        // Third Rule
        $numberLength = strlen($number);
        if ($numberLength != 11) {
            return false;
        }
        // Fourth Rule
        $singleDigits = 0;
        for ($i = 0; $i < $numberLength - 1; $i += 2) {
            $singleDigits += intval($numberArray[$i]);
        }
        $doubleDigits = 0;
        for ($i = 1; $i < $numberLength - 2; $i += 2) {
            $doubleDigits += intval($numberArray[$i]);
        }
        $tenthDigit = intval($numberArray[9]);
        $modDigit = (($singleDigits * 7) - $doubleDigits) % 10;
        if ($modDigit != $tenthDigit) {
            return false;
        }
        // Fifth Rule
        $eleventhDigit = intval($numberArray[10]);
        $modDigit = ($singleDigits + $doubleDigits + $tenthDigit) % 10;
        if ($modDigit != $eleventhDigit) {
            return false;
        }
        return true;
    }
}