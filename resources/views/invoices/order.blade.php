<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <style>
       body {
        width: 750px;
        color: #010101; /* Set text color */
        font-family: sans-serif; /* Set font family */
				padding-right: 10px;
				padding-left: 10px;
				border: 1px solid red;
      }
      .header-details {
        display: block;
      }
      .pummys-logo {
        height: 60px; /* Assuming 1rem is equivalent to 10px */
        margin-bottom: 0.5rem; /* Assuming 1rem is equivalent to 10px */
        margin-top: 0.5rem;
      }
      .header-contact {
        margin-top: 70px;
        margin-bottom: 70px;
      }
      .header-address {
        margin-bottom: 10px;
      }
      .order-date {
        display: block;
        position: absolute;
        left: 520px;
        top: 20px;
      }
      .order-description {
        margin-bottom: 50px;
        font-size: 14px;
      }

      .order-text {
        font-size: 20px;
      }
      .date {
        display: block;
        font-size: 13px;
      }
      table {
        border-collapse: collapse;
				font-family: sans-serif;
      }
      .table-header th,
      .table-body {
        border-bottom: 1px solid black;
      }
      .table-header th {
        font-size: 14px;
        padding: 3px 6px; /* Add padding to create space between the text and the bottom border */
      }

      .address {
        text-decoration: underline;
        font-size: 10px;
      }
      .client-details {
        display: block;
        font-size: 14px;
      }
      .table {
        min-width: 745px;
      }

      .table-body {
        border-top: 1px solid black;
				font-family: sans-serif;
      }

      .table-body tr td {
        padding: 8px;
        font-weight: 500;
        font-size: 15px;
        text-align: center;
      }
      .product-description {
        width: fit-content;
        text-align: center;
        font-size: 15px;
      }

      .order-extra-info {
        margin-top: 100px;
        font-size: 14px;
      }

      .total-price {
        display: block;
        width: 745px;
        margin-left: 5px;
        margin-top: 10px;
        font-weight: 600;
      }
      .price {
        margin-left: 547px;
      }
      .footer {
        margin-top: 240px;
        display: block;
        border-top: 1px dashed black;
        /* font-weight: 700; */
      }
      .address-details,
      .bank-details {
        display: block;
        font-size: 14px;
      }
      .product-description-header {
        text-align: left;
        padding-left: 10px;
      }
    </style>
  </head>
  <body>
    @php
        $amount = 0;
    @endphp
    <header>
      <div class="header-details">
        <img
          class="pummys-logo"
          src="https://aion-returnsportal.s3.eu-central-1.amazonaws.com/store/798220d2b0b739309db7cd5bc117e61b.png"
        />
        <div class="order-date">
          <span class="order-text"> Rechnung {{ $order_name }} </span>
          <div class="date">
            <span> Bestelldatum: </span>
            <span> {{ $created_at }} </span>
          </div>
        </div>
      </div>
      <div class="header-contact">
        <div class="header-address">
          <span class="address">Dieseo GmbH, Sophienblatt 40, 24103 Kiel</span>
        </div>
        <div class="client-details">
          <div>{{ $billing_address['first_name'] }} {{ $billing_address['last_name']  }}</div>
          <div>{{ $billing_address['address1'] }} {{ $billing_address['address2'] }}</div>
          <div>{{ $billing_address['zip'] }}, {{ $billing_address['city'] }}</div>
        </div>
      </div>
    </header>
    <main>
      <div class="order-description">
        <span
          >Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam
          nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat
          volutpat. Ut wisi enim ad minim veniam, quis
        </span>
      </div>
      <div>
        <table class="table">
          <tr class="table-header">
            <th>Pos.</th>
            <th class="product-description-header">Bezeichnung</th>
            <th style="margin-left: 5px; margin-right: 5px">Menge</th>
            <th>Einheit</th>
            <th>Einzel €</th>
            <th>Rabatt %</th>
            <th>Gesamt €</th>
          </tr>
          <tbody class="table-body">
            @foreach ($line_items as $index => $item)
            @php
                $total = ($item['price'] - $item['total_discount']) > 0 ? ($item['price'] - $item['total_discount']) : 0;
                $amount += $total;
            @endphp
            <tr>
              <td>{{ $index + 1 }}</td>
              <td class="product-description">
                {{ $item['name'] }}
              </td>
              <td>{{ $item['quantity'] }}</td>
              <td>Stück</td>
              <td>{{ $item['price'] }} </td>
              <td>{{ $item['total_discount']}}</td>
              <td>{{ $total }} </td>
            </tr>
            @endforeach

          </tbody>
        </table>
        <div class="total-price">
          <span> Gesamtbetrag* </span>
          <span class="price"> {{ $amount }} </span>
        </div>
      </div>
      <div class="order-extra-info">
        Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam
        nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat
        volutpat. Ut wisi enim ad minim veniam, quis
      </div>
    </main>
    <footer class="footer">
      <div class="address-details" style="float: left">
        <div>Dieseo GMBH</div>
        <div>Sophienblatt 40</div>
        <div>24103 Kiel</div>
      </div>
      <div
        style="
          float: left;
          margin-left: 70px;
          margin-right: 70px;
          font-size: 14px;
        "
      >
        <div>Steuernummer: 20/292/53366</div>
      </div>
      <div class="bank-details" style="float: left">
        <div>dieseo GMBH</div>
        <div>Commerzbank</div>
        <div>IBAN: DE18 2104 0010 0718 8949 05</div>
        <div>BIC: COBADEFFXXX</div>
      </div>
      <div style="clear: both"></div>
    </footer>
  </body>
</html>
