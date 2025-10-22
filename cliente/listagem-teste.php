<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        /* Generals resets and unimportant stuff */
        * {
            margin: 0px;
            padding: 0px;
        }

        body {
            background: #eaebec;
            font-family: "Open Sans", sans-serif;
        }

        /* --- Product Card ---- */
        #make-3D-space {
            position: relative;
            perspective: 800px;
            width: 340px;
            height: 500px;
            transform-style: preserve-3d;
            transition: transform 5s;
            position: absolute;
            top: 80px;
            left: 50%;
            margin-left: -167px;
        }

        #product-front{
            width: 335px;
            height: 500px;
            background: #fff;
            position: absolute;
            left: -5px;
            top: -5px;
            -webkit-transition: all 100ms ease-out;
            -moz-transition: all 100ms ease-out;
            -o-transition: all 100ms ease-out;
            transition: all 100ms ease-out;
        }

        #product-card.animate,
        #product-card.animate #product-front {
            top: 0px;
            left: 0px;
            -webkit-transition: all 100ms ease-out;
            -moz-transition: all 100ms ease-out;
            -o-transition: all 100ms ease-out;
            transition: all 100ms ease-out;
        }

        #product-card {
            width: 325px;
            height: 490px;
            position: absolute;
            top: 10px;
            left: 10px;
            overflow: hidden;
            transform-style: preserve-3d;
            -webkit-transition: 100ms ease-out;
            -moz-transition: 100ms ease-out;
            -o-transition: 100ms ease-out;
            transition: 100ms ease-out;
        }

        #product-card.animate {
            top: 5px;
            left: 5px;
            width: 335px;
            height: 500px;
            box-shadow: 0px 13px 21px -5px rgba(0, 0, 0, 0.3);
            -webkit-transition: 100ms ease-out;
            -moz-transition: 100ms ease-out;
            -o-transition: 100ms ease-out;
            transition: 100ms ease-out;
        }

        .stats-container {
            background: #fff;
            position: absolute;
            top: 386px;
            left: 0;
            width: 265px;
            height: 300px;
            padding: 27px 35px 35px;
            -webkit-transition: all 200ms ease-out;
            -moz-transition: all 200ms ease-out;
            -o-transition: all 200ms ease-out;
            transition: all 200ms ease-out;
        }

        #product-card.animate .stats-container {
            top: 272px;
            -webkit-transition: all 200ms ease-out;
            -moz-transition: all 200ms ease-out;
            -o-transition: all 200ms ease-out;
            transition: all 200ms ease-out;
        }

        .stats-container .product_name {
            font-size: 22px;
            color: #393c45;
        }

        .stats-container p {
            font-size: 16px;
            color: #b1b1b3;
            padding: 2px 0 20px 0;
        }

        .stats-container .product_price {
            float: right;
            color: #48cfad;
            font-size: 22px;
            font-weight: 600;
        }

        .image_overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: #48daa1;
            opacity: 0;
        }

        #product-card.animate .image_overlay {
            opacity: 0.7;
            -webkit-transition: all 200ms ease-out;
            -moz-transition: all 200ms ease-out;
            -o-transition: all 200ms ease-out;
            transition: all 200ms ease-out;
        }

        .product-options {
            padding: 2px 0 0;
        }

        .product-options strong {
            font-weight: 700;
            color: #393c45;
            font-size: 14px;
        }

        .product-options span {
            color: #969699;
            font-size: 14px;
            display: block;
            margin-bottom: 8px;
        }

        #view_details {
            position: absolute;
            top: 112px;
            left: 50%;
            margin-left: -85px;
            border: 2px solid #fff;
            color: #fff;
            font-size: 19px;
            text-align: center;
            text-transform: uppercase;
            font-weight: 700;
            padding: 10px 0;
            width: 172px;
            opacity: 0;
            -webkit-transition: all 200ms ease-out;
            -moz-transition: all 200ms ease-out;
            -o-transition: all 200ms ease-out;
            transition: all 200ms ease-out;
        }

        #view_details:hover {
            background: #fff;
            color: #48cfad;
            cursor: pointer;
        }

        #product-card.animate #view_details {
            opacity: 1;
            width: 152px;
            font-size: 15px;
            margin-left: -75px;
            top: 115px;
            -webkit-transition: all 200ms ease-out;
            -moz-transition: all 200ms ease-out;
            -o-transition: all 200ms ease-out;
            transition: all 200ms ease-out;
        }

        div.colors div {
            margin-top: 3px;
            width: 15px;
            height: 15px;
            margin-right: 5px;
            float: left;
        }

        div.colors div span {
            width: 15px;
            height: 15px;
            display: block;
            border-radius: 50%;
        }

        div.colors div span:hover {
            width: 17px;
            height: 17px;
            margin: -1px 0 0 -1px;
        }

        div.c-blue span {
            background: #6e8cd5;
        }

        div.c-red span {
            background: #f56060;
        }

        div.c-green span {
            background: #44c28d;
        }

        div.c-white span {
            background: #fff;
            width: 14px;
            height: 14px;
            border: 1px solid #e8e9eb;
        }

        div.shadow {
            width: 335px;
            height: 520px;
            opacity: 0;
            position: absolute;
            top: 0;
            left: 0;
            z-index: 3;
            display: none;
            background: -webkit-linear-gradient(left, rgba(0, 0, 0, 0.1), rgba(0, 0, 0, 0.2));
            background: -o-linear-gradient(right, rgba(0, 0, 0, 0.1), rgba(0, 0, 0, 0.2));
            background: -moz-linear-gradient(right, rgba(0, 0, 0, 0.1), rgba(0, 0, 0, 0.2));
            background: linear-gradient(to right, rgba(0, 0, 0, 0.1), rgba(0, 0, 0, 0.2));
        }

        div.shadow {
            z-index: 10;
            opacity: 1;
            background: -webkit-linear-gradient(left, rgba(0, 0, 0, 0.2), rgba(0, 0, 0, 0.1));
            background: -o-linear-gradient(right, rgba(0, 0, 0, 0.2), rgba(0, 0, 0, 0.1));
            background: -moz-linear-gradient(right, rgba(0, 0, 0, 0.2), rgba(0, 0, 0, 0.1));
            background: linear-gradient(to right, rgba(0, 0, 0, 0.2), rgba(0, 0, 0, 0.1));
        }
    </style>
</head>

<body>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700' rel='stylesheet' type='text/css'>
    <div id="make-3D-space">
        <div id="product-card">
            <div id="product-front">
                <div class="shadow"></div>
                <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/245657/t-shirt.png" alt="" />
                <div class="image_overlay"></div>
                <div id="view_details">View details</div>
                <div class="stats">
                    <div class="stats-container">
                        <span class="product_price">$39</span>
                        <span class="product_name">Adidas Originals</span>
                        <p>Men's running shirt</p>
                        <div class="product-options">
                            <strong>SIZES</strong>
                            <span>XS, S, M, L, XL, XXL</span>
                            <strong>COLORS</strong>
                            <div class="colors">
                                <div class="c-blue"><span></span></div>
                                <div class="c-red"><span></span></div>
                                <div class="c-white"><span></span></div>
                                <div class="c-green"><span></span></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            // Lift card and show stats on Mouseover
            $('#product-card').hover(function() {
                $(this).addClass('animate');
            }, function() {
                $(this).removeClass('animate');
            });
        });
    </script>
</body>

</html>