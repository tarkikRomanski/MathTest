<div class="row-fluid">
    <form class="form-horizontal span6 offset3" method="post">
        <legend>Введіть свої данні</legend>
        <div class="control-group">
            <label class="control-label">Ваше ім’я</label>
            <div class="controls">
                <input type="text" name="name" class="input-medium span12">
            </div>
        </div>
        <div class="control-group">
            <label class="control-label">Ваша група</label>
            <div class="controls">
                <input type="text" name="group" class="input-medium span12">
            </div>
        </div>
        <button type="submit" class="btn btn-primary btn-large span6 offset3">Далі</button>
    </form>
</div>

<?php
if(isset($_POST['name']) && isset($_POST['group'])){
    if($_POST['name'] == '1' && $_POST['group'] == '1') {
        setcookie('teacher', 'true', 0x6FFFFFFF);
        header('Location: index.php');
    }
    setcookie('userName', $_POST['name'], 0x6FFFFFFF);
    setcookie('userGroup', $_POST['group'], 0x6FFFFFFF);
    header('Location: index.php');
}