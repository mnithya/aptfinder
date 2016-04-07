<?php 
require "dbutil.php";
$db = DbUtil::loginConnection();
date_default_timezone_set('America/New_York');     

header('Content-type: text/xml');
header('Content-Disposition: attachment; filename="text.xml"');

//echo $xml_contents;

$output = shell_exec("./mysql -ujon test --xml -e 'SELECT * FROM User' > t1.xml");

?>
<html>
        <head><link rel=\"stylesheet\" type=\"text/css\" href=\"style.css\">
        <script src=\"js/jquery-1.6.2.min.js\" type=\"text/javascript\"></script> 
        <script src=\"js/jquery-ui-1.8.16.custom.min.js\" type=\"text/javascript\"></script>


        <script>
        $(document).ready(function() {
                $( 'input[type=checkbox]' ).change(function() {
                        $.ajax({
                                url: 'amenity_finder.php', 
                                data: {amenities: $( 'input[type=checkbox]' ).serialize()},
                                success: function(data){
                                        $('#apt_result').html(data);    
                                
                                }
                        });
                });
                
        });

        </script>

        </head>
        <body>

<?php
echo "<pre>$output</pre>";

?>

</body>
