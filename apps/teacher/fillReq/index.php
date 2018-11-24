<?php 
    $title="กรอกใบเบิก";
    load_fun('TinyDB');
    $sOrg=selectTb('sub_orgdata','sub_org_name');
    $sOrg=$sOrg[0];
    $s=selectTb('userdata','title,name,surname');
    $fulName=current_user('title').current_user('name').' '.current_user('surname');
    // print_r($sOrg);
?>
<script src="<?php print site_url('system/template/AdminLTE/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js',true); ?>"></script>
<form method="POST" action="result.php">
    <div class="col-md-6">
        <div class="form-group">
            <label>ภาควิชา</label>
            <select class="form-control select2" style="width: 100%;" name="dept">
                <?php
                    $i=0;
                    foreach($sOrg as $k){
                        $i++;
                        print("<option value='$i'>$k</option>");
                    }
                ?>
            </select>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>ใช้ในงาน</label>
            <select class="form-control select2" style="width: 100%;" name="usefor">
                <?php

                ?>
            </select>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label>ต้องการใช้ภายในวันที่</label>
            <div class="input-group date">
                <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                </div>
            <input type="text" class="form-control pull-right" id="datepicker" name="requireDate">
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>ผู้รับพัสดุ</label>
            <select class="form-control select2" style="width: 100%;" name="receiver">
                <?php
                    $i=0;
                    foreach($s as $r){
                        if(strtolower($r['name'])=='administrator')continue;
                        $i++;
                        // $isSelected=$i==1?'selected':'';
                        if($r['title'].$r['name'].' '.$r['surname']==$fulName)$isSelected='selected';
                        else $isSelected='';
                        print "<option value='$i' $isSelected>".$r['title'].$r['name'].' '.$r['surname']."</option>";
                    }
                ?>
            </select>
        </div>
    </div>

    <div class="col-xs-12">
        <div class="box">
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                    <tr>
                        <th width='35%' style="vertical-align : middle; text-align:center" rowspan='2'>รายการ</th>
                        <th style="text-align:center" colspan='3'>จำนวน</th>
                        <th style="vertical-align : middle; text-align:center" rowspan='2'>หน่วยนับ</th>
                        <th style="text-align:center" colspan='3'>ส่วนของงานพัสดุ</th>
                        <th style="vertical-align : middle; text-align:center" rowspan='2'>หมายเหตุ</th>
                        <th>
                    </tr>
                    <tr>
                        <td style="text-align:center">เบิก</td>
                        <td style="text-align:center">จ่าย</td>
                        <td style="text-align:center">ค้างจ่าย</td>
                        <td style="text-align:center">รหัสพัสดุ</td>
                        <td style="text-align:center">ต้นทุน/หน่วย</td>
                        <td style="text-align:center">จำนวนเงิน</td>
                        
                        
                        <!-- <td><span class="label label-success">Approved</span></td>
                        <td><input type="text" name="Monday2" size="3" maxlength="4" value="" onkeypress="return inputLimiter(event,'Numbers')"> <input type="checkbox" tabindex="-1" name="Stime2">Sick?<input type="checkbox" tabindex="-1" name="Vac2">Vacation?</td> -->
                    </tr>
                    <?php for($i=0;$i<5;$i++){ ?>
                    <tr>
                        <!-- <input type="hidden" name="vat_<?php print $i;?>"> -->
                        <td><input type="text" name="listName_<?php print $i;?>" style="width:100%; text-align: left;"></td>
                        <td><input type="text" name="request_<?php print $i;?>" id="value" style="width:100%; text-align: right;"></td>
                        <td><input type="text" name="dispense_<?php print $i;?>" id="value" style="width:100%; text-align: right;"></td>
                        <td><input type="text" name="remain_<?php print $i;?>" id="value" style="width:100%; text-align: right;"></td>
                        <td><select class="form-control select2" style="width: 100%;" name="unit">
                            <?php
                                $j=0;
                                foreach($s as $r){
                                    if(strtolower($r['name'])=='administrator')continue;
                                    $j++;
                                    // $isSelected=$i==1?'selected':'';
                                    if($r['title'].$r['name'].' '.$r['surname']==$fulName)$isSelected='selected';
                                    else $isSelected='';
                                    print "<option value='$j' $isSelected>".$r['title'].$r['name'].' '.$r['surname']."</option>";
                                }
                            ?>
                            </select>
                        </td>
                        <td><input type="text" name="material_id_<?php print $i;?>" style="width:100%; text-align: right;"></td>
                        <!-- <td><input type="text" name="cost_<?php print $i;?>" id="test" style="width:100%" onkeypress="this.style.width = ((this.value.length + 4) * 8) + 'px';"></td>
                        <td><input type="text" name="amount_<?php print $i;?>" id="test" style="width:100%" onkeypress="this.style.width = ((this.value.length + 4) * 8) + 'px';"></td> -->
                        <td><input type="text" name="cost_<?php print $i;?>" id="money" style="width:100%; text-align: right;"></td>
                        <td><input type="text" name="amount_<?php print $i;?>" id="money" style="width:100%; text-align: right;" disabled></td>
                        <td><input type="text" name="" id="" style="width:100%; text-align: right;"></td>
                    </tr>
                    <?php
                    }
                    ?>
                    <tr>
                        <td style="text-align: right;"><label>ส่วนลด</label></td>
                        <td colspan="4"><input type="text" name="textDiscount" style="width:100%; text-align: left;" disabled></td>
                        <td colspan="3"><input type="text" name="discount" id="money" style="width:100%; text-align: right;"></td>
                        <td><input type="text" style="width:100%; text-align: right;" disabled></td>
                    </tr>
                    <tr>
                        <td style="text-align: right;"><label>รวมราคา</label></td>
                        <td colspan='4'><input type="text" name="textBeforeTaxAmount" style="width:100%; text-align: right;" disabled></td>
                        <td colspan="3"><input type="text" name="beforeTaxAmount" id="money" style="width:100%; text-align: right;" disabled></td>
                        <td><input type="text" style="width:100%; text-align: right;" disabled></td>
                    </tr>
                    <tr>
                        <td style="text-align: right;"><label>ภาษีมูลค่าเพิ่ม 7%</label></td>
                        <td colspan="4"><input type="text" name="textTaxAmount" style="width:100%; text-align: left;" disabled></td>
                        <td colspan="3"><input type="text" name="taxAmount" id="money" style="width:100%; text-align: right;" disabled></td>
                        <td><input type="text" style="width:100%; text-align: right;" disabled></td>
                    </tr>
                </table>
            </div>
        </div>
        <button type="submit" class="btn btn-primary pull-right">Submit</button>
    </div>
</form>
<script>
    $('input[id=money]').focusout(function(){
        if(this.value!=''){
        this.value=parseFloat(this.value.replace(/,/g, ""))
        .toFixed(2)
        .toString()
        .replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }
    });

    $('input[id=value]').focusout(function(){
        if(this.value!=''){
        this.value=parseFloat(this.value.replace(/,/g, ""))
        .toString()
        .replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }
    });

    <?php for($i=0;$i<5;$i++){ ?>
        // $('input[name=<?php print "amount_$i";?>').focusout(function(){
        //     if(this.value=='')this.value=0;
        // });
        // $('input[name='+amount+']').val(15);
        /************************* cost field *********************/
            $('input[name=<?php print "cost_$i" ;?>]').change(function(){
                $('input[name=<?php print "cost_$i" ;?>]').val(this.value);
                var request_val=$('input[name=<?php print "request_$i" ;?>]').val()==''?0:$('input[name=<?php print "request_$i" ;?>]').val().replace(/,/g, "");
                var dispense_val=$('input[name=<?php print "dispense_$i" ;?>]').val()==''?0:$('input[name=<?php print "dispense_$i" ;?>]').val().replace(/,/g, "");
                var remain_val=$('input[name=<?php print "remain_$i" ;?>]').val()==''?0:$('input[name=<?php print "remain_$i" ;?>]').val().replace(/,/g, "");
                var totalVal=   parseInt(request_val)+
                                parseInt(dispense_val)+
                                parseInt(remain_val);
                
                var totalAmount=parseFloat(this.value.replace(/,/g, ""))*parseFloat(totalVal);
                totalAmount=parseFloat(totalAmount).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                
                $('input[name=<?php print "amount_$i" ;?>]').val(totalAmount);
                
                var sumAmount=0;
                <?php for($j=0;$j<5;$j++){ ?>
                    var textAmount=$('input[name=<?php print"amount_$j";?>').val()==''?0:$('input[name=<?php print"amount_$j";?>').val().replace(/,/g, "");
                    var amount=parseFloat(textAmount);
                    sumAmount+=amount;
                    // alert("sumAmount"+sumAmount);
                
                <?php } ?>
                
                var discount=$('input[name=discount]').val()==''?0:$('input[name=discount]').val().replace(/,/g, "");
                sumAmount-=parseFloat(discount);

                var taxAmount=((sumAmount*100)/107).toFixed(2);
                var beforeTaxAmount=(sumAmount-taxAmount).toFixed(2);

                $('input[name=taxAmount]').val(taxAmount);
                $('input[name=beforeTaxAmount]').val(beforeTaxAmount);
            })
            .focusout(function(){
                if(this.value=='')this.value=0;
            });

        
        

        /************************* request field *********************/
            $('input[name=<?php print "request_$i" ;?>]')
            .change(function(){
                $('input[name=<?php print "request_$i" ;?>]').val(this.value);
                var request_val=this.value;
                var dispense_val=$('input[name=<?php print "dispense_$i" ;?>]').val()==''?0:$('input[name=<?php print "dispense_$i" ;?>]').val().replace(/,/g, "");
                var remain_val=$('input[name=<?php print "remain_$i" ;?>]').val()==''?0:$('input[name=<?php print "remain_$i" ;?>]').val().replace(/,/g, "");
                var cost_val=$('input[name=<?php print "cost_$i";?>').val()==''?0:$('input[name=<?php print "cost_$i";?>').val().replace(/,/g, "");

                var totalVal=   parseFloat(request_val)+
                                parseFloat(dispense_val)+
                                parseFloat(remain_val);

                var totalAmount=parseFloat(cost_val)*parseFloat(totalVal);
                totalAmount=parseFloat(totalAmount).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                $('input[name=<?php print "amount_$i" ;?>]').val(totalAmount);

                var sumAmount=0;
                <?php for($j=0;$j<5;$j++){ ?>
                    var textAmount=$('input[name=<?php print"amount_$j";?>').val()==''?0:$('input[name=<?php print"amount_$j";?>').val().replace(/,/g, "");
                    var amount=parseFloat(textAmount);
                    sumAmount+=amount;
                    // alert("sumAmount"+sumAmount);
                
                <?php } ?>
                
                var discount=$('input[name=discount]').val()==''?0:$('input[name=discount]').val().replace(/,/g, "");
                sumAmount-=parseFloat(discount);

                var taxAmount=((sumAmount*100)/107).toFixed(2);
                var beforeTaxAmount=(sumAmount-taxAmount).toFixed(2);

                $('input[name=taxAmount]').val(taxAmount);
                $('input[name=beforeTaxAmount]').val(beforeTaxAmount);
            })
            .focusout(function(){
                if(this.value=='')this.value=0;
            });

        /************************* dispense field *********************/
            $('input[name=<?php print "dispense_$i" ;?>]')
            .change(function(){
                $('input[name=<?php print "dispense_$i" ;?>]').val(this.value);
                var request_val=$('input[name=<?php print "request_$i" ;?>]').val()==''?0:$('input[name=<?php print "request_$i" ;?>]').val().replace(/,/g, "");
                var dispense_val=this.value;
                var remain_val=$('input[name=<?php print "remain_$i" ;?>]').val()==''?0:$('input[name=<?php print "remain_$i" ;?>]').val().replace(/,/g, "");
                var cost_val=$('input[name=<?php print "cost_$i";?>').val()==''?0:$('input[name=<?php print "cost_$i";?>').val().replace(/,/g, "");
                
                var totalVal=   parseFloat(request_val)+
                                parseFloat(dispense_val)+
                                parseFloat(remain_val);
                
                var totalAmount=parseFloat(cost_val)*parseFloat(totalVal);
                totalAmount=parseFloat(totalAmount).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                $('input[name=<?php print "amount_$i" ;?>]').val(totalAmount);
                
                var sumAmount=0;
                <?php for($j=0;$j<5;$j++){ ?>
                    var textAmount=$('input[name=<?php print"amount_$j";?>').val()==''?0:$('input[name=<?php print"amount_$j";?>').val().replace(/,/g, "");
                    var amount=parseFloat(textAmount);
                    sumAmount+=amount;
                    // alert("sumAmount"+sumAmount);
                
                <?php } ?>
                
                var discount=$('input[name=discount]').val()==''?0:$('input[name=discount]').val().replace(/,/g, "");
                sumAmount-=parseFloat(discount);

                var taxAmount=((sumAmount*100)/107).toFixed(2);
                var beforeTaxAmount=(sumAmount-taxAmount).toFixed(2);

                $('input[name=taxAmount]').val(taxAmount);
                $('input[name=beforeTaxAmount]').val(beforeTaxAmount);
            })
            .focusout(function(){
                if(this.value=='')this.value=0;
            });
        
        /************************* remain field *********************/
            $('input[name=<?php print "remain_$i" ;?>]')
            .change(function(){
                $('input[name=<?php print "remain_$i" ;?>]').val(this.value);
                var remain_val=this.value;
                var request_val=$('input[name=<?php print "request_$i" ;?>]').val()==''?0:$('input[name=<?php print "request_$i" ;?>]').val().replace(/,/g, "");
                var dispense_val=$('input[name=<?php print "dispense_$i" ;?>]').val()==''?0:$('input[name=<?php print "dispense_$i" ;?>]').val().replace(/,/g, "");
                var cost_val=$('input[name=<?php print "cost_$i";?>').val()==''?0:$('input[name=<?php print "cost_$i";?>').val().replace(/,/g, "");
                
                var totalVal=   parseFloat(request_val)+
                                parseFloat(dispense_val)+
                                parseFloat(remain_val);
                
                var totalAmount=parseFloat(cost_val)*parseFloat(totalVal);
                totalAmount=parseFloat(totalAmount).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                $('input[name=<?php print "amount_$i" ;?>]').val(totalAmount);

                var sumAmount=0;
                <?php for($j=0;$j<5;$j++){ ?>
                    var textAmount=$('input[name=<?php print"amount_$j";?>').val()==''?0:$('input[name=<?php print"amount_$j";?>').val().replace(/,/g, "");
                    var amount=parseFloat(textAmount);
                    sumAmount+=amount;
                    // alert("sumAmount"+sumAmount);
                
                <?php } ?>
                
                var discount=$('input[name=discount]').val()==''?0:$('input[name=discount]').val().replace(/,/g, "");
                sumAmount-=parseFloat(discount);

                var taxAmount=((sumAmount*100)/107).toFixed(2);
                var beforeTaxAmount=(sumAmount-taxAmount).toFixed(2);

                $('input[name=taxAmount]').val(taxAmount);
                $('input[name=beforeTaxAmount]').val(beforeTaxAmount);
            })
            .focusout(function(){
                if(this.value=='')this.value=0;
            });
    <?php } ?>
    $('input[name=discount]').change(function(){
        var sumAmount=0;
        
        <?php for($j=0;$j<5;$j++){ ?>
            var textAmount=$('input[name=<?php print"amount_$j";?>').val()==''?0:$('input[name=<?php print"amount_$j";?>').val().replace(/,/g, "");
            var amount=parseFloat(textAmount);
            sumAmount+=amount;
        <?php } ?>
        
        var discount=$('input[name=discount]').val()==''?0:$('input[name=discount]').val().replace(/,/g, "");
        sumAmount-=parseFloat(discount);

        var taxAmount=((sumAmount*100)/107).toFixed(2);
        var beforeTaxAmount=(sumAmount-taxAmount).toFixed(2);

        $('input[name=taxAmount]').val(taxAmount);
        $('input[name=beforeTaxAmount]').val(beforeTaxAmount);
    });
    $('#datepicker').datepicker({
      autoclose: true
    })

</script>