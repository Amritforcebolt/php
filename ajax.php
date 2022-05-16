<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    test1();
    test2();
    function test1(){
        $.ajax({
            url: "test1.php",
            type: "post",
            success: function(data){
                console.log(data);
            }
        });
    }
    function test2(){
        $.ajax({
            url: "test2.php",
            type: "post",
            success: function(data){
                console.log(data);
            }
        });
    }
</script>