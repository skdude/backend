<!DOCTYPE HTML>
<html>
<head>

</head>
<body>

<h1>Products</h1>
<ul>
    <?php foreach ($items as $item){
        echo "<li>".$item['name']."</li>";
        echo "<h3>".$item['price']."</h2>";
        echo form_open('cart/insert');
        echo form_label('qty','qty');
        echo form_input('qunatity');
        echo form_hidden('id',$item['id']);
        echo form_submit('submit','add');
        echo form_close();
    }
    ?>
</ul>

<div class="cart">
    <h2>Your Cart</h2>
    <?php
    if(!$this->cart->contents()){
        echo "<p>Your Cart Is Empty At The Moment</p>";
    }else{

        $items = $this->cart->contents();
        foreach ($items as $item){
            echo "<h3>".$item['name']."</h3>";
            echo "<h3>".$item['qty']."</h3>";
            echo "<h3>".$item['subtotal']."</h3>";


        }
    }
    ?>
</div>




</body>
</html>