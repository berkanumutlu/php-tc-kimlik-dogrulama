<?php
require 'config/config.php';
require 'config/functions.php';

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
    /*
     * Verification Type. You can find list in config.php.
     * @var string|null
     */
    private $verifyType;

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
        $this->name = case_converter_turkish($name, 'uppercase');
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
        $this->surname = case_converter_turkish($surname, 'uppercase');
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
     * @return mixed
     */
    public function getVerifyType()
    {
        return $this->verifyType;
    }

    /**
     * @param  mixed  $verifyType
     */
    public function setVerifyType($verifyType)
    {
        $this->verifyType = $verifyType;
    }

    /**
     * @return bool
     */
    public function verify()
    {
        $verifyType = $this->getVerifyType();
        if (empty($verifyType) || !in_array($verifyType, VERIFY_TYPE_LIST)) {
            if (in_array(VERIFY_TYPE, VERIFY_TYPE_LIST)) {
                $this->setVerifyType(VERIFY_TYPE);
            } else {
                if (is_array(VERIFY_TYPE_LIST) && count(VERIFY_TYPE_LIST) > 0) {
                    $this->setVerifyType(current(VERIFY_TYPE_LIST));
                } else {
                    $this->setVerifyType(null);
                }
            }
            $verifyType = $this->getVerifyType();
        }
        switch ($verifyType) {
            case 'algorithm':
                return $this->verifyWithAlgorithm();
                break;
            case 'curl':
                return $this->verifyWithCURL();
                break;
        }
        return false;
    }

    /**
     * @return bool
     */
    public function verifyWithAlgorithm()
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

    /**
     * @return array
     */
    public function prepareCURL()
    {
        $response = [];
        $response['url'] = VERIFY_TYPE_CURL['URL'];
        $requestType = VERIFY_TYPE_CURL['REQUEST']['TYPE'];
        $response['header'] = VERIFY_TYPE_CURL['REQUEST']['HEADER'][$requestType];
        $number = $this->getNumber();
        $name = $this->getName();
        $surname = $this->getSurname();
        $birthYear = $this->getBirthYear();
        switch ($requestType) {
            case 'SOAP11':
                $response['data'] = '<?xml version="1.0" encoding="utf-8"?>
            <soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
                <soap:Body>
                    <TCKimlikNoDogrula xmlns="http://tckimlik.nvi.gov.tr/WS">
                        <TCKimlikNo>'.$number.'</TCKimlikNo>
                        <Ad>'.$name.'</Ad>
                        <Soyad>'.$surname.'</Soyad>
                        <DogumYili>'.$birthYear.'</DogumYili>
                    </TCKimlikNoDogrula>
                </soap:Body>
            </soap:Envelope>';
                break;
            case 'SOAP12':
                $response['data'] = '<?xml version="1.0" encoding="utf-8"?>
                <soap12:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap12="http://www.w3.org/2003/05/soap-envelope">
                  <soap12:Body>
                    <TCKimlikNoDogrula xmlns="http://tckimlik.nvi.gov.tr/WS">
                      <TCKimlikNo>'.$number.'</TCKimlikNo>
                      <Ad>'.$name.'</Ad>
                      <Soyad>'.$surname.'</Soyad>
                      <DogumYili>'.$birthYear.'</DogumYili>
                    </TCKimlikNoDogrula>
                  </soap12:Body>
                </soap12:Envelope>';
                break;
        }
        array_push($response['header'], 'Content-Length: '.strlen($response['data']));
        return $response;
    }

    /**
     * @return bool
     */
    public function verifyWithCURL()
    {
        $opts = $this->prepareCURL();
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $opts['url']);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $opts['data']);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $opts['header']);
        $response = curl_exec($ch);
        curl_close($ch);
        $TCKimlikNoDogrulaResult = strip_tags($response) == 'true' ? true : false;
        return $TCKimlikNoDogrulaResult;
    }
}