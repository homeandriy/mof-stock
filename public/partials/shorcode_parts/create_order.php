<?php
$nomenclature = new MOF_Nomenclature();
$all_nomenclature = $nomenclature->getAll();
?>
<pre>
    <?php  ?>
</pre>
<diw class="wrap">
    <form action="<?php echo $_SERVER['REQUEST_URI']?>" method="post" enctype="multipart/form-data">
        <table class="table">
            <thead class="thead-dark">
            <tr>
                <th scope="col">№</th>
                <th scope="col">Назва</th>
                <th scope="col">Кількість</th>
                <th scope="col">Важливість</th>
                <th scope="col">Керування</th>
            </tr>
            </thead>
            <tbody id="list-order">

            </tbody>
        </table>
        <div class="form-group">
            <label for="comments">Ваш коментар до замовленн</label>
            <textarea class="form-control" id="comments" rows="3"></textarea>
        </div>
        <button type="submit" id="insert_order" class="btn btn-primary">Завершити додавання номенклатури та відправити на перевірку</button>
    </form>
    <hr>
    <h2>Додавання номенклатури до замовлення</h2>
    <hr>
    <form action="" method="get">
        <div class="form-group">
            <label for="nomenclature-name">Вибреть номенклатуру</label>
            <select class="form-control form-control-lg" id="nomenclature-name" name="nomenclature-name">
                <option value="none">Оберіть</option>
                <?php foreach ($all_nomenclature as $_current) : ?>
                <option value="<?php echo $_current->id; ?>"> <?php echo $_current->name; ?> </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="amount">Кількість</label>
            <input type="number" class="form-control form-control-lg" name="amount" id="amount" min="1" max="500" >
        </div>
        <div class="form-group">
            <label for="priority">Приорітет</label>
            <select class="form-control form-control-lg" id="priority" name="priority">
                <option value="none">Оберіть</option>
                <option value="priority-not"> Не приорітетно </option>
                <option value="priority-hot"> Приорітетно </option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary" id="addItems">Додати до замовлення</button>
    </form>

    <script type="text/javascript">
        (function( $ ) {
            'use strict';

            const nomenclature = JSON.parse('<?php echo json_encode($all_nomenclature, JSON_UNESCAPED_UNICODE)?>');
            $(document).ready(function () {
                const addButton = $('#addItems');
                let order = new Order( $('#list-order') );
                addButton.click(function (event) {
                    event.preventDefault();
                    let id       = $('#nomenclature-name').val();
                    let amount   = $('#amount').val();
                    let priority = $('#priority').val();
                    if(id !== 'none' || priority !== 'none') {
                        order.add( id,  amount, priority)
                    }
                    else {
                        console.log('error');
                    }
                });
                window.deleteItem = function( _this ){
                    event.preventDefault();
                    order.delete($(_this).data('id'));
                };
                $('#insert_order').click(function (event){
                    event.preventDefault();
                    order.insert($('#comments').val());
                })
            });

            function Order ( idElement )
            {
                this.order = [];
                this.nomenclature = nomenclature;
                this.idElement = idElement;

                this.insert = function ( comment ) {
                    if(this.order.length === 0) {
                        alert('Спочатку Додайте номенклатуру');
                        return null;
                    }

                    $.ajax({
                        url: window.mof_ajaxurl,
                        method : 'POST',
                        data: {
                            'action'      : 'insert_order',
                            'nomenclature': this.order,
                            'comment'     : comment
                        },
                        beforeSend:function( xhr ) {

                        },
                        success:function(data) {
                            // This outputs the result of the ajax request
                            console.log(data);
                        },
                        error: function(errorThrown){
                            console.log(errorThrown);
                        }
                    });

                };
                this.add = function (idNomenclature, amount, priority) {
                    // console.log(idNomenclature);
                    for ( let i = 0; i < this.nomenclature.length; i++){
                        if( Number(idNomenclature) === +this.nomenclature[i]['id']){
                            if( undefined !== this.order[ this.nomenclature[i]['id'] ] ) {
                                console.log(this.order[this.nomenclature[i]['id']]);
                                console.log(+amount + +this.order[this.nomenclature[i]['id']]['amount']);
                                this.order[this.nomenclature[i]['id']]['amount'] =  +amount + +this.order[this.nomenclature[i]['id']]['amount'];

                            }
                            else {
                                let item = this.nomenclature[i];
                                item['amount'] = amount;
                                item['priority'] = priority;
                                this.order[item['id']] = item;
                            }
                            console.log(this.order);
                            this.render();
                            this.clearForm();
                        }
                    }
                };
                this.delete = function ( id ) {
                    console.log(id);
                    if( undefined !== this.order[id] ) {
                        this.order.splice(this.order.indexOf(id), 1);
                        this.render();
                    }
                };
                this.render = function () {
                    idElement.html();
                    let html = '';
                    let z= 1;
                    for ( let item in this.order){
                        html += '<tr><td>'+z+'</td><td>'+this.order[item]['name']+'</td><td>'+this.order[item]['amount']+'</td><td>'+this.order[item]['priority']+'</td><td>'+this.renderButton(this.order[item]['id'])+'</td></tr>';
                        z++;
                    }
                    idElement.html(html);
                };
                this.renderButton = function(id) {
                    return '<button class="delete-item btn btn-dark"  onclick="deleteItem(this)" data-id = "'+id+'">Видалити</button>';
                };
                this.clearForm = function () {
                    $('#nomenclature-name').prop('selectedIndex', 0);
                    $('#amount').val(1);
                    $('#priority').prop('selectedIndex', 0);
                }
            }
        })( jQuery );
    </script>
</diw>
