<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ReportUtil
 *
 * @author manny
 */
class ReportUtil {
    //put your code here
    public static function dateTimeForFileName(){
        return date("Ymdhis");
    }
    public static function buildFileName($reportId, $fileExt){
        return $reportId .'_' . self::dateTimeForFileName() . '.' . $fileExt;
    }
    
}
