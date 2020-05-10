$(function(){

    "use strict";
    $('.add-product').on('click',function(e){
        e.preventDefault();
        var name = $(this).data('name');
        var price = $(this).data('price');
        var id = $(this).data('id');


        $(this).removeClass('btn-success').addClass('btn-default disabled');

        var table =
        `<tr>
        <td>${name}</td>
         <td><input type="number" name="products[${id}][quantity]" data-price="${price}" class="form-control input-sm quantity" min="1" value="1"></td>
         <td class="product-price">${price}</td>
         <td><button class="btn btn-danger btn-sm remove" data-id="${id}"><i class="fa fa-trash"></i></button></td>
        </tr>`;

        $('.order-list').append(table);

        calc();


        $('.disabled').on('click', function(){


        });

        $('.remove').on('click',function(e){

            e.preventDefault();

            var id = $(this).data('id');
             $('#product-'+ id).removeClass('btn-default disabled').addClass('btn-success');
            $(this).closest('tr').remove();

            calc();
        });

    });

    function calc(){

        var price = 0;

        $('.order-list .product-price').each(function(index){

            price += parseInt($(this).text());

        });

            $('.total').text(parseFloat(price));

            if(price > 0){
                $('#add-order').removeClass('disabled');

            }else{

                $('#add-order').addClass('disabled');
            }
    }

    $('body').on('keyup change', '.quantity', function(){

         var price = $(this).data('price');
         var quantity = parseInt($(this).val());
         var totalprice = price * quantity;
      //  $('tr td:eq(3)').text(parseFloat(totalprice));
      // $('span.total').text(parseFloat(totalprice));
        $(this).closest('tr').find('.product-price').html(totalprice);
        calc();
    });


    $('.order-prodcut').on('click', function(e){

        e.preventDefault();
    // $('.product-list').fadeToggle();
    $('.test').fadeIn();
        var url = $(this).data('url');
        var method = $(this).data('method');
        $.ajax({
            url:url,
            method:method,
            success:function(data){

            }

        });
    });

  });
