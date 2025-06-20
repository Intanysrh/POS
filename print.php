<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <style>
        .body{
            font-family:monospace;
            width: 80mm;
            margin: auto;
            padding: 10px;
        }

        .invoice{
            text-align: center;
        }

        .line{
            margin: 5px 0;
            border-top: 1px dashed black;
        }

        .info, .products, .summary{
            text-align: left;
        }

        .products .item{
            margin-bottom: 5px
        }

        .products .item-qty{
            display: flex;
            justify-content: space-between;
        }

        .info .row, .summary .row{
            display: flex;
            justify-content: space-between;
            margin:2px;
        }

        .footer{
            text-align: center;
            font-size: 13px;
            margin-top:10px;
        }

        @media print{
            body{
                width: 80mm;
                margin: 0;
            }
        }
    </style>
</head>
<body>
    <div class="invoice">
        <div class="invoice-header">
            <h3>Kedai Kopi PPKD JP</h3>
            <h2>ENAK BENULL</h2>

            <div class="info text-center">
                Jl. xxxxx xxxxxxxxxx xxxxx
                <br>
                0899999999999999
            </div>
        </div>
        <div class="line"></div>
        <div class="info">
            <div class="row">
                <span>20/06/2025</span>
                <span>09:39</span>
            </div>
            <div class="row">
                <span>Cashier:</span>
                <span>Reza</span>
            </div>
            <div class="row">
                <span>Order Id</span>
                <span>TR-200625-001</span>
            </div>
            <div class="line"></div>
            <div class="products">
                <div class="item">
                    <strong>Smoothies Vanilla Coffee</strong>
                    <div class="item-qty">
                        <span>1x @20.000</span>
                        <span>Rp 20.000</span>
                    </div>
                </div>
            </div>

            <div class="line"></div>
            <div class="summary">
                <div class="row">
                    <span>Sub Total</span>
                    <span>Rp 20.000</span>
                </div>
            </div>
        </div>

        <div class="line"></div>
        <footer class="text-center">Terima kasih telah membeli di sini</footer>
    </div>
    <script>
        window.print();
    </script>
</body>
</html>