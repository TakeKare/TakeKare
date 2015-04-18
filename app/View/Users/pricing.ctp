<!DOCTYPE html>
<html>

<head>

<meta charset="UTF-8">

<!--
Copyright (c) 2014 by Vivek kumar (http://codepen.io/vivek-kumar/pen/KoLwz)

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
-->

<title>Flat Pricing table - CodePen</title>

<style>
    /*
  Inspired by the dribble shot http://dribbble.com/shots/1285240-Freebie-Flat-Pricing-Table?list=tags&tag=pricing_table
  */

    /*--------- Font ------------*/
    @import url(http://fonts.googleapis.com/css?family=Droid+Sans);
    @import url(http://weloveiconfonts.com/api/?family=fontawesome);
    /* fontawesome */
    [class*="fontawesome-"]:before {
        font-family: 'FontAwesome', sans-serif;
    }
    * {
        margin: 0;
        padding: 0;
        border: 0;
        font-size: 100%;
        font: inherit;
        vertical-align: baseline;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
    }
    /*------ utiltity classes -----*/
    .fl{ float:left; }
    .fr{ float: right; }
    /*its also known as clearfix*/
    .group:before,
    .group:after {
        content: "";
        display: table;
    }
    .group:after {
        clear: both;
    }
    .group {
        zoom: 1;  /*For IE 6/7 (trigger hasLayout) */
    }

    body {
        background: #F2F2F2;
        font-family: 'Droid Sans', sans-serif;
        line-height: 1;
        font-size: 16px;
    }
    .wrapper {

    }
    .pricing-table {
        width: 80%;
        margin: 50px auto;
        text-align: center;
        padding: 10px;
        padding-right: 0;
    }
    .pricing-table .heading{
        color: #9C9E9F;
        text-transform: uppercase;
        font-size: 1.3rem;
        margin-bottom: 4rem;
    }
    .block{
        width: 30%;
        margin: 0 15px;
        overflow: hidden;
        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;
        border-radius: 5px;
        /*    border: 1px solid red;*/
    }
    /*Shared properties*/
    .title,.pt-footer{
        color: #FEFEFE;
        text-transform: capitalize;
        line-height: 2.5;
        position: relative;
    }
    .content{
        position: relative;
        color: #FEFEFE;
        padding: 20px 0 10px 0;
    }
    /*arrow creation*/
    .content:after, .content:before,.pt-footer:before,.pt-footer:after {
        top: 100%;
        left: 50%;
        border: solid transparent;
        content: " ";
        height: 0;
        width: 0;
        position: absolute;
        pointer-events: none;
    }
    .pt-footer:after,.pt-footer:before{
        top:0;
    }
    .content:after,.pt-footer:after {
        border-color: rgba(136, 183, 213, 0);
        border-width: 5px;
        margin-left: -5px;
    }
    /*/arrow creation*/
    .price{
        position: relative;
        display: inline-block;
        margin-bottom: 0.625rem;
    }
    .price span{
        font-size: 6rem;
        letter-spacing: 8px;
        font-weight: bold;
    }
    .price sup{
        font-size: 1.5rem;
        position: absolute;
        top: 12px;
        left: -12px;
    }
    .hint{
        font-style: italic;
        font-size: 0.9rem;
    }
    .features{
        list-style-type: none;
        background: #FFFFFF;
        text-align: left;
        color: #9C9C9C;
        padding:30px 22%;
        font-size: 0.9rem;
    }
    .features li{
        padding:15px 0;
        width: 100%;
    }
    .features li span{
        padding-right: 0.4rem;
    }
    .pt-footer{
        font-size: 0.95rem;
        text-transform: capitalize;
    }
    /*PERSONAL*/
    .personal .title{
        background: #78CFBF;
    }
    .personal .content,.personal .pt-footer{
        background: #82DACA;
    }
    .personal .content:after{
        border-top-color: #82DACA;
    }
    .personal .pt-footer:after{
        border-top-color: #FFFFFF;
    }
    /*PROFESSIONAL*/
    .professional .title{
        background: #3EC6E0;
    }
    .professional .content,.professional .pt-footer{
        background: #53CFE9;
    }
    .professional .content:after{
        border-top-color: #53CFE9;
    }
    .professional .pt-footer:after{
        border-top-color: #FFFFFF;
    }
    /*BUSINESS*/
    .business .title{
        background: #E3536C;
    }
    .business .content,.business .pt-footer{
        background: #EB6379;
    }
    .business .content:after{
        border-top-color: #EB6379;
    }
    .business .pt-footer:after {
        border-top-color: #FFFFFF;
    }
</style>

<script>
    window.console = window.console || function(t) {};
    window.open = function(){ console.log('window.open is disabled.'); };
    window.print = function(){ console.log('window.print is disabled.'); };
    // Support hover state for mobile.
    if (false) {
        window.ontouchstart = function(){};
    }
</script>

</head>

<body>

<body>
<div class="wrapper">
    <!-- PRICING-TABLE CONTAINER -->
    <div class="pricing-table group">
        <h1 class="heading" style="vertical-align: middle">
            <?=$this->Html->image('logo.png', array('style' => 'vertical-align: middle'))?> <span style="vertical-align: middle">Pricing overview</span>
        </h1>
        <!-- PERSONAL -->
        <div class="block personal fl">
            <h2 class="title">Month By Month</h2>
            <!-- CONTENT -->
            <div class="content">
                <p class="price">
                    <sup>$</sup>
                    <span>97</span>
                    <sub>/mth</sub>
                </p>
                <p class="hint">&nbsp;</p>
            </div>
            <!-- /CONTENT -->
            <!-- FEATURES -->
            <ul class="features">
                <li><span class="fontawesome-dashboard"></span>20 Stores</li>
                <li><span class="fontawesome-cog"></span>Unlimited Analytics</li>
                <li><span class="fontawesome-star"></span>Managed Cloud Hosting</li>
                <li><span class="fontawesome-dashboard"></span>Unlimited Tech Support</li>
                <li>&nbsp;</li>
                <li>&nbsp;</li>
                <li>&nbsp;</li>
                <li>&nbsp;</li>
            </ul>
            <!-- /FEATURES -->
            <!-- PT-FOOTER -->
            <div class="pt-footer">
                <p>Sing Up</p>
            </div>
            <!-- /PT-FOOTER -->
        </div>
        <!-- /PERSONAL -->
        <!-- PROFESSIONAL -->
        <div class="block professional fl">
            <h2 class="title">6 Months</h2>
            <!-- CONTENT -->
            <div class="content">
                <p class="price">
                    <sup>$</sup>
                    <span>549</span>
                </p>
                <p class="hint">$91.50/mth</p>
            </div>
            <!-- /CONTENT -->
            <!-- FEATURES -->
            <ul class="features">
                <li><span class="fontawesome-cog"></span>20 Stores</li>
                <li><span class="fontawesome-cog"></span>Unlimited Analytics</li>
                <li><span class="fontawesome-star"></span>Managed Cloud Hosting</li>
                <li><span class="fontawesome-dashboard"></span>Unlimited Tech Support</li>
                <li><span class="fontawesome-cloud"></span>Industry Wide Reports</li>
                <li><span class="fontawesome-cog"></span>Trend Analysis</li>
                <li>&nbsp;</li>
                <li>&nbsp;</li>
            </ul>
            <!-- /FEATURES -->
            <!-- PT-FOOTER -->
            <div class="pt-footer">
                <p>Sing Up</p>
            </div>
            <!-- /PT-FOOTER -->
        </div>
        <!-- /PROFESSIONAL -->
        <!-- BUSINESS -->
        <div class="block business fl">
            <h2 class="title">12 Months</h2>
            <!-- CONTENT -->
            <div class="content">
                <p class="price">
                    <sup>$</sup>
                    <span>999</span>
                </p>
                <p class="hint">$83.25/mth</p>
            </div>
            <!-- /CONTENT -->

            <!-- FEATURES -->
            <ul class="features">
                <li><span class="fontawesome-dashboard"></span>100 Stores</li>
                <li><span class="fontawesome-cog"></span>Unlimited Analytics</li>
                <li><span class="fontawesome-star"></span>Managed Cloud Hosting</li>
                <li><span class="fontawesome-dashboard"></span>Unlimited Tech Support</li>
                <li><span class="fontawesome-cloud"></span>Industry Wide Reports</li>
                <li><span class="fontawesome-cog"></span>Trend Analysis</li>
                <li><span class="fontawesome-star"></span>Store Mapping</li>
                <li><span class="fontawesome-dashboard"></span>Insights</li>
            </ul>
            <!-- /FEATURES -->

            <!-- PT-FOOTER -->
            <div class="pt-footer">
                <p>Sing Up</p>
            </div>
            <!-- /PT-FOOTER -->
        </div>
        <!-- /BUSINESS -->
    </div>
    <!-- /PRICING-TABLE -->

</div>


<p style="text-align: center; padding-bottom: 2em">
    <a href="<?=Router::url(['action' => 'login'])?>" style="color: #2a6496">Sign In</a>
</p>

<script>
    if (document.location.search.match(/type=embed/gi)) {
        window.parent.postMessage('resize', "*");
    }
</script>

</body>
</html>
