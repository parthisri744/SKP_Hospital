<?php 
require_once('Model/Model.php');
class Form {
 
    public static function input_text($label,$parameter,$required="yes",$value=NULL){
        $html ='<label class="form-label">Enter '.$label.'</label>
        <input type="text" name="'.$parameter.'" placeholder="'.$label.'" id="'.$parameter.'" value="'.$value.'" class="form-control '.$parameter.'" autocomplete="off" ';
        $html.= $required=="yes" ? 'required>' : '>';      
        $html .= '<span class="invalid-feedback">Please Enter '.$label.'</span>';
     return $html;
    }
    public static function input_readonly($label=NULL,$parameter,$value=NULL,$style=NULL){
      $html='<label class="form-label">'.$label.'</label>';
      $html .='<input type="text" name="'.$parameter.'"  id="'.$parameter.'" readonly  value="'.$value.'" style="'.$style.'" class="form-control '.$parameter.'">';
       return $html; 
   }
    public static function input_email($label,$parameter,$required="yes",$value=NULL){
        $html ='<label class="form-label">Enter '.$label.'</label>
        <input type="email" name="'.$parameter.'" placeholder="'.$label.'" id="'.$parameter.'" value="'.$value.'" class="form-control '.$parameter.'" autocomplete="off" ';
        $html.= $required=="yes" ? 'required>' : '>';
        $html .= '<span class="invalid-feedback">Please Enter '.$label.'</span>';
       return $html;
      }
      public static function input_password($label,$parameter,$required="yes",$value=NULL){
        $html ='<label class="form-label">Enter '.$label.'</label>
        <input type="password" name="'.$parameter.'" placeholder="'.$label.'" id="'.$parameter.'" value="'.$value.'" class="form-control '.$parameter.'" autocomplete="off" ';
        $html.= $required=="yes" ? 'required>' : '>';
        $html .= '<span class="invalid-feedback">Please Enter '.$label.'</span>';
       return $html;
      }
      public static function input_number($label,$parameter,$required="yes",$value=NULL){
        $html ='<label class="form-label">Enter '.$label.'</label>
        <input type="number" name="'.$parameter.'" placeholder="'.$label.'" id="'.$parameter.'"  value="'.$value.'" class="form-control '.$parameter.'" autocomplete="off" ';
        $html.= $required=="yes" ? 'required>' : '>';
        $html .= '<span class="invalid-feedback">Please Enter '.$label.'</span>';
       return $html;
      }       
      public static function input_datetime($label,$parameter,$required="yes",$value=NULL){
        $html ='<label class="form-label">Select '.$label.'</label>
        <input type="datetime-local" name="'.$parameter.'" placeholder="'.$label.'" id="'.$parameter.'"  value="'.$value.'" class="form-control '.$parameter.'" autocomplete="off" ';
        $html.= $required=="yes" ? 'required>' : '>';
        $html .= '<span class="invalid-feedback">Please Select '.$label.'</span>';
       return $html;
      } 
      public static function input_date($label,$parameter,$required="yes",$value=NULL){
        $html ='<label class="form-label">Select '.$label.'</label>
        <input type="date" name="'.$parameter.'" placeholder="'.$label.'" id="'.$parameter.'"  value="'.$value.'" class="form-control '.$parameter.'" autocomplete="off" ';
        $html.= $required=="yes" ? 'required>' : '>';
        $html .= '<span class="invalid-feedback">Please Select '.$label.'</span>';
       return $html;
      } 
      public static function input_hidden($parameter,$value=NULL){
        $html ='
        <input type="hidden" name="'.$parameter.'"  id="'.$parameter.'"  value="'.$value.'" class="'.$parameter.'" >';
       return $html;
      }
      public static function textarea($label,$parameter,$required="yes",$value=NULL){
        $html='<label class="form-label">Enter '.$label.'</label>
        <textarea name="'.$parameter.'" id="'.$parameter.'"  cols="10" class="form-control '.$parameter.'"  placeholder="Enter '.$label.'" style=" border: 2px solid #3399ff;" rows="3"';
        $html.= $required=="yes" ? ' required >' : '>';
        $html.=''.$value.'</textarea>';
        $html .= '<span class="invalid-feedback">Please Enter '.$label.'</span>';
       return $html;
      }
      public static function submit($value,$parameter="submit",$style=NULL){
          $html ='<input  type="submit" class="btn btn-success"  name="'.$parameter.'" style="'.$style.'"  id="'.$parameter.'" value="'.$value.'">';
          return $html; 
      }   
       public static function button($label,$parameter,$style=NULL){
        $html ='<button  class="btn btn-success"  name="'.$parameter.'" style="'.$style.'"  id="'.$parameter.'" >'.$label.'</button>';
        return $html; 
    }

      public static function reset($value,$style=NULL){
        $html ='<input  type="reset" class="btn btn-secondary" style="'.$style.'"   id="submit" value="'.$value.'">';
        return $html; 
    }
      public static function dashboard($label,$count,$link,$color=NULL){
       $html = '<div class="card-deck p-2">';
       $html.= '<div class="card" style="background-color:'.$color.';border:3px solid #ff0066;border-radius:10%">';
       $html.= '<div class="card-body text-center">';
       $html.='<p class="card-text text-uppercase"><h5><span style="color:green"><b><i>'.$label.'</i></b></span></h5></p>';
       $html.='<div class="count-up">';
       $html.='<h1 class="counter-count display-1" style="color:#ff751a"> '.$count.'</h1>';
       $html.= '<a href="'.$link.'" class="btn btn-outline-dark card-link">Process</a>';
       $html.='</div></div></div></div>  ';
       return $html;
      }
      public static function head($content,$color="#ff0066"){
       $html ='<div class="card-title p-3 text-center">';
       $html .='<h5><span style="color:'.$color.'"><b><i><u>'.$content.'</u></i></b></span></h5></div>';
       return $html;
      }
      public static function redirect($url){
        $html = "<script> window.location.href='index.php?action=$url';</script>";
        return $html;
      }
      public static function navigation($url,$label,$style=NULL){
          $html = '<a  href="index.php?action='.$url.'" style="'.$style.'" class="btn btn-danger">'.$label.'</a>';
          return $html;
      }
      public static function select($label,$parameter,$required="yes",$data){
        $datas = explode(',',$data);
        $html='<label class="form-label">Select '.$label.'</label>';
        $html .= "<select name='".$parameter."'  id='".$parameter."' style=' border: 2px solid #3399ff;' class='form-control'";
        $html.= $required=="yes" ? ' required >' : '>';
        $html.="<option value=''>Please Select</option>";
        foreach($datas as $value){
          $html.= "<option value='". $value ."'>".$value."</option>"."<br />";
        }
        $html.="</select>";
        $html .= '<span class="invalid-feedback">Please Select '.$label.'</span>';
        return $html;
      }
      public static function get_doctors($paramete,$required="yes"){
      $html='<label class="form-label">Select Doctor Name</label>';
      $html.='<select name="'.$paramete.'" id="'.$paramete.'"  class="form-control '.$paramete.' js-example-basic-single" ';
      $html.=  $required=="yes" ? ' required >' : '>';
      $html.='<option value = """">Please Select </option>';
      $html .=  Model::doctors();
      $html.='</select>
        <span class="invalid-feedback">Please Select Doctor Name</span>';
       return $html;
      }
      public static function options($label,$paramete,$required="yes",$option=Null){
        $html='<label class="form-label">Select '.$label.'</label>';
        $html.='<select name="'.$paramete.'" id="'.$paramete.'"  class="form-control '.$paramete.' js-example-basic-single" ';
        $html.=  $required=="yes" ? ' required >' : '>';
        $html.='<option value = """">Please Select</option>';
        $html .= $option;
        $html.='</select>
          <span class="invalid-feedback">Please Select Fees Name</span>';
         return $html;
        }
      public static function createModal($label,$class,$path,$id){
        echo   '<input type="submit" value="'.$label.'" class="'.$class.'" data-toggle="modal" data-target="#exampleModal'.$id.'">'; 
        echo '<div class="modal fade" id="exampleModal'.$id.'" tabindex="-1" role="dialog" aria-labelledby="examplemodellabel">';
            echo '<div class="modal-dialog modal-lg" role="document">';//
                echo '<div class="modal-content">';
                    echo '<div class="model-header">';
                       // echo '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
                    echo '</div>';
                        echo '<div class="modal-body">';
                         echo  '<div class="file-loading">';
                         echo '        <input type="file"  name="fileToUpload" class="form-control" id="fileToUpload">';
                          echo  '</div>';    
                          echo '<div id="file-errors"></div>';                       
                            echo '</div>';
                            echo '<div class="modal-footer">';
                                 echo '<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>';
                                 echo  '<button type="button" class="btn btn-primary">Save changes</button>';
                            echo '</div>';
                 echo '</div>';
            echo '</div>';
        echo '</div>';
        }
        public static function input_file($parameter,$label){
            $html ='<input type="file"  name="'.$parameter.'" required class="form-control" id="'.$parameter.'">';
            $html.= '<span class="invalid-feedback">Please Browse the '.$label.'</span>';
            return $html;
        }
    }
?>