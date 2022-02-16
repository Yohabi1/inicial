(function($) {
    "use strict";
    $(document).ready(function () {
        var myCurRt = $('#cp_currency_rt').val();
        var myCurPerc = $('#bal_trans_percent').val();
        var myCurren = $('#currency').val()

        let fixedCharge, percentCharge;
        fixedCharge = +myCurRt;
        percentCharge = +myCurPerc;
        $('#amount').on('keyup',function () {
            var amt = this.value;
            if (($.isNumeric(amt)) && (parseFloat(amt) > 0)){
                var perCharge = parseFloat(amt);
                var totalCharge = perCharge/parseFloat(fixedCharge);
                var m = 'Total '+parseFloat(totalCharge.toFixed(8))+' '+myCurren+' wil deduct from your balance.';
                msg(m);
            } else {
                msg('Amount should be numeric & greater than 0');
            }

        });
        function msg(msg) {
            $('.wrnMsg').text(msg);
        }
    });   


})(jQuery);