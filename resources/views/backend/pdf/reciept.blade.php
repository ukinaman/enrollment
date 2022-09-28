<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title></title>
  <style>
    *{
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }
    .pdf-container{
      width: 8.5in;
      padding: 2rem;
    }
    .info-container{
      margin: 1.5rem 0rem; 
    }
    .table-container{
      width: 90%;
    }
    table, td, th {
      border: 1px solid;
      text-align: left;
      padding: 5px;
    }
    .subjects-table{
      font-size: .8rem;
      border-collapse: collapse;
    }
    .table-1{
      width: 50%;
      float: left;
    }
    .table-2{
      width: 50%;
      float: right;
    }
    .table-3{
      width: 100%;
      clear: both;
      border: none;
      margin-top: 1em!important;
    }
    .amount-td{
      text-align: right!important;
    }
    .info{
      font-weight: bold;
    }
  </style>
</head>
<body>
  <div class="pdf-container">
    <div class="container">
      <div class="logo-wrapper"></div>
      <div class="heading-wrapper">
        <h1 class="text-primary">CANOSSA COLLEGE</h1>
          <p>Lakeside Park Subdivision</p>
          <p>San Pablo City, Laguna 4000</p>
          <p>Telefax: 049 5623890 to 91</p>
          <p>Website: www..canossacollege.edu.ph</p>
      </div>
    </div>
    <div class="info-container">
      <p class="course-name info">{{ $course_name }}</p>
      <br>
      <p class="info">{{ $year_sem }}</p>
      <p class="info">{{ 'S.Y.'.' '.$school_year }}</p>
    </div>
    <h3>No.{{ $or_number }}</h3>
    <div class="table-container">
      {{-- Reciept --}}
      @if (!$enrollee->isFullOfPayment($enrollee->mop_id))
      <table class="subjects-table table-3">
        <thead>
          <tr>
            <th>{{ $enrollee->getFullName($enrollee->id, 2) }}</th>
            <th class="amount-td">{{ $enrollee->getCourse($enrollee->course_id, 'acc') }}</th>
          </tr>
          <tr>
            <th>{{ $enrollee->getMop() }}</th>
            <th class="amount-td">{{ $payment->getPaymentDate($payment->created_at) }}</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>
              <p style="text-align: center;"> - - - Particulars - - -</p>
              <p>{{ $payment->term }}</p>
            </td>
            <td>
              <p style="text-align: center;"> - - - Amount - - -</p>
              <p class="amount-td">{{ number_format($payment->amount, 2) }}</p>
            </td>
          </tr>
          <tr>
            <td>
              <p style="font-weight: bold">TOTAL</p>
            </td>
            <td class="amount-td" style="font-weight: bold">{{ number_format($payment->amount, 2) }}</td>
          </tr>
        </tbody>
      </table>
      @else
        <table class="subjects-table table-3">
          <thead>
            <tr>
              <th>{{ $enrollee->getFullName($enrollee->id, 2) }}</th>
              <th class="amount-td">{{ $enrollee->getCourse($enrollee->course_id, 'acc') }}</th>
            </tr>
            <tr>
              <th>{{ $enrollee->getMop() }}</th>
              <th class="amount-td">{{ $payment->getPaymentDate($payment->created_at) }}</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>
                <p style="text-align: center;"> - - - Particulars - - -</p>
                @foreach ($sem_fees as $sem_fee)
                  <p>{{ $sem_fee->name }}</p>
                @endforeach
              </td>
              <td>
                <p style="text-align: center;"> - - - Amount - - -</p>
                @foreach ($sem_fees as $sem_fee)
                  <p class="amount-td">{{ $enrollee->enrolleeFeesAmountWithDiscount($sem_fee->id, $enrollee->id) }}</p>
                @endforeach
                <hr>
                <p style="width: 100%">
                  <span>Total</span>
                  <span style="float: right">{{ number_format($enrollee->enrolleeOverallTotal($enrollee->id), 2) }}</span>
                </p>
              </td>
            </tr>
            <tr>
              <td>
                <p style="float: left">Discount</p>
                <p style="float: right">{{ $enrollee->getEnrolleeDiscountPercentage($enrollee->id) }}%</p>
              </td>
              <td class="amount-td">{{ number_format($enrollee->getEnrolleeDiscountTotal($enrollee->id), 2) }}</td>
            </tr>
            <tr>
              <td>
                <p style="font-weight: bold">TOTAL</p>
              </td>
              <td class="amount-td" style="font-weight: bold">{{ number_format($enrollee->enrolleeOverallTotalWithDiscount($enrollee->id), 2) }}</td>
            </tr>
          </tbody>
        </table>
      @endif
      <div class="info-container">
        <h4 style="font-size: 24px">Payment method: {{ $payment->payment_method }}</h4>
      </div>
    </div>
</body>
</html>