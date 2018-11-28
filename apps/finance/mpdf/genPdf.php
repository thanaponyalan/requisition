<?php
    $id=1;
    load_fun('mpdf');
    load_fun('tinyDB');
    $data=selectTb('req_material','*','id="'.$id.'"');
    $subData=selectTb('req_item','material_name,request_quantity,unit_id,cost_per_unit,note','req_id="'.$id.'"');
    $data=$data[0];
    print_r($data);
    print_r($subData);
    $html = '
    <h1 style="font-size: 16pt; font-weight: bold; text-align: center;">ใบเบิกวัสดุ</h1>
    <table border="1" style="border-collapse:collapse; margin-left: auto; margin-right: auto;">
    <tr>
        <td style="font-weight: bold; font-size: 10pt; width: 0.44in; text-align:center;" rowspan="2">ลำดับ</td>
        <td style="font-weight: bold; font-size: 10pt; vertical-align : middle; text-align:center; width:2.71in;" rowspan="2">รายการ</td>
        <td style="font-weight: bold; font-size: 10pt; text-align:center; width: 1.68in;" colspan="3">จำนวน</td>
        <td style="font-weight: bold; font-size: 10pt; text-align:center; width: 2.31in;" colspan="5">ส่วนของงานพัสดุ</td>
        <td style="font-weight: bold; font-size: 10pt; vertical-align : middle; width:0.55in; text-align:center;" rowspan="2">หมายเหตุ</td>
    </tr>
    <tr>
        <td style="font-weight: bold; font-size: 10pt; text-align:center; width: 0.79in;">เบิก</td>
        <td style="font-weight: bold; font-size: 10pt; text-align:center; width: 0.43in;">จ่าย</td>
        <td style="font-weight: bold; font-size: 10pt; text-align:center; width: 0.46in;">ค้างจ่าย</td>
        <td style="font-weight: bold; font-size: 10pt; text-align:center; width: 0.56in;">รหัสพัสดุ</td>
        <td style="font-weight: bold; font-size: 10pt; text-align:center; width: 0.89in;" colspan="2">ต้นทุน/หน่วย</td>
        <td style="font-weight: bold; font-size: 10pt; text-align:center; width: 0.86in;" colspan="2">จำนวนเงิน</td>
    </tr>';
    $i=0;
    foreach($subData as $k=>$v){
        $strCost=$v['cost_per_unit'];
        $qty=$v['request_quantity'];
        $moneyCost = number_format($strCost,2,'.',',');
        $moneyCost=explode('.',$moneyCost);
        $sumAmount=0;
        if(is_numeric($strCost)&&is_numeric($qty))$sumAmount=$strCost*$qty;
        $moneySumAmount=number_format($sumAmount,2,'.',',');
        $moneySumAmount=explode('.',$moneySumAmount);
        $i++;
        $html.=
        '<tr>
            <td style="font-size: 14pt; text-align:center">'.$i.'</td>
            <td style="font-size: 14pt; text-align:left;">'.$v['material_name'].'</td>
            <td style="font-size: 14pt; text-align:center">'.$v['request_quantity'].'</td>
            <td style="font-size: 14pt; text-align:center"></td>
            <td style="font-size: 14pt; text-align:center"></td>
            <td style="font-size: 14pt; text-align:center"></td>
            <td style="font-size: 14pt; text-align:right; width: 0.6in;">'.$moneyCost[0].'</td>
            <td style="font-size: 14pt; text-align:left; width: 0.29in;">'.$moneyCost[1].'</td>
            <td style="font-size: 14pt; text-align:right; width: 0.56in;">'.$moneySumAmount[0].'</td>
            <td style="font-size: 14pt; text-align:left; width: 0.3in;">'.$moneySumAmount[1].'</td>
            <td style="font-size: 14pt; text-align:center">'.$v['note'].'</td>
        </tr>';
    }
    while($i<5){
        $i++;
        $html.=
        '<tr>
            <td style="padding-bottom: 0.22in; font-size: 10pt; text-align:center"></td>
            <td style="font-size: 10pt; text-align:center; border-bottom: 0;"></td>
            <td style="font-size: 10pt; text-align:center"></td>
            <td style="font-size: 10pt; text-align:center"></td>
            <td style="font-size: 10pt; text-align:center"></td>
            <td style="font-size: 10pt; text-align:center"></td>
            <td style="font-size: 10pt; text-align:center"></td>
            <td style="font-size: 10pt; text-align:center"></td>
            <td style="font-size: 10pt; text-align:center"></td>
            <td style="font-size: 10pt; text-align:center"></td>
            <td style="font-size: 10pt; text-align:center"></td>
        </tr>';
    }
    $discount=$data['discount'];
    $strDiscount=explode('.',number_format($discount,2,'.',','));
    $html.=
    '<tr>
        <td style="font-size: 10pt; text-align:center"></td>
        <td style="font-size: 14pt; text-align:right;">ส่วนลด</td>
        <td style="font-size: 10pt; text-align:center"></td>
        <td style="font-size: 10pt; text-align:center"></td>
        <td style="font-size: 10pt; text-align:center"></td>
        <td style="font-size: 10pt; text-align:center"></td>
        <td style="font-size: 10pt; text-align:center"></td>
        <td style="font-size: 10pt; text-align:center"></td>
        <td style="font-size: 14pt; text-align:right">'.$strDiscount[0].'</td>
        <td style="font-size: 14pt; text-align:left">'.$strDiscount[1].'</td>
        <td style="font-size: 10pt; text-align:center"></td>
    </tr>';
        
    $totalAmount=$data['total_cost'];
    $tax=$data['vat'];
    $beforeTaxAmount=is_numeric($totalAmount)&&is_numeric($tax)?$totalAmount-$tax:$totalAmount;
    $strBefore=explode('.',number_format($beforeTaxAmount,2,'.',','));
    $html.=
    '<tr>
        <td style="font-size: 10pt; text-align:center"></td>
        <td style="font-size: 14pt; text-align:right;">รวมราคา</td>
        <td style="font-size: 10pt; text-align:center"></td>
        <td style="font-size: 10pt; text-align:center"></td>
        <td style="font-size: 10pt; text-align:center"></td>
        <td style="font-size: 10pt; text-align:center"></td>
        <td style="font-size: 10pt; text-align:center"></td>
        <td style="font-size: 10pt; text-align:center"></td>
        <td style="font-size: 14pt; text-align:right">'.$strBefore[0].'</td>
        <td style="font-size: 14pt; text-align:left">'.$strBefore[1].'</td>
        <td style="font-size: 10pt; text-align:center"></td>
    </tr>';
    
    $strTax=explode('.',number_format($tax,2,'.',','));
    $html.=
    '<tr>
        <td style="font-size: 10pt; text-align:center"></td>
        <td style="font-size: 14pt; text-align:right;">ภาษีมูลค่าเพิ่ม 7%</td>
        <td style="font-size: 10pt; text-align:center"></td>
        <td style="font-size: 10pt; text-align:center"></td>
        <td style="font-size: 10pt; text-align:center"></td>
        <td style="font-size: 10pt; text-align:center"></td>
        <td style="font-size: 10pt; text-align:center"></td>
        <td style="font-size: 10pt; text-align:center"></td>
        <td style="font-size: 14pt; text-align:right">'.$strTax[0].'</td>
        <td style="font-size: 14pt; text-align:left">'.$strTax[1].'</td>
        <td style="font-size: 10pt; text-align:center"></td>
    </tr>';

    
    $html.='</table>
    ';
		$click='<a href="'.genPdf(true,$html).'">Click Here to Download as PDF</a>';
		print ($html);
		print($click);