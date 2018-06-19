<?php
    date_default_timezone_set('America/Tegucigalpa');

    function dayToDia($day){
        switch ($day) {
            case 'Sunday':
                return 'Domingo';
                break;
            case 'Monday':
                return 'Lunes';
                break;
            case 'Tuesday':
                return 'Martes';
                break;
            case 'Wednesday':
                return 'Miercoles';
                break;
            case 'Thursday':
                return 'Jueves';
                break;
            case 'Friday':
                return 'Viernes';
                break;
            case 'Saturday':
                return 'Sabado';
                break;
        }
    }

    function monthToMes($mes){
        switch ($mes) {
            case 'January':
                return 'Enero';
                break;
            case 'February':
                return 'Febrero';
                break;
            case 'March':
                return 'Marzo';
                break;
            case 'April':
                return 'Abril';
                break;
            case 'May':
                return 'Mayo';
                break;
            case 'June':
                return 'Junio';
                break;
            case 'July':
                return 'Julio';
                break;
            case 'August':
                return 'Agosto';
                break;
            case 'September':
                return 'Septiembre';
                break;
            case 'October':
                return 'Octubre';
                break;
            case 'November':
                return 'Noviembre';
                break;
            case 'December':
                return 'Diciembre';
                break;
        }
    }

    function fechaIngAEsp($fecha){
        $fecha = explode('-', $fecha);
        return $fecha[2] . "/" . $fecha[1] . "/" . $fecha[0];
    }

    function fechaFormato($fecha){
        $fecha = explode('/', $fecha);
        $diaMes = mktime(0,0,0,$fecha[1],$fecha[0],$fecha[2]);
        $diaFormat = date("j", $diaMes) . " / " . monthToMes(date("F", $diaMes)) . " / " . date("Y", $diaMes) ;
        return $diaFormat;
    }

    function fechaFullFormato($fecha){
        $fecha = explode('/', $fecha);
        $diaMes = mktime(0,0,0,$fecha[1],$fecha[0],$fecha[2]);
        $diaFullFormat = dayToDia(date("l", $diaMes)) . " " . date("j", $diaMes) . ", " . monthToMes(date("F", $diaMes)) . " de " . date("Y", $diaMes) ;
        return $diaFullFormat;
    }

?>