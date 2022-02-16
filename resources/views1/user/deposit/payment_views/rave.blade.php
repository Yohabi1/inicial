<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>{{$general->web_name}}</title>
</head>
<body>
    <form method="POST" action="{{ route('rave.pay') }}" id="paymentForm">
{{ csrf_field() }} 
    <div class="row" style="margin-bottom:40px;">
        <div class="col-md-8 col-md-offset-2">
            <input type="hidden" name="orderID" value="{{$track}}">
        </div>
    </div>
</form>
<script>
    document.getElementById("paymentForm").submit();
</script>
</body>
</html>
