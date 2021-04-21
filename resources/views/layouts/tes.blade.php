<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<link href="css/smart_cart.min.css" rel="stylesheet" type="text/css" />
<section class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Products
                </div>
                <div class="panel-body">
                    <div class="row">
                        <!-- BEGIN PRODUCTS -->
                        <div class="col-md-4 col-sm-6">
                            <div class="sc-product-item thumbnail">
                                <div class="caption">
                                    <h4 data-name="product_name">Product 1</h4>
                                    <p data-name="product_desc">Product details</p>
                                    <hr class="line">

                                    <div>
                                        <div class="form-group">
                                            <label>Size: </label>
                                            <select name="product_size" class="form-control input-sm">
                                                <option>S</option>
                                                <option>M</option>
                                                <option>L</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Color: </label><br />
                                            <label class="radio-inline">
                                                <input type="radio" name="product_color" value="red"> red
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="product_color" value="blue"> blue
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="product_color" value="green"> green
                                            </label>
                                        </div>
                                        <div class="form-group2">
                                            <input class="sc-cart-item-qty" name="product_quantity" min="1" value="1" type="number">
                                        </div>
                                        <strong class="price pull-left">50</strong>

                                        <input name="product_price" value="50" type="hidden" />
                                        <input name="product_id" value="12" type="hidden" />
                                        <button class="sc-add-to-cart btn btn-success btn-sm pull-right">Add to cart</button>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>








                        <!-- END PRODUCTS -->
                    </div>
                </div>
            </div>

        </div>

        <aside class="col-md-4">

            <!-- Cart submit form -->
            <form action="{{ url('tes2') }}" method="GET">
                <!-- SmartCart element -->
                <div id="smartcart"></div>
            </form>

        </aside>
    </div>
</section>

<!-- Include jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js" type="text/javascript" ></script>
<!-- Include SmartCart -->
<script src="js/jquery.smartCart.min.js" type="text/javascript"></script>
<!-- Initialize -->
<script type="text/javascript">
    $(document).ready(function(){
        // Initialize Smart Cart
        $('#smartcart').smartCart();
    });
</script>
