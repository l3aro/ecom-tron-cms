<?php
namespace App\Libraries;

class UploadFile {
    
    public static function uploadImage($images,$folder, $old_image = "", $crop = false) {
        // define a maximum size for the uploaded images
        if (!defined("MAX_SIZE")) define ( "MAX_SIZE", 5120000000 );
        // define the width and height for the thumbnail
        // note that theese dimmensions are considered the maximum dimmension and are not fixed,
        // because we have to keep the image ratio intact or it will be deformed
        if (!defined("WIDTH")) define ( "WIDTH", 1920 );
        //Hien tai bien nay chua duoc dung.
        //Bien nay se duoc dung neu muon copy anh voi ty le thay doi cho ca width va height.
        if (!defined("HEIGHT")) define ( "HEIGHT", 1920 );
        //Begin: Upload and copy new thumbnai images.
        //Ham nay chi dung duoc voi anh co duoi .jpg, jpeg, png.
        if (!defined("TB_WIDTH")) define ( "TB_WIDTH", 250 );
        //Hien tai bien nay chua duoc dung.
        //Bien nay se duoc dung neu muon copy anh voi ty le thay doi cho ca width va height.
        if (!defined("TB_HEIGHT")) define ( "TB_HEIGHT", 250 );
        //Begin: Upload and copy new thumbnai images.
        //Ham nay chi dung duoc voi anh co duoi .jpg, jpeg, png.
        $tempfolder = $folder . "/temp/";
        $thumb_folder = $folder . "/tb/";
        $image = $images ['name'];
        if ($image) {
            $filename = stripslashes ( $images ['name'] );
            $extension = self::getExtension ( $filename );
            $extension = strtolower ( $extension );
            if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif")) {
            ?>
                <script language="javascript">
                    alert('<?php echo "File type is not image format!"; ?>');
                    window.history.back();
                </script>
            <?php
                die ();
            } else {
                list($usec, $sec) = explode(".", microtime(true));
                $tempfile = $tempfolder . $usec . $sec . '.' . $extension;
                // Tao temp file
                $copied = copy ( $images ['tmp_name'], $tempfile );
                if ($copied) {
                    $imageInfo = getimagesize($tempfile);
                    $imageName = $usec . $sec . '.' . $extension;
                    $imageFileCreate = $folder . $imageName;
                    $thumb_name = $thumb_folder . $imageName;
                    
                    if($imageInfo[0] > WIDTH) $new_w = WIDTH;
                    else $new_w = $imageInfo[0];
                    if($imageInfo[1] > HEIGHT) $new_h = HEIGHT;
                    else $new_h = $imageInfo[1];
                    
                    if ($extension == "gif" || ($imageInfo[0] <= WIDTH && $imageInfo[1] <= HEIGHT)) {
                        copy ( $tempfile, $imageFileCreate );
                       
                    } else {
                        self::make_thumb ( $tempfile, $imageFileCreate, $new_w, $new_h );
                    }
                    // Tao anh thumbnail resize lai neu can phai crop
                    if ($crop) {
                        $thumb = self::resize_image($tempfile,$thumb_name,TB_WIDTH,TB_HEIGHT);
                    } else {
                        $thumb = self::make_thumb($tempfile,$thumb_name,TB_WIDTH,TB_HEIGHT);
                    }
                } else {
                    print_r($copied);
                    echo "<br><br><br>Upload anh loi"; die;
                }				
            }
            // Delete image in temp folder.
            if (isset ( $tempfile )) unlink ( $tempfile );
        }
        //End: Upload and copy images.
        // If user upload new photo. Delete old image.
        if (isset ( $image_name ) && $old_image != "") {
            try{
                if (is_file($folder . $old_image)) unlink ( $folder . $old_image );
                if (is_file($thumb_folder .$old_image)) unlink ( $thumb_folder .$old_image );
            }catch (Zend_Exception $ex){}
        }
        if (isset ( $imageName )) return $imageName;
        else return $old_image;
    
    } // End function.
    
    //Begin: Ham tao thumbnai images.
    //Dung tao them 1 anh thumbnai trong khi nhap tin cua CMS.
    //Anh thumbnai nay se duoc dung de hien thi cung voi mo ta cua tin.
    //Hien tai ham nay dang duoc dung de tao anh co kich thuoc : chieu rong theo kich thuoc duoc fix cung.
    //chieu cao se thu lai theo ty le tinh duoc cua chieu rong.
    //Neu muon thu anh theo ty le cua ca 2 chieu, mo comment tren ung voi "$ratio2" va cac dong code lien quan.
    //this is the function that will create the thumbnail image from the uploaded image
    //the resize will be done considering the width and height defined, but without deforming the image
    public static function make_thumb($img_name,$filename,$new_w,$new_h, $crop = false){
        //get image extension.
        $ext=strtolower(self::getExtension($img_name));
        //creates the new image using the appropriate function from gd library
        if(!strcmp("jpg",$ext) || !strcmp("jpeg",$ext))
        $src_img=imagecreatefromjpeg($img_name);
    
        if(!strcmp("png",$ext))
        $src_img=imagecreatefrompng($img_name);
        
        if(!strcmp("gif",$ext))
        $src_img=imagecreatefromgif($img_name);
        
        //gets the dimmensions of the image
        $old_x=imageSX($src_img);
        $old_y=imageSY($src_img);
    
        // next we will calculate the new dimmensions for the thumbnail image
        // the next steps will be taken:
        // 1. calculate the ratio by dividing the old dimmensions with the new ones
        // 2. if the ratio for the width is higher, the width will remain the one define in WIDTH variable
        // and the height will be calculated so the image ratio will not change
        // 3. otherwise we will use the height ratio for the image
        // as a result, only one of the dimmensions will be from the fixed ones
        $ratio1=$old_x/$new_w;
        $ratio2=$old_y/$new_h;
        if($ratio1>$ratio2) {
            $thumb_w=$new_w;
            $thumb_h=$old_y/$ratio1;
        }else {
            $thumb_h=$new_h;
            $thumb_w=$old_x/$ratio2;
        }
    
        // we create a new image with the new dimmensions
        $dst_img=imagecreatetruecolor($thumb_w,$thumb_h);
    
        // resize the big image to the new created one
        imagecopyresampled($dst_img,$src_img,0,0,0,0,$thumb_w,$thumb_h,$old_x,$old_y);
    
        // output the created image to the file. Now we will have the thumbnail into the file named by $filename
        if(!strcmp("png",$ext)){
            imagepng($dst_img,$filename);
        }elseif(!strcmp("gif",$ext)){
            imagegif($dst_img,$filename);
        }else{
            imagejpeg($dst_img,$filename);
        }
        //destroys source and destination images.
        imagedestroy($dst_img);
        imagedestroy($src_img);
    }

    public static function resize_image($source_image, $destination_filename, $width = 300, $height = 300, $quality = 90, $crop = true) {
        if( ! $image_data = getimagesize( $source_image ) ) {
            return false;
        }
            
        switch( $image_data['mime'] ) {
            case 'image/gif':
            $get_func = 'imagecreatefromgif';
            $suffix = ".gif";
            break;
            case 'image/jpeg';
            $get_func = 'imagecreatefromjpeg';
            $suffix = ".jpg";
            break;
            case 'image/png':
            $get_func = 'imagecreatefrompng';
            $suffix = ".png";
            break;
        }
            
        $img_original = call_user_func( $get_func, $source_image );
        $old_width = $image_data[0];
        $old_height = $image_data[1];
        $new_width = $width;
        $new_height = $height;
        $src_x = 0;
        $src_y = 0;
        $current_ratio = round( $old_width / $old_height, 2 );
        $desired_ratio_after = round( $width / $height, 2 );
        $desired_ratio_before = round( $height / $width, 2 );
            
        if( $old_width < $width || $old_height < $height ) {
            /**
            * The desired image size is bigger than the original image.
            * Best not to do anything at all really.
            */
            return false;
        }
            
        /**
        * If the crop option is left on, it will take an image and best fit it
        * so it will always come out the exact specified size.
        */
        if( $crop ) {
            /**
            * create empty image of the specified size
            */
            $new_image = imagecreatetruecolor( $width, $height );
                
            /**
            * Landscape Image
            */
            if( $current_ratio > $desired_ratio_after ) {
                $new_width = $old_width * $height / $old_height;
            }
                
            /**
            * Nearly square ratio image.
            */
            if( $current_ratio > $desired_ratio_before && $current_ratio < $desired_ratio_after ) {
                if( $old_width > $old_height ) {
                    $new_height = max( $width, $height );
                    $new_width = $old_width * $new_height / $old_height;
                } else {
                    $new_height = $old_height * $width / $old_width;
                }
            }
                
            /**
            * Portrait sized image
            */
            if( $current_ratio < $desired_ratio_before ) {
                $new_height = $old_height * $width / $old_width;
            }
                
            /**
            * Find out the ratio of the original photo to it's new, thumbnail-based size
            * for both the width and the height. It's used to find out where to crop.
            */
            $width_ratio = $old_width / $new_width;
            $height_ratio = $old_height / $new_height;
                
            /**
            * Calculate where to crop based on the center of the image
            */
            $src_x = floor( ( ( $new_width - $width ) / 2 ) * $width_ratio );
            $src_y = round( ( ( $new_height - $height ) / 2 ) * $height_ratio );
        }
        /**
        * Don't crop the image, just resize it proportionally
        */
        else {
            if( $old_width > $old_height ) {
                $ratio = max( $old_width, $old_height ) / max( $width, $height );
            } else {
                $ratio = max( $old_width, $old_height ) / min( $width, $height );
            }
                
            $new_width = $old_width / $ratio;
            $new_height = $old_height / $ratio;
                
            $new_image = imagecreatetruecolor( $new_width, $new_height );
        }
            
        /**
        * Where all the real magic happens
        */
        imagecopyresampled( $new_image, $img_original, 0, 0, $src_x, $src_y, $new_width, $new_height, $old_width, $old_height );
            
        /**
        * Save it as a JPG File with our $destination_filename param.
        */
        imagejpeg( $new_image, $destination_filename, $quality );
            
        /**
        * Destroy the evidence!
        */
        imagedestroy( $new_image );
        imagedestroy( $img_original );
            
        /**
        * Return true because it worked and we're happy. Let the dancing commence!
        */
        return true;
    } 

    // This function reads the extension of the file.
	// It is used to determine if the file is an image by checking the extension.
	public static function getExtension($str) {
	    $i = strrpos($str,".");
	    if (!$i) { return ""; }
	    $l = strlen($str) - $i;
	    $ext = substr($str,$i+1,$l);
	    return $ext;
	}
            
            
}

?>