<?php

    // export.php

    $connect = mysqli_connect("localhost", "root", "", "company");
    
    $output = '';
    
    if (isset($_POST["export"])) {
        
        $query      =    "SELECT * FROM items";
        
        $result     =    mysqli_query($connect , $query);
        
        if (mysqli_num_rows($result) > 0) {
        
            $output .= '
       
                <table class="table" bordered="1">  
                    <tr>  
                        <th>ID</th>  
                        <th>Name</th>  
                        <th>Type</th>  
                        <th>Brand</th>
                        <th>Price</th>
                    </tr>
            ';
            
            while ($row = mysqli_fetch_array($result)) {
                
                $output .= '
        
                    <tr>  
                        <td>' . $row["id"] . '</td>  
                        <td>' . $row["name"] . '</td>  
                        <td>' . $row["type"] . '</td>  
                        <td>' . $row["brand"] . '</td>  
                        <td>' . $row["price"] . '</td>
                    </tr>
                ';
            }
            
            $output .= '</table>';
            
            header('Content-Type: application/xls');
            header('Content-Disposition: attachment ; filename=download1.xls');
            
            echo $output;
        }
    }
