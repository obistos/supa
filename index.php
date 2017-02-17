<?php 

    function getImagesFromDir($path) {
        $images = array();
        if ( $img_dir = @opendir($path) ) {
            while ( false !== ($img_file = readdir($img_dir)) ) {
                // checks for gif, jpg, png
                if ( preg_match("/(\.gif|\.jpg|\.png)$/", $img_file) ) {
                    $images[] = $img_file;
                }
            }
            closedir($img_dir);
        }
        return $images;
    }

    $path = 'img/';
    $imgList = getImagesFromDir($path);
    
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <title>Next picture using hotkeys</title>

    <link href="css/style.css" rel="stylesheet" />

    <script src="js/jquery-2.1.1.min.js"></script>
    <script src="js/jquery.hotkeys.js"></script>
    <script src="js/jquery.keyboard-navigation.js"></script>
</head>
<body>

    <div class="ob-section">
        <?php
            foreach ($imgList as $img) {                        
                        //print_r($img); exit();
        ?>   
        <div class="image">
            <img src="<?=$path.$img?>">
        </div>

    </div>

    <!-- init plugin -->
    <script>
        $(function(){

            // init jquey navigation
            $('.ob-section').keyboardNavagation({
                offset: -100
            });
            
            // j - next
            $(document).bind('keydown', 'k', function(){
                $('.ob-section').trigger('scrollNext');
            });

            // k - prev
            $(document).bind('keydown', 'j', function(){
                $('.ob-section').trigger('scrollPrev');
            });

            $('.image').on('selected', function(){
                console.log('selected element', this);
            })
            

        });
    </script>

</body>
</html>