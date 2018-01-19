@extends('layouts.application_master')
<script>
    function add(id, price) {
        $('#table').show();
        $('#c'+id).show();
        $('#nothing').hide();
        $('#p'+id).attr('disabled', true);
        var currentTotal;

        if ($('#total').is(':empty')) {
            currentTotal = 0;
        } else {
            currentTotal = parseInt($('#total').text());
        }
        var newTotal = currentTotal + parseInt(price);
        $('#total').text(newTotal);
    }

    function remove(id, price) {
        $('#c'+id).hide();
        $('#p'+id).attr('disabled', false);
        var allHidden = true;
        for (var i = 1; i <= 4; i++) {
            if ($('#c'+i+':visible').length != 0) {
                allHidden = false;
            }
        }

        if (allHidden) {
            $('#nothing').show();
            $('#total').text('');
            $('#table').hide();
        } else {
            var currentTotal = parseInt($('#total').text());
            var newTotal = currentTotal - parseInt(price);
            $('#total').text(newTotal);
        }
    }

    function addAll() {
        $('#table').show();
        $('#nothing').hide();
        for (var id = 1; id <= 4; id++) {
            $('#c'+id).show();
            $('#p'+id).attr('disabled', true);
        }
        $('#total').text(70);
    }

    function removeAll() {
        $('#table').hide();
        $('#nothing').show();
        for (var id = 1; id <= 4; id++) {
            $('#c'+id).hide();
            $('#p'+id).attr('disabled', false);
        }
        $('#total').text('');
    }
</script>
<div class="container">
    <h1>Order Form</h1>
    <div class="col-md-6">
        <h2>Available Products</h2>
        <ul class="list-group">
            <li class="list-group-item">
                Product 1 <span>$25.00 <button onclick="add(1, 25)" id="p1">Add</button></span>
            </li>
            <li class="list-group-item">
                Product 2 <span>$15.00 <button onclick="add(2, 15)" id="p2">Add</button></span>
            </li>
            <li class="list-group-item">
                Product 3 <span>$20.00 <button onclick="add(3, 20)" id="p3">Add</button></span>
            </li>
            <li class="list-group-item">
                Product 4 <span>$10.00 <button onclick="add(4, 10)" id="p4">Add</button></span>
            </li>
        </ul>
        <div style="float: right;">
            <button onclick="addAll()">Add All</button>
        </div>
    </div>
    <div class="col-md-6">
        <h2>Items In Cart</h2>
        <div id="nothing">
            Nothing to show
        </div>
        <div hidden id="table">
            <ul class="list-group">
                <li class="list-group-item" style="display: none;" id="c1">
                    Product 1 <span><a href="javascript: void(0);" onclick="remove(1, 25)">X</a></span>
                </li>
                <li class="list-group-item" style="display: none;" id="c2">
                    Product 2 <span><a href="javascript: void(0);" onclick="remove(2, 15)">X</a></span>
                </li>
                <li class="list-group-item" style="display: none;" id="c3">
                    Product 3 <span><a href="javascript: void(0);" onclick="remove(3, 20)">X</a></span>
                </li>
                <li class="list-group-item" style="display: none;" id="c4">
                    Product 4 <span><a href="javascript: void(0);" onclick="remove(4, 10)">X</a></span>
                </li>
            </ul>
            <div style="float: right;">
                <button onclick="removeAll()">Remove All</button>
            </div>
            <strong>Total: </strong>$<span id="total"></span>.00
        </div>
    </div>
</div>
