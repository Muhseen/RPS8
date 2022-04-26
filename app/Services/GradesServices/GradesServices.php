<?php

namespace App\Services\GradesServices;

class GradesServices
{

    public static function usableGrades()
    {
        return   array('A', 'AB', 'B', 'BC', 'C', 'CD', 'D', 'DE', 'E',  'F', 'AW', 'IS', 'PI', 'PC', 'NA');
    }
    public static function failedGrades()
    {
        return   array('F', 'AW', 'IS', 'PI', 'PC', 'NA');
    }

    public static function computeGrade($score)
    {

        switch ($score) {
            case $score >= 75 && $score <= 100:
                return 'A';
                break;
            case $score >= 70 && $score <= 74:
                return 'AB';
                break;
            case $score >= 65 && $score <= 69:
                return 'B';
                break;
            case $score >= 60 && $score <= 64:
                return 'BC';
            case $score >= 55 && $score <= 59:
                return 'C';
            case $score >= 50 && $score <= 54:
                return 'CD';
            case $score >= 45 && $score <= 49:
                return 'D';
            case $score >= 40 && $score <= 44:
                return 'E';
            case $score >= 0 && $score <= 39:
                return 'F';
            case $score == -100:
                return "AE";

            case $score == -150:
                return "PC";
            case $score == -200:
                return "AW";
            case $score == -250:
                return "NA";
            case $score == -300:
                return "EX";
            case $score == -400:
                return "EM";
            case $score == -500:
                return "NR";
            case $score == -600:
                return "SK";
            case $score == -700:
                return "CP";
            case $score == -800:
                return "PI";
            case $score == -900:
                return "IS";
            case $score == -950:
                return "NN";
            case $score == -970:
                return "DE";
        }
    }
    public static function computePoints($score)
    {

        switch ($score) {
            case $score >= 75 && $score <= 100:
                return 4.0;
                break;
            case $score >= 70 && $score <= 74:
                return 3.50;
                break;
            case $score >= 65 && $score <= 69:
                return 3.25;
                break;
            case $score >= 60 && $score <= 64:
                return 3.0;
            case $score >= 55 && $score <= 59:
                return 2.75;
            case $score >= 50 && $score <= 54:
                return 2.50;
            case $score >= 45 && $score <= 49:
                return 2.25;
            case $score >= 40 && $score <= 44:
                return 2.0;
            case $score >= 0 && $score <= 39:
                return 0.0;
            case $score < 0:
                return 0.0;
        }
    }
}