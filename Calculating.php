<?php
////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////Brackets/////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
/*----------------------------------Result:-----------------------------------*/
/*----------------------------------------------------------------------------*/  
/*------------------------------arr(status, msg)------------------------------*/
/*----------------------------------------------------------------------------*/  

/*------Входные данные------*/
$str = '(}a b [c d] () t y o){';

function Brackets($str){
    
    $count = strlen($str);
    $brackets = [];
    
    ////////////////////////////////////////////////
    /*---Создаем массив для удобной работы с ним---*/
        for($i=0;$i<$count;$i++){
            switch($str[$i]){
                
                case'(':
                    array_push($brackets,0);
                break;
                
                case')':
                    array_push($brackets,1);
                break;
                
                case'[':
                    array_push($brackets,3);
                break;
                
                case']':
                    array_push($brackets,4);
                break;
                
                case'{':
                    array_push($brackets,6);
                break;
                
                case'}':
                    array_push($brackets,7);
                break;
            }
        }
    /*--------------------------------------------*/  
    ////////////////////////////////////////////////
       
       
       
    ////////////////////////////////////////////////
    /*-----Обрабатываем созданый ранее массив-----*/
    while(1){
        $flag = false;
        $count = count($brackets);
        
        for($i=0;$i<$count;$i++){
            if($brackets[$i]-1 == $brackets[$i-1]){
                array_splice($brackets, $i-1,2); 
                $flag = true;
            }
        }
        
        if(!$flag){
            return $return = ['status' => 'error', 'msg' => 'Скобки раставлены не верно!'];
        }elseif($brackets == null){
            return $return = ['status' => 'ok', 'msg' => 'Все скобки раставлены верно!'];
        }
    }
    /*---------------------------------------------*/
    ////////////////////////////////////////////////
}

/*------Вывод------*/
print_r(Brackets($str)['msg']);





////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////Calculating///////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
/*----------------------------------Result:-----------------------------------*/
/*----------------------------------------------------------------------------*/  
/*--------------------------------str(result)---------------------------------*/
/*----------------------------------------------------------------------------*/  

/*------Входные данные------*/
$str = '2+2+2-1';

function Calculating ($str){
$num_s = [];
$sign_s = [];
    
    $count  = strlen($str);
    /////////////////////////////////////////////
    /*--------------Создаем стеки--------------*/
    for($i=0;$i<$count;$i++){
        if(is_numeric($str[$i])) $num .= $str[$i];
        else{
           array_push($num_s,$num);
           array_push($sign_s,"{$str[$i]}");
           $num = '';
        }
    } if($num != null) array_push($num_s,$num);
    /*-----------------------------------------*/
    /////////////////////////////////////////////
    
    
    
    $count = count($num_s);
    ////////////////////////////////////////////////////////
    /*------------------------Вычисляем-------------------*/
    for($i=0;$i<=$count;$i++){
        $sign = array_shift($sign_s);
        $num1 = array_shift($num_s);
        $num2 = array_shift($num_s);
        
        if($sign == '-') array_unshift($num_s,$num1 - $num2);
        else array_unshift($num_s,$num1 + $num2);
    }
    /*----------------------------------------------------*/
    ////////////////////////////////////////////////////////
    
return $num_s[0];
}

/*------Вывод------*/
print_r(Calculating ($str));


/*-----------------------------------ВНИМАНИЕ!--------------------------------*/ 
/*-----------------------------------ВНИМАНИЕ!--------------------------------*/ 
/*-----------------------------------ВНИМАНИЕ!--------------------------------*/ 
/*-----------------Метод показанный ниже работает не на 100%,-----------------*/ 
/*------------но он мне сильно понравился и я решил его оставить!-------------*/
/*------Вот его визуализция:   https://www.youtube.com/watch?v=n2bs5Bdgi4k----*/
/*-----------------------------------ВНИМАНИЕ!--------------------------------*/ 
/*-----------------------------------ВНИМАНИЕ!--------------------------------*/ 
/*-----------------------------------ВНИМАНИЕ!--------------------------------*/ 


////////////////////////////////////////////////////////////////////////////////
////////////////////A beautiful solution, but with a drawback///////////////////
////////////////////////////////////////////////////////////////////////////////
/*----------------------------------Result:-----------------------------------*/
/*----------------------------------------------------------------------------*/  
/*----------------------------------str(msg)----------------------------------*/
/*----------------------------------------------------------------------------*/  

/*--------------------------------Post sсriptum-------------------------------*/
/*----Этот метод очень лаконичтный и красивый (на мой взгляд), но он имеет----*/ 
/*-----------------------------подводный камень.------------------------------*/ 

/*------Входные данные------*/
$str = '(a b {[}c d] () t y o)';

$st1 = [];
$st2 = [];
$st3 = [];

function Brackets_fake($str){
global $st1,$st2,$st3;

    $count = strlen($str);
    
    for($i=0;$i<$count;$i++){
        switch($str[$i]){
            
            case'(':
            case'[':    
            case'{':
                Brackets_put($str[$i]);    
            break;
            
            case')':
                Brackets_del('(');
            break;
            
            case']':
                Brackets_del('[');
            break;
            
            case'}':
                Brackets_del('{');
            break;
        }
    }
    
    if(count($st1) == 0 and count($st2) == 0 and count($st3) == 0)
        $return = 'Все скобки раставлены верно!';
    else
        $return = 'Скобки раставлены не верно!';
        
return $return;
}



function Brackets_put($bracket){
global $st1,$st2,$st3;
    
    $st1_bracket = $st1['0'];
    $st2_bracket = $st2['0'];
    $st3_bracket = $st3['0'];
    
    if($st1_bracket == null or $st1_bracket == $bracket)
        array_unshift($st1,$bracket);
    elseif($st2_bracket == null or $st2_bracket == $bracket)
        array_unshift($st2,$bracket);
    elseif($st3_bracket == null or $st3_bracket == $bracket)
        array_unshift($st3,$bracket);
}



function Brackets_del($bracket){
global $st1,$st2,$st3;
    
    $st1_bracket = $st1['0'];
    $st2_bracket = $st2['0'];
    $st3_bracket = $st3['0'];
    
    $st1_count = count($st1);
    $st2_count = count($st2);
    $st3_count = count($st3);

    if($st1_bracket == $bracket and $st1_count > $st2_count and $st1_count > $st3_count)
        $gg = array_shift($st1);
    elseif($st2_bracket == $bracket and $st2_count > $st3_count)
        $gg = array_shift($st2);
    elseif($st3_bracket == $bracket)
        $gg = array_shift($st3);
    else exit('Ошибка в скобках!');
    
}



/*------Вывод------*/
print_r(Brackets_fake($str));


?>
