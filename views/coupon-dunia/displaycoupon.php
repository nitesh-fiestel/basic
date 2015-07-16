    <a href="javascript:void(0);" onclick="downloadCoupon();" class="btn btn-success btn-block" >    Download All the coupons</a> 
    <br><br><br>
                    <?php 
                    for($idx = 0;$idx < 60 && $idx < count($resultStore);$idx++) {
                        $expiry=$resultStore[$idx]['Expiry'];
                        if($expiry=='')
                                $expiry='Activated Forever';
                        $mycode=$resultStore[$idx]['CouponCode'];
                        if($mycode=='' or $mycode=='YOUR OWN COUPON')
                                $mycode='Deal Activated';
                    ?>
                    <div class="row">
                        <div class="col-sm-4" style="text-align: left;">
                            Type: <?= $resultStore[$idx]['CouponType'] ?>
                            
                            
                        </div>
                        <div class="col-sm-5" style="padding-left: 63px;" >
                            <?= "<h2>".$resultStore[$idx]['Site']."</h2>" ?>
                        </div>
                    </div>
                    
                    <div class="row" style="padding-left: 13px;">
                        <?= $resultStore[$idx]['Description']; ?>
                    </div><br>
                    
                    <div class="well well-sm" style="padding-left: 450px;"> 
                                       Code: <?= $mycode ?>
                    </div>
                    
                    <div class="row" style="padding-left: 14px;">
                        <?= '<h5>Expiry: '.$expiry.'</h5>'; ?>
                    </div>
                    
                   
                    <b><hr></b>
                    
                    <?php }?>