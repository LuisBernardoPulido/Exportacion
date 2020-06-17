<?php
/**
 * Created by Bernardo.
 * User: Luis Bernardo Pulido Gaytan
 * Date: 13/02/2017
 * Time: 03:04 PM
 */

namespace app\models;
use Faker\Provider\DateTime;
use yii\base\Model;
use Yii;
use yii\db\Expression;


class Utileria
{
    public static function generarUrlReporte($reporte, $formato, $parametros=[]){
        $url = 'http://'.Yii::$app->params['birt'].'/mpcs/frameset?__report='.$reporte.'.rptdesign&__format='.$formato;

        for($i=0; $i<count($parametros); $i++){
            $url.= '&'.$parametros[$i][0].'='.strval($parametros[$i][1]);
        }
        return $url;
    }
    public static function convertirFecha($fecha){ //Return 00/00/0000
        $hoy=explode('-',$fecha);
        return $hoy[2].'/'.$hoy[1].'/'.$hoy[0];
    }
    public static function invertirFecha($fecha){ //Return 0000-00-00
        $hoy=explode('/',$fecha);
        return $hoy[2].'-'.$hoy[1].'-'.$hoy[0];
    }
    public static function convertirFechaHora($fecha){ //Return 00/00/0000 00:00
        $parte=explode(" ", $fecha);
        $hoy=explode('-',$parte[0]);
        $hora=explode(':',$parte[1]);
        return $hoy[2].'/'.$hoy[1].'/'.$hoy[0]." ".$hora[0].":".$hora[1];
    }
    public static function invertirFechaHora($fecha){ //Return 0000-00-00 00:00
        $parte=explode(" ", $fecha);
        $hoy=explode('/',$parte[0]);
        return $hoy[2].'-'.$hoy[1].'-'.$hoy[0]." ".$parte[1];
    }

    public static function horaFechaActual(){
        $expression = new Expression('NOW()');
        $now = (new \yii\db\Query)->select($expression)->scalar();  // SELECT NOW();
        return $now;
    }
    public static function encrypt($cadena){
        $res=md5($cadena);
        return $res;
    }

    public static function getEdadAnimal($fechaNacimiento){
        $edad = Yii::$app->db->createCommand('SELECT TIMESTAMPDIFF(month, '.$fechaNacimiento.','.Utileria::getFechaActualOnly().') as diff',[])->queryAll();
        return  $edad[0]['diff'];
    }
    public static function getFechaActualOnly(){
        $fecha = Yii::$app->db->createCommand('SELECT CURDATE() AS fecha',[])->queryAll();
        return $fecha[0]['fecha'];
    }

    public static function getFechaNacimiento($meses){
        $fecha = Yii::$app->db->createCommand('SELECT (DATE_ADD(CURDATE(),INTERVAL -'.$meses.' MONTH)) AS fecha',[])->queryAll();
        return $fecha[0]['fecha'];
    }
    public static function getFechaNacimientoNueva($meses, $delimitador){
        $fecha = Yii::$app->db->createCommand('SELECT (DATE_ADD("'.$delimitador.'",INTERVAL -'.$meses.' MONTH)) AS fecha',[])->queryAll();
        return $fecha[0]['fecha'];
    }
    public static function getCelda($columna, $fila){
        $letra = self::getNumColumna($columna);
        return $letra.$fila;
    }
    public static function getNumColumna($columna){
        switch($columna){
            case 1: $res='A'; break;
            case 2: $res='B'; break;
            case 3: $res='C'; break;
            case 4: $res='D'; break;
            case 5: $res='E'; break;
            case 6: $res='F'; break;
            case 7: $res='G'; break;
            case 8: $res='H'; break;
            case 9: $res='I'; break;
            case 10: $res='J'; break;
            case 11: $res='K'; break;
            case 12: $res='L'; break;
            case 13: $res='M'; break;
            case 14: $res='N'; break;
            case 15: $res='O'; break;
            case 16: $res='P'; break;
            case 17: $res='Q'; break;
            case 18: $res='R'; break;
            case 19: $res='S'; break;
            case 20: $res='T'; break;
            case 21: $res='U'; break;
            case 22: $res='V'; break;
            case 23: $res='W'; break;
            case 24: $res='X'; break;
            case 25: $res='Y'; break;
            case 26: $res='Z'; break;
            case 27: $res='AA'; break;
            case 28: $res='AB'; break;
            case 29: $res='AC'; break;
            case 30: $res='AD'; break;
            case 31: $res='AE'; break;
            case 32: $res='AF'; break;
            case 33: $res='AG'; break;
            case 34: $res='AH'; break;
            case 35: $res='AI'; break;
            case 36: $res='AJ'; break;
            case 37: $res='AK'; break;
            case 38: $res='AL'; break;
            case 39: $res='AM'; break;
            case 40: $res='AN'; break;
            case 41: $res='AO'; break;
            case 42: $res='AP'; break;
            case 43: $res='AQ'; break;
            case 44: $res='AR'; break;
            case 45: $res='AS'; break;
            case 46: $res='AT'; break;
            case 47: $res='AU'; break;
            case 48: $res='AV'; break;
            case 49: $res='AW'; break;
            case 50: $res='AX'; break;
            default: $res="NO FOUND";
        }
        return $res;
    }
    public static function UsuariosKey($str = '', $long = 0) {
        $stop=false;
        $key=null;
        while($stop!=true){
            $key = null;
            $str = str_split($str);
            $start = 0;
            $limit = count($str) - 1;
            for ($x = 0; $x < $long; $x++) {
                $key .= $str[rand($start, $limit)];
            }
            if(!Users::find()->where('username=:user', [':user'=>$key])->one() && $key!=null){

                $stop=true;
            }
        }
        return $key;


    }
    public static function PassKey($str = '', $long = 0) {

            $key = null;
            $str = str_split($str);
            $start = 0;
            $limit = count($str) - 1;
            for ($x = 0; $x < $long; $x++) {
                $key .= $str[rand($start, $limit)];
            }


        return $key;


    }

}