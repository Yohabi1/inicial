<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>{{$general->web_name}}</title>
</head>
<body>
<form method="POST" id="PayForm" action="{{ route('paystack.pay') }}" accept-charset="UTF-8" class="form-horizontal" role="form">
{{ csrf_field() }} 
    <div class="row" style="margin-bottom:40px;">
        <div class="col-md-8 col-md-offset-2">
            
            <input type="hidden" name="email" value="{{optional($gatewayData->user)->email}}"> {{-- required --}}
            <input type="hidden" name="orderID" value="{{$gatewayData->trx}}">
            <input type="hidden" name="amount" value="{{$gatewayData->amount}}"> {{-- required in kobo --}}
            <input type="hidden" name="quantity" value="{{$gatewayData->amount}}">
            <input type="hidden" name="currency" value="NGN">

            <input type="hidden" name="reference" value="{{ Unicodeveloper\Paystack\Facades\Paystack::genTranxRef() }}"> {{-- required --}}

        </div>
    </div>
</form>
<script>
    document.getElementById("PayForm").submit();
</script>
</body>
</html>
