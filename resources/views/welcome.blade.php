<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>Tabu-Manh</title>
    <link rel="icon" type="image/x-icon" href="/favicon.png">
    <link rel="dns-prefetch" href="https://fonts.googleapis.com">
    <link rel="dns-prefetch" href="https://web.logwork.com/cores/173/tpl/main">
    <link rel="stylesheet" type="text/css"
          href="https://web.logwork.com/cores/173/tpl/main/css_min/font-awesome.min.1612172030.css" media="all">
    <link rel="stylesheet" type="text/css"
          href="https://web.logwork.com/cores/173/tpl/main/css_min/4c331e3e688e6e19efeb3e76f684fa4f.css" media="all">
    <style>
        .box-time {
            margin-top: 200px;
        }

        body {
            background-image: url("new-year.jpg");
            background-position: center;
        }

        .box-input input,
        .box-input button {
            background: transparent;
            padding: 5px 15px;
            border-radius: 5px;
            border: 1px solid #007a4d;
            text-align: center;
            color: black;
            margin-top: 10px;
        }

        .box-input input {
            min-width: 300px;
        }

        .box-input button:hover {
            background: #007a4d;
            color: white;
        }
    </style>
</head>
<body role="document" class="page_950">
<script
    src="https://logwork.com/widget/currency/index.js?params=%5B%7B%22tt%22%3A%22Currency%20Converter%22%2C%22lc%22%3A%22https%3A%2F%2Flogwork.com%2Ffree-currency-converter-calculator%22%2C%22sz%22%3A%22260%22%2C%22cr%22%3A%22USD%2CEUR%2CJPY%2CGBP%2CCNY%2CINR%22%7D%5D&amp;url=https://logwork.com/countdown-timer&amp;v=202282321"
    id="currency_convertor"></script>
<script src="https://cdn.logwork.com/widget/text_api.js?v=202282321" id="clock-widget-text"></script>
<script src="https://cdn.logwork.com/widget/clock_api.js?v=202282321" id="clock-time"></script>
<script src="https://cdn.logwork.com/widget/digital_api.js?v=202282321" id="digital-clock"></script>
<script>var cdn_widget_url = 'https://cdn.logwork.com/widget';
    var countdown_js_url = 'https://web.logwork.com/cores/173/tpl/main/widget/countdown/js';
    var countdown_css_url = 'https://web.logwork.com/cores/173/tpl/main/widget/countdown/css';</script>
<div class="container-fluid box-time">
    <div class="row" style="justify-content: center; display: flex;">
        <div class="col-md-8">
            <div style="text-align:center">
                <div id="show_time"></div>
                <div id="js_preview"></div>
                <div id="js_view_local" style="height: 420px;">
                    <iframe
                        srcdoc="<head><meta http-equiv=&quot;Content-Type&quot; content=&quot;text/html; charset=utf-8&quot; /><title>Countdown Clock</title><link href=&quot;https://web.logwork.com/cores/173/tpl/main/widget/countdown/css/flip.css&quot; id=&quot;stylesheet&quot; rel=&quot;stylesheet&quot;><style>body {font-family: sans-serif;padding: 0;margin: 0;}* {margin: 0;padding: 0;}.text{font-size: 44px;}.flipdown.flipdown__theme-dark .rotor-group-heading:before {color: }.days-before::before,.hours-before::before,.minutes-before::before,.seconds-before::before{content: attr(data-before);font-size: 1.9vw;font-weight: 400;color:  !important;}.flipdown.flipdown__theme-dark .rotor,.flipdown.flipdown__theme-dark .rotor-top,.flipdown.flipdown__theme-dark .rotor-leaf-front,.flipdown.flipdown__theme-dark .rotor-bottom,.flipdown.flipdown__theme-dark .rotor-leaf-rear{color: ;background-color: #007a4d;}.light-theme {color: }</style><style id=&quot;days_style&quot;></style><script src=&quot;https://web.logwork.com/cores/173/tpl/main/widget/countdown/js/flipdown.js&quot;></script></head><body><div id=&quot;js_countdown&quot; style=&quot;height:26vw;&quot;><div id=&quot;countdown&quot;><div class=&quot;text&quot;>Sắp sang năm mới rồi</div><div style='margin-top: 50px' id=&quot;flipdown&quot; class=&quot;flipdown&quot;></div></div></div><input type=&quot;hidden&quot; id=&quot;js_style&quot; value=&quot;flip&quot; /><input type=&quot;hidden&quot; id=&quot;js_language&quot; value=&quot;en&quot; /><input type=&quot;hidden&quot; id=&quot;js_date&quot; value=&quot;1672506000&quot; /><input type=&quot;hidden&quot; id=&quot;js_tz&quot; value=&quot;Europe/Madrid&quot; /><input type=&quot;hidden&quot; id=&quot;js_uid&quot; value=&quot;1&quot; /><script type=&quot;text/javascript&quot;>function downloadJSAtOnload(){var element = document.createElement(&quot;script&quot;);element.src = &quot;https://web.logwork.com/cores/173/tpl/main/widget/countdown/js/js.js&quot;;document.body.appendChild(element);}if (window.addEventListener)window.addEventListener(&quot;load&quot;, downloadJSAtOnload, false);else if (window.attachEvent)window.attachEvent(&quot;onload&quot;, downloadJSAtOnload);else window.onload = downloadJSAtOnload;</script></body>"
                        style="border: transparent; width: 100%; height: 420px;"></iframe>
                </div>
                <form class="box-input" method="post" action="{{ route('maintain') }}">
                    @csrf
                    <input type="text" name="code" value="" class="" placeholder="Enter code">
                    <button>Connect</button>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
