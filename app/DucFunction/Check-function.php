<?php

function Hasrole($needle, $yourRoles){
       
    if($yourRoles){
        
        if( !is_array($needle)){
            
            if( in_array($needle, $yourRoles))          return      true;
        }
        else{
            
            foreach($needle as $item){
                
                if( in_array($item , $yourRoles))       return      true;
            }
        }
        
        return  false;
    }
    
}