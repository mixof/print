/**
 * Created by jaclark on 5/30/16.
 */
$(document).ready(function () {
    var ordersTable = $('#orderTable').DataTable({
        "order": [[ 0, "desc" ]]
    });

    ordersTable.on('click', [name = "pay"], function (event) {
        if (event.target.innerText === "Pay Artist") {
            var button = event.target;
            var oid = button.attributes['data-id'].value;
            var payid = $(button);
            payid.find('.spinning').show();
            payid.attr('disabled', 'disable');
            event.preventDefault();
            $.ajax({
                url: "artist/pay/" + oid,
                type: 'GET',
                data: {id: oid},
                success: function (response) {
                    if (response == 'success') {
                        payid.hide();
                        $('<span style="color:#090">PAID</span>').insertAfter(payid);
                        $('<div class="alert alert-success" role="alert">Order Updated.</div>').insertBefore('.container .page-header');
                    } else {
                        payid.removeAttr('disabled');
                        payid.find('.spinning').hide();
                        $('<div class="alert alert-danger" role="alert">Order failed to update. Error returned from PayPal:' + response + '</div>').insertBefore('.container .page-header');
                    }
                }
            });
        }
    });

    $(".datepicker" ).datepicker();

    $('.payall').click(function(event){
        $('<div class="alert alert-success" role="alert">Please wait...</div>').insertBefore('.container .page-header');
        $('a.pay').each(function(index, element) {
            var oid = $(this).attr('data-id');
            var payid = $(this);
            payid.find('.spinning').show();
            payid.attr('disabled','disable');
            event.preventDefault();

            $.ajax({
                url: "artist/pay/"+oid,
                type: 'GET',
                data: { id: oid },
                success: function(response)
                {
                    if ( response == 'success' ) {
                        payid.hide();
                        $('<span style="color:#090">PAID</span>').insertAfter(payid);
                    } else {
                        payid.removeAttr('disabled');
                        payid.find('.spinning').hide();
                        $('<br><span style="color:#f00">Error occur please try again</span>').insertAfter(payid);
                    }
                }
            });

            $(document).ajaxStop(function () {
                $('.payall').find('.spinning').hide();
                $('.alert').html('Orders Updated');
            });
        });
    });

});