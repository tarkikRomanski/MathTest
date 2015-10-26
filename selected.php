<div class="row-fluid" xmlns="http://www.w3.org/1999/html">
    <div class="offset3 span6">
        <h2 class="text-center text-center">Вітаю, <?=$_COOKIE['userName']?>, оберіть тест</h2>
        <form id="selected_test" class="form-horizontal" method="post" action="test.php">
            <div class="control-group">
                <label class="control-label">Виберіть тему:</label>
                <div class="controls">
                    <select class="selectpicker" name="test_name" data-style="btn-link" data-width="100%"></select>
                </div>
            </div>
            <center><input type="submit" class="btn-large btn-primary btn-large offset3 span6" value="Обрати"></center>
        </form>
    </div>
</div>

<script>
        $.get(
            "getTheme.php",
            {
                id: 'allTheme'
            },
            function(data){
                var theme = JSON.parse(data);
                res = '';
                for (var i =0; i < theme.count; i++) {
                    res += "<option>"+theme['test'+i]+"</option>";
                }

                $('.selectpicker').html(res);
            }
        );
</script>