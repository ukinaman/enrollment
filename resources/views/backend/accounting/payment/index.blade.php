@extends('backend.layouts.app')

@section('content')
<div class="page-wrapper">
    <div class="container">
        <x-page-header title="Payments" buttonType="" buttonTitle="" routeName="" enrollee="0" />
        <div class="page-body">
          <div class="container">
            <x-student-information enrollmentId="{{ $enrollee->id }}"/>
            <div class="card">
              <div class="card-header">
                  <h3 class="card-title">Summary</h3>
              </div>
              <div class="card-body">
                {{-- <x-invoice /> --}}
                <div>
                  <table class="table table-bordered">
                    <thead>
                      <th colspan="2">For {{ $enrollee->mop_id == 1 ? 'Full Payment' : 'Down Payment' }}</th>
                      <th colspan="2">{{ $enrollee->mop_id == 1 ? 'Cash Discount' : 'Down Payment' }}</th>
                      <th>Amount</th>
                    </thead>
                    <tbody>
                      @foreach ($sem_fees as $sem_fee)
                        <tr>
                          <td>{{ $sem_fee->name }}</td>
                          <td class="amount">{{ number_format($sem_fee->getEnrolleeSumary($sem_fee->id, $enrollee->course_id, $sem_fee->name, $enrollee->id), 2) }}</td>
                          @if ( $enrollee->mop_id == 1)
                            <td>{{ $sem_fee->name == 'Tuition' ? $enrollee->getDiscount($enrollee->id)."%" : '' }}</td>
                          @else
                            <td></td>
                          @endif
                          @if ( $enrollee->mop_id == 1)
                            <td id="discount">{{ $sem_fee->getTotalDiscount($enrollee->id, $sem_fee->name) }}</td>
                          @else
                            <td></td>
                          @endif
                          <td class="totalAmount">
                            {{ number_format($sem_fee->getEnrolleeSummaryWithDiscount($sem_fee->id, $enrollee->course_id, $sem_fee->name, $enrollee->id), 2) }}
                          </td>
                        </tr>
                      @endforeach
                      <tr>
                        <td style="font-weight: bold;">Total</td>
                        <td id="amountText"></td>
                        <td></td>
                        <td id="discountText"></td>
                        <td style="border-bottom: 3px double; font-weight: bold;" id="totalText"></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
    <script>
      // A $( document ).ready() block.
      $( document ).ready(function() {
        calc_total_amount();
        calc_amount();
        calc_discount();
      });
      function calc_total_amount(){
        var sum = 0;
        $(".totalAmount").each(function(){
          sum += parseFloat($(this).text().replaceAll(',', ''));
        });
        $('#totalText').text(commaSeparateNumber(sum.toFixed(2)));
      }
      
      function calc_amount(){
        var sum = 0;
        $(".amount").each(function(){
          sum += parseFloat($(this).text().replaceAll(',', ''));
        });
        $('#amountText').text(commaSeparateNumber(sum.toFixed(2)));
      }

      function calc_discount(){
        var discount = (isNaN(parseFloat($("#discount").text().replaceAll(',', '')))) ? 0 : parseFloat($("#discount").text().replaceAll(',', ''));
        $('#discountText').text(commaSeparateNumber(discount.toFixed(2)));
      }

      function commaSeparateNumber(val){
        val = val.toString().replace(/,/g, ''); //remove existing commas first
        var valRZ = val.replace(/^0+/, ''); //remove leading zeros, optional
        var valSplit = valRZ.split('.'); //then separate decimals
      
        while (/(\d+)(\d{3})/.test(valSplit[0].toString())){
          valSplit[0] = valSplit[0].toString().replace(/(\d+)(\d{3})/, '$1'+','+'$2');
        }
      
        if(valSplit.length == 2){ //if there were decimals
         val = valSplit[0] + "." + valSplit[1]; //add decimals back
        }else{
          val = valSplit[0]; }
      
        return val;
      }
    </script>
@endsection