<?php ?>
<pre>
    <?php //print_r($_SERVER)?>
</pre>
<diw class="wrap">

    <form action="<?php echo $_SERVER['REQUEST_URI']?>" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="itemName">Назва</label>
            <input type="text" class="form-control form-control-lg" id="itemName" name="itemName" placeholder="Введіть назву номенклатури">
            <small id="itemName" class="form-text text-muted">Звичайна назва</small>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="type_pay" id="type_pay_pre" value="pre" checked>
            <label class="form-check-label" for="type_pay_pre">
                Передоплата
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="type_pay" id="type_pay_post" value="post">
            <label class="form-check-label" for="type_pay_post">
                Післяоплата
            </label>
        </div>
        <button type="submit" class="btn btn-primary">Створити</button>
    </form>
</diw>
