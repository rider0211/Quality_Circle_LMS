
<style>
    .clearfix:after {
        content: "";
        display: table;
        clear: both;
    }

    a {
        color: #0087C3;
        text-decoration: none;
    }

    body {
        position: relative;
        width: 21cm;  
        height: 29.7cm; 
        margin: 0 auto; 
        color: #555555;
        background: #FFFFFF; 
        font-family: Arial, sans-serif; 
        
    }
    .content-body{
        font-size: 14px; 
        font-family: SourceSansPro;
    }

    header {
        padding: 10px 0;
        margin-bottom: 20px;
        border-bottom: 1px solid #AAAAAA;
    }

    #logo {
        float: left;
        margin-top: 8px;
    }

    #logo img {
        height: 70px;
    }

    #company {
        float: right;
        text-align: right;
    }


    #details {
        margin-bottom: 50px;
    }

    #client {
        padding-left: 6px;
        border-left: 6px solid #0087C3;
        float: left;
    }

    #client .to {
        color: #777777;
    }

    h2.name {
        font-size: 1.4em;
        font-weight: normal;
        margin: 0;
    }

    #invoice {
        float: right;
        text-align: right;
    }

    #invoice h1 {
        color: #0087C3;
        font-size: 2.4em;
        line-height: 1em;
        font-weight: normal;
        margin: 0  0 10px 0;
    }

    #invoice .date {
        font-size: 1.1em;
        color: #777777;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        border-spacing: 0;
        margin-bottom: 20px;
    }

    table th, table td {
        padding: 13px;
        background: #EEEEEE;
        text-align: center;
        border-bottom: 1px solid #FFFFFF;
    }

    table th {
        white-space: nowrap;        
        font-weight: normal;
    }

    table td {
        text-align: right;
    }

    table td h3{
        color: #57B223;
        font-size: 1.2em;
        font-weight: normal;
        margin: 0 0 0.2em 0;
    }

    table .no {
        color: #FFFFFF;
        font-size: 1.6em;
        background: #57B223;
    }

    table .desc {
        text-align: left;
    }

    table .unit {
        background: #DDDDDD;
    }

    table .qty {
    }

    table .total {
        background: #57B223;
        color: #FFFFFF;
    }

    table td.unit,
    table td.qty,
    table td.total {
        font-size: 1.2em;
    }

    table tbody tr:last-child td {
        border: none;
    }

    table tfoot td {
        padding: 10px 20px;
        background: #FFFFFF;
        border-bottom: none;
        font-size: 1.2em;
        white-space: nowrap; 
        border-top: 1px solid #AAAAAA; 
    }

    table tfoot tr:first-child td {
        border-top: none; 
    }

    table tfoot tr:last-child td {
        color: #57B223;
        font-size: 1.4em;
        border-top: 1px solid #57B223; 

    }

    table tfoot tr td:first-child {
        border: none;
    }

    #thanks{
        font-size: 2em;
        margin-bottom: 50px;
    }

    #notices{
        padding-left: 6px;
        border-left: 6px solid #0087C3;  
    }

    #notices .notice {
        font-size: 1.2em;
    }

    footer {
        color: #777777;
        width: 100%;
        height: 30px;
        position: absolute;
        bottom: 0;
        border-top: 1px solid #AAAAAA;
        padding: 8px 0;
        text-align: center;
    }
    .inner-wrapper{
        min-height:0px !important;
        padding-top: 50px !important;
    }
</style>

<section role="main" class="content-body" style="margin-left:0px; padding-top 75px;">
    <header class="clearfix">
      <div id="logo">
        <img src="<?= base_url()?>assets/images/logo.png">
      </div>
      <div id="company">
        <h2 class="name"><?= $term['companyname']?></h2>
        <div><?= $invoice->company_name?></div>
        <div><?= $invoice->phone?></div>
        <div><a href="<?= base_url() . "company/". $invoice->url ?>"><?=$invoice->url ?></a></div>
      </div>
      </div>
    </header>
    <main style ="padding:20px">
      <div id="details" class="clearfix">
        <div id="client">
          <div class="to">INVOICE TO:</div>
          <h2 class="name"><?=$user["name"]?></h2>
          <div class="address"><?=$user['phone']?></div>
          <div class="email"><a href="mailto:<?=$user['email'] ?>"><?=$user['email'] ?></a></div>
        </div>
        <div id="invoice">
          <h1>INVOICE <?=$invoice->id?></h1>
          <div class="date">Date of Invoice: <?= date("Y/m/d", strtotime($invoice->pay_date))?></div>
          <!-- <div class="date">Due Date: 30/06/2014</div> -->
        </div>
      </div>
      <table border="0" cellspacing="0" cellpadding="0">
        <thead>
          <tr>
            <th class="no">#</th>
            <th class="desc">DESCRIPTION</th>
            <th class="unit">PAYMENT METHOD</th>
            <th class="qty">QUANTITY</th>
            <th class="qty">COMPANY NAME</th>
            <th class="total">TOTAL</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="no">01</td>
            <td class="desc"><h3><?= $invoice->payment_title?></h3><?= $invoice->description?></td>
            <td class="unit"><?= $invoice->payment_method?></td>
            <td class="qty">1</td>
            <td class="qty"><?= $invoice->company_name?></td>
            <td class="total">$<?=$invoice->amount?></td>
          </tr>
        </tbody>
        <tfoot>
          <tr>
            <td colspan="3"></td>
            <td colspan="2">PRICE</td>
            <td>$<?= $invoice->price?></td>
          </tr>
          <tr>
            <td colspan="3"></td>
            <td colspan="2">DISCOUNT(<?= $invoice->discount?>%)</td>
            <td>-$<?= $invoice->price * ($invoice->discount/100)?></td>
          </tr>
          <tr>
            <td colspan="3"></td>
            <td colspan="2">SUBTOTAL</td>
            <td>$<?= $invoice->price * (100 - $invoice->discount)/100?></td>
          </tr>
          <tr>
            <td colspan="3"></td>
            <td colspan="2">TAX <?= $invoice->tax_type=='1'? '$':''?><?=$invoice->tax_rate?><?= $invoice->tax_type=='0'? '(%)':''?></td>
            <td>$<?php 
              if($invoice->tax_type == '1'){
                echo $invoice->price * (100 - $invoice->discount)/100 + $invoice->tax_rate;
              }else{
                echo ($invoice->price * (100 - $invoice->discount)/100) * $invoice->tax_rate/100;
              }
            ?></td>
          </tr>
          <tr>
            <td colspan="3"></td>
            <td colspan="2">GRAND TOTAL</td>
            <td>$<?= $invoice->amount?></td>
          </tr>
        </tfoot>
      </table>
      <div id="thanks">Thank you!</div>
      <!-- <div id="notices">
        <div>NOTICE:</div>
        <div class="notice">A finance charge of 1.5% will be made on unpaid balances after 30 days.</div>
      </div> -->
    </main>
    <footer>
      Invoice was created on a computer and is valid without the signature and seal.
    </footer>
</section>