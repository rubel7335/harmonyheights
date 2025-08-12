
<div id="dataContainer" class="row" >
<button id="printPdfButton">Print as PDF</button>
<div id="PrintableArea">
    <div  class="col-md-12"  style="font-family: monospace; ">    
                            <div  class="col-md-3"></div>
                            <div  class="col-md-6">
                                    <table class="table table-bordered"  >
                                        <thead style="background:#D6EEEE;">
                                                    <tr >
                                                        <th colspan="2" style="font-weight:bold;text-align:center">Income Expenditure Summary</th>
                                                    </tr>
                                        </thead>
                                        <tr style="font-weight:bold;text-align:right">
                                            <td> [A] Total Deposit of Member in Taka</td>
                                            <!-- <td><?php echo $total_income;?></td> -->
                                            <!-- <td><?= anchor('payment/summary', $total_income, 'class="edit-link"') ?></td>    -->
                                            <td><a href="javascript:void(0);" class="edit-link" onclick="handleClick('<?= site_url('payment/summary') ?>')"><?= $total_income ?></a></td>   
                                        </tr>
                                        <tr style="font-weight:bold;text-align:right">
                                            <td> [B] Total Expenditure </td>
                                            <!-- <td><?php echo $total_expense;?></td>    -->
                                            <!-- <td><?= anchor('expense/index', $total_expense, 'class="edit-link"') ?></td>    -->
                                            <td><a href="javascript:void(0);" class="edit-link" onclick="handleClick('<?= site_url('expense/index') ?>')"><?= $total_expense ?></a></td> 
                                        </tr>
                                        <tr style="font-weight:bold;text-align:right">
                                            <td> [C] Advance in director's hand</td>
                                            <!-- <td><?php echo $total_balance;?></td>    -->
                                            <td><a href="javascript:void(0);" class="edit-link" onclick="handleClick('<?= site_url('FundTransfer/currentbalance') ?>')"><?= $total_balance ?></a></td>

                                            <!-- <td><?= anchor('FundTransfer/currentbalance', $total_balance, 'class="edit-link"') ?></td>   -->
                                              
                                        </tr>
                                        <tr>
                                            <td style="font-weight:bold;text-align:right">Cash in A/C after Expenditure and Advance[A-B-C]</td>
                                            <td style="font-weight:bold;text-align:right"><?php echo $total_income-$total_expense-$total_balance;?></td>     
                                        </tr>
                                    </table>
                            </div>
                            <div  class="col-md-3"></div>
    </div>  
    <div    class="col-md-12" style="font-family: monospace; ">
            <div class="col-md-2" style="padding:10px;"></div>
            <div class="col-md-8" style="padding:20px;">
                    <table class="table table-striped table-bordered  compact hover tbl"  cellspacing="0">
                        <thead>
                            <tr>
                                <th  style="background:#D6EEEE;padding:7px;text-align:right;">Sl</th>
                                <th  style="background:#D6EEEE;padding:7px;text-align:right;">Name</th>
                                <th  style="background:#D6EEEE;padding:7px;text-align:right;">Cash withdraw from account</th>
                                <th  style="background:#D6EEEE;padding:7px;text-align:right;">Expenditure</th>
                                <th  style="background:#D6EEEE;padding:7px;text-align:right;">Cash in hand</th>
                            </tr>
                        </thead>

                        
                        <?php $totalExp=0;$totalWithdraw=0;$totalCashInHand=0;?>            
                            <?php $sl=1;foreach ($person_info_array as $person_info): ?>
                                    <tr style="padding:5px;text-align:right;">
                                        <td><?php echo $sl++;?></td>      
                                        <td><?php echo $person_info['name'];?></td>      
                                        
                                        <?php 
                                            $person_id = $person_info['person_id'];
                                            $withdraw = $person_info['withdraw'];
                                            $totalWithdraw=$totalWithdraw+$withdraw;                                   
                                            $spent=$person_info['spent'];
                                            $totalExp=$totalExp+$spent;
                                            $cash_in_hand = $person_info['cash_in_hand'];
                                            $totalCashInHand = $totalCashInHand+$cash_in_hand;
                                        ?>
                                    
                                        <td><?= anchor('FundTransfer/read?id='.$person_id, $withdraw, 'class="edit-link"') ?></td>
                                        <td><?= anchor('expense/index?id='.$person_id, $spent, 'class="edit-link"') ?></td>                                    
                                        <td><?php echo $cash_in_hand;?></td>
                                    </tr>
                            <?php endforeach; ?>
                            
                            <tfoot>
                                <tr style="font-weight:bold;background:#FFFFFF;padding:3px;text-align:right"> 
                                    <td colspan="2">Total</td> 
                                    <td><?php echo $totalWithdraw;?></td>  
                                    <td><?php echo $totalExp;?></td>               
                                    <td ><?php echo $totalCashInHand;?></td>                               
                                </tr>
                            </tfoot>
                    </table>
            </div> 
            <div class="col-md-2" style="padding:10px;"></div>
    </div>
    </div>
</div>
<script>
 
  function handleClick(url) {
    // Handle the click event here
    window.location.href = url; // Navigate to the specified URL
  }


  document.getElementById('printPdfButton').addEventListener('click', function () {
    // Select the HTML element to be converted to PDF
    const element = document.getElementById('PrintableArea');

    // Configuration for html2pdf
    const options = {
      margin: 10,
      filename: 'income_expenditure_summary.pdf',
      image: { type: 'jpeg', quality: 0.98 },
      html2canvas: { scale: 2 },
      jsPDF: { unit: 'mm', format: 'a4', orientation: 'landscape' },
      onbeforestart: function (element) {
        // Modify hyperlinks to display as plain text
        const hyperlinks = element.querySelectorAll('a');
        hyperlinks.forEach((link) => {
          link.textContent = link.href; // Display hyperlink as plain text
          link.style.textDecoration = 'none'; // Remove underline
        });
      },
    };

    // Use html2pdf library to generate PDF
    html2pdf(element, options);
  });
</script>

