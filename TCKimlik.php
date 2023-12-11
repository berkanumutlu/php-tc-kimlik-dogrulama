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
    private $no;
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
     * @var string|null
     */
    private $birthDate;
    /*
     * Year of Birth (e.g. 1997)
     * @var string|int|null
     */
    private $birthYear;
    /*
     * Month of Birth (e.g. 2)
     * @var string|int|null
     */
    private $birthMonth;
    /*
     * Day of Birth (e.g. 1)
     * @var string|int|null
     */
    private $birthDay;
    /*
     * Gender (e.g. 'E' or 'K' / 'M' or 'F')
     * @var string|null
     */
    private $gender;
    /*
     * Nationality (e.g. 'T.C.' / 'TUR')
     * @var string|null
     */
    private $nationality;
    /*
     * Document No (e.g. A0123456)
     * @var string|null
     */
    private $documentNo;
}