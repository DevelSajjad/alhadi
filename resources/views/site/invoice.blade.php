<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice</title>
    <link rel="stylesheet" href="{{ asset('assets/frontend/plugins/bootstrap/dist/css/bootstrap.min.css') }}">
    {{-- bootstrap 5 --}}
    <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>
<body>
    <section class="">
        <div class="container mt-5">
            <div class="row g-5 border-bottom">
                <div class="col-xs-8 col-sm-8 col-lg-8 ">
                    <div class="m-0">
                        <img width="50%" src="{{asset('assets/images/logo_long.jpg')}}" alt="">
                    </div>
                    <div class="mt-5">
                        <h2 class="fw-bold"> Touch & Solve Technologies Limited</h2>
                        <h4>Company ID : C-172940</h4>
                        <h4>Tax ID : 849776384956</h4>
                        <h4>House: # 202, 3rd Floor, Road: 3/A, Block: B Sagupta Housing Society Pallabi, Mirpur -12, Dhaka- 1216</h4>
                        <h4>Web: www.touchandsolve.com, E:sales@touchandsolve.com</h4>
                        <h4>Dhaka, Bangladesh</h4>
                    </div>
                </div>
                <div class="col-xs-4 col-sm-4 text-end">
                    <h1 class="fw-bold mt-4">Invoice</h1>
                   <h2># INV-000003</h2>
                   <h4 class="mt-3">Balance Due</h4>
                   <h2>BDT34,500.00</h2>
                </div>
            </div>
        </div>
    </section>

    <section class="mt-5">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <p class="fs-4">To</p>
                    <h4>Lucid Health Care</h4>
                    <p class="fs-4">Rahman Lucid Tower wing -1 Level -2 19/3 Kakrail area Dhaka, 1000</p>
                </div>
                <div class="col-sm-6 text-end">
                    <p class="fs-4"><span class="fw-bold">Invoice Date :</span> 31 Jul 2022</p>
                    <p class="fs-4"><span class="fw-bold">Terms : </span>Due on Receipt</p>
                    <p class="fs-4"><span class="fw-bold">Due Date :</span> 31 Jul 2022</p>
                </div>
            </div>
        </div>
    </section>
    <section class="mt-5">
        <div class="container">
            <div class="row border-bottom">
                <div class="col-sm-12 table-responsive">
                    <table class="table  border-light">
                        <thead>
                          <tr class="bg-secondary text-light fs-2">
                            <th scope="col">#</th>
                            <th scope="col" class="">Item & Description</th>
                            <th scope="col"> Qty</th>
                            <th scope="col"> Rate</th>
                            <th scope="col"> Amount</th>
                          </tr>
                        </thead>
                        <tbody class="fs-3">
                          <tr>
                            <th scope="row">1</th>
                            <td>Kstar 3KVA Online HP Series 930</td>
                            <td>1.00</td>
                            <td>52,60,010.00</td>
                            <td>52,60,010.00</td>
                          </tr>
                          <tr>
                            <th scope="row">2</th>
                            <td>High Frequency And Double Conversion Online Technology</td>
                            <td></td>
                            <td></td>
                          </tr>
                          <tr>
                            <th scope="row">3</th>
                            <td colspan="2">Fully Digitized Microprocessor Control</td>
                            <td></td>
                            <td></td>
                          </tr>
                          <tr>
                            <th scope="row">4</th>
                            <td colspan="2">Wide Input Voltage Range</td>
                            <td></td>
                            <td></td>
                          </tr>
                          <tr>
                            <th scope="row">5</th>
                            <td colspan="2">LCD Display</td>
                            <td></td>
                            <td></td>
                          </tr>
                          <tr>
                            <th scope="row">6</th>
                            <td colspan="2">UPS Start-Up Without Battery HP930C</td>
                            <td></td>
                            <td></td>
                          </tr>
                          <tr>
                            <th scope="row">7</th>
                            <td colspan="2">Cold Start</td>
                            <td></td>
                            <td></td>
                          </tr>
                          <tr>
                            <th scope="row">8</th>
                            <td colspan="2">Advanced Battery Management</td>
                            <td></td>
                            <td></td>
                          </tr>
                          <tr>
                            <th scope="row">9</th>
                            <td colspan="2">Load Capacity Display</td>
                            <td></td>
                            <td></td>
                          </tr>
                          <tr>
                            <th scope="row">10</th>
                            <td colspan="2">Battery Voltage Display</td>
                            <td></td>
                            <td></td>
                          </tr>
                          <tr>
                            <th scope="row">11</th>
                            <td colspan="2">Optional Extension Battery Pack</td>
                            <td></td>
                            <td></td>
                          </tr>
                          <tr>
                            <th scope="row">12</th>
                            <td colspan="2">Network/Fax/Modem Surge Protection</td>
                            <td></td>
                            <td></td>
                          </tr>
                          <tr>
                            <th scope="row">13</th>
                            <td colspan="2">Fan Speed Adjusted By Load Automatically</td>
                            <td></td>
                            <td></td>
                          </tr>
                          <tr>
                            <th scope="row">14</th>
                            <td colspan="2">Short Circuit And Overload Protection</td>
                            <td></td>
                            <td></td>
                          </tr>
                          <tr>
                            <th scope="row">15</th>
                            <td colspan="2">Lightning And Surge Protection</td>
                            <td></td>
                            <td></td>
                          </tr>
                          <tr>
                            <th scope="row">16</th>
                            <td colspan="2">Automatic Battery Charging In UPS Off Mode</td>
                            <td></td>
                            <td></td>
                          </tr>
                          <tr>
                            <th scope="row">17</th>
                            <td colspan="2">Automatic Battery Charging In UPS Off Mode</td>
                            <td></td>
                            <td></td>
                          </tr>
                          <tr>
                            <th scope="row">18</th>
                            <td colspan="2">Input L And N Reversed Alarm Function</td>
                            <td></td>
                            <td></td>
                          </tr>
                          <tr>
                            <th scope="row">19</th>
                            <td colspan="2">EPO Function (Optional)</td>
                            <td></td>
                            <td></td>
                          </tr>
                          <tr>
                            <th scope="row">20</th>
                            <td colspan="2">Optional SNMP Card Slot</td>
                            <td></td>
                            <td></td>
                          </tr>
                          <tr>
                            <th scope="row">21</th>
                            <td colspan="2">Smart RS232 Communication With Monitoring Software</td>
                            <td></td>
                            <td></td>
                          </tr>
                          <tr>
                            <th scope="row">21</th>
                            <td colspan="2">EMI/RFI Noise Filter</td>
                            <td></td>
                            <td></td>
                          </tr>
                        </tbody>
                      </table>
                </div>
            </div>
        </div>
    </section>

    <section class="mt-3">
      <div class="container text-end">
        <div class="row">
          <div class="col-sm-12">
            <p class="fs-4"><span class="fw-bold me-5"> Sub Total</span>34,500.00</p>
            <p class="fs-4"><span class="fw-bold me-5"> Total BDT</span>34,500.00</p>
            <p class="fs-4"><span class="fw-bold me-5"> Balance Due</span> BDT34,500.00</p>
          </div>
        </div>
      </div>
    </section>
    <section class="mt-5 ">
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <p class="fs-4 fw-bold"> Notes</p>
            <p class="fs-4">Thanks for your business.</p>
            <p class="fs-4 fw-bold">Terms & Conditions</p>
            <p class="fs-4">For Terms & Conditions Please visit: <a target="_blank" class="text-decoration-none" href="https://www.touchandsolve.com/#/">Touch and Solve Terms & Conditions</a></p>
          </div>
        </div>
      </div>
    </section>
    <section class="mt-5 mb-5 pb-5">
      <div class="container">
        <div class="row">
          <div class="col-sm-3 me-5">
            <p class="fs-4 fw-bold border-bottom">Authorized Signature</p>
          </div>
          <div class="col-sm-3 ">
            <p class="fs-4 fw-bold border-bottom"> Receiver Signature</p>
          </div>
        </div>
      </div>
    </section>
</body>
</html>