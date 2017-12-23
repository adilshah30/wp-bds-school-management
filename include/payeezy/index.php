<form method="post" action="https://checkout.globalgatewaye4.firstdata.com">
<input type="hidden" name="x_login" value="HCO-MIND-513" /> <!-- Payment Page ID located in the Payeezy Gateway Payment Pages administration interface -->
<input type="hidden" name="x_fp_sequence" value="42311" /> <!-- Random number used in the x_fp_hash calculation -->
<input type="hidden" name="x_fp_timestamp" value="1287098097" /> <!-- Current UTC timestamp -->
<input type="hidden" name="x_currency_code" value="USD" />
<!-- 
    The x_currency_code field isn’t actually required, but is here for clarity.
    By default, the currency defined in the Payeezy Gateway Payment Page administration interface will be used.
    If you are specifying a currency code, it must also be used in the x_fp_hash calculation (see the PHP example below).
-->
<input type="hidden" name="x_amount" value="19.95" /> <!-- Order amount -->
<input type="hidden" name="x_fp_hash" value="0688a6886e25775ddf6b2947b578f793" /> <!-- Calculated hash value -->
<input type="hidden" name="x_show_form" value="PAYMENT_FORM" /> 
<input type="submit" name="checkout" value="Checkout Now" />
</form>