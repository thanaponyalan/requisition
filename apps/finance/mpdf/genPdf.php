<?php
    $id=2;
    load_fun('mpdf');
    load_fun('tinyDB');
    $data=selectTb('req_material','*','id="'.$id.'"');
    $subData=selectTb('req_item','material_name,request_quantity,unit_id,cost_per_unit,note','req_id="'.$id.'"');
    $data=$data[0];
    print_r($data);
    print_r($subData);
    $TAB='<span style="visibility: hidden; color: white;">XXXXXXXX</span>';
    $html = '
    <table>
        <tr>
            <td rowspan="3" style="width: 2.31in;"><img style="width: 0.89in; height: 0.89in;" src="'.site_url('system/pictures/logo/institute.jpg',true).'"></td>
            <td rowspan="3" style="width: 2.31in;"><h1 style="font-size: 20pt; font-weight: bold; vertical-align : middle; text-align: center;"><span></span>บันทึกรายงานขอซื้อ/จ้าง</h1></td>
            <td style="width: 2.31in; font-size: 16pt; font-weight: bold; vertical-align : top; text-align: right;">แบบ พจ.1</td>
        </tr>
        <tr>
            <td></td>
        </tr>
        <tr>
            <td></td>
        </tr>
    </table>

    <table width="100%">
        <tr>
            <td width="10%" style="font-size: 16pt;">    <b>หน่วยงาน</b> </td>
            <td width="80%" style="font-size: 15pt; border-bottom: 1px solid black; border-style: dotted;">
                คณะครุศาสตร์อุตสาหกรรมและเทคโนโลยี ส่วนสนับสนุนวิชาการ โทร. 3681, 6087, 6091
            </td>
            <td width="10%"></td>
        </tr>
    </table>

    <table width="100%">
        <tr>
            <td width="5%" style="font-size: 16pt;">     <b>ที่</b>          </td>
            <td width="17%" style="font-size: 15pt;">    ศธ  0524.04(1.5)/ </td>
            <td width="28%" style="border-bottom: 1px solid black; border-style: dotted;"></td>
            <td width="10%"></td>
            <td width="5%" style="font-size: 16pt;">     <b>วันที่</b>       </td>
            <td width="35%" style="font-size: 15pt; border-bottom: 1px solid black; border-style: dotted;"></td>
        </tr>
    </table>
    
    <table width="100%">
        <tr>
            <td width="6%" style="font-size: 16pt;">  <b>เรื่อง</b>   </td>
            <td width="94%" style="font-size: 15pt; border-bottom: 1px solid black; border-style: dotted;"></td>
        </tr>
    </table>

    <table width="100%">
        <tr>
        <td width="100%" style="border-bottom: 1px solid black;"></td>
        </tr>
    </table>

    <table width="100%">
        <tr>
            <td width="5%" style="font-size: 16pt;">  <b>เรียน</b>   </td>
            <td width="10%" style="font-size: 15pt; border-bottom: 1px solid black; border-style: dotted;">อธิการบดี</td>
            <td width="85%"></td>
        </tr>
    </table>

    <table width="100%">
        <tr>
            <td width="5%" style="font-size: 15pt;"></td>
            <td width="20%" style="font-size: 15pt;">ด้วยภาควิชา/งานพัสดุ</td>
            <td width="23%" style="font-size: 15pt; text-align: center; border-bottom: 1px solid black; border-style: dotted;">ครุศาสตร์วิศวกรรม</td>
            <td width="28%" style="font-size: 15pt;">ขอรายงานเสนอเพื่อขอจัดซื้อ/จ้าง</td>     
            <td width="24%" style="font-size: 15pt; text-align: center; border-bottom: 1px solid black; border-style: dotted;">วัสดุการศึกษา</td>
        </tr>
    </table>

    <table width="100%">
        <tr>
            <td width="5%" style="font-size: 15pt;">ให้แก่</td>
            <td width="35%" style="font-size: 15pt; text-align: center; border-bottom: 1px solid black; border-style: dotted;">ภาควิชาครุศาสตร์วิศวกรรม</td>
            <td width="15%" style="font-size: 15pt;">เนื่องจากมีความจำเป็น</td>
            <td width="45%" style="font-size: 15pt; text-align: center; border-bottom: 1px solid black; border-style: dotted;">เพื่อใช้ในการเรียนการสอน</td>
        </tr>
    </table>

    <table width="70%">
        <tr>
            <td width="50%" style="font-size: 15pt; text-align: center; border-bottom: 1px solid black; border-style: dotted;">หลักสูตรครุศาสตร์วิศวกรรม 5 ปี (ป.ตรี)</td>
            <td width="20%"style="font-size: 15pt;">ตามรายการและราคาต่อไปนี้</td>
        </tr>
    </table>
    <br>

    <table border="1" style="border-collapse:collapse; margin-left: auto; margin-right: auto;">
        <tr>
            <td style="font-weight: bold; font-size: 14pt; text-align: center; width: 0.5in;">ลำดับที่</td>
            <td style="font-weight: bold; font-size: 14pt; text-align: center; width: 0.63in;">รหัสพัสดุ GPSC</td>
            <td style="font-weight: bold; font-size: 14pt; text-align: center; width: 2.22in;">รายการและรายละเอียด</td>
            <td style="font-weight: bold; font-size: 14pt; text-align: center; width: 0.79in;">จำนวน หน่วย</td>
            <td style="font-weight: bold; font-size: 14pt; text-align: center; width: 0.98in;">ราคาซื้อ/จ้าง ครั้งหลังสุด หน่วยละ(บาท)</td>
            <td style="font-weight: bold; font-size: 14pt; text-align: center; width: 1.07in;">ราคาซื้อ/จ้าง ครั้งนี้ หน่วยละ(บาท)</td>
            <td style="font-weight: bold; font-size: 14pt; text-align: center; width: 0.74in;">รวมเงิน (บาท)</td>
        </tr>';
        $i=0;
        foreach($subData as $k=>$v){
            $unitId=$v['unit_id'];
            $unitName=selectTb('unit_data','unit_name','id="'.$unitId.'"');
            $unitName=$unitName[0]['unit_name'];
            $strCost=$v['cost_per_unit'];
            $qty=$v['request_quantity'];
            $moneyCost = number_format($strCost,2,'.',',');
            // $moneyCost=explode('.',$moneyCost);
            $sumAmount=0;
            if(is_numeric($strCost)&&is_numeric($qty))$sumAmount=$strCost*$qty;
            $moneySumAmount=number_format($sumAmount,2,'.',',');
            // $moneySumAmount=explode('.',$moneySumAmount);
            $i++;
            $html.=
            '<tr>
                <td style="font-size: 14pt; text-align:center">'.$i.'</td>
                <td style="font-size: 14pt; text-align:center"></td>
                <td style="font-size: 14pt; text-align:left;">'.$v['material_name'].'</td>
                <td style="font-size: 14pt; text-align:center">'.$v['request_quantity']." ".$unitName.'</td>
                <td style="font-size: 14pt; text-align:center"></td>
                <td style="font-size: 14pt; text-align:right;">'.$moneyCost.'</td>
                <td style="font-size: 14pt; text-align:right;">'.$moneySumAmount.'</td>
            </tr>';
        }
        while($i<5){
            $i++;
            $html.=
            '<tr>
                <td style="font-size: 14pt; text-align:center;"><span style="visibility: hidden; color: white; font-size: 14pt;">X</span></td>
                <td style="font-size: 14pt; text-align:center; border-bottom: 0;"></td>
                <td style="font-size: 14pt; text-align:center"></td>
                <td style="font-size: 14pt; text-align:center"></td>
                <td style="font-size: 14pt; text-align:center"></td>
                <td style="font-size: 14pt; text-align:center"></td>
                <td style="font-size: 14pt; text-align:center"></td>
            </tr>';
        }
        $discount=$data['discount'];
        $strDiscount=(number_format($discount,2,'.',','));
        $html.=
        '<tr>
            <td style="font-size: 10pt; text-align:center"></td>
            <td style="font-size: 10pt; text-align:center"></td>
            <td style="font-size: 10pt; text-align:center"></td>
            <td style="font-size: 10pt; text-align:center"></td>
            <td style="font-size: 10pt; text-align:center"></td>
            <td style="font-size: 14pt; text-align:right;">ส่วนลด</td>
            <td style="font-size: 14pt; text-align:right">'.$strDiscount.'</td>
        </tr>';
            
        $totalAmount=$data['total_cost'];
        $tax=$data['vat'];
        $beforeTaxAmount=is_numeric($totalAmount)&&is_numeric($tax)?$totalAmount-$tax:$totalAmount;
        $strBefore=(number_format($beforeTaxAmount,2,'.',','));
        $html.=
        '<tr>
            <td style="font-size: 10pt; text-align:center"></td>
            <td style="font-size: 10pt; text-align:center"></td>
            <td style="font-size: 10pt; text-align:center"></td>
            <td style="font-size: 10pt; text-align:center"></td>
            <td style="font-size: 10pt; text-align:center"></td>
            <td style="font-size: 14pt; text-align:right;">รวมราคา</td>
            <td style="font-size: 14pt; text-align:right">'.$strBefore.'</td>
        </tr>';
        
        $strTax=(number_format($tax,2,'.',','));
        $html.=
        '<tr>
            <td style="font-size: 10pt; text-align:center"></td>
            <td style="font-size: 10pt; text-align:center"></td>
            <td style="font-size: 10pt; text-align:center"></td>
            <td style="font-size: 10pt; text-align:center"></td>
            <td style="font-size: 10pt; text-align:center"></td>
            <td style="font-size: 14pt; text-align:right;">ภาษีมูลค่าเพิ่ม 7%</td>
            <td style="font-size: 14pt; text-align:right">'.$strTax.'</td>
        </tr>';

        $strTotalAmount=number_format($totalAmount,2,'.',',');
        $html.=
        '<tr>
            <td style="font-size: 10pt; text-align:center; border-bottom: 0; border-left: 0; border-right: 0;"></td>
            <td style="font-size: 10pt; text-align:center; border-bottom: 0; border-left: 0; border-right: 0;"></td>
            <td style="font-size: 10pt; text-align:center; border-bottom: 0; border-left: 0; border-right: 0;"></td>
            <td style="font-size: 10pt; text-align:center; border-bottom: 0; border-left: 0; border-right: 0;"></td>
            <td style="font-size: 10pt; text-align:center; border-bottom: 0; border-left: 0; border-right: 0;"></td>
            <td style="font-size: 14pt; text-align:center; border-bottom: 0; border-left: 0;">รวมเป็นเงินทั้งสิ้น</td>
            <td style="font-size: 14pt; text-align:right;">'.$strTotalAmount.'</td>
        </tr>
        <tr>
            <td style="font-size: 10pt; text-align:center; border-bottom: 0; border-left: 0; border-right: 0; border-top: 0;"></td>
            <td style="font-size: 10pt; text-align:center; border-bottom: 0; border-left: 0; border-right: 0; border-top: 0;"></td>
            <td style="font-size: 10pt; text-align:center; border-bottom: 0; border-left: 0; border-right: 0; border-top: 0;"></td>
            <td style="font-size: 10pt; text-align:center; border-bottom: 0; border-left: 0; border-right: 0; border-top: 0;"></td>
            <td style="font-size: 10pt; text-align:center; border-bottom: 0; border-left: 0; border-right: 0; border-top: 0;"></td>
            <td style="font-size: 14pt; text-align:center; border-bottom: 0; border-left: 0; border-right: 0; border-top: 0;"></td>
            <td style="font-size: 14pt; text-align:right; border-left: 0; border-right: 0; border-top: 0;"></td>
        </tr>
        ';
    $html.='</table>

    <table width="100%">
        <tr>
            <td width="100%" colspan="6" style="font-size: 14pt;">หน่วยงานขอใช้เงินในการจัดหา ตามรหัสดังนี้</td>
        </tr>
    </table>
    <table width="100%">
        <tr>
            <td width="6%" style="font-size: 14pt;">วิทยาเขต/คณะ</td>
            <td width="44%" style="font-size: 14pt; text-align: center; border-bottom: 1px solid black; border-style: dotted;">คณะครุศาสตร์อุตสาหกรรมและเทคโนโลยี</td>
            <td width="25%" style="font-size: 14pt;">รหัสวิทยาเขต/คณะ/สำนัก/บัณฑิต</td>
            <td width="25%" style="font-size: 14pt; text-align: center; border-bottom: 1px solid black; border-style: dotted;">03</td>
        </tr>
    </table>
    <table width="100%">
        <tr>
            <td width="7%" style="font-size: 14pt;">ภาควิชา/กอง/ฝ่าย</td>
            <td width="43%" style="font-size: 14pt; text-align: center; border-bottom: 1px solid black; border-style: dotted;">ครุศาสตร์วิศวกรรม</td>
            <td width="15%" style="font-size: 14pt;">รหัสภาควิชา/กอง/ฝ่าย</td>
            <td width="35%" style="font-size: 14pt; text-align: center; border-bottom: 1px solid black; border-style: dotted;">03050</td>
        </tr>
    </table>';
    
    //ใบเบิกวัสดุ
    $html.='<!-- <table border="1" style="border-collapse:collapse; margin-left: auto; margin-right: auto;">
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
                <td style="font-size: 14pt; text-align:center">'.$v['request_quantity']." ".$unitName.'</td>
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

        
    $html.='</table> -->
    ';
		$click='<a href="'.genPdf(true,false,$html).'">Click Here to Download as PDF</a>';
		print ($html);
		print($click);