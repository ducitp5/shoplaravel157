<?php

namespace App\Imports;

use App\CategoryProductModel;
use Maatwebsite\Excel\Concerns\ToModel;



class ExcelImports implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    public function model(array $row)
    {
        if($row[5] == null){
            
            $row[5] = 0;
        }
        
        if($row[6] == null){
            
            $row[6] = 0;            
        }
        
        if($row[7] == null){
            
            $row[7] = 0;
        }
        
        return new CategoryProductModel([
            
            'category_id'               =>   $row[0],
            'meta_keywords'             =>   $row[1],
            'category_name'             =>   $row[2],
            'slug_category_product'     =>   $row[3],
            'category_desc'             =>   $row[4],
            'category_parent'           =>   $row[5],             
            'category_status'           =>   $row[6],
            'category_order'            =>   $row[7],
        ]);
    }
}
