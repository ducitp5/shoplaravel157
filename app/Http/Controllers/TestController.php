<?php


namespace App\Http\Controllers;


use App\Lang;
use App\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use App\PostLang;
use App\Post2;
use App\Lpl2;

use app\DucClass\PHPMailer\PHPMailer;
use app\DucClass\mySql\myModel;




class TestController extends Controller
{
   
    public function export_excel2(){
        
//        echo     view('test.excel.export2.export');
 
        
        
        
?>

	hehe chao
	
    <script type="text/javascript">

    	alert('keke 2');
    	console.log('sin chao');	
    </script>

<?php 
         
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
                header('Content-Disposition: attachment ; filename=download2.xls');
                
                echo $output;
            }
        }
        
    
    }
    
    public function export_excel_view2(){
        
        echo     view('test.excel.export2.index');
    }
    
    
    
    public function export_excel(){
        
        return     view('test.excel.export.export');
    }
    
    public function export_excel_view(){
        
        echo     view('test.excel.export.index');
    }
    
    
    public function send_mail(Request $request){
        
        echo '<script> console.log("page 24 - '.__DIR__ .'" ) </script>';
        
        echo '<script> console.log("page 26 - '.app_path() .'" ) </script>';
        
        //include(app_path() .'\DucClass\PHPMailer\PHPMailer.php  ');
        //include(app_path() .'\DucClass\PHPMailer\SMTP.php       ');
   
        $mail               =    new PHPMailer(true);
        
        
        $mail->isSMTP();
        
        $mail->Host         =    'smtp.gmail.com';
        $mail->SMTPAuth     =    true;
        $mail->Username     =    'ducitp5@gmail.com';        // YOUR gmail email
        $mail->Password     =    'rkgslzyzkxmgzymd';         // APP gmail password
        $mail->Port         =    465;                        // 465
        $mail->SMTPSecure   =    'ssl';                      // ssl
        
        
        $data               =    $request->all();
        
        
        if(isset($_POST["sender"]))
            
            $sender         =   $_POST["sender"];
            
        else       
            
            $sender         =   "vo danh";
       
        $name               =    $_POST["userName"];
        $email              =    $_POST["userEmail"];
        $subject            =    $_POST["subject"];
        $content            =    $_POST["content"];
        
        
        // Setting the email content
        
        $mail   ->IsHTML(true);
        
        $mail   ->setFrom('toiladuc@gmail.com', $sender);          // FROM personalize company
        
        $mail   ->addAddress( $email   ,    $name);                    // sent to
        
        $mail   ->Subject       =    $subject;
        
        $mail   ->Body          =    $content;
        
        
//        session_start();          // already added in index.php
        
        if($mail->send()){
            
            $_SESSION["message"]    =   "send reussit";
            
            echo '<script> console.log("send is reussit") </script>';
        }
        else {
            
            $_SESSION["message"]    =   "cant not send";
            
            $response  =   "saome thing wrong " .$mail->ErrorInfo;
            
            echo '<script> console.log("erreur - '.$mail->ErrorInfo.'") </script>';
        }
        
        return Redirect::to('/test/send-mail-view');

    
    }
    
    public function send_mail_view(){
        
        echo     view('test.mail.contact-view');
    }
    
    public function timestamp(){
        
        date_default_timezone_set("Asia/Bangkok");
        
        echo     date('H:i:s');
    }
    
    
    public function array_cart(){
        
        return              view('test.array.addarray');
    }
    
    
    public function list_post(){
        
        return              view('test.post.list_post');
    }
    
    public function list_post_2(){
        
        return              view('test.post.list_post_2');
    }
    
    
    public function list_post_3(){
        
        return              view('test.post.list_post_3');
    }
    
    
    public function list_post_4(){
        
        return              view('test.post.list_post_4');
    }
   
    
    public function list_post_5(){
        
        return              view('test.post.list_post_5');
    }
   
    public function list_post_6(){
        
        return              view('test.post.list_post_6');
    }
    
    public function list_post_7(){
        
        return              view('test.post.list_post_7');
    }
    
    
    
    public function post_assign_lang(Request $request){       
     
                     
        Lpl2::where('post_id'    ,   $request->post_id)    ->delete();               //      clear and refresh
        
//        dd($request);
        
        if($request->english_lang){
            
// /            dd($request->english_lang);
            
            $getlang            =   new Lpl2();
            
            $getlang->post_id   =   $request->post_id;
            $getlang->lang_id   =   1;
            
            $getlang->save();
        }
        
        if($request->french_lang){
            
            $getlang            =   new Lpl2();
            
            $getlang->post_id   =   $request->post_id;
            $getlang->lang_id   =   2;
            
            $getlang->save();
        }
        
        if($request->viet_lang){
            
            $getlang            =   new Lpl2();
            
            $getlang->post_id   =   $request->post_id;
            $getlang->lang_id   =   3;
            
            $getlang->save();
        }
         
        
        return      redirect()  ->back()    ->with('message'    ,   'add langage successful');
    }
    
    
   
    
    
    
    public function suggestion(){
        
        return              view('test.suggestion');
    }
      
    
    public function detail_products(){
        
        return              view('test.details_products');
    }
    public function detail_products_1(){
        
        return              view('test.details_products_1');
    }
    public function detail_products_2(){
        
        return              view('test.details_products_2');
    }
    
    
    public function header(){
        
        return              view('test.include.header');
    }
    
    public function leftside(){
        
        return              view('test.include.leftside');
    }
    
    public function slider(){
        
        return              view('test.include.slider');
    }

    
    public function video(){
           
        return              view('test.videoModal');
    }
    
    public function watch_video(Request $request){
        
        
        $video_id                   =    $request   ->video_id;
        
        $video                      =    Video::find($video_id);
        
        $output['video_title']      =    $video     ->video_title;
        $output['video_desc']       =    $video     ->video_desc;
        
/*         $output['video_link']       =    '<iframe   width="100%"    height="500" 

                                                    src="https://www.youtube.com/embed/'.$video->video_link.'?rel=0&modestbranding=1&autohide=1&showinfo=0&controls=0" 
                                                    frameborder="0"     allowfullscreen"    frameborder="0"     allowfullscreen>
                
                                          </iframe>';
    */     
        $output['video_link']       =   '<video  id                   ="my_yt_video"
					                             class                ="vlite-js"
					                             data-youtube-id      ="'.$video->video_link.'">
					                     </video>';
        
        
        echo json_encode($output);
        
    }
    
    
    
    public function session_cart(){
        
        return              view('test.session_cart');
    }
    
    public function refresh_cart(){
        
        Session::flush();
        
        Session::put('message'      ,   'delete all session');
        
        return redirect()->back();
//        return              URL::to('test/session_cart');
    }
    
    public function session_cart_2(){
        
        return              view('test.session_cart_2');
    }

    
    public function adminheader(){
        
        return              view('test.admin.include.header');
    }
    
    
    public function adminaside(){
        
        return              view('test.admin.include.aside');
    }
    
    
    public function add_category_product(){
        
        return              view('test.admin.add_category_product');
    }
    
    
    public function all_category_product(){
        
        return              view('test.admin.all_category_product');
    }
    
    
    public function information(){
        
        return              view('test.admin.information');
    }
    
    
    public function add_post(){
        
        return              view('test.admin.add_post');
    }
    
    
    public function post2_lpl2(){
        
        return              view('test.mysql.post2_lpl2');        
    }
    
    public function lpl2_post2(){
        
        return              view('test.mysql.lpl2_post2');
    }
    
    public function lpl2_lang2(){
        
        return              view('test.mysql.lpl2_lang2');
    }
        
    public function lang2_lpl2(){
        
        return              view('test.mysql.lang2_lpl2');
    }
    
    public function post2(){
        
        return              view('test.mysql.post2');
    }
        
}
