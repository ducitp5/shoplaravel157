<?php


function echo_pre( $data ) {
    
    $output     =    "<pre> ";
    
    $output     .=   $data;
    
    $output     .=   "</pre>";
    
    echo        $output;
}


function echo_preprintr( $data ) {
    
    echo     "<pre> ";
    
    print_r($data);
    
    echo     "</pre>";
}

function echo_prepvardump( $data ) {
    
    echo     "<pre> ";
    
    var_dump($data);
    
    echo     "</pre>";
}


function consolelog_session() {
    
    consolelog_json2('laravel session' , session()->all());
//    consolelog_json2('laravel session' , $_SESSION);
}


function consolelog_json( $data ) {
    
    $output     =    "<script>console.log('csl1 - ' , ";
    
    $output     .=   json_encode($data);
    
    $output     .=   ");</script>";
    
    echo        $output;
}

function consolelog_json2( $title , $data ) {
    
    $output     =    "<script>console.log('" .$title."'  , ";
    
    $output     .=   json_encode($data);
    
    $output     .=   ");</script>";
    
    echo        $output;
}


function consolelogpretty( $data ) {
    
    $output     =    "<script>console.log('csl11 - ' , JSON.stringify(";
    
    $output     .=   $data;       // json_encode($data);
    
    $output     .=   ", null , 4 ));</script>";
    
    echo        $output;
}


function consolelogpretty2($title ,  $data ) {
    
    $output     =    "<script>console.log('" .$title. "' , JSON.stringify(";
    
    $output     .=    json_encode($data);
    
    $output     .=   ", null , 4 ));</script>";
    
    echo        $output;
}



function consolelog3( $data ) {
    
    $output     =    "<script>console.log('csl33 - ";
    
    $output     .=   json_encode(print_r($data  ,  true));
    
    $output     .=   "');</script>";
    
    echo        $output;
}




function consolelog33( $title , $data ) {
    
    $output     =    "<script>console.log('" .$title. "' , ";
    
    $output     .=   json_encode(print_r($data , true ));
    
    $output     .=   ");</script>";
    
    echo        $output;
}





function consolelog2($title , $data ) {
    
    $output     =    "<html><script>console.log('" .$title."' , '" 
        
                        .$data  ;
    
    $output     .=   "')</script> </html>";
    
    echo        $output;
}



function consolelog( $data ) {
    
    $output     =    "<script>console.log( '";
    
    $output     .=   $data;
    
    $output     .=   "' );</script>";
    
    echo        $output;
}


function consoletype( $data ) {
    
    $output     =
    
        "<script>
        
            var tab = '" .$data."' ;
                
            console.log(typeof tab);
                
         </script>";
    
    
    echo        $output;
}


function consoletype2( $title , $data ) {
    
    $output     =
    
    "<script>
            var title = '" .$title."' ;

            var tab = " .$data." ;
                
            console.log(title , typeof tab);
                
         </script>";
    
    
    echo        $output;
}

function consolevar( $data ) {
    
    $output     =
    
        "<script>
        
            var tab = ".$data." ;
                
            console.log( tab);
                
         </script>";
    
    
    echo        $output;
}


function consolevar2($title , $data ) {
    
    $output     =
    
        "<script>
            var title = '".$title."' ;
    
            var tab = ".$data." ;
                
            console.log(title , tab);
                
         </script>";
    
    
    echo        $output;
}


function consolelog_parse2( $title , $data ) {
    
    $output     =
    
        "<script>
            var title = '".$title."' ;
                
            var tab   =  ".json_encode($data)." ;
                
            console.log(title , tab);
                
         </script>";
    
    
    echo        $output;
}


function consoletable( $data ) {
    
    $output     =    
    
        "<script>

            var tab = ".$data." ;

            console.table( tab);
    
         </script>";
    
    
    echo        $output;
}



function alert( $data ) {
    
    $output     =
    
        "<script>
                            
            alert('" .$data. "');
                
         </script>";
        
        
    echo        $output;
}
