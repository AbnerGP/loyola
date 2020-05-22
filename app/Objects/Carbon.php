<?php
/**
 * Created by PhpStorm.
 * User: DrekTop
 * Date: 06/04/2018
 * Time: 10:36 AM
 */

namespace App\Objects;

use DateTimeZone;
use Carbon\Carbon as CarbonBase;

class Carbon extends CarbonBase
{

    public function __construct($date, $tz = null)
    {
        if(str_contains($date, "/")) {
            $date = str_replace("/", "-", $date);
        }

        parent::__construct($date, $tz);
    }

    static public function createFromCustom($time = null, $tz = null) {
        $time = str_replace("/", "-", $time);
        $time = strtotime($time);
        return new self($time, $tz);
    }


    protected static $days = array(
        self::SUNDAY => 'Domingo',
        self::MONDAY => 'Lunes',
        self::TUESDAY => 'Martes',
        self::WEDNESDAY => 'Miercoles',
        self::THURSDAY => 'Jueves',
        self::FRIDAY => 'Viernes',
        self::SATURDAY => 'Sabado',
    );

    protected static $months = [
        '',
        'Enero',
        'Febrero',
        'Marzo',
        'Abril',
        'Mayo',
        'Junio',
        'Julio',
        'Agosto',
        'Septiembre',
        'Octubre',
        'Noviembre',
        'Diciembre'
    ];

    protected static function translator()
    {
        if (static::$translator === null) {
            static::$translator = new Translator('es');
            static::$translator->addLoader('array', new ArrayLoader());
            static::setLocale('es');
        }

        return static::$translator;
    }

    protected function DayStr() {
        return static::$days[$this->format('w')];
    }

    protected function MonthStr() {
        return static::$months[$this->format('n')];
    }

    public function toSpanish() {
        return static::$days[$this->format('w')].' '.$this->format('d').' de '.static::$months[$this->format('n')]. ' del '.$this->format("Y");
    }

    public function toSpanishYearly() {
        return static::$days[$this->format('w')].' '.$this->format('d').' de '.static::$months[$this->format('n')];
    }

    public function toSpanishWithHours() {
        return $this->toSpanish().' a las '. $this->format("h:i a");
    }


    public function getDayandMonth() {
        return $this->format("j").' de '.$this->MonthStr();
    }



    public function DayandHour() {
        return $this->DayStr().' a las '. $this->format("h:i a");
    }

    public function getMomentforHumans() {


        if($this->format("d-m-y") == self::now()->format("d-m-y")) {

            if($this->diffInMinutes(self::now()) < 180) {
                return "moment";
            }

            return "Hoy";
        }

        if($this->format("d-m-y") == self::now()->subDay(1)->format("d-m-y")) {
            return "Ayer";
        }

        if($this->format("d-m-y") == self::now()->subDay(2)->format("d-m-y")) {
            return "Antier";
        }

        if($this->timestamp < self::now()->timestamp) {

            if($this->diffInDays(self::now()) < 6) {
                return $this->DayStr();
            }

            if($this->format('y') != self::now()->format('y')) {
                return $this->getDayandMonth().' del '.$this->format('Y');
            }


            return $this->getDayandMonth();
        }

        if($this->format("d-m-y") == self::now()->addDays(1)->format('d-m-y')) {
            return "Mañana";
        }

        return $this->format('Y');

    }

    public function getMoment() {
        $moment = $this->getMomentforHumans();
        if($moment == "moment") {
            return $this->diffForHumans();
        }
        return $this->getMomentforHumans()." ".$this->format("H:i");
    }


}