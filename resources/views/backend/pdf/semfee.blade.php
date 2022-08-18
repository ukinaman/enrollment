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
    <div class="table-container">
      {{-- Subjects --}}
      <table class="subjects-table table-1">
        <thead>
          <tr>
            <th>SUBJECTS</th>
            <th></th>
            <th>UNITS</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($subjects as $subject)
            <tr>
              <td>{{ $subject->code }}</td>
              <td>{{ $subject->name }}</td>
              <td>{{ $subject->units }}</td>
            </tr>
            @if($loop->last)
              <tr>
                <th>TOTAL</th>
                <th></th>
                <th>{{ $subject->getTotalUnits($course, $year, $sem) }}</th>
              </tr>
            @endif
          @endforeach
        </tbody>
      </table>
      {{-- Semestral Fees --}}
      <table class="subjects-table table-2">
        <thead>
          <tr>
            <th>SEMESTRAL FEES</th>
            <th class="amount-td">AMOUNT</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($sem_fees as $sem_fee)
            <tr style="font-weight: bold">
              <td>{{ $sem_fee->name }}</td>
              <td class="amount-td">{{ $sem_fee->total($sem_fee->id, $course, $year, $sem) }}</td>
            </tr>
            @foreach ($sem_fee->fees as $fee)
              <tr>
                <td>{{ $fee->name == "Tuition" ? $fee->name.'/units' : $fee->name }}</td>
                <td class="amount-td">{{ number_format($fee->amount, 2) }}</td>
              </tr>
            @endforeach
            @if($loop->last)
              <tr>
                <th>TOTAL</th>
                <th class="amount-td">{{ number_format($sem_fee->getOverallTotal($course, $year, $sem), 2) }}</th>
              </tr>
            @endif
          @endforeach
        </tbody>
      </table>
      {{-- Full Payment --}}
      <table class="subjects-table table-3">
        <thead>
          <tr>
            <th colspan="2">FULL PAYMENT</th>
            <th colspan="2">CASH DISCOUNT</th>
            <th class="amount-td">AMOUNT</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($sem_fees as $sem_fee)
            <tr>
              <td>{{ $sem_fee->name }}</td>
              <td>{{ $sem_fee->total($sem_fee->id, $course, $year, $sem) }}</td>
              <td>{{ $sem_fee->id == 1 ? $sem_fee->getDiscountPercentage().'%' : '' }}</td>
              <td>{{ $sem_fee->id == 1 ? number_format($sem_fee->getTotalDiscount($sem_fee->getDiscountPercentage(), $sem_fee->id, $course, $year, $sem), 2) : '' }}</td>
              <td class="amount-td">{{ $sem_fee->overallAmount($sem_fee->getDiscountPercentage(), $sem_fee->id, $course, $year, $sem) }}</td>
            </tr>
            @if($loop->last)
              <tr>
                <th colspan="4">TOTAL TF, SF, & EF FOR FULL PAYMENT</th>
                <th class="amount-td">{{ number_format($sem_fee->getOverAllTotalWithDiscount($sem_fee->getDiscountPercentage(), $sem_fee->id, $course, $year, $sem), 2) }}</th>
              </tr>
            @endif
          @endforeach
        </tbody>
      </table>
      {{-- Downpayment --}}
      <table class="subjects-table table-3">
        <thead>
          <tr>
            <th colspan="2">FOR INSTALLMENT BASIS</th>
            <th colspan="2">DOWN PAYMENT</th>
            <th class="amount-td">AMOUNT</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($sem_fees as $sem_fee)
            <tr>
              <td>{{ $sem_fee->name }}</td>
              <td>{{ $sem_fee->total($sem_fee->id, $course, $year, $sem) }}</td>
              <td colspan="2">{{ $sem_fee->downpaymentSumarry($sem_fee->id, $course, $year, $sem) }}</td>
              <td class="amount-td">{{ $sem_fee->getDownpaymentOverallTotal($sem_fee->id, $course, $year, $sem) }}</td>
              {{-- <td class="amount-td">{{ $sem_fee->isLessThan5K($sem_fee->id, $course, $year, $sem) }}</td> --}}
            </tr>
            @if($loop->last)
              <tr>
                <th>TOTAL</th>
                <th>{{ number_format($sem_fee->getOverallTotal($course, $year, $sem), 2) }}</th>
                <th colspan="2">{{ number_format($sem_fee->getTotalDownpayment($sem_fee->id, $course, $year, $sem), 2) }}</th>
                <th class="amount-td">{{ number_format($sem_fee->getDownpaymentOverallAmount($course, $year, $sem), 2) }}</th>
              </tr>
              <tr>
                <th colspan="4">DIVIDED BY 3 TERMS</th>
                <th class="amount-td">/3</th>
              </tr>
              <tr>  
                <th colspan="4">PER TERM (before every exam period)</th>
                <th class="amount-td">{{ number_format($sem_fee->getPerTermAmount($course, $year, $sem), 2) }}</th>
              </tr>
            @endif
          @endforeach
        </tbody>
      </table>
    </div>
</body>
</html>